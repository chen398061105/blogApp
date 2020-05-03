<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>后台用户列表</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>

    @include('admin.public.styles')
    @include('admin.public.script')
    <style>
        .layui-table th {
            text-align: center;
        }
    </style>
</head>

<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a href="">演示</a>
            <a>
              <cite>导航元素</cite></a>
          </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="row" style="float: left;padding-top: 7px;padding-left: 25px;padding-right: 5px">
                    <button class=" layui-btn"
                            onclick="xadmin.open('添加角色','{{ url('admin/role/create') }}',600,450)"><i
                                class="layui-icon"></i>添加
                    </button>
                </div>
                <form method="POST" action="{{ url('admin/user/del') }}">
                    {{ csrf_field() }}
                    <div class="layui-inline layui-card-header">
                        <button class="layui-btn layui-btn-danger" type="submit"><i
                                    class="layui-icon"></i>批量删除
                        </button>
                    </div>
                    <div class="layui-card-body ">
                        <table class="layui-table">
                            <thead>
                            <tr>
                                <th>
                                </th>
                                <th>ID</th>
                                <th>角色名</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td align="center" width="50px">
                                        <input type="checkbox" class="box" lay-skin="primary" name="ids[]"
                                               value="{{ $role->id }}">
                                    </td>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->role_name }}</td>
                                    <td class="td-manage">
                                        <a title="授权"    href="{{ url('admin/role/auth/'.$role->id )}}">
                                            <i class="layui-icon">&#xe612;</i>
                                        </a>
                                        <a title="编辑"
                                           onclick="xadmin.open('编辑','{{ url('admin/user/'.$role->id.'/edit') }}',600,400)"
                                           href="javascript:;">
                                            <i class="layui-icon">&#xe642;</i>
                                        </a>
                                        <a title="删除" onclick="member_del(this,{{ $role->id }})" href="javascript:;">
                                            <i class="layui-icon">&#xe640;</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </form>
                <div class="layui-card-body ">
                    <div class="page">
                        {{ $roles->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script>
    layui.use(['laydate', 'form'], function () {
        var laydate = layui.laydate;
        var form = layui.form;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

    /*用户-停用*/
    function member_stop(obj, id) {
        layer.confirm('确认要停用吗？', function (index) {

            if ($(obj).attr('title') == '启用') {

                //发异步把用户状态进行更改
                $(obj).attr('title', '停用')
                $(obj).find('i').html('&#xe62f;');

                $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                layer.msg('已停用!', {icon: 5, time: 1000});

            } else {
                $(obj).attr('title', '启用')
                $(obj).find('i').html('&#xe601;');

                $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                layer.msg('已启用!', {icon: 5, time: 1000});
            }

        });
    }

    /*用户-删除*/
    function member_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            //发异步删除数据
            //参数1 url 参数2 方法和token 参数3 闭包函数
            $.post('/admin/user/' + id, {
                "_method": "delete", "_token": "{{ csrf_token() }}"
            }, function (data) {
                if (data.status == 0) {
                    $(obj).parents("tr").remove();
                    layer.msg(data.message, {icon: 6, time: 2000});
                } else {
                    layer.msg(data.message, {icon: 5, time: 2000});
                }

            })
        });
    }

</script>
</html>