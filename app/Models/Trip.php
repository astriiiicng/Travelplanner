<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination',
        'start_date',
        'end_date',
        'jumlah_orang',
        'budget',
        'preferences',
        'context',
        'summary',
        'budget_breakdown',
        'itinerary',
    ];

    protected $casts = [
        'preferences' => 'array',
        'budget_breakdown' => 'array',
        'itinerary' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'jumlah_orang' => 'integer',
        'budget' => 'float',
    ];
}
