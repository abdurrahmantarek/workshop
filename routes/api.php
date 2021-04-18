<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::group([

    'middleware' => 'api',
    'prefix' => 'auth',
    'namespace' => 'App\Http\Controllers\Api'

], function () {

    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');

});


Route::group([

    'middleware' => 'auth:api',
    'namespace' => 'App\Http\Controllers\Api'

], function () {

    Route::apiResource('tweet', 'TweetsController@store')->only('store');
    Route::apiResource('follow', 'FollowsController@store')->only('store');
    Route::post('report', 'ReportsController@report');

});
