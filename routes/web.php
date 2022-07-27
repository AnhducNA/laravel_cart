<?php

use Illuminate\Http\Request;
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

Route::get('/', 'App\Http\Controllers\CartController@index');
Route::get('/cart/add/{id}', 'App\Http\Controllers\CartController@addCart');
Route::get('/cart/delete/{id}', 'App\Http\Controllers\CartController@deleteItemCart');

Route::get('/listCart', 'App\Http\Controllers\CartController@viewListCart')
    ->name('listCart');
Route::get('/listCart/delete/{id}', 'App\Http\Controllers\CartController@deleteItemListCart');
Route::get('/listCart/save/{id}/{quanty}', 'App\Http\Controllers\CartController@saveItemListCart');
Route::post('/listCart/saveAll', 'App\Http\Controllers\CartController@saveAllListCart');
Route::get('/listCart/deleteAll', 'App\Http\Controllers\CartController@deleteAllListCart');


Route::get('/check', function () {
    if (!empty(session('Cart'))) {
        echo "<pre>";
        print_r(session('Cart'));
        echo "------------";
        // print_r(session('Cart')->products);
    }
});
