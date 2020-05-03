<?php

namespace App\Http\Controllers\Admin;

use App\Model\Permission;
use App\Model\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->paginate(5);
        return view('admin.role.list', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.role.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //获取提交数据
        $input = $request->except('_token');
        //表单验证 暂时不做
        //添加到数据库
        $res = Role::create($input);
        if ($res) {
            flash('添加成功！')->overlay();
            return redirect('admin/role');
        } else {
            flash('添加失败！')->error();
            return back();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //获取授权页面
    public function auth($id)
    {
        //获取当前角色信息
        $role = Role::find($id);
        //获取权限列表
        $perms = Permission::get();
        //获取当前角色拥有的权限
        $own_perms = $role->permission;
        //遍历权限，并把权限返回前台
        $own_pers = [];
        foreach ($own_perms as $own) {
            //角色拥有的权限
            $own_pers[] = $own->id;
        }
        return view('admin.role.auth', compact('perms', 'role', 'own_pers'));
    }

    //处理授权
    public function doauth(Request $request){
        $input = $request->except('_token');
        //接收到数据，插入角色权限管理表，如果已经存在则先删除
        \DB::table('role_permission')->where('role_id',$input['role_id'])->delete();

        //追加新的权限
        $perms = $input['permission_id'];
        if(!empty($perms)){
            foreach ($perms as $perm){
                \DB::table('role_permission')->insert(['role_id'=>$input['role_id'],'permission_id'=>$perm]);
            }
            flash('修改成功！')->overlay();
            return redirect('admin/role');
        }else{
            flash('修改失败！')->error();
            return back();
        }

    }
}
