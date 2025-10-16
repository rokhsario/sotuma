<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'title_break_index', 'title_break_index_2', 'title_line1', 'title_line2', 'title_line3', 'image', 'category_id', 'has_details', 'description', 'specifications', 'features', 'slug', 'sort_order'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = static::generateUniqueSlug($product->title);
            } else {
                // If a slug is provided manually, still ensure uniqueness
                $product->slug = static::ensureUniqueSlug($product->slug);
            }
        });

        static::updating(function ($product) {
            // Only adjust slug if it's empty or collides with another record when title changes
            if ($product->isDirty('title') && empty($product->getOriginal('slug'))) {
                $product->slug = static::generateUniqueSlug($product->title, $product->id);
            }
            
            // If slug is dirty (manually changed) or currently collides, enforce uniqueness
            if ($product->isDirty('slug')) {
                $product->slug = static::ensureUniqueSlug($product->slug, $product->id);
            }
        });
    }

    /**
     * Generate a unique slug from a title. If it exists, append an incrementing suffix.
     */
    protected static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($title);
        if ($baseSlug === '') {
            $baseSlug = 'produit';
        }
        $slug = $baseSlug;
        $counter = 1;
        while (static::query()
            ->when($ignoreId, function ($q) use ($ignoreId) { $q->where('id', '!=', $ignoreId); })
            ->where('slug', $slug)
            ->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        return $slug;
    }

    /**
     * Ensure a given slug string is unique in the table.
     */
    protected static function ensureUniqueSlug(string $rawSlug, ?int $ignoreId = null): string
    {
        $baseSlug = Str::slug($rawSlug);
        if ($baseSlug === '') {
            $baseSlug = 'produit';
        }
        $slug = $baseSlug;
        $counter = 1;
        while (static::query()
            ->when($ignoreId, function ($q) use ($ignoreId) { $q->where('id', '!=', $ignoreId); })
            ->where('slug', $slug)
            ->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        return $slug;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
