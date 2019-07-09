<?php
// 后台公共路由部分
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function () {
    //登录、注销
    Route::get('login', 'LoginController@showLoginForm')->name('admin.loginForm');
    Route::post('login', 'LoginController@login')->name('admin.login');
    Route::get('logout', 'LoginController@logout')->name('admin.logout');
});

// 首页
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']], function () {
    //后台布局
    Route::get('/', 'IndexController@index')->name('admin.layout');
    //后台首页
    Route::get('/index', 'IndexController@index')->name('admin.index');
    //图标
    Route::get('icons', 'IndexController@icons')->name('admin.icons');
});

// 后台管理
Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'operation.log']], function () {

    // 系统管理
    Route::group(['middleware' => ['permission:system.manage']], function () {
        //数据表格接口
        Route::get('data', 'IndexController@data')->name('admin.data')->middleware('permission:system.role|system.user|system.permission');
        //用户管理
        Route::group(['middleware' => ['permission:system.user']], function () {
            Route::get('user', 'UserController@index')->name('admin.user');
            //添加
            Route::get('user/create', 'UserController@create')->name('admin.user.create')->middleware('permission:system.user.create');
            Route::post('user/store', 'UserController@store')->name('admin.user.store')->middleware('permission:system.user.create');
            //编辑
            Route::get('user/{id}/edit', 'UserController@edit')->name('admin.user.edit')->middleware('permission:system.user.edit');
            Route::put('user/{id}/update', 'UserController@update')->name('admin.user.update')->middleware('permission:system.user.edit');
            //删除
            Route::delete('user/destroy', 'UserController@destroy')->name('admin.user.destroy')->middleware('permission:system.user.destroy');
            //分配角色
            Route::get('user/{id}/role', 'UserController@role')->name('admin.user.role')->middleware('permission:system.user.role');
            Route::put('user/{id}/assignRole', 'UserController@assignRole')->name('admin.user.assignRole')->middleware('permission:system.user.role');
            //分配权限
            Route::get('user/{id}/permission', 'UserController@permission')->name('admin.user.permission')->middleware('permission:system.user.permission');
            Route::put('user/{id}/assignPermission', 'UserController@assignPermission')->name('admin.user.assignPermission')->middleware('permission:system.user.permission');
        });
        //角色管理
        Route::group(['middleware' => 'permission:system.role'], function () {
            Route::get('role', 'RoleController@index')->name('admin.role');
            //添加
            Route::get('role/create', 'RoleController@create')->name('admin.role.create')->middleware('permission:system.role.create');
            Route::post('role/store', 'RoleController@store')->name('admin.role.store')->middleware('permission:system.role.create');
            //编辑
            Route::get('role/{id}/edit', 'RoleController@edit')->name('admin.role.edit')->middleware('permission:system.role.edit');
            Route::put('role/{id}/update', 'RoleController@update')->name('admin.role.update')->middleware('permission:system.role.edit');
            //删除
            Route::delete('role/destroy', 'RoleController@destroy')->name('admin.role.destroy')->middleware('permission:system.role.destroy');
            //分配权限
            Route::get('role/{id}/permission', 'RoleController@permission')->name('admin.role.permission')->middleware('permission:system.role.permission');
            Route::put('role/{id}/assignPermission', 'RoleController@assignPermission')->name('admin.role.assignPermission')->middleware('permission:system.role.permission');
        });
        //权限管理
        Route::group(['middleware' => 'permission:system.permission'], function () {
            Route::get('permission', 'PermissionController@index')->name('admin.permission');
            //添加
            Route::get('permission/create', 'PermissionController@create')->name('admin.permission.create')->middleware('permission:system.permission.create');
            Route::post('permission/store', 'PermissionController@store')->name('admin.permission.store')->middleware('permission:system.permission.create');
            //编辑
            Route::get('permission/{id}/edit', 'PermissionController@edit')->name('admin.permission.edit')->middleware('permission:system.permission.edit');
            Route::put('permission/{id}/update', 'PermissionController@update')->name('admin.permission.update')->middleware('permission:system.permission.edit');
            //删除
            Route::delete('permission/destroy', 'PermissionController@destroy')->name('admin.permission.destroy')->middleware('permission:system.permission.destroy');
        });
        //菜单管理
        Route::group(['middleware' => 'permission:system.menu'], function () {
            Route::get('menu', 'MenuController@index')->name('admin.menu');
            Route::get('menu/data', 'MenuController@data')->name('admin.menu.data');
            //添加
            Route::get('menu/create', 'MenuController@create')->name('admin.menu.create')->middleware('permission:system.menu.create');
            Route::post('menu/store', 'MenuController@store')->name('admin.menu.store')->middleware('permission:system.menu.create');
            //编辑
            Route::get('menu/{id}/edit', 'MenuController@edit')->name('admin.menu.edit')->middleware('permission:system.menu.edit');
            Route::put('menu/{id}/update', 'MenuController@update')->name('admin.menu.update')->middleware('permission:system.menu.edit');
            //删除
            Route::delete('menu/destroy', 'MenuController@destroy')->name('admin.menu.destroy')->middleware('permission:system.menu.destroy');
        });

        //系统日志管理
        Route::group(['middleware' => 'permission:system.log'], function () {
            Route::get('systemLog', 'SystemLogController@index')->name('admin.systemLog');
        });

        // 操作日志管理
        Route::group(['middleware' => 'permission:system.operationLog'], function () {
            Route::get('operationLog', 'OperationLogController@index')->name('admin.operationLog');
            Route::get('operationLog/data', 'OperationLogController@data')->name('admin.operationLog.data');
        });
    });
});