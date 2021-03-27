<?php
/**
 * Copyright (c) 2020. Electric
 */

namespace App\Modules\Systems\Models\Entities;

use App\Models\Entities\AbstractModel;

class Example extends AbstractModel
{
    protected $table = 'example';

    /**
     * Get the Status that owns the Notes.
     */
    public function status()
    {
        return $this->belongsTo('App\Modules\Systems\Models\Entities\Status', 'status_id');
    }
}
