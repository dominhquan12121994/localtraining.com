<?php

/**
 * Class Orders
 * @package App\Modules\Orders\Models
 * @author Electric <huydien.it@gmail.com>
 */

namespace App\Modules\Orders\Models\Entities;

/* Contracts */
use App\Models\Entities\AbstractModel;

/* Traits */
use App\Modules\Orders\Models\Mutator\OrdersMutator;
use App\Modules\Orders\Models\Relations\OrdersRelation;

/* Filter */
//use App\Modules\Orders\Models\Filters\OrdersFilter;

/* Observer */
use App\Modules\Orders\Models\Observer\OrdersObserver;

/* Libs */
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends AbstractModel
{
    use OrdersMutator, OrdersRelation;
    use SoftDeletes;

    protected $fillable = array();

    protected $hidden = array(
    );

    protected $dates = [
        'deleted_at'
    ];

    /*
    public function scopeFilter($query, OrdersFilter $filter){
        return $filter->apply($query);
    }
    */

    public static function boot()
    {
        parent::boot();
        self::observe(OrdersObserver::class);
    }
}
