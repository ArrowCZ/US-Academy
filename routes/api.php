<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cities', function () {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, OPTIONS');
    
    $cities = [];

    foreach (\App\City::All() as $city) {
        if (count($city->trainings)) {
            unset($city->trainings);
            $cities[] = $city;
        }
    }
    
    return $cities;
});

Route::get('/cities/{city}/trainings', function(int $city) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, OPTIONS');

    $city = \App\City::findOrFail($city);

    $trainings_b = [];
    $trainings_a = [];
    $workshops = [];
    $camps = [];

    foreach ($city->getTrainings(0) as $training) {
        if (empty($training->hidden)) {
            $training->paid = min($training->paid_count(), $training->capacity);
            unset($training->orders);
            unset($training->city_id);
            unset($training->created_at);
            unset($training->updated_at);
    
            if ($training->advanced) {
                $trainings_a[] = $training;
            } else {
                $trainings_b[] = $training;
            }
        }
    }

    foreach ($city->getTrainings(1) as $training) {
        if (empty($training->hidden)) {
            $training->paid = min($training->paid_count(), $training->capacity);
            unset($training->orders);
            unset($training->city_id);
            unset($training->created_at);
            unset($training->updated_at);
    
            $training->date = $training->date();
    
            $workshops[] = $training;
        }
    }

    foreach ($city->getTrainings(2) as $training) {
        if (empty($training->hidden)) {
            $training->paid = min($training->paid_count(), $training->capacity);
            unset($training->orders);
            unset($training->city_id);
            unset($training->created_at);
            unset($training->updated_at);
    
            $training->date = $training->date();
            $training->date_to = $training->dateTo();
    
            $camps[] = $training;
        }
    }

    return [
        'parent'    => $city,
        'trainings_beginners' => $trainings_b,
        'trainings_advanced' =>  $trainings_a,
        'workshops' => $workshops,
        'camps'     => $camps,
    ];
});

Route::get('/trainings/{training}', function($training) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, OPTIONS');

    $training = \App\Training::findOrFail($training);
    $training->paid = min($training->paid_count(), $training->capacity);

    $city = \App\City::findOrFail($training->city_id);
    unset($city->trainings);

    $training->city = $city;

    unset($training->orders);
    unset($training->city_id);
    unset($training->created_at);
    unset($training->updated_at);

    if ($training->date) {
        $training->date = $training->date();
    }

    if ($training->date_to) {
        $training->date_to = $training->dateTo();
    }

    /*$leader = [
        'name'     => 'Marek Klátil',
        'function' => 'Vedoucí tábora a organizátor',
        'phone'    => '+420 725 980 860',
        'email'    => 'marek.kladil@gmail.com',
    ];*/

    if ($training->leader) {
        switch($training->type) {
            case 0:
                $training->leader->function = 'Vedoucí trenér';
                break;
    
            case 1:
                $training->leader->function = 'Organizátor';
                break;
    
            case 2:
                $training->leader->function = 'Vedoucí tábora a organizátor';
                break;
        }
    }

    /*$training->leader = $leader;*/

    $image = null;

    if (isset($training->images[0])) {
        $image = $training->images[0];
        $training->image = $image;

        $image->path = asset($image->path);
    } else {
        $training->image = null;
    }

    unset($training->images);

    //$training->leader = $training->leader;


    return [
        'item' => $training,
    ];
});

Route::post('/order', function (Request $request) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization');

    $data = $request->all();

    $validator = Validator::make($data, [
        'training_id' => 'required',
        'name'  => 'required',
        'email' => 'required',
        //'gdpr'  => 'required',
    ]);

    if ($validator->fails()) {
        return response(['message' => 'error',], 400);
        //return redirect()->route('detail', ['training' => $training->id])->withErrors($validator)->withInput();
    }
    
    /** @var \App\Training $training */
    $training = \App\Training::findOrFail($data['training_id']);
    /** @var \App\City $city */
    $city = \App\City::findOrFail($training->city_id);

    unset($data['_token']);

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

    return ['message' => 'ok'];
    //return $response->with(); 
    // redirect()->route('success');//->with('status', 'Byl jste zapsan. Ocekavejte instrukce emailem.');
});

Route::options('/order', function (Request $request) {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept, Origin, Authorization');

    return ['message' => 'ok'];
});
