<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AncVisit extends Model
{
    protected $fillable = [
        'mother_id',
        'visit_date',
        'gestation_weeks',
        'weight',
        'blood_pressure',
        'notes',
    ];

    public function mother()
    {
        return $this->belongsTo(Mother::class);
    }
}