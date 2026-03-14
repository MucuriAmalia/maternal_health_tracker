<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Investigation extends Model
{
    use HasFactory;

    protected $fillable = [
        'anc_visit_id',
        'investigation_type',
        'result',
        'status',
        'investigation_date',
        'notes',
    ];

    public function ancVisit()
    {
        return $this->belongsTo(AncVisit::class);
    }
}
