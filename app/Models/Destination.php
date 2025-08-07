<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'description',
        'image',
        'price_from',
        'rating',
        'featured',
        'gallery',
        'duration'
    ];

    protected $casts = [
        'gallery' => 'array',
        'featured' => 'boolean',
        'price_from' => 'decimal:2',
        'rating' => 'decimal:2'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Scope a query to only include active destinations.
     * Since there's no is_active field, this returns all destinations.
     * Can be modified later when an is_active field is added.
     */
    public function scopeActive($query)
    {
        return $query; // All destinations are considered active for now
    }

    /**
     * Scope a query to only include featured destinations.
     */
    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    /**
     * Scope a query to only include highlighted destinations.
     * Currently uses the featured field since there's no separate highlighted field.
     */
    public function scopeHighlighted($query)
    {
        return $query->where('featured', true);
    }
}
