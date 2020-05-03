<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <title>分类列表</title>
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

<body >
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
                <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5" method="get" action="{{ url('admin/category') }}">
                        <div class="layui-input-inline">
                            <select name="num" lay-filter="aihao">
                                <option value="5" @if($request->input('num') == 5) selected @endif>每页显示5条数据</option>
                                <option value="10" @if($request->input('num') == 10) selected @endif>每页显示10条数据</option>
                            </select>
                        </div>

                        <div class="layui-inline layui-show-xs-block">
                            <input type="text" name="catename" value="{{ $request->input('catename') }}"
                                   placeholder="请输入分类名" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn" lay-submit="" lay-filter="sreach"><i
                                        class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>
                <div class="row" style="float: left;padding-top: 7px;padding-left: 25px;padding-right: 5px">
                    <button class=" layui-btn"
                            onclick="xadmin.open('添加分类','{{ url('admin/category/create') }}',600,450)"><i
                                class="layui-icon"></i>添加
                    </button>
                </div>
                <form method="POST" action="{{ url('admin/category/del') }}">
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
                                <th>排序
                                </th>
                                <th>ID</th>
                                <th>分类名</th>
                                <th>分类标题</th>
                                <th>操作</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cate as $c )
                                <tr>
                                    <td align="center" width="50px">
                                        <input type="checkbox" name="ids[]" lay-skin="primary"
                                               value="{{ $c->cate_id }}">
                                    </td>
                                    <td align="center" width="20px">
                                        <input type="text" class="layui-input x-sort" name="order"
                                               value="{{ $c->cate_order }}"
                                               onchange="changeOrder(this,{{ $c->cate_id }})">
                                    </td>
                                    <td>{{ $c->cate_id }}</td>
                                    <td>{{ $c->cate_name }}</td>
                                    <td>{{ $c->cate_title }}</td>

                                    <td class="td-manage" align="center" >
                                        <a  title="编辑" class="layui-btn layui-btn layui-btn-xs"
                                                onclick="xadmin.open('编辑','{{ url('admin/category/'.$c->cate_id.'/edit') }}',600,450)">
                                            <i class="layui-icon">&#xe642;</i>编辑
                                        </a>

                                        <a title="删除" class="layui-btn-danger layui-btn layui-btn-xs"
                                                onclick="member_del(this,{{ $c->cate_id }})" href="javascript:;"><i
                                                    class="layui-icon">&#xe640;</i>删除
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
                        {{ $cates->appends($request->all())->render() }}
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

    function changeOrder(obj, id) {

        // 获取当前文本框的值（修改后的排序值）
        var order_id = $(obj).val();

        $.post('/admin/category/changeOrder', {
                '_token': "{{csrf_token()}}", "cate_id": id, "cate_order": order_id, },function(data) {
                    // console.log(data);
                    if (data.status == 0) {
                        layer.msg(data.message, {icon: 6}, function () {
                            location.reload();
                        });
                    } else {
                        layer.msg(data.message, {icon: 5});
                    }

            }
        );
    }

    /*用户-删除*/
    function member_del(obj, id) {
        layer.confirm('确认要删除吗？', function (index) {
            //发异步删除数据
            //参数1 url 参数2 方法和token 参数3 闭包函数
            $.post('/admin/category/' + id, {
                "_method": "delete", "_token": "{{ csrf_token() }}"
            }, function (data) {
                if (data.status == 0) {
                    $(obj).parents("tr").remove();
                    layer.msg(data.message, {icon: 6, time: 5000});
                } else {
                    layer.msg(data.message, {icon: 5, time: 5000});
                }

            })
        });
    }

</script>
</html>