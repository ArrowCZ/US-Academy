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

use App\Training;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $cities = [];

    foreach (\App\City::All() as $city) {
        if (count($city->trainings)) {
            $cities[] = $city;
        }
    }

    return view('home')->with('cities', $cities);
});

Route::view('/legal', 'legal')->name('legal');



Route::get('/detail/{training}', function ($training_id) {
    $training = Training::findOrFail($training_id);

    $city = \App\City::findOrFail($training->city_id);

    return view('detail')->with('training', $training)->with('city', $city);
})->name('detail');

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


Route::get('/console/migrate', function () {
    return Artisan::call('migrate');
});