<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Orders\Models\Entities;

use App\Models\Entities\AbstractModel;

class OrderLog extends AbstractModel
{
    protected $table = 'order_logs';

    protected $fillable = [
        'order_id', 'content', 'user', 'timer'
    ];

    public $timestamps = false;
}