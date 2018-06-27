<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class DataController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $client = new Client();
        $req = 'https://backend.sigfox.com/api/devices/'.$id.'/messages';
        $result = $client->request('GET', $req, ['auth' =>  ['5b333faa9e93a138cd76e33c', '51373ef70a9aacb8f673a0fa1497dcc0']]);
        if ($result->getStatusCode() == 200) {
            $items = json_decode($result->getBody());
            foreach ($items as $item) {
                $device = Device::create(['name' => $item->device]);
                dd($device);
            }
        }
        return view('home');
    }
}
