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
                $product->slug = Str::slug($product->title);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('title') && empty($product->slug)) {
                $product->slug = Str::slug($product->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
