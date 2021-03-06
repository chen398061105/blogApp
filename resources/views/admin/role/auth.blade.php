<!DOCTYPE html>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>授权页面</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
      @include('admin.public.styles')
      @include('admin.public.script')
  </head>
  
  <body>
    <div class="x-body">
        <form class="layui-form" action="{{ url('admin/role/auth/doauth') }}" method="post">
            {{ csrf_field() }}
            <br>
          <div class="layui-form-item">
              <label  class="layui-form-label">
                  <span class="x-red">*</span>角色名
              </label>
              <div class="layui-input-inline">
                  <input type="hidden" name="role_id" value="{{ $role->id }}">
                  <input type="text" id="L_email" value="{{ $role->role_name }}" name="role_name" required="" lay-verify=""
                  autocomplete="off" class="layui-input">
              </div>

          </div>

            <div class="layui-form-item">
                <label  class="layui-form-label">
                    <span class="x-red">*</span>权限表
                </label>
                <div class="layui-input-inline" style="width:600px;">
                    @foreach($perms as $v)
                        @if(in_array($v->id,$own_pers))
                            <input type="checkbox" checked="checked" name="permission_id[]" title="{{ $v->per_name }}" value="{{ $v->id }}" lay-skin="primary">
                        @else
                            <input type="checkbox"  name="permission_id[]" title="{{ $v->per_name }}" value="{{ $v->id }}" lay-skin="primary">
                        @endif
                            @endforeach
                </div>
            </div>

          <div class="layui-form-item">
              <label for="L_repass" class="layui-form-label">
              </label>
              <button  class="layui-btn" lay-filter="add" lay-submit="">
                  授权
              </button>
          </div>
      </form>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        


          //监听提交
          form.on('submit(add)', function(data){

            // return false;
          });
          
          
        });
    </script>
    <script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
      })();</script>
  </body>

</html>