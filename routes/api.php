<?php

use Illuminate\Http\Request;
// use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route;
use Webpatser\Uuid\Uuid;

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


Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('authcheck', 'API\UserController@details');
    Route::post('getUser', 'API\UserController@getUser');
    Route::post('addAddress', 'AddressController@create');
    Route::post('updateAddres' , 'AddressController@updateAddres');
    Route::post('getUserAddress', 'API\UserController@getUserAddress');
});


Route::get('createRole', 'API\UserController@createRole');





