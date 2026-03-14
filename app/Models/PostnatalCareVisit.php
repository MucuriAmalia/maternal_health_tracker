<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostnatalCareVisit extends Model
{
    protected $fillable = [
        'mother_id',
        'delivery_id',
        'visit_date',
        'visit_time',
        'days_after_delivery',
        'mother_condition',
        'bleeding_status',
        'temperature',
        'blood_pressure',
        'breastfeeding_status',
        'baby_condition',
        'notes',
    ];

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }

    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }
}
