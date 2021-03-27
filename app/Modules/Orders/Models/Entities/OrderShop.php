<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Orders\Models\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Passport\HasApiTokens;

use App\Modules\Orders\Models\Mutator\OrderShopMutator;
use App\Modules\Orders\Models\Relations\OrderShopRelation;

class OrderShop extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
    use HasApiTokens;
    use OrderShopMutator;
    use OrderShopRelation;

    protected $guard_name = 'shop';

    protected $table = 'order_shops';

    protected $fillable = [
        'name', 'phone', 'address', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $attributes = [
        'menuroles' => 'shop',
    ];
}