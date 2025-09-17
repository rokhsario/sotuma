<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'alt_text',
        'caption',
        'sort_order',
        'is_featured',
        'duration',
        'dimensions'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
        'duration' => 'integer'
    ];

    /**
     * Get the post that owns the media
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the project that owns the media
     */
    public function project()
    {
        return $this->belongsTo(\App\Models\Project::class);
    }

    /**
     * Get the full URL for the media file
     */
    public function getUrlAttribute()
    {
        return $this->file_path ? asset($this->file_path) : null;
    }

    /**
     * Get the thumbnail URL
     */
    public function getThumbnailUrlAttribute()
    {
        $path = $this->file_path;
        $pathInfo = pathinfo($path);
        $thumbnailPath = $pathInfo['dirname'] . '/thumbnails/' . $pathInfo['basename'];
        
        return asset($thumbnailPath);
    }

    /**
     * Get the full path for the media file
     */
    public function getFullPathAttribute()
    {
        return $this->file_path ? public_path($this->file_path) : null;
    }

    /**
     * Check if the media file exists
     */
    public function fileExists()
    {
        return $this->file_path && file_exists($this->full_path);
    }

    /**
     * Check if the media is an image
     */
    public function isImage()
    {
        return in_array(strtolower($this->file_type), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp']);
    }

    /**
     * Check if the media is a video
     */
    public function isVideo()
    {
        return in_array(strtolower($this->file_type), ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv', '3gp']);
    }

    /**
     * Check if the media is an audio file
     */
    public function isAudio()
    {
        return in_array(strtolower($this->file_type), ['mp3', 'wav', 'ogg', 'aac', 'flac', 'wma']);
    }

    /**
     * Get file size in human readable format
     */
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get duration in human readable format
     */
    public function getFormattedDurationAttribute()
    {
        if (!$this->duration) return null;
        
        $hours = floor($this->duration / 3600);
        $minutes = floor(($this->duration % 3600) / 60);
        $seconds = $this->duration % 60;
        
        if ($hours > 0) {
            return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        } else {
            return sprintf('%02d:%02d', $minutes, $seconds);
        }
    }

    /**
     * Get the appropriate icon for the media type
     */
    public function getIconAttribute()
    {
        if ($this->isImage()) {
            return 'fas fa-image';
        } elseif ($this->isVideo()) {
            return 'fas fa-video';
        } elseif ($this->isAudio()) {
            return 'fas fa-music';
        } else {
            return 'fas fa-file';
        }
    }

    /**
     * Get the media type label
     */
    public function getTypeLabelAttribute()
    {
        if ($this->isImage()) {
            return 'Image';
        } elseif ($this->isVideo()) {
            return 'Video';
        } elseif ($this->isAudio()) {
            return 'Audio';
        } else {
            return 'File';
        }
    }
}
