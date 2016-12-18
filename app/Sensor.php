<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 感測器
 *
 * @property integer id
 * @property string name
 * @property string type
 * @property string unit
 * @property string location
 *
 * @property EnvData envdatas
 *
 * @mixin \Eloquent
 */
class Sensor extends Model
{
    /* @var array $fillable 可大量指派的屬性 */
    protected $fillable = [
        'name', 'type', 'unit', 'location', 'api_key'
    ];

    /** @var int $perPage 分頁時的每頁數量 */
    protected $perPage = 10;

    public function envdatas()
    {
        return $this->hasMany(EnvData::class);
    }
}
