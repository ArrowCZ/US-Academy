<?php

namespace App\Http\Controllers;

use App\Training;
use Illuminate\Http\Request;

class TrainingsController extends Controller
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
        return view('admin.trainings');
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
            'city_id'  => 'required',
            'day'      => 'required',
            'time'     => 'required',
            'season'   => 'required',
            'trainer'  => 'required',
            'capacity' => 'required',
            'price'    => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('cities.show', [ 'city' => $request->city_id ])
                ->withErrors($validator)
                ->withInput();
        }

        $training = new Training($request->all());
        $training->save();

        return redirect()
            ->route('cities.show', [ 'city' => $request->city_id ])
            ->with('status', 'Kroužek byl vytvořen.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $training = Training::findOrFail($id);

        return view('admin.training')->with('training', $training);
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
        $training = Training::findOrFail($id);

        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'day'      => 'required',
            'time'     => 'required',
            'season'   => 'required',
            'trainer'  => 'required',
            'capacity' => 'required',
            'price'    => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('trainings.show', [ 'training' => $id ])
                ->withErrors($validator)
                ->withInput();
        }

        $training->fill($request->all());
        $training->save();

        return redirect()
            ->route('trainings.show', [ 'training' => $id ])
            ->with('status', 'Kroužek byl upraven.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $training = Training::findOrFail($id);

        return $training;
    }
}
