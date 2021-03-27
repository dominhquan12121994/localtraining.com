<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Operators\Models\Entities;

use App\Models\Entities\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Operators\Models\Relations\ProvincesRelation;

class ZoneProvinces extends AbstractModel
{
    use SoftDeletes;
    use ProvincesRelation;

    protected $table = 'zone_provinces';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['zone', 'code', 'name', 'short_name'];

    protected $dates = [
        'deleted_at'
    ];

    /**
     * Get the province zone.
     *
     * @param  string  $value
     * @return string
     */
    public function getZoneAttribute($value)
    {
        return array('bac' => 'Miền Bắc', 'trung' => 'Miền Trung', 'nam' => 'Miền Nam')[$value];
    }
}
