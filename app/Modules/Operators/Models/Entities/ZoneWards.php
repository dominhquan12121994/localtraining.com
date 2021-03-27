<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Operators\Models\Entities;

use App\Models\Entities\AbstractModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Operators\Models\Relations\WardsRelation;

class ZoneWards extends AbstractModel
{
    use SoftDeletes;
    use WardsRelation;

    protected $table = 'zone_wards';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['p_id', 'd_id', 'code', 'name'];

    public $timestamps = false;

    protected $dates = [
        'deleted_at'
    ];
}
