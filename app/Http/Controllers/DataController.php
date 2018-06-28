<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Device;
use App\Data;
use Auth;
use Response;

class DataController extends Controller
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

    public function saveOneCaptor($id)
    {
        $client = new Client();
        $req = 'https://backend.sigfox.com/api/devices/'.$id.'/messages';
        $result = $client->request('GET', $req, ['auth' =>  ['5b333faa9e93a138cd76e33c', '51373ef70a9aacb8f673a0fa1497dcc0']]);
        if ($result->getStatusCode() == 200) {
            $items = json_decode($result->getBody());
            foreach ($items as $item) {
                foreach ($item as $data) {
                    $device = Device::where('name' , $data->device)->first();
                    if ($device == null) {
                        $device = Device::create(['name' => $data->device]);
                    }
                    if (isset($data->computedLocation)) {
                        $location = [];
                        $i = 0;
                        $max = 1;
                        foreach ($data->computedLocation as $myinfo) {
                            $location[$i] = $myinfo;
                            $i++;
                            $max++;
                        }
                        $nb_batch = $max%4;
                        $current= 0;
                        for($j=0; $j<$nb_batch; $j++) {
                            $data_captor = Data::where('time' , $data->time)->first();
                            if ($data_captor == null) {
                                $data_captor = Data::create(['lat' => $location[$current+0], 'lng' => $location[$current+1],'radius' => $location[$current+2], 'time' => $data->time, 'source' => $location[$current+3], 'device_id' => $device->id]);
                            }
                            $current += 4;
                        }
                    }
                }
            }
        }
        return Response::json(array(
                'result' => 'success',
        ));
    }

    public function saveAllCaptor()
    {
        $all_id = ['38A758','3893C5','386998','38A790','383D3B', '3868A7', '38695B', '38430B', '38A831', '37B9D5'];
        $client = new Client();
        for ($it=0; $it<sizeof($all_id); $it++) {
            $req = 'https://backend.sigfox.com/api/devices/'.$all_id[$it].'/messages';
            $result = $client->request('GET', $req, ['auth' =>  ['5b333faa9e93a138cd76e33c', '51373ef70a9aacb8f673a0fa1497dcc0']]);
            if ($result->getStatusCode() == 200) {
                $items = json_decode($result->getBody());
                foreach ($items as $item) {
                    foreach ($item as $data) {
                        $device = Device::where('name' , $data->device)->first();
                        if ($device == null) {
                            $device = Device::create(['name' => $data->device, 'users_id' => Auth()->id]);
                        }
                        if (isset($data->computedLocation)) {
                            $location = [];
                            $i = 0;
                            $max = 1;
                            foreach ($data->computedLocation as $myinfo) {
                                $location[$i] = $myinfo;
                                $i++;
                                $max++;
                            }
                            $nb_batch = $max%4;
                            $current= 0;
                            for($j=0; $j<$nb_batch; $j++) {
                                $data_captor = Data::where('time' , $data->time)->first();
                                if ($data_captor == null) {
                                    $data_captor = Data::create(['lat' => $location[$current+0], 'lng' => $location[$current+1],'radius' => $location[$current+2], 'time' => $data->time, 'source' => $location[$current+3], 'device_id' => $device->id]);
                                }
                                $current += 4;
                            }
                        }
                    }
                }
            }
        }
        return Response::json(array(
                'result' => 'success',
        ));
    }
}
