<?php

// app/Models/Setting.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'group',
        'name',
        'locked',
        'payload'
    ];

    protected $casts = [
        'locked' => 'boolean',
        'payload' => 'array',
    ];
}