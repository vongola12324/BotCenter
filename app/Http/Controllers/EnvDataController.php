<?php

namespace App\Http\Controllers;

use App\EnvData;

class EnvDataController extends Controller {

    public function index() {
        $datas = EnvData::with('sensor')->orderBy('created_at', 'desc')->paginate();
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