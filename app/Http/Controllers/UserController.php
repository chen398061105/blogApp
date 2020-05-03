<?php

namespace App\Http\Controllers;

use App\Model\AdminUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //add
    /*
     *
     */
    public function add(){
        return view('add');
    }

    public function store(Request $request){
        $data = $request->except('_token');
        //orm 方法
        $data['user_pass'] = md5($request['user_pass']);

        //add method
       $res = AdminUser::create(['user_name'=>$data['user_name'],'user_pass'=>$data['user_pass']]);
//        dd($res);
        if ($res){
            return redirect('user/index');
        }
        return back();
    }

    public function  index(){
        $data = AdminUser::get();
        return view('user.list',compact('data'));
    }

    public function edit($id){
        //·根据id得到用户
        $data = AdminUser::find($id);
        //返回修改的页面
        return view('user.edit',compact('data'));
    }
    public function update(Request $request){

        $input = $request->all();
        $user = AdminUser::find($input['user_id']);
        $res = $user->update(['user_name'=>$input['user_name']]);

        if($res){
            return redirect('user/index');
        }else{
            return back();
        }
    }
    public function delete($id){
        $user = AdminUser::find($id);
        $res = $user->delete();

        if($res){
            $data =[
              'status'=> 0,
                'msg'=>'删除成功！'
            ];
        }else{
            $data =[
                'status'=> 1,
                'msg'=>'删除失败！'
            ];
        }
        return $data;
    }

}
