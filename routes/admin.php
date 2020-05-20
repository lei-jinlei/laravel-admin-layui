<?php

//登录、注销
Route::get('login', 'LoginController@showLoginForm')->name('admin.loginForm');
Route::post('login', 'LoginController@login')->name('admin.login');
Route::get('logout', 'LoginController@logout')->name('admin.logout');

// 首页
Route::group(['middleware' => ['auth']], function () {
    //后台布局
    Route::get('/', 'IndexController@index')->name('admin.layout');
    //后台首页
    Route::get('/index', 'IndexController@index')->name('admin.index');
    //后台首页
    Route::get('/index1', 'IndexController@index1')->name('admin.index1');
    //图标
    Route::get('icons', 'IndexController@icons')->name('admin.icons');
    // 目录
    Route::get('init', 'ApiController@init')->name('admin.init');
});