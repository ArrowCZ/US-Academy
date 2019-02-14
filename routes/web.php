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
    return include __DIR__ . '/../www/index.html';
})->name('home');

Route::get('/{city}/{training}', function () {
   // if (file_exists(public_path('index.html'))) {
    return include __DIR__ . '/../www/index.html';
    // }
})->where('city', '[0-9]+');

Route::get('/gdpr', function () {
   // if (file_exists(public_path('index.html'))) {
        return include __DIR__ . '/../www/index.html';
   // }
});

Route::get('/podminky', function () {
    // if (file_exists(public_path('index.html'))) {
        return include __DIR__ . '/../www/index.html';
   // }
});

Route::get('/rezervace/{training?}', function () {
    // if (file_exists(public_path('index.html'))) {
        return include __DIR__ . '/../www/index.html';
   // }
});

Route::get('/legal', function(){
    Redirect::away('https://usacademy.cz');
    header('Location: https://www.usacademy.cz', true, 301);
})->name('legal');
Route::get('/terms', function(){
    Redirect::away('https://usacademy.cz');
    header('Location: https://www.usacademy.cz', true, 301);
})->name('terms');
Route::get('/success', function(){
    Redirect::away('https://usacademy.cz');
    header('Location: https://www.usacademy.cz', true, 301);
})->name('success');

//Route::view('/form', 'form')->name('form');

Route::get('/detail/{training}', function ($training_id) {
    Redirect::away('https://usacademy.cz');
    header('Location: https://www.usacademy.cz', true, 301);
    return;

    $training = Training::findOrFail($training_id);
    $city = \App\City::findOrFail($training->city_id);

    return view('detail')->with('training', $training)->with('city', $city);
})->name('detail');

Route::get('/form/{training}', function ($training) {
    Redirect::away('https://usacademy.cz');
    header('Location: https://www.usacademy.cz', true, 301);
    return;

    $training = Training::findOrFail($training);
    $city = \App\City::findOrFail($training->city_id);

    return view('form')->with('training', $training)->with('city', $city);
});

Route::post('/form/{training}', function (Request $request, $training) {
    Redirect::away('https://usacademy.cz');
    header('Location: https://www.usacademy.cz', true, 301);
    return;

    /** @var Training $training */
    $training = Training::findOrFail($training);
    /** @var \App\City $city */
    $city = \App\City::findOrFail($training->city_id);

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

    switch ($training->type) {
        case 0:
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
            break;

        case 1:
            if (!$training->free_count()) {
                return redirect()->route('detail', ['training' => $training->id])->withErrors($validator)->withInput();
            }

            $order->save();

            $mail = new \App\Mail\OrderCreated($order, $city, $training);

            $filename2 = base_path() . "/resources/assets/potvrzeni_{$training->id}.docx";
            if (file_exists($filename2)) {
                $mail->attach($filename2, ['as' => 'Potvrzeni.docx']);
            }

            $filename = base_path() . '/resources/assets/informace.docx';
            if (file_exists($filename)) {
                $mail->attach($filename, ['as' => 'Informace-a-program.docx']);
            }

            try {
                \Illuminate\Support\Facades\Mail::to($order->email)->send($mail);
            } catch (Swift_TransportException $ex) {
                // return $ex;
            }

            break;
        case 2:
            $mail = new \App\Mail\OrderCreated($order, $city, $training);

            $order->save();

            try {
                \Illuminate\Support\Facades\Mail::to($order->email)->send($mail);
            } catch (Swift_TransportException $ex) {
                // return $ex;
            }

            break;
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

// Route::get('/admin/inovices', 'OrdersController@inovices');

Route::get('/admin/orders/{order}/invoice', 'OrdersController@inovice')->name('inovice');

Route::resource('/admin/trainings', 'TrainingsController')->names([
    'index' => 'admin.trainings',
]);

Route::resource('/admin/users', 'UsersController')->names([
    'index' => 'admin.users'
]);

Route::resource('/admin/worked', 'WorkedController')->names([
    'index' => 'admin.worked'
]);

Route::post('/admin/trainings/{training}/mail', 'TrainingsController@mail');
Route::post('/admin/trainings/{training}/image', 'TrainingsController@image');

Route::get('/console/migrate', function () {
    return Artisan::call('migrate');
});
