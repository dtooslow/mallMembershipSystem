<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'name',
        'category',
        'location',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
