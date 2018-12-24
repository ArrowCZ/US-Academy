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
    $city = \App\City::findOrFail($city);

    $trainings = [];
    $workshops = [];
    $camps = [];

    foreach ($city->getTrainings(0) as $training) {
        $training->paid = min($training->paid_count(), $training->capacity);
        unset($training->orders);
        unset($training->city_id);
        unset($training->created_at);
        unset($training->updated_at);

        $trainings[] = $training;
    }

    foreach ($city->getTrainings(1) as $training) {
        $training->paid = min($training->paid_count(), $training->capacity);
        unset($training->orders);
        unset($training->city_id);
        unset($training->created_at);
        unset($training->updated_at);

        $workshops[] = $training;
    }

    foreach ($city->getTrainings(2) as $training) {
        $training->paid = min($training->paid_count(), $training->capacity);
        unset($training->orders);
        unset($training->city_id);
        unset($training->created_at);
        unset($training->updated_at);

        $camps[] = $training;
    }

    return [
        'parent'    => $city,
        'trainings' => $trainings,
        'workshops' => $workshops,
        'camps'     => $camps,
    ];
});