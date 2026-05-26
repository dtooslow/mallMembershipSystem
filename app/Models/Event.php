<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'type',
        'description',
        'image',
        'event_date',
    ];

    protected $casts = [
        'event_date' => 'date',
    ];
}
