<?php

namespace App\Http\Controllers;

use App\City;
use App\Mail\MassTraining;
use App\Training;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;

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
        $city = City::findOrFail($training->city_id);

        $new_orders = $training->state(1);

        return view('admin.training')
            ->with([
                'training'   => $training,
                'city'       => $city,
                'new_orders' => $new_orders,
            ]);
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

    public function mail(Request $request, $id) {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'text'    => 'required',
            'subject' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('trainings.show', [ 'training' => $id ])
                ->withErrors($validator)
                ->withInput();
        }

        /** @var Training $training */
        $training = Training::findOrFail($id);

        $orders = [];

        foreach ($training->orders()->getResults() as $order) {
            if ($order->isPaid()) {
                $mail = new MassTraining($request->text);
                $mail->subject($request->subject);
                \Illuminate\Support\Facades\Mail::to($order->email)->send($mail);

            }
            $orders[] = $order;
        }

        return redirect()
            ->route('trainings.show', [ 'training' => $id ])
            ->with('status', 'Hromadný mail byl poslán.');
    }
}
