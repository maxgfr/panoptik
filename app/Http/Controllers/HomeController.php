<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Place;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $place = Place::get();
        return view('map.map_opt', compact('place'));
    }
}
