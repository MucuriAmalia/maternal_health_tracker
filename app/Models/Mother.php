<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mother extends Model
{
    protected $fillable = [
        'hospital_number',
        'full_name',
        'phone',
        'id_number',
        'date_of_birth',
        'age',
        'marital_status',
        'occupation',
        'residence',
        'next_of_kin_name',
        'next_of_kin_phone',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_active' => 'boolean',
    ];

    public function pregnancies(): HasMany
    {
        return $this->hasMany(Pregnancy::class);
    }

    public function ancVisits()
{
    return $this->hasMany(AncVisit::class);
}
}