<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Operators\Models\Entities;

use App\Models\Entities\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Operators\Models\Relations\DistrictsRelation;

class ZoneDistricts extends AbstractModel
{
    use SoftDeletes;
    use DistrictsRelation;

    protected $table = 'zone_districts';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'code', 'name'];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * Get the province zone.
     *
     * @param  string  $value
     * @return string
     */
    public function getTypeAttribute($value)
    {
        return array('noi' => 'Nội thành', 'ngoai' => 'Ngoại thành', 'huyen' => 'Huyện/Xã')[$value];
    }
}
