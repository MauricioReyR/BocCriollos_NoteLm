<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'role',
        'rating',
        'avatar_emoji',
        'text',
        'is_approved',
        'sort_order',
    ];

    protected $casts = [
        'rating' => 'integer',
        'is_approved' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopePending($query)
    {
        return $query->where('is_approved', false);
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order')->latest();
    }

    public function getAvatarAttribute(): string
    {
        return $this->avatar_emoji ?: '😊';
    }
}
