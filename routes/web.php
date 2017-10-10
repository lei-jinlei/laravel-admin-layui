<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

Route::get('/signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

Route::get('login', 'SessionsController@create')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::get('singup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

Route::get('password/reset', 'Auth\forgotpasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\forgotpasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);

Route::get('/users/{user}/followings', 'UsersController@followings')->name('users.followings');
Route::get('/users/{user}/followers', 'UsersController@followers')->name('users.followers');

Route::post('/uers/follwers/{user}', 'FollowersController@store')->name('followers.store');
Route::delete('/users/follwers/{user}', 'FollowersController@destroy')->name('followers.destroy');

Route::resource('students', 'StudentsController');
Route::get('/session1', 'StudentsController@session1');
Route::get('/session2', 'StudentsController@session2');

// 宣传页面
Route::get('activity0', 'StudentsController@activity0');
// 活动页面
Route::group(['middleware' => ['activity']], function(){
    Route::any('activity1', 'StudentsController@activity1');
    Route::any('activity2', 'StudentsController@activity2');
});


Route::any('/wechat', 'WeChatController@serve');
