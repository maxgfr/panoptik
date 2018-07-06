<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use App\Http\Requests\DeviceRequest;

class DeviceController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sensor =  Auth::user()->device()->get();
        return view('sensor.index', compact('sensor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sensor = new Device();
        return view('sensor.create', compact('sensor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeviceRequest $request)
    {
        $instance = Device::create($request->all());
        return redirect()->route('sensor.index')->with('success', 'You add a sensor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sensor = Device::findOrFail($id);
        $sensor->delete();
        return redirect()->route('sensor.index')->with('error', 'You delete a sensor');
    }
}
