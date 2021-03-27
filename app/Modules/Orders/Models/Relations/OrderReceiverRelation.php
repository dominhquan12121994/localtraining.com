<?php
/**
 * Class OrderReceiverRelation
 * @package App\Modules\Orders\Models\Relations
 * @author Electric <huydien.it@gmail.com>
 */

namespace App\Modules\Orders\Models\Relations;

use App\Modules\Operators\Models\Entities\ZoneProvinces;
use App\Modules\Operators\Models\Entities\ZoneDistricts;
use App\Modules\Operators\Models\Entities\ZoneWards;

trait OrderReceiverRelation
{
    public function provinces()
    {
        return $this->belongsTo(ZoneProvinces::class, 'p_id');
    }

    public function districts()
    {
        return $this->belongsTo(ZoneDistricts::class, 'd_id');
    }

    public function wards()
    {
        return $this->belongsTo(ZoneWards::class, 'w_id');
    }
}
