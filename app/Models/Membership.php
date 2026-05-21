<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $fillable = [
        'user_id',
        'tier',
        'points',
        'expires_at',
        'last_renewed_at',
        'status',
        'payment_method',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'last_renewed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isExpired(): bool
    {
        if (!$this->expires_at) {
            return false;
        }
        return $this->expires_at->isPast();
    }

    public function status(): string
    {
        if ($this->status !== 'active') {
            return ucfirst($this->status); // e.g., Pending, Rejected, Cancelled
        }
        
        return $this->isExpired() ? 'Expired' : 'Active';
    }
}
