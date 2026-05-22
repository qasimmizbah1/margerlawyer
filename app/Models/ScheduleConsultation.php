<?php

// app/Models/ScheduleConsultation.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleConsultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'items',
    ];

    protected $casts = [
        'items' => 'array',
    ];
}