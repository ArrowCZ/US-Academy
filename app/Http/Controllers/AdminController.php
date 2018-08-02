<?php
/**
 * Created by PhpStorm.
 * User: skeblow
 * Date: 29.7.18
 * Time: 15:45
 */

namespace App\Http\Controllers;


class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }
}