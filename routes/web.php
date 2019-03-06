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

//静态页面路由
Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');

//注册
Route::get('/signup', 'UsersController@create')->name('signup');
//用户资源路由
Route::resource('/users', 'UsersController');
//用户登录
Route::get('/login', 'LoginController@create')->name('login');
Route::post('/login', 'LoginController@store')->name('login');
Route::delete('/logout', 'LoginController@destroy')->name('logout');

//用户激活
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//忘记密码
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/email/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');