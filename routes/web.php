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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $cities = \App\City::All();

    return view('home')->with('cities', $cities);
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/admin', 'AdminController@index');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->name('admin');

Route::get('/admin/cities', function () {
    $cities = \App\City::all();

    return view('admin.cities')->with('cities', $cities);
})->name('admin_cities');

Route::get('/admin/cities/{id}', function ($id) {
    $city = \App\City::where('id', $id)->firstOrFail();

    return view('admin.city')->with('city', $city);
});


Route::post('/admin/cities', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|max:255',
    ]);

    $city = tap(new App\City($data))->save();

    return redirect('/admin/cities');
});

Route::delete('/admin/cities/{id}', function (Request $request) {

});

Route::view('/legal', 'legal');
Route::view('/detail', 'detail');

Route::get('/admin/orders', function () {
    return view('admin.orders');
})->name('admin_orders');
