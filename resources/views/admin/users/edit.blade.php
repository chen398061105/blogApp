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
    {{--    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>--}}
    @include('admin.public.styles')
    @include('admin.public.script')

</head>

<body>
<div class="x-body">
    <form class="layui-form">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>用户名
            </label>
            <div class="layui-input-inline">
                <input type="hidden" name="uid" value="{{ $user['user_id'] }}">
                <input type="text" id="L_email" value="{{ $user['user_name'] }}" name="user_name" required=""
                       lay-verify="username"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>将会成为您唯一的登入名
            </div>
        </div>

        {{--修改其他信息后续追加--}}
        {{--        <div class="layui-form-item">--}}
        {{--            <label for="L_email" class="layui-form-label">--}}
        {{--                <span class="x-red">*</span>邮箱--}}
        {{--            </label>--}}
        {{--            <div class="layui-input-inline">--}}
        {{--                <input type="text" id="L_email" value="{{ $user['email'] }}" name="email" required="" lay-verify="email"--}}
        {{--                       autocomplete="off" class="layui-input">--}}
        {{--            </div>--}}
        {{--            <div class="layui-form-mid layui-word-aux">--}}
        {{--                <span class="x-red">*</span>将会成为您唯一的登入名--}}
        {{--            </div>--}}
        {{--        </div>--}}

        {{--        <div class="layui-form-item">--}}
        {{--            <label for="L_pass" class="layui-form-label">--}}
        {{--                <span class="x-red">*</span>密码--}}
        {{--            </label>--}}
        {{--            <div class="layui-input-inline">--}}
        {{--                <input type="password" id="L_pass" name="pass" required="" lay-verify="pass"--}}
        {{--                       autocomplete="off" class="layui-input">--}}
        {{--            </div>--}}
        {{--            <div class="layui-form-mid layui-word-aux">--}}
        {{--                6到16个字符--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="layui-form-item">--}}
        {{--            <label for="L_repass" class="layui-form-label">--}}
        {{--                <span class="x-red">*</span>确认密码--}}
        {{--            </label>--}}
        {{--            <div class="layui-input-inline">--}}
        {{--                <input type="password" id="L_repass" name="repass" required="" lay-verify="repass"--}}
        {{--                       autocomplete="off" class="layui-input">--}}
        {{--            </div>--}}
        {{--        </div>--}}
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

        //自定义验证规则
        form.verify({
            nikename: function (value) {
                if (value.length < 5) {
                    return '昵称至少得5个字符啊';
                }
            }
            , pass: [/(.+){6,12}$/, '密码必须6到12位']
            , repass: function (value) {
                if ($('#L_pass').val() != $('#L_repass').val()) {
                    return '两次密码不一致';
                }
            }
        });
        form.on('submit(edit)', function (data) {
            var uid = $("input[name='uid']").val();
            //发异步，把数据提交给php
            $.ajax({
                type: 'PUT',
                url: '/admin/user/' + uid ,
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
        //监听提交

    });
</script>
<script>var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</body>

</html>