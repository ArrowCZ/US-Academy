<?php

namespace App\Http\Controllers;

use App\City;
use App\Mail\OrderCreated;
use App\Mail\OrderPaid;
use App\Order;
use App\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Swift_TransportException;

class OrdersController extends Controller
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
        return view('admin.orders');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $order = Order::findOrFail($id);
        $training = Training::findOrFail($order->training_id);
        $city = City::findOrFail($training->city_id);
        $cities = City::all();

        return view('admin.order')
            ->with([
                'order'    => $order,
                'training' => $training,
                'city'     => $city,
                'cities'   => $cities,
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
        $order = Order::findOrFail($id);
        $training = Training::findOrFail($order->training_id);
        $city = City::findOrFail($training->city_id);

        $sent = '';

        if (isset($request->state)) {
            $state = $request->state;
            $old_state = $order->state;

            switch ($state) {
                case 1:
                    $mail = new OrderCreated($order, $city, $training, $old_state == 3);
                    break;
                case 2:
                    $mail = new OrderPaid($order, $city, $training);
                    break;

            }

            if (isset($mail)) {
                $sent = ' Email byl odeslán.';
                try {
                    Mail::to($order->email)->send($mail);
                } catch (Swift_TransportException $ex) {
                }
            }

            $order->state = $state;
        }

        if (isset($request->training_id)) {
            $order->training_id = $request->training_id;
        }

        $order->save();

        return redirect()
            ->route('orders.show', [ 'order' => $order->id ])
            ->with('status', 'Objednávka byla upravena.' . $sent);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }
}
