<?php

namespace App\Http\Controllers\Admin;

use App\Model\AdminUser;
use App\Org\code\Code;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //login view
    public function login()
    {
        return view('admin.login');
    }

    //验证码方法
    public function code()
    {
        $code = new Code();
        $code->make();
    }

    //第三方插件验证码
//    public function  captcha(){
//        $phrase = new PhraseBuilder;
//        // 设置验证码位数
//        $code = $phrase->build(6);
//        // 生成验证码图片的Builder对象，配置相应属性
//        $builder = new CaptchaBuilder($code, $phrase);
//        // 设置背景颜色
//        $builder->setBackgroundColor(220, 210, 230);
//        $builder->setMaxAngle(25);
//        $builder->setMaxBehindLines(0);
//        $builder->setMaxFrontLines(0);
//        // 可以设置图片宽高及字体
//        $builder->build($width = 100, $height = 40, $font = null);
//        // 获取验证码的内容
//        $phrase = $builder->getPhrase();
//        // 把内容存入session
//        \Session::flash('code', $phrase);
//        // 生成图片
//        header("Cache-Control: no-cache, must-revalidate");
//        header("Content-Type:image/jpeg");
//        $builder->output();
//    }

    //表单数据验证
    public function doLogin(Request $request)
    {
        // 1 接收表单数据
        $input = $request->except('_token');
        // 2 进行表单验证
//        $validator = Validator::make('需要验证的表单数据','验证规则数组','错误提示信息数组')；
        $rule = [
            'username' => 'required|between:4,18',
            'password' => 'required|between:4,18|alpha_dash',//数字 字母 下划线
        ];
        $message = [
            'username.required' => '用户名必须输入',
            'username.between' => '用户名长度必须为4～18位',
            'password.required' => '用户名必须输入',
            'password.between' => '密码长度必须为4～18位',
            'password.alpha_dash' => '密码必须是数字,字母,下划线',
        ];
        $validator = Validator::make($input, $rule, $message);
        //如果验证失败跳转到登录页面，要在登陆页面写错误提示信息
        if ($validator->fails()) {
            return redirect('admin/login')->withErrors($validator)->withInput();
        }
        // 3 验证账户是否存在
        //3-1 验证验证码
        if (strtolower($input['code'])  != strtolower(session()->get('code'))) {
            return redirect('admin/login')->with('errors', '验证码错误！');
        }
        // 3-1验证账户信息
        $user = AdminUser::where('user_name', $input['username'])->first();
        if (!$user) {
            return redirect('admin/login')->with('errors', '用户名错误！');
        }
        //3-2验证密码
        if ($input['password'] != Crypt::decrypt($user['user_pass'])) {
            return redirect('admin/login')->with('errors', '密码错误！');
        }
        //4 信息保存到session中
        session()->put('user', $user);

        //5 跳转到后台页面
        return redirect('admin/index');
    }

    //后台首页
    public function index()
    {
        return view('admin.index');
    }

    //后台欢迎页面
    public function welcome()
    {
        return view('admin.welcome');
    }
    //logout
    public function logout(){
        //clear session information
        session()->flush();
        return redirect('admin/login');
    }
    //noaccess
    public function noaccess(){
        return view('errors.noaccess');
    }
}
