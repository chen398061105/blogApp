<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('admin.public.styles')
    @include('admin.public.script')
</head>

<body>
<div class="layui-fluid">
    <div class="layui-row">
        <form class="layui-form layui-form-pane" id="art_form" action="{{ url('admin/article') }}" method="post">
            {{ csrf_field() }}
            <div class="layui-form-item">
                <label for="L_email" class="layui-form-label">
                    <span class="x-red">*</span>分类
                </label>
                <div class="layui-input-inline">
                    <select name="cate_id">
                        <option value="0">==顶级分类==</option>
                        @foreach($cate as $k=>$v)
                            <option value="{{ $v->cate_id }}">{{ $v->_cate_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="layui-form-mid layui-word-aux">
                    <span class="x-red">*</span>
                </div>
            </div>

            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>文章标题
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="name" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label for="L_art_art" class="layui-form-label">
                    <span class="x-red">*</span>作者
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="name" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="L_art_art" class="layui-form-label">
                    <span class="x-red">*</span>缩略图
                </label>
                <div class="layui-input-block layui-upload">
                    <input type="hidden" id="img1" class="hidden" name="art_thumb" value="">
                    <button type="button" class="layui-btn" id="test1">
                        <i class="layui-icon">&#xe67c;</i>上传图片
                    </button>
                    <input type="file" name="photo" id="photo_upload" style="display: none;"/>
                </div>
            </div>

            <div class="layui-form-item layui-form-text">
                <div class="layui-input-block">
                    <img src="" alt="" id="art_thumb_img" style="max-width: 350px; max-height:100px;">
                </div>
            </div>

            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>关键词
                </label>
                <div class="layui-input-inline">
                    <input type="text" id="name" name="name" required="" lay-verify="required"
                           autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label for="desc" class="layui-form-label" style="width: 600px">
                    <span class="x-red">*</span>描述
                </label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" id="desc" name="desc" class="layui-textarea" style="width: 600px"></textarea>
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label for="desc" class="layui-form-label" style="width:1000px">
                    <span class="x-red">*</span>内容
                </label>
                <div class="layui-input-block">
                    <script type="text/javascript" charset="utf-8"
                            src="{{ asset('ueditor/ueditor.config.js')}}"></script>
                    <script type="text/javascript" charset="utf-8"
                            src="{{ asset('ueditor/ueditor.all.min.js')}}"></script>
                    <script type="text/javascript" charset="utf-8"
                            src="{{ asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                    {{--                    初始化容器--}}
                    <script id="editor" type="text/plain" name="art_content" style="width:1000px;height:300px;"></script>
                    <script>  var ue = UE.getEditor('editor');</script>

                    <button class="layui-btn" lay-filter="add" lay-submit="">
                        增加
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</body>
<script>
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'}
    });

    //Markdown AJAX 后续追加
    $('#previewBtn').click(function () {
        $.ajax({
            url: "/admin/article/pre_mk",
            type: "post",
            data: {
                cont: $('#z-textarea').val()
            },
            success: function (res) {
                $('#z-textarea-preview').html(res);
            },
            error: function (err) {
                console.log(err.responseText);
            }
        });
    })


</script>
<script>
    layui.use(['form', 'layer', 'upload', 'element'], function () {
        $ = layui.jquery;
        var form = layui.form
            , layer = layui.layer;
        var upload = layui.upload;
        var element = layui.element;

        $('#test1').on('click', function () {
            $('#photo_upload').trigger('click');
            $('#photo_upload').on('change', function () {
                var obj = this;

                var formData = new FormData($('#art_form')[0]);
                $.ajax({
                    url: '/admin/article/upload',
                    type: 'post',
                    data: formData,
                    // 因为data值是FormData对象，不需要对数据做处理
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (data['ServerNo'] == '200') {
                            // 如果成功
                            $('#art_thumb_img').attr('src', '/uploads/' + data['path']);
                            $('input[name=art_thumb]').val('/uploads/' + data['path']);
                            $(obj).off('change');
                            layer.msg('上传成功！', {icon: 6, time: 3000})
                        } else {
                            // 如果失败
                            alert(data['ResultData']);
                        }
                    },
                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        var number = XMLHttpRequest.status;
                        var info = "错误号" + number + "文件上传失败!";
                        alert(info);
                    },
                    async: true
                });
            });

        });

        //监听提交
        form.on('submit(add)', function (data) {

        });


    });
</script>
<script>var _hmt = _hmt || [];
    (function () {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</html>