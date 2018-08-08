<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $cities = \App\City::All();

    return view('home')->with('cities', $cities);
});

Route::view('/legal', 'legal')->name('legal');

Route::view('/detail', 'detail')->name('detail');

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');

Route::resource('/admin/cities', 'CitiesController')->names([
    'index' => 'admin.cities',
]);

Route::resource('/admin/orders', 'OrdersController')->names([
    'index' => 'admin.orders',
]);

Route::resource('/admin/trainings', 'TrainingsController')->names([
    'index' => 'admin.trainings',
]);
