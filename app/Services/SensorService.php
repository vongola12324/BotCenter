<?php

namespace App\Services;

class SensorService{

    protected static $support = [
        "Temperature" => ["℃", "℉"],
        "Humidity" => ["g/m^2", "%"],
        "CO" => ["ppm", "mg", "mg/kWh"],
        "CH4" => ["ppm", "mg", "mg/kWh"],
        "Infrared" => [""]
    ];

    public static function isSupport($device_type) {
        return in_array($device_type, array_keys(static::$support));
    }

    public static function getUnits($device_type) {
        return static::$support[$device_type];
    }

    public static function isAllowed($device_type, $unit) {
//        return static::isSupport($device_type) and in_array($unit, static::getUnits($device_type));
        return static::isSupport($device_type);
    }

    public static function getDevices() {
        return array_keys(static::$support);
    }

    public static function getList() {
        return static::$support;
    }
}