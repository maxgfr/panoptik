<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;
use Validator;
use Response;
use Illuminate\Support\Facades\Input;

class MapController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('map');
    }

    public function position(Request $request)
    {
        $rules = array();
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $devices = Device::all();
            foreach($devices as $device) {
                $positions = $device->data()->get();
                    foreach($positions as $pos){
                        $data['features'][] = array(
                            'type' => 'Feature',
                            'id' => $device->id,
                            'properties' => array('id' => $device->name,
                                                'timestamp' => date('d-m-y H:i:s', $pos->time)
                                            ),
                            'geometry' => array(
                                            'type' => "Point",
                                            'coordinates' => array( floatval($pos->lng), floatval($pos->lat))
                                            )
                        );
                    }
            }
        }
        return response()->json($data);
    }

    public function path(Request $request)
    {
        $rules = array();
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $devices = Device::all();
            foreach($devices as $device) {
                $positions = $device->data()->get();
                    foreach($positions as $pos){
                        $data[] = [$pos->lat, $pos->lng];
                    }
            }
        }
        return response()->json($data);
    }

    public function index_last_pos()
    {
        return view('map_last');
    }

}
