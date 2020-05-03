<?php
//
//Route::get('user/add','UserController@add');
//Route::post('user/store','UserController@store');
//Route::get('user/index','UserController@index');
//Route::get('user/edit/{id}','UserController@edit');
//Route::post('user/update','UserController@update');
//Route::post('user/delete/{id}','UserController@delete');


//后台登录路由组， 前缀admin，命名空间Admin
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('login', 'LoginController@login');
    Route::post('doLogin', 'LoginController@doLogin');
//验证码路由
    Route::get('code', 'LoginController@code');
//第三方验证码,必须在中间件外面
//Route::get('code/captcha/{id}','Admin\LoginController@captcha');
});
//没有权限访问的路由
Route::get('noaccess', 'Admin\LoginController@noaccess');

    //后台登录路由组， 前缀admin，命名空间Admin，中间件islogin，权限设置hasRole 后续完善
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['isLogin']], function () {
    //后台首页
    Route::get('index', 'LoginController@index');
    //后台欢迎页面
    Route::get('welcome', 'LoginController@welcome');
    //退出路由
    Route::get('logout', 'LoginController@logout');

    //用户模块资源路由
    Route::post('user/del', 'UserController@delAll');
    Route::resource('user', 'UserController');

    //角色模块
    Route::resource('role', 'RoleController');
    //角色授权路由
    Route::get('role/auth/{id}', 'RoleController@auth');
    //处理授权
    Route::post('role/auth/doauth', 'RoleController@doauth');
    //权限模块，权限的增删改查功能尚未完善，后续追加
    Route::resource('permission', 'PermissionController');

    //分类资源路由、后续待完善
    Route::resource('category', 'CategoryController');
    Route::post('category/changeOrder', 'CategoryController@changeOrder');
    Route::post('category/del', 'CategoryController@delAll');

    //文章资源路由组 后续待完善
    Route::resource('article','ArticleController');
    Route::post('article/upload','ArticleController@upload');
    //网站配置资源路由 ，后续完善
    Route::resource('config','ConfigController');
});
//前台路由

Route::get('index','Home\IndexController@index')->name('index');
Route::get('lists/{id}','Home\IndexController@lists');
Route::get('detail/{id}','Home\IndexController@detail');

