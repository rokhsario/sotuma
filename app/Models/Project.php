<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'project_category_id', 'image'];

    public function category()
    {
        return $this->belongsTo(\App\Models\ProjectCategory::class, 'project_category_id');
    }

    public function images()
    {
        return $this->hasMany(\App\Models\ProjectImage::class);
    }

    /**
     * Get the main image URL
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset($this->image) : null;
    }

    /**
     * Get the main image full path
     */
    public function getImagePathAttribute()
    {
        return $this->image ? public_path($this->image) : null;
    }

    /**
     * Check if the main image exists
     */
    public function imageExists()
    {
        return $this->image && file_exists($this->image_path);
    }

    /**
     * Get the featured image (first image or main image)
     */
    public function getFeaturedImageAttribute()
    {
        $firstImage = $this->images()->first();
        if ($firstImage) {
            return $firstImage->url;
        }
        
        return $this->image_url;
    }

    /**
     * Get all image URLs
     */
    public function getAllImageUrlsAttribute()
    {
        $urls = [];
        
        // Add main image if it exists
        if ($this->image_url) {
            $urls[] = $this->image_url;
        }
        
        // Add additional images
        foreach ($this->images as $image) {
            if ($image->url && !in_array($image->url, $urls)) {
                $urls[] = $image->url;
            }
        }
        
        return $urls;
    }
}
