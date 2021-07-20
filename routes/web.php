<?php

use Illuminate\Support\Facades\Route;

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
//     return view('demo1.index');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('farmers', 'FarmersController@index')->name('farmers');
//    Route::get('products', 'GoodsController@index')->name('products');
    Route::get('farmers_data', 'FarmersController@datatable')->name('farmers_data');
    Route::get('farmers/{id?}', 'FarmersController@show')->name('farmers.show');
    Route::get('edit_farmer_page', 'FarmersController@edit_page')->name('farmers.edit_page');
    Route::get('edit_product_page', 'GoodsController@edit_page')->name('products.edit_page');
    Route::post('farmers', 'FarmersController@store')->name('farmers.store');
    Route::delete('farmers/{id?}', 'FarmersController@delete')->name('farmers.delete');

    Route::get('traders', 'TradersController@index')->name('traders');
    Route::get('traders_data', 'TradersController@datatable')->name('traders_data');
    Route::get('traders/{id?}', 'TradersController@show')->name('traders.show');
    Route::get('edit_trader_page', 'TradersController@edit_page')->name('traders.edit_page');
    Route::post('traders', 'TradersController@store')->name('traders.store');
    Route::delete('traders/{id?}', 'TradersController@delete')->name('traders.delete');

    Route::get('truckers', 'TruckerController@index')->name('truckers');
    Route::get('truckers_data', 'TruckerController@datatable')->name('truckers_data');
    Route::get('TruckersController/{id?}', 'TruckerController@show')->name('truckers.show');
    Route::get('edit_trucker_page', 'TruckerController@edit_page')->name('truckers.edit_page');
    Route::post('truckers', 'TruckerController@store')->name('truckers.store');
    Route::delete('truckers/{id?}', 'TruckerController@delete')->name('truckers.delete');

    Route::get('SBP', 'SBPController@index')->name('SBP');
    Route::get('SBP_data', 'SBPController@datatable')->name('SBP_data');
    Route::get('edit_SBP_page', 'SBPController@edit_page')->name('SBP.edit_page');
    Route::post('SBPController', 'SBPController@store')->name('SBP.store');
    Route::delete('SBPController/{id?}', 'SBPController@delete')->name('SBP.delete');

    Route::get('goods', 'GoodsController@index')->name('goods');
    Route::get('goods_data', 'GoodsController@datatable')->name('goods_data');
    Route::get('goods/{id?}', 'GoodsController@show')->name('goods.show');
    Route::get('edit_goods_page', 'GoodsController@edit_page')->name('goods.edit_page');
    Route::post('goods', 'GoodsController@store')->name('goods.store');
    Route::delete('goods/{id?}', 'GoodsController@delete')->name('goods.delete');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('dashboard');
