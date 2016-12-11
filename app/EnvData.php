<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sensor;


/**
 * 環境數據
 *
 * @property string data
 * @property string ip
 *
 * @property Sensor|null sensor
 *
 * @mixin \Eloquent
 */
class EnvData extends Model
{
    /* @var array $fillable 可大量指派的屬性 */
    protected $fillable = [
        'data', 'ip', 'sensor_id'
    ];

    protected $table = 'envdata';


    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}
