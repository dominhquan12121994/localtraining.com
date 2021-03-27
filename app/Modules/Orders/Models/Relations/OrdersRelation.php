<?php

/**
 * Class OrdersRelation
 * @package App\Modules\Orders\Models\Relations
 * @author Electric <huydien.it@gmail.com>
 */

namespace App\Modules\Orders\Models\Relations;

use App\Modules\Orders\Models\Entities\OrderLog;
use App\Modules\Orders\Models\Entities\OrderTrace;

trait OrdersRelation
{
    public function logs()
    {
        return $this->belongsTo(OrderLog::class, 'order_id');
    }

    public function traces()
    {
        return $this->belongsTo(OrderTrace::class, 'order_id');
    }
}
