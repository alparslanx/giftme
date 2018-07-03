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

Route::group(['prefix' => 'most_popular', 'namespace' => 'User'], function () {
    Route::get('/last_week', ['as' => 'api.user.most_popular.last_week', 'uses' => 'MostPopularController@last_week']);
});

Route::group(['prefix' => 'gift', 'namespace' => 'User'], function () {
    Route::get('/approved_list', ['as' => 'api.user.gift.approved_list', 'uses' => 'GiftController@approved_list']);
    Route::get('/pending_list', ['as' => 'api.user.gift.pending_list', 'uses' => 'GiftController@pending_list']);
    Route::get('/list', ['as' => 'api.user.gift.list', 'uses' => 'GiftController@list']);
    Route::post('/send', ['as' => 'api.user.gift.send', 'uses' => 'GiftController@send']);
    Route::post('/change_status', ['as' => 'api.user.gift.change_status', 'uses' => 'GiftController@change_status']);
});