<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>角色添加</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
{{--    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>--}}
    @include('admin.public.styles')
    @include('admin.public.script')

</head>

<body>
<div class="x-body">
    <form class="layui-form" method="post" action="{{ url('admin/role') }}">
        {{ csrf_field() }}
        <br>
        <div class="layui-form-item">
            <label  class="layui-form-label">
                <span class="x-red">*</span>角色名
            </label>
            <div class="layui-input-inline">
                <input type="text" id="role_name" name="role_name" required=""
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>将会成为您唯一的角色名
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button class="layui-btn" lay-filter="add" lay-submit="">
                增加
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form', 'layer'], function () {
        $ = layui.jquery;
        var form = layui.form
            , layer = layui.layer;


        //监听提交
        form.on('submit(add)', function (data) {

        });


    });
</script>

</body>

</html>