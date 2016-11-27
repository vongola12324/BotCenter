<?php

namespace App\Services;

class SensorService{

    protected $support = [
        "Temperature" => ["℃", "℉"],
        "Humidity" => ["g/m^2", "%"],
        "CO" => ["ppm", "mg", "mg/kWh"],
        "CH4" => ["ppm", "mg", "mg/kWh"],
        "Infrared" => [""]
    ];

    public function isSupport($device_type) {
        return in_array($device_type, array_keys($this->support));
    }

    public function getUnit($device_type) {
        return $this->support[$device_type];
    }

    public function isAllowed($device_type, $unit) {
        return $this->isSupport($device_type) and in_array($unit, $this->getUnit($device_type));
    }

    public function getList() {
        return $this->support;
    }
}