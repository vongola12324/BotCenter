<?php

namespace App\Http\Controllers;

use App\Sensor;
use Illuminate\Http\Request;
use App\Services\SensorService;
use Webpatser\Uuid\Uuid;

class SensorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sensors = Sensor::all();

        return view('sensor.index', compact('sensors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $devices = SensorService::getDevices();
        $units = SensorService::getUnits();

//        dd($units);
        return view('sensor.create-or-edit', compact(['devices', 'units']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'type'     => 'required',
            'unit'     => 'required',
            'location' => 'required',
        ]);

        $sensor = Sensor::create([
            'name'     => $request->get('name'),
            'type'     => SensorService::getDevices()[$request->get('type')],
            'unit'     => SensorService::getUnits()[$request->get('unit')],
            'location' => $request->get('location'),
            'api_key'  => Uuid::generate(4)
            ,
        ]);

        if ($sensor) {
            return redirect()->route('sensor.index')->with('global', '感測器已建立');
        } else {
            return redirect()->route('sensor.index')->with('error', '感測器建立失敗');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param Sensor $sensor
     * @return \Illuminate\Http\Response
     */
    public function show(Sensor $sensor)
    {
        // noting
        return redirect()->route('sensor.index')->with('error', 'Don\'t be a hacker!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Sensor $sensor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sensor $sensor)
    {
        $devices = SensorService::getDevices();
        $units = SensorService::getUnits();
        return view('sensor.create-or-edit', compact(['sensor', 'devices', 'units']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Sensor $sensor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sensor $sensor)
    {
        $this->validate($request, [
            'name'     => 'required',
            'type'     => 'required',
            'unit'     => 'required',
            'location' => 'required',
        ]);

        $sensor->update([
            'name'     => $request->get('name'),
            'type'     => SensorService::getDevices()[$request->get('type')],
            'unit'     => SensorService::getUnits()[$request->get('unit')],
            'location' => $request->get('location'),
        ]);

        if ($sensor) {
            return redirect()->route('sensor.index')->with('global', '感測器已更新');
        } else {
            return redirect()->route('sensor.index')->with('error', '感測器更新失敗');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sensor $sensor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sensor $sensor)
    {
        $sensor->delete();
        return redirect()->route('sensor.index')->with('global', '感測器已刪除');
    }
}
