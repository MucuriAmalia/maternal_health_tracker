<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pregnancy extends Model
{
    protected $fillable = [
        'mother_id',
        'pregnancy_number',
        'booking_date',
        'lmp',
        'edd',
        'gravida',
        'para',
        'gestational_age_at_booking',
        'risk_level',
        'status',
        'referral_source',
        'anc_profile_completed',
        'notes',
    ];

    protected $casts = [
        'booking_date' => 'date',
        'lmp' => 'date',
        'edd' => 'date',
        'anc_profile_completed' => 'boolean',
    ];

    public function mother(): BelongsTo
    {
        return $this->belongsTo(Mother::class);
    }
}