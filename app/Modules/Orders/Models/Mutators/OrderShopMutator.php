<?php
/**
 * Copyright (c) 2020. Electric
 */

/**
 * Class OrderShopMutator
 * @package App\Modules\Orders\Models\Mutator
 * @author Electric <huydien.it@gmail.com>
 */

namespace App\Modules\Orders\Models\Mutator;

use Illuminate\Support\Facades\Hash;

trait OrderShopMutator
{
    /**
     * Set the shop's password
     *
     * @param  string  $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
