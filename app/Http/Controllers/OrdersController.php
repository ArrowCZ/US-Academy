<?php

namespace App\Http\Controllers;

use App\City;
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

        return view('admin.order')
            ->with('order', $order)
            ->with('training', $training)
            ->with('city', $city);
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id) {
        $order = Order::findOrFail($id);
        $training = Training::findOrFail($order->training_id);
        $city = City::findOrFail($training->city_id);

        $state = $request->state;

        if ($order->state != 1 && $state == 1) {
            $sent = ' Email byl odeslán.';
            try {
                $mail = new OrderPaid($order, $city, $training);

                Mail::to($order->email)->send($mail);
            } catch (Swift_TransportException $ex) { }
        } else {
            $sent = '';
        }

        $order->state = $state;
        $order->save();

        return redirect()
            ->route('orders.show', ['order' => $order->id])
            ->with('status', 'Stav objednávky změněn.' . $sent);
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
