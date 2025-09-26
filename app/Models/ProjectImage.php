<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    use HasFactory;

    protected $fillable = ['project_id', 'image', 'sort_order'];

    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class);
    }

    /**
     * Get the full URL for the image file
     */
    public function getUrlAttribute()
    {
        return $this->image ? asset($this->image) : null;
    }

    /**
     * Get the full path for the image file
     */
    public function getFullPathAttribute()
    {
        return public_path($this->image);
    }

    /**
     * Check if the image file exists
     */
    public function fileExists()
    {
        return file_exists($this->full_path);
    }

    /**
     * Get file size in human readable format
     */
    public function getFormattedSizeAttribute()
    {
        if (!$this->fileExists()) {
            return '0 B';
        }

        $bytes = filesize($this->full_path);
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get image dimensions
     */
    public function getDimensionsAttribute()
    {
        if (!$this->fileExists()) {
            return null;
        }

        $imageInfo = getimagesize($this->full_path);
        if ($imageInfo) {
            return $imageInfo[0] . 'x' . $imageInfo[1];
        }

        return null;
    }
}
