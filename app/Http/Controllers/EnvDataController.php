<?php

namespace App\Http\Controllers;

use App\EnvData;
use App\Sensor;
use Illuminate\Http\Request;

class EnvDataController extends Controller {

    public function index(Request $request) {
        $hasToken = $request->get('token') || false;
        $hasSensor = false;
        $sensor = null;
        if ($hasToken) {
            $sensor = Sensor::where('api_key', $request->get('token'))->first();
            $hasSensor = $sensor || $hasSensor;
        }
        if ($hasToken && $hasSensor) {
            $datas = EnvData::where('sensor_id', $sensor->id)->with('sensor')->orderBy('created_at', 'desc')->paginate();
        } else {
            $datas = EnvData::with('sensor')->orderBy('created_at', 'desc')->paginate();
        }
        return view('sensor.data', compact('datas'));
    }

    public function clear() {
        $datas = EnvData::get();
        foreach($datas as $data) {
            $data->delete();
        }
        return redirect()->route('envdata')->with('global', '資料清除成功');
    }

    public function destroy(EnvData $data) {
        $data->delete();
        return redirect()->route('envdata')->with('global', '資料刪除成功');
    }
}