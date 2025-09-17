<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['title','tags','summary','slug','description','photo','quote','post_cat_id','post_tag_id','added_by','status','views'];


    public function cat_info(){
        return $this->hasOne('App\Models\PostCategory','id','post_cat_id');
    }
    public function tag_info(){
        return $this->hasOne('App\Models\PostTag','id','post_tag_id');
    }

    public function author_info(){
        return $this->hasOne('App\User','id','added_by');
    }

    /**
     * Get all media for this post
     */
    public function media()
    {
        return $this->hasMany(Media::class)->orderBy('sort_order', 'asc');
    }

    /**
     * Get all images for this post
     */
    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    /**
     * Get featured media for this post
     */
    public function featuredMedia()
    {
        return $this->hasMany(Media::class)->where('is_featured', true)->orderBy('sort_order', 'asc');
    }

    /**
     * Get the main featured image
     */
    public function getFeaturedImageAttribute()
    {
        $featured = $this->featuredMedia()->first();
        if ($featured) {
            return $featured->url;
        }
        // For legacy photos stored in public directory
        return $this->photo ? asset($this->photo) : null;
    }

    /**
     * Get the photo URL properly formatted
     */
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset($this->photo) : null;
    }

    /**
     * Get the blog image using the same mapping system as frontend
     */
    public function getBlogImageAttribute()
    {
        // Prefer the actual uploaded/seeded photo if available
        if ($this->photo) {
            return asset($this->photo);
        }

        // Fallback mapping for legacy/static displays
        $availableImages = [
            'warm-solutions-energy-saving.jpg',
            'window-wall-architecture.jpg', 
            'aluminum-ultra-low-carbon.jpg',
            'external-roller-shutters.jpg',
            'sustainable-construction-myths.jpg',
            'historic-buildings-aluminum.jpg',
            'aluminum-windows-security.jpg',
            'sliding-doors-guide.jpg',
            'aluminum-windows-production.jpg',
            'large-aluminum-glazing.jpg',
            'sustainable-construction-future.jpg',
            'eco-friendly-office-buildings.jpg',
            'sustainable-construction-rules.jpg',
            'aluminum-carbon-footprint.jpg'
        ];

        $imageIndex = ($this->id - 1) % count($availableImages);
        $blogImage = $availableImages[$imageIndex];

        return asset('images/blog/' . $blogImage);
    }

    /**
     * Get the first media item for this post
     */
    public function getFirstMediaAttribute()
    {
        return $this->images()->first();
    }

    /**
     * Check if this post has videos
     */
    public function hasVideos()
    {
        return $this->images()->where(function($query) {
            $query->where('image', 'like', '%.mp4')
                  ->orWhere('image', 'like', '%.avi')
                  ->orWhere('image', 'like', '%.mov')
                  ->orWhere('image', 'like', '%.wmv')
                  ->orWhere('image', 'like', '%.flv')
                  ->orWhere('image', 'like', '%.webm')
                  ->orWhere('image', 'like', '%.mkv');
        })->exists();
    }

    /**
     * Check if this post has images
     */
    public function hasImages()
    {
        return $this->images()->where(function($query) {
            $query->where('image', 'like', '%.jpg')
                  ->orWhere('image', 'like', '%.jpeg')
                  ->orWhere('image', 'like', '%.png')
                  ->orWhere('image', 'like', '%.gif')
                  ->orWhere('image', 'like', '%.webp')
                  ->orWhere('image', 'like', '%.svg');
        })->exists();
    }

    public static function getAllPost(){
        return Post::with(['cat_info','author_info','images'])->orderBy('id','DESC')->paginate(10);
    }
    // public function get_comments(){
    //     return $this->hasMany('App\Models\PostComment','post_id','id');
    // }
    public static function getPostBySlug($slug){
        return Post::with(['cat_info','tag_info','author_info','images'])->where('slug',$slug)->where('status','active')->first();
    }

    public function comments(){
        return $this->hasMany(PostComment::class)->whereNull('parent_id')->where('status','active')->with(['user_info' => function($query) {
            $query->select('id', 'name', 'email', 'photo');
        }])->orderBy('id','DESC');
    }
    public function allComments(){
        return $this->hasMany(PostComment::class)->where('status','active')->with(['user_info' => function($query) {
            $query->select('id', 'name', 'email', 'photo');
        }]);
    }


    // public static function getProductByCat($slug){
    //     // dd($slug);
    //     return Category::with('products')->where('slug',$slug)->first();
    //     // return Product::where('cat_id',$id)->where('child_cat_id',null)->paginate(10);
    // }

    // public static function getBlogByCategory($id){
    //     return Post::where('post_cat_id',$id)->paginate(8);
    // }
    public static function getBlogByTag($slug){
        // dd($slug);
        return Post::where('tags',$slug)->paginate(8);
    }

    /**
     * Increment the view count for this post
     */
    public function incrementViews()
    {
        $this->increment('views');
    }
}
