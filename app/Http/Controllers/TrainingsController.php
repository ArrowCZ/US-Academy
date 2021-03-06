<?php

namespace App\Http\Controllers;

use App\City;
use App\Image;
use App\Mail\MassTraining;
use App\Order;
use App\Training;
use App\User;
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
        $this->middleware('isAdmin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //return view('admin.trainings');
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
        $data = $request->all();

        switch ($request->type) {
            default:
                $validator = \Illuminate\Support\Facades\Validator::make($data, [
                    'city_id'  => 'required',
                    /*'day'      => 'required',
                    'time'     => 'required',
                    'season'   => 'required',
                    'capacity' => 'required',
                    'price'    => 'required',*/
                ]);
                break;

            case 1:
                $validator = \Illuminate\Support\Facades\Validator::make($data, [
                    'city_id'  => 'required',
                    /*'date'     => 'required',
                    'capacity' => 'required',
                    'price'    => 'required',*/
                ]);
                break;

            case 2:
                $validator = \Illuminate\Support\Facades\Validator::make($data, [
                    'city_id'  => 'required',
                    /*'date'     => 'required',
                    'price'    => 'required',*/
                ]);
                break;
        }

        if ($validator->fails()) {
            return redirect()
                ->route('cities.show', [ 'city' => $request->city_id ])
                ->withErrors($validator)
                ->withInput();
        }

        if (!empty($data['date'])) {
            $data['date'] = \DateTime::createFromFormat('j.n. Y', $data['date']);
        } else {
            unset($data['date']);
        }

        if (!empty($data['date_to'])) {
            $data['date_to'] = \DateTime::createFromFormat('j.n. Y', $data['date_to']);
        } else {
            unset($data['date_to']);
        }

        $training = new Training($data);
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

        $users = User::where('name', '<>', 'admin')->get();

        return view('admin.training')
            ->with([
                'training'   => $training,
                'city'       => $city,
                'new_orders' => $new_orders,
                'users'      => $users,
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

        $data = $request->all();
        $data['hidden'] = !empty($data['hidden']);
        $data['advanced'] = !empty($data['advanced']);

        if ($training->type == 1) {
            $validator = \Illuminate\Support\Facades\Validator::make($data, [
                //'date'     => 'required',
               // 'trainer'  => 'required',
                'capacity' => 'required',
                'price'    => 'required',
            ]);
        } elseif ($training->type == 2) {
            $validator = \Illuminate\Support\Facades\Validator::make($data, [
                'capacity' => 'required',
                'price'    => 'required',
            ]);
        } else {
            $validator = \Illuminate\Support\Facades\Validator::make($data, [
                'day'      => 'required',
                'time'     => 'required',
                'season'   => 'required',
                //'trainer'  => 'required',
                'capacity' => 'required',
                'price'    => 'required',
            ]);
        }

        if (!empty($data['date'])) {
            $data['date'] = \DateTime::createFromFormat('j.n. Y', $data['date']);
        } else {
            unset($data['date']);
        }

        if (!empty($data['date_to'])) {
            $data['date_to'] = \DateTime::createFromFormat('j.n. Y', $data['date_to']);
        } else {
            unset($data['date_to']);
        }

        if ($validator->fails()) {
            return redirect()
                ->route('trainings.show', [ 'training' => $id ])
                ->withErrors($validator)
                ->withInput();
        }

        $training->fill($data);
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

        foreach ($training->orders as $order) {
            $order->delete();
        }

        $training->delete();

        return redirect()
            ->route('cities.show', [ 'city' => $training->city_id ])
            ->with('status', 'Kroužek byl smazán.');
    }

    public function mail(Request $request, $id) {
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'text'    => 'required',
            'subject' => 'required',
            'orders'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('trainings.show', [ 'training' => $id ])
                ->withErrors($validator)
                ->withInput();
        }

        $orders = Order::find($request->orders);

        $count = 0;

        foreach ($orders as $order) {
            $count++;
            if ($order->isPaid()) {
                $mail = new MassTraining($request->text);
                $mail->subject($request->subject);

                \Illuminate\Support\Facades\Mail::to($order->email)->send($mail);
            }
            $orders[] = $order;
        }

        return redirect()
            ->route('trainings.show', [ 'training' => $id ])
            ->with('status', "Hromadný mail byl poslán {$count} lidem.");
    }

    public function image(Request $request, $id) {
        $training = Training::findOrFail($id);

        if ($request->hasFile('image')) {
            
            foreach ($training->images as $image) {
                $image->delete();
            }

            $image = new Image();
            $image->training_id = $training->id;
            $image->path = '';
            $image->width = 0;
            $image->height = 0;
            $image->save();

            $path = $image->id . '.' . $request->image->extension();
            $request->image->storeAs('img', $path, 'public');

            $image->path =  'img/' . $path;
            $image->save();
        }
        
        return redirect()
        ->route('trainings.show', [ 'training' => $id ])
        ->with('status', 'Obrázek byl nahrán.');
    }
}
