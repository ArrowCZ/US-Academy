<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function index() {
        $users = User::where('name', '<>', 'admin')->get();

        return view('admin.users')->with([
            'users' => $users,
        ]);
        //return $users;
    }

    public function store(Request $request) {
        $data = $request->all();
        $validator = \Illuminate\Support\Facades\Validator::make($data, [
            'name'     => 'required',
            'email'    => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('admin.users.index')
                ->withErrors($validator)
                ->withInput();
        }

        $data['email'] = "{$data['email']}@usacademy.cz";
        $data['password'] = Hash::make($data['password']);

        $user = new User($data);

        $user->save();

        return redirect()->route('admin.users.index')->with([
            'status' => 'Uživatel byl vytvořen',
        ]);
    }
}
