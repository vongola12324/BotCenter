<?php

namespace App\Http\Controllers;

use App\EnvData;
use App\Sensor;
use Illuminate\Http\Request;
use App\Services\SensorService;

class APIController extends Controller
{
    protected static $jsonOptions = JSON_PRESERVE_ZERO_FRACTION + JSON_UNESCAPED_UNICODE;

    public function setData(Request $request)
    {
        $data = null;

        if ($request->get('data') && $request->get('token')) {
            $sensor = Sensor::where('api_key' , $request->get('token'))->first();
            if ($sensor) {
                $data = EnvData::create([
                    'data' => $request->get('data'),
                    'ip'    => $request->getClientIp(),
                    'sensor_id' => $sensor->id
                ]);
            } else {
                return response()->json("Error: Wrong token.", 200, [], static::$jsonOptions);
            }
        }

        if ($data) {
            return response()->json("Ok.", 200, [], static::$jsonOptions);
        } else {
            return response()->json("Error: Unknown.", 200, [], static::$jsonOptions);
        }
    }


    public function getData(Request $request) {
        $name = $request->get('name');
        $type = $request->get('type');
        $limit = $request->get('limit') || 30;
        $data = null;
        if ($name) {
            $sensors = Sensor::where('name', $name)->plurk('id');
            $data = EnvData::whereIn('sensor_id', $sensors);
        } else if ($type) {
            $sensors = Sensor::where('type', $type)->plurk('id');
            $data = EnvData::whereIn('sensor_id', $sensors);
        } else {
            $data = EnvData::select('*');
        }
        $data = $data->orderBy('created_at', 'desc');

        if ($limit) {
            $data = $data->take($limit);
        }

        return response()->json($data->get(), 200, [], static::$jsonOptions);
    }
}
