<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\AdminUser;
use App\Model\Role;
use App\Model\Permission;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /*思路，用户登录时候获取他的的权限保存在session中
         * 去数据库找寻找该用户是否有权限，如果有则访问，没有则提示。
         */
        //"App\Http\Controllers\Admin\LoginController@index"
        //1获取当前请求的路由， 对应的控制器方法名
        $route = \Route::current()->getActionName();
//        dd($route);
        //2获取用户权限组
        //2-1 获取登录时候的角色值
        $user = AdminUser::find(session()->get('user')->user_id);
        //2-2获取当前用户的角色
        $roles = $user->role;
//         dd($roles);
        $arr = [];//可以在这里加一些默认的权限 这样可以通用 ，后续改善
        foreach ($roles as $role) {
            //根据当前角色获取所有权限，权限可能也是列表 再次遍历
            $perms = $role->permission;
            foreach ($perms as $perm) {
                $arr[] = $perm->per_url;
            }
        }
        //去掉重复权限
        $arr = array_unique($arr);

        //判断route 是否存在该数组中，在则true
        if (in_array($route, $arr)) {
            return $next($request);
        } else {
            return redirect('noaccess');
        }
    }
}
