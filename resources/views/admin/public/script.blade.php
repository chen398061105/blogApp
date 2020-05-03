<!-- <link rel="stylesheet" href="./css/theme5.css"> -->
<script src="{{ asset('admin/lib/layui/layui.js') }}" charset="utf-8"></script>
<script type="text/javascript" src="{{ asset('admin/js/xadmin.js') }}"></script>
<!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
<!--[if lt IE 9]>
<script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
<script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>

<![endif]-->
{{--@include('flash::message')--}}
<script src="{{ asset(('js/jquery.js')) }}"></script>
<script src="//code.jquery.com/jquery.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
@include('flash::message')
<script>
    $('#flash-overlay-modal').modal();
</script>