<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'mother_id',
        'anc_visit_id',
        'delivery_date',
        'delivery_time',
        'delivery_type',
        'baby_gender',
        'baby_weight',
        'delivery_outcome',
        'notes',
    ];

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }

    public function ancVisit()
    {
        return $this->belongsTo(AncVisit::class);
    }
}
