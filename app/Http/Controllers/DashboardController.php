<?php

namespace App\Http\Controllers;

use App\EnvData;
use App\Sensor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $hasSensor = Sensor::count();
        $temperature = null;
        if ($hasSensor) {
            $sensor = Sensor::where('type', 'Temperature')->first();
            $temperatures = EnvData::where('sensor_id', $sensor->id)->take(180)->get();
            $temperature = [];
            foreach($temperatures as $temp) {
                $temperature = array_merge($temperature, [(string)$temp['created_at'] => $temp['data']]);
            }
            return view('index', compact(['hasSensor', 'temperature']));
        } else {
            return view('index', compact(['hasSensor', 'temperature']));
        }
    }
}
