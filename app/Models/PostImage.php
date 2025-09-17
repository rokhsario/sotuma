<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'image'];

    public function post()
    {
        return $this->belongsTo(\App\Models\Post::class);
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

    /**
     * Get the file extension
     */
    public function getFileExtensionAttribute()
    {
        return $this->image ? strtolower(pathinfo($this->image, PATHINFO_EXTENSION)) : null;
    }

    /**
     * Check if the media is an image
     */
    public function isImage()
    {
        $extension = $this->file_extension;
        return in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp']);
    }

    /**
     * Check if the media is a video
     */
    public function isVideo()
    {
        $extension = $this->file_extension;
        return in_array($extension, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv', '3gp', 'm4v']);
    }

    /**
     * Get the media type (image or video)
     */
    public function getMediaTypeAttribute()
    {
        if ($this->isVideo()) {
            return 'video';
        } elseif ($this->isImage()) {
            return 'image';
        }
        return 'unknown';
    }
}
