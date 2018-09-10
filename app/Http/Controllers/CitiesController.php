<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $cities = City::all();

        return view('admin.cities')->with('cities', $cities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required',
            'x'    => '',
            'y'    => '',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.cities')->withErrors($validator)->withInput();
        }

        $city = new City($request->all());
        $city->save();

        return redirect()->route('admin.cities')->with('status', 'Město bylo vytvořeno.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $city = City::findOrFail($id);

        return view('admin.city')->with('city', $city);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $city = City::findOrFail($id);

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required',
            'x'    => '',
            'y'    => '',
        ]);

        if ($validator->fails()) {
            return redirect()->route('cities.show', ['city' => $city->id])->withErrors($validator)->withInput();
        }

        $city->fill($request->all());
        $city->save();

        return redirect()->route('cities.show', ['city' => $city->id])->with('status', 'Město bylo upraveno.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $city = City::findOrFail($id);

        foreach ($city->trainings as $training) {
            foreach ($training->orders as $order) {
                $order->delete();
            }
            $training->delete();
        }

        $city->delete();

        return redirect()->route('admin.cities')->with('status', 'Město bylo smazáno.');
    }
}
