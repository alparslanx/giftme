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

Route::group(['prefix' => 'gift'], function () {
    Route::get('/pending_list', ['as' => 'api.admin.gift.pending_list', 'uses' => 'GiftController@pending_list']);
    Route::post('/reset_daily_gift_limit', ['as' => 'api.admin.gift.reset_daily_gift_limit', 'uses' => 'GiftController@reset_daily_gift_limit']);
});