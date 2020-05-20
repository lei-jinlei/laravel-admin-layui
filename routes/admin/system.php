<?php

// 系统管理
Route::group(['middleware' => ['auth', 'operation.log', 'permission:admin.system']], function () {
        //数据表格接口
        Route::get('data', 'UserController@data')->name('admin.data')->middleware('permission:system.role|admin.system.user.index|system.permission');
        //用户管理
        Route::group(['middleware' => ['permission:admin.system.user.index']], function () {
            Route::get('user', 'UserController@index')->name('admin.system.user.index');
            //添加
            Route::get('user/create', 'UserController@create')->name('admin.system.user.create')->middleware('permission:admin.system.user.create');
            Route::post('user/store', 'UserController@store')->name('admin.system.user.store')->middleware('permission:admin.system.user.create');
            //编辑
            Route::get('user/{id}/edit', 'UserController@edit')->name('admin.system.user.edit')->middleware('permission:admin.system.user.edit');
            Route::put('user/{id}/update', 'UserController@update')->name('admin.system.user.update')->middleware('permission:admin.system.user.edit');
            //删除
            Route::delete('user/destroy', 'UserController@destroy')->name('admin.system.user.destroy')->middleware('permission:admin.system.user.destroy');
            //分配角色
            Route::get('user/{id}/role', 'UserController@role')->name('admin.system.user.role')->middleware('permission:admin.system.user.role');
            Route::put('user/{id}/assignRole', 'UserController@assignRole')->name('admin.system.user.assignRole')->middleware('permission:admin.system.user.role');
            //分配权限
            Route::get('user/{id}/permission', 'UserController@permission')->name('admin.system.user.permission')->middleware('permission:admin.system.user.permission');
            Route::put('user/{id}/assignPermission', 'UserController@assignPermission')->name('admin.system.user.assignPermission')->middleware('permission:admin.system.user.permission');
        });
        //角色管理
        Route::group(['middleware' => 'permission:admin.system.role.index'], function () {
            Route::get('role', 'RoleController@index')->name('admin.system.role.index');
            //添加
            Route::get('role/create', 'RoleController@create')->name('admin.system.role.create')->middleware('permission:admin.system.role.create');
            Route::post('role/store', 'RoleController@store')->name('admin.system.role.store')->middleware('permission:admin.system.role.create');
            //编辑
            Route::get('role/{id}/edit', 'RoleController@edit')->name('admin.system.role.edit')->middleware('permission:admin.system.role.edit');
            Route::put('role/{id}/update', 'RoleController@update')->name('admin.system.role.update')->middleware('permission:admin.system.role.edit');
            //删除
            Route::delete('role/destroy', 'RoleController@destroy')->name('admin.system.role.destroy')->middleware('permission:admin.system.role.destroy');
            //分配权限
            Route::get('role/{id}/permission', 'RoleController@permission')->name('admin.system.role.permission')->middleware('permission:admin.system.role.permission');
            Route::put('role/{id}/assignPermission', 'RoleController@assignPermission')->name('admin.system.role.assignPermission')->middleware('permission:admin.system.role.permission');
        });
        //权限管理
        Route::group(['middleware' => 'permission:admin.system.permission.index'], function () {
            Route::get('permission', 'PermissionController@index')->name('admin.system.permission.index');
            //添加
            Route::get('permission/create', 'PermissionController@create')->name('admin.system.permission.create')->middleware('permission:admin.system.permission.create');
            Route::post('permission/store', 'PermissionController@store')->name('admin.system.permission.store')->middleware('permission:admin.system.permission.create');
            //编辑
            Route::get('permission/{id}/edit', 'PermissionController@edit')->name('admin.system.permission.edit')->middleware('permission:admin.system.permission.edit');
            Route::put('permission/{id}/update', 'PermissionController@update')->name('admin.system.permission.update')->middleware('permission:admin.system.permission.edit');
            //删除
            Route::delete('permission/destroy', 'PermissionController@destroy')->name('admin.system.permission.destroy')->middleware('permission:admin.system.permission.destroy');
        });
        //菜单管理
        Route::group(['middleware' => 'permission:admin.system.menu'], function () {
            Route::get('menu', 'MenuController@index')->name('admin.menu');
            Route::get('menu/data', 'MenuController@data')->name('admin.menu.data');
            //添加
            Route::get('menu/create', 'MenuController@create')->name('admin.menu.create')->middleware('permission:admin.system.menu.create');
            Route::post('menu/store', 'MenuController@store')->name('admin.menu.store')->middleware('permission:admin.system.menu.create');
            //编辑
            Route::get('menu/{id}/edit', 'MenuController@edit')->name('admin.menu.edit')->middleware('permission:admin.system.menu.edit');
            Route::put('menu/{id}/update', 'MenuController@update')->name('admin.menu.update')->middleware('permission:admin.system.menu.edit');
            //删除
            Route::delete('menu/destroy', 'MenuController@destroy')->name('admin.menu.destroy')->middleware('permission:admin.system.menu.destroy');
        });

        //系统日志管理
        Route::group(['middleware' => 'permission:admin.system.systemLog.index'], function () {
            Route::get('systemLog', 'SystemLogController@index')->name('admin.system.systemLog.index');
        });

        //Redis管理
        Route::group(['middleware' => 'permission:admin.system.redisManager'], function () {
            Route::get('redis-manager')->name('admin.system.redisManager');
        });

        // 操作日志管理
        Route::group(['middleware' => 'permission:admin.system.operationLog.index'], function () {
            Route::get('operationLog', 'OperationLogController@index')->name('admin.system.operationLog.index');
            Route::get('operationLog/data', 'OperationLogController@data')->name('admin.system.operationLog.data');
        });
    });
