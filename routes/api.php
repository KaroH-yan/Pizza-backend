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

Route::post('login', 'PassportController@login');
Route::get('pizzas', 'PizzaController@index');
Route::get('pizzas/{id}', 'PizzaController@show');
Route::get('orders/{id}', 'OrderController@show');

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('orders', 'OrderController@index');
    Route::post('orders', 'OrderController@store');

});



