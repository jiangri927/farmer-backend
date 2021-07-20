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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
    Route::post('store/product','API\ProductController@store');
    Route::post('delete/product/{product_id?}','API\ProductController@delete');
    Route::post('delete-all/product/{user_id?}','API\ProductController@delete_all');
    Route::post('update/product/{product_id?}','API\ProductController@update');
    Route::get('show/products/','API\ProductController@index');
});
