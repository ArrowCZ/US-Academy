<?php

namespace App\Http\Controllers;

use DateTime;
use App\City;
use App\Worked;
use Illuminate\Http\Request;

class WorkedController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user = \Auth::user();
        $cities = City::all();

        return view('admin.worked')->with([
            'user'   => $user,
            'cities' => $cities,
        ]);
    }

    public function store(Request $request) {
        $data = $request->all();

        if (!empty($data['date'])) {
            $data['date'] = DateTime::createFromFormat('j.n. Y', $data['date']);
        } else {
            $data['date'] = new DateTime();
        }

        $data['user_id'] = \Auth::user()->id;

        $worked = new Worked($data);

        $worked->save();

        return redirect()->route('admin.worked')->with([
            'status' => 'Hodiny byly zapsané.',
        ]);
    }
}
