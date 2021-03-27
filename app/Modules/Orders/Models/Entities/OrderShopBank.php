<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Orders\Models\Entities;

use App\Models\Entities\AbstractModel;

class OrderShopBank extends AbstractModel
{
    protected $table = 'order_shops_bank';

    protected $fillable = [
        'id', 'bank_name', 'bank_branch', 'stk_name', 'stk', 'cycle_cod'
    ];

    public $timestamps = false;
}