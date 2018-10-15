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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('/', function () {
    $cities = [];

    foreach (\App\City::All() as $city) {
        if (count($city->trainings)) {
            $cities[] = $city;
        }
    }

    return view('home')->with('cities', $cities);
})->name('home');

Route::view('/legal', 'legal')->name('legal');
Route::view('/terms', 'terms')->name('terms');
Route::view('/success', 'success')->name('success');

//Route::view('/form', 'form')->name('form');

Route::get('/detail/{training}', function ($training_id) {
    $training = Training::findOrFail($training_id);
    $city = \App\City::findOrFail($training->city_id);

    return view('detail')->with('training', $training)->with('city', $city);
})->name('detail');

Route::get('/form/{training}', function ($training) {
    $training = Training::findOrFail($training);
    return redirect()->route('detail', ['training' => $training->id]);
    $city = \App\City::findOrFail($training->city_id);

    if ($training->type != 0) {
        return view('detail')->with('training', $training)->with('city', $city);
    }

    return view('form')->with('training', $training)->with('city', $city);
});

Route::post('/form/{training}', function (Request $request, $training) {
    $training = Training::findOrFail($training);
    return redirect()->route('detail', ['training' => $training->id]);
    $city = \App\City::findOrFail($training->city_id);

    if ($training->type != 0) {
        return view('detail')->with('training', $training)->with('city', $city);
    }

    $data = $request->all();
    unset($data['_token']);

    $validator = Validator::make($data, [
        'name'  => 'required',
        'email' => 'required',
        //'gdpr'  => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->route('detail', ['training' => $training->id])->withErrors($validator)->withInput();
    }

    $order = new \App\Order($data);

    $order->training_id = $training->id;
    $order->price = $training->price;
    $order->count = 1;

    if (!$training->free_count()) {
        $order->state = 3;
    }

    $order->save();

    if ($order->state === 3) {
        $mail = new \App\Mail\OrderSub($order, $city, $training);
    } else {
        $mail = new \App\Mail\OrderCreated($order, $city, $training);
    }

    try {
        \Illuminate\Support\Facades\Mail::to($order->email)->send($mail);
    } catch (Swift_TransportException $ex) {
        // return $ex;
    }

    return redirect()->route('success');//->with('status', 'Byl jste zapsan. Ocekavejte instrukce emailem.');
});


Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin');

Route::resource('/admin/cities', 'CitiesController')->names([
    'index' => 'admin.cities',
]);

Route::resource('/admin/orders', 'OrdersController')->names([
    'index' => 'admin.orders',
]);


Route::get('/admin/orders/{order}/invoice', 'OrdersController@inovice')->name('inovice');

Route::resource('/admin/trainings', 'TrainingsController')->names([
    'index' => 'admin.trainings',
]);

Route::post('/admin/trainings/{training}/mail', 'TrainingsController@mail');

Route::get('/console/migrate', function () {
    return Artisan::call('migrate');
});