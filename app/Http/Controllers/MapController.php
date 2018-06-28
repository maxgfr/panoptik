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

    public function position_last(Request $request)
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
                $position = $device->data()->orderBy('time', 'desc')->first();
                $data['features'][] = array(
                    'type' => 'Feature',
                    'id' => $device->id,
                    'properties' => array('id' => $device->name,
                                        'radius' => $position->radius
                                    ),
                    'geometry' => array(
                                    'type' => "Point",
                                    'coordinates' => array( floatval($position->lng), floatval($position->lat))
                                    )
                );
            }
        }
        return response()->json($data);
    }


    public function index_optimize_pos()
    {
        return view('map_opt');
    }

    public function position_optimize(Request $request)
    {
        $rules = array();
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Response::json(array(
                    'errors' => $validator->getMessageBag()->toArray(),
            ));
        } else {
            $devices = Device::all();
            $stack = array();
            foreach($devices as $device) {
                $position = $device->data()->orderBy('time', 'desc')->first();
                $data['features'][] = array(
                    'type' => 'Feature',
                    'id' => $device->id,
                    'properties' => array('id' => $device->name,
                                        'radius' => $position->radius
                                    ),
                    'geometry' => array(
                                    'type' => "Point",
                                    'coordinates' => array( floatval($position->lng), floatval($position->lat))
                                    )
                );
                array_push($stack, [$position->lat, $position->lng]);
            }
        }
        $array = self::algo_opt($stack);
        $data['result'] = $array;
        return response()->json($data);
    }

    public function get_intermediate_pos(){

        // Formate in string for the api call
        /*$origin = $origin_pos[0].','.$origin_pos[1];
        $destination = $site_dest_pos[0].','.$site_dest_pos[1];
        */

        //Test
        $devices = Device::all();
        $stack = array();
        foreach($devices as $device) {
            $position = $device->data()->orderBy('time', 'desc')->first();
            array_push($stack, [$position->lat, $position->lng]);
        }
        $array = self::algo_opt($stack);
        $origin = $array[0].','.$array[1];
        $destination =  '43.543643,1.511001';

        //----- Get path from google
        $googleapikey = 'AIzaSyB6jCgdJ4mCpM3yUNjv5YF0zphhM8sfROM';
        $api_request = 'http://maps.googleapis.com/maps/api/directions/json?origin='.$origin.'&destination='.$destination;

        $options = array(
        'http' => array(
          'header'  => "key=".$googleapikey,
          'method'  => 'GET'
        )
        );

        $context  = stream_context_create($options);
        $result = file_get_contents($api_request, false, $context);
        $obj = json_decode($result, true);
        dd($obj);

        return $obj;
    }

    private function algo_opt ($array) {
        $average = self::average($array);
        $new = self::removing_outliers($array, $average);
        return self::average($new);
    }

    private function average($array){
        $sum_long = 0;
        $sum_lat = 0;
        $variance_a = 0;
        $variance_b = 0;
        foreach ($array as list($a, $b)) {
            $sum_long += $a;
            $sum_lat += $b;
        }
        $average_a = floatval($sum_long/count($array));
        $average_b = floatval($sum_lat/count($array));
        foreach($array as list($a, $b)){
            // sum of squares of differences between
            // all numbers and means.
            $variance_a += pow(($a - $average_a), 2);
            $variance_b += pow(($b - $average_b), 2);
        }
        $average= array($average_a, $average_b, sqrt($variance_a/count($array)), sqrt($variance_b/count($array)));
        return $average;
    }

    private function removing_outliers($array, $average){
        $n = 0;
        $var_long = $average[2] * 1.2;
        $var_lat = $average[3] * 1.2;
        $results = array();
        foreach ($array as list($a, $b)){
            if (($a < $average[0] + $var_long && $a > $average[0] - $var_long) && ($b < $average[1] + $var_lat && $b > $average[1] - $var_lat))
            array_push($results, [$a, $b]);
        }
        return ($results);
    }

}
