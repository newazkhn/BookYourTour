<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'destination_id', 
        'user_id', 
        'name', 
        'email', 
        'people_count', 
        'travel_date', 
        'total_amount',
        'status'
    ];

    protected $casts = [
        'travel_date' => 'date',
    ];

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the status badge color
     */
    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'confirmed', 'approved' => 'green',
            'cancelled' => 'red',
            default => 'yellow',
        };
    }

    /**
     * Get the status icon
     */
    public function getStatusIconAttribute()
    {
        return match($this->status) {
            'confirmed', 'approved' => '✓',
            'cancelled' => '✗',
            default => '⏳',
        };
    }

    /**
     * Scope a query to only include pending bookings.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope a query to only include confirmed bookings.
     * Handles both 'confirmed' and 'approved' status values.
     */
    public function scopeConfirmed($query)
    {
        return $query->whereIn('status', ['confirmed', 'approved']);
    }

    /**
     * Scope a query to only include cancelled bookings.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }
}

