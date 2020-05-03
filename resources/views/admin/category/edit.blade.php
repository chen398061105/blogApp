<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>修改用户资料</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    @include('admin.public.styles')
    @include('admin.public.script')
    <style>
        .layui-form-label {
            width: 100px;
        }

        .layui-form-item {
            margin-top: 20px;
        }
    </style>
</head>

<body style="overflow-y: hidden">
<div class="x-body">
    <form class="layui-form">
        {{--         <input type="hidden"  name="_method" value="put" >--}}
        {{--        {{ csrf_field() }}--}}
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>分类名
            </label>
            <div class="layui-input-inline">
                <input type="hidden" name="cate_id" value="{{ $cate->cate_id }}">
                <input type="text" i value="{{ $cate->cate_name }}" name="cate_name" required=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">
                <span class="x-red">*</span>分类标题
            </label>
            <div class="layui-input-inline">
                <input type="text" i value="{{ $cate->cate_title }}" name="cate_title" required=""
                       autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button class="layui-btn" lay-filter="edit" lay-submit="">
                修改
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form', 'layer'], function () {
        $ = layui.jquery;
        var form = layui.form
            , layer = layui.layer;


        form.on('submit(edit)', function (data) {
            var cate_id = $("input[name='cate_id']").val();
            //发异步，把数据提交给php
            $.ajax({
                type: 'PUT',
                url: '/admin/category/' + cate_id,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data.field,
                success: function (data) {
                    // 弹层提示修改成功，并刷新父页面
                    if (data.status == 0) {
                        layer.alert(data.message, {icon: 6}, function () {
                            parent.location.reload(true);
                        });
                    } else {
                        layer.alert(data.message, {icon: 5});
                    }
                },
            });
            return false;
        });
    });
</script>

</body>

</html>