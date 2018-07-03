<?php

/*
|--------------------------------------------------------------------------
| Api\guest Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * USER
 */
Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
    /**
     * LOGİN
     */
    Route::post('/login', ['as' => 'api.guest.user.login', 'uses' => 'LoginController@index']);


    /**
     * CREATE
     */
    Route::post('/create', ['as' => 'api.guest.user.create', 'uses' => 'CreateController@index']);
});