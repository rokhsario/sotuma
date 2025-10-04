<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image_path',
        'type',
        'alt_text',
        'description',
        'sort_order',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer'
    ];

    // Scope for active images
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for specific type
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    // Scope for ordered images
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    // Get full image URL
    public function getImageUrlAttribute()
    {
        return asset($this->image_path);
    }
}
