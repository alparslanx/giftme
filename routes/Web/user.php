<?php
/*
|--------------------------------------------------------------------------
| Web\User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', ['as' => 'web.index', 'uses' => 'HomeController@index']);
Route::get('/gifts', ['as' => 'web.gift', 'uses' => 'GiftController@index']);
Route::get('/pending_gifts', ['as' => 'web.pending_gift', 'uses' => 'GiftController@pending']);
Route::get('/send_gift', ['as' => 'web.send_gift', 'uses' => 'GiftController@send']);