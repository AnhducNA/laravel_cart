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

Route::get('/', 'App\Http\Controllers\CartController@index');
Route::get('/cart/add/{id}', 'App\Http\Controllers\CartController@addCart');
Route::get('/cart/delete/{id}', 'App\Http\Controllers\CartController@deleteItemCart');
Route::get('/cart/list', 'App\Http\Controllers\CartController@viewListCart');
Route::get('/check', function () {
    if (!empty(session('Cart'))) {
        echo "<pre>";
        print_r(session('Cart'));
        echo "------------";
        print_r(session('Cart')->products);
    }
});
