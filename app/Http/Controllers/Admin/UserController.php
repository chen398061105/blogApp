<?php

namespace App\Http\Controllers\Admin;

use App\Model\AdminUser;
use App\Model\Cate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * 获取列表.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //关键字过滤降序检索
        $user = AdminUser::orderBy('user_id', 'desc')
            ->where(function ($query) use ($request) {
                //根据用户名检索
                $username = $request->get('username');
                if (!empty($username)) {
                    $query->where('user_name', 'like', '%' . $username . '%');
                }
                //根据邮箱名检索
                $email = $request->get('email');
                if (!empty($email)) {
                    $query->where('email', 'like', '%' . $email . '%');
                }
            })->paginate($request->input('num') ? $request->input('num') : 3);

        return view('admin.users.list', compact('user', 'request'));
    }

    /**
     * 返回添加页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.users.add');
    }

    /**
     * 添加操作
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1 接收数据
        $input = $request->all();
//        dd($input);
        // 2 进行表单验证
        // 3 添加到数据库 username pass repass email
        $username = $input['username'];
        $pass = Crypt::encrypt($input['pass']);
        $res = AdminUser::create(['user_name' => $username, 'user_pass' => $pass, 'email' => $input['email']]);
        if ($res) {
            $data = [
                'status' => 0,
                'message' => '添加成功！',
            ];
        } else {
            $data = [
                'status' => 1,
                'message' => '添加失败！',
            ];
        }
        return $data;

        // 4 json形式返回客户端
    }

    /**
     * 显示一条用户记录
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 返回修改页面
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = AdminUser::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * 执行修改操作
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //        1. 根据id获取要修改的记录
        $user = AdminUser::find($id);
//        2. 获取要修改成的用户名
        $username = $request->input('user_name');

        $user->user_name = $username;

        $res = $user->save();
        if ($res) {
            $data = [
                'status' => 0,
                'message' => '修改成功！'
            ];
        } else {
            $data = [
                'status' => 1,
                'message' => '修改失败！'
            ];
        }
        return $data;
    }

    /**
     * 执行删除操作
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = AdminUser::find($id);
        $res = $user->delete();
        if ($res) {
            $data = [
                'status' => 0,
                'message' => '删除成功！'
            ];
        } else {
            $data = [
                'status' => 1,
                'message' => '删除失败！'
            ];
        }
        return $data;
    }

    /*
     * 批量删除
     * return view list
     */
    public function delAll(Request $request)
    {
        $input = $request->get('ids');
        $destroy = AdminUser::destroy($input);
        if ($destroy) {
            flash('删除成功！')->overlay();
            return redirect('admin/user');
        } else {
            flash('删除失败!')->overlay();
            return redirect()->back();
        }
    }

}
