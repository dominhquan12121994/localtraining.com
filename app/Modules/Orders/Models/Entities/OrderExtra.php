<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Orders\Models\Entities;

use App\Models\Entities\AbstractModel;

class OrderExtra extends AbstractModel
{
    protected $table = 'order_extras';

    protected $fillable = [
        'note1', 'note2', 'client_code'
    ];

    public $timestamps = false;
}