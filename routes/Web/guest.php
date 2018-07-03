<?php
/*
|--------------------------------------------------------------------------
| Web Guest Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'user', 'namespace' => 'User'],function(){
    Route::get('/login',['as'=>'web.guest.user.login','uses' => 'LoginController@index']);
});