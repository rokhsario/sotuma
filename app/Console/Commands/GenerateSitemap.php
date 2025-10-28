<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Models\Project;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProjectCategory;
use App\Models\Post;
use App\Models\PostImage;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate {--path=public/sitemap.xml : Output path relative to base path}';
    protected $description = 'Generate a static sitemap.xml file with URLs for pages, categories, products, projects, and blog posts';

    public function handle()
    {
        $this->info('Generating sitemap.xml ...');

        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

        $today = date('Y-m-d');

        // Static pages
        $static = [
            ['loc' => route_exists('home') ? route('home') : url('/') , 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => route_exists('about-us') ? route('about-us') : url('/about-us'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route_exists('contact') ? route('contact') : url('/contact'), 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => route_exists('products.all') ? route('products.all') : url('/products'), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => route_exists('categories.index') ? route('categories.index') : url('/categories'), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => route_exists('project-categories.index') ? route('project-categories.index') : url('/categories-projets'), 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => route_exists('media') ? route('media') : url('/media'), 'changefreq' => 'weekly', 'priority' => '0.7'],
        ];

        foreach ($static as $item) {
            $xml .= '<url>';
            $xml .= '<loc>'.htmlspecialchars($item['loc'], ENT_XML1).'</loc>';
            $xml .= '<lastmod>'.$today.'</lastmod>';
            $xml .= '<changefreq>'.$item['changefreq'].'</changefreq>';
            $xml .= '<priority>'.$item['priority'].'</priority>';
            $xml .= '</url>';
        }

        // Categories
        try {
            foreach (Category::query()->get() as $category) {
                $xml .= '<url>';
                $xml .= '<loc>'.htmlspecialchars(route_exists('categories.show') ? route('categories.show', $category->slug) : url('/categories/'.$category->slug), ENT_XML1).'</loc>';
                $xml .= '<lastmod>'.optional($category->updated_at)->format('Y-m-d').'</lastmod>';
                $xml .= '<changefreq>weekly</changefreq>';
                $xml .= '<priority>0.8</priority>';
                $xml .= '</url>';
            }
        } catch (\Throwable $e) {}

        // Products
        try {
            foreach (Product::query()->get() as $product) {
                $xml .= '<url>';
                $xml .= '<loc>'.htmlspecialchars(route_exists('product-detail') ? route('product-detail', $product->slug) : url('/product-detail/'.$product->slug), ENT_XML1).'</loc>';
                $xml .= '<lastmod>'.optional($product->updated_at)->format('Y-m-d').'</lastmod>';
                $xml .= '<changefreq>monthly</changefreq>';
                $xml .= '<priority>0.7</priority>';
                $xml .= '</url>';
            }
        } catch (\Throwable $e) {}

        // Project categories
        try {
            foreach (ProjectCategory::query()->get() as $pc) {
                $xml .= '<url>';
                $xml .= '<loc>'.htmlspecialchars(route_exists('project-categories.show') ? route('project-categories.show', $pc->slug) : url('/categories-projets/'.$pc->slug), ENT_XML1).'</loc>';
                $xml .= '<lastmod>'.optional($pc->updated_at)->format('Y-m-d').'</lastmod>';
                $xml .= '<changefreq>weekly</changefreq>';
                $xml .= '<priority>0.8</priority>';
                $xml .= '</url>';
            }
        } catch (\Throwable $e) {}

        // Projects
        try {
            foreach (Project::query()->get() as $project) {
                $xml .= '<url>';
                $xml .= '<loc>'.htmlspecialchars(route_exists('projects.show') ? route('projects.show', $project) : url('/projet/'.$project->id), ENT_XML1).'</loc>';
                $xml .= '<lastmod>'.optional($project->updated_at)->format('Y-m-d').'</lastmod>';
                $xml .= '<changefreq>monthly</changefreq>';
                $xml .= '<priority>0.7</priority>';
                $xml .= '</url>';
            }
        } catch (\Throwable $e) {}

        // Blog posts (with images if available)
        try {
            foreach (Post::query()->where('status', 'active')->get() as $post) {
                $xml .= '<url>';
                $xml .= '<loc>'.htmlspecialchars(route_exists('media.detail') ? route('media.detail', $post->slug) : url('/media-detail/'.$post->slug), ENT_XML1).'</loc>';
                $xml .= '<lastmod>'.optional($post->updated_at)->format('Y-m-d').'</lastmod>';
                $xml .= '<changefreq>monthly</changefreq>';
                $xml .= '<priority>0.6</priority>';
                try {
                    $images = $post->images()->get();
                    foreach ($images as $img) {
                        if ($img->url) {
                            $xml .= '<image:image><image:loc>'.htmlspecialchars($img->url, ENT_XML1).'</image:loc></image:image>';
                        }
                    }
                    if (!$images->count() && $post->photo_url) {
                        $xml .= '<image:image><image:loc>'.htmlspecialchars($post->photo_url, ENT_XML1).'</image:loc></image:image>';
                    }
                } catch (\Throwable $ie) {}
                $xml .= '</url>';
            }
        } catch (\Throwable $e) {}

        $xml .= '</urlset>';

        // Write main sitemap file
        $pathOption = $this->option('path');
        $absolutePath = base_path($pathOption);
        $dir = dirname($absolutePath);
        if (!is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }
        File::put($absolutePath, $xml);

        $publicUrl = url('/sitemap.xml');
        $this->info("Sitemap generated at: {$absolutePath}");
        $this->info("Public URL: {$publicUrl}");

        // Build separate image sitemap
        $this->info('Generating sitemap-images.xml ...');
        $imageXml = '<?xml version="1.0" encoding="UTF-8"?>';
        $imageXml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

        // Helper to append image tags
        $appendImages = function(string $pageUrl, array $imageUrls) use (&$imageXml) {
            if (empty($imageUrls)) return;
            $imageXml .= '<url>';
            $imageXml .= '<loc>'.htmlspecialchars($pageUrl, ENT_XML1).'</loc>';
            foreach ($imageUrls as $img) {
                if (!$img) continue;
                $imageXml .= '<image:image><image:loc>'.htmlspecialchars($img, ENT_XML1).'</image:loc></image:image>';
            }
            $imageXml .= '</url>';
        };

        // Products (main image)
        try {
            foreach (Product::query()->get(['slug','image','updated_at']) as $product) {
                $pageUrl = route_exists('product-detail') ? route('product-detail', $product->slug) : url('/product-detail/'.$product->slug);
                $imgs = [];
                if (!empty($product->image)) {
                    $imgs[] = url($product->image);
                }
                $appendImages($pageUrl, $imgs);
            }
        } catch (\Throwable $e) {}

        // Project categories (no images linked directly by default)
        // Projects (main + gallery)
        try {
            foreach (Project::query()->with('images')->get() as $project) {
                $pageUrl = route_exists('projects.show') ? route('projects.show', $project) : url('/projet/'.$project->id);
                $imgs = [];
                if (!empty($project->image)) {
                    $imgs[] = url($project->image);
                }
                foreach ($project->images as $img) {
                    if ($img->url) { $imgs[] = $img->url; }
                }
                $appendImages($pageUrl, array_values(array_unique($imgs)));
            }
        } catch (\Throwable $e) {}

        // Blog posts (main + gallery)
        try {
            foreach (Post::query()->with('images')->where('status','active')->get() as $post) {
                $pageUrl = route_exists('media.detail') ? route('media.detail', $post->slug) : url('/media-detail/'.$post->slug);
                $imgs = [];
                if (method_exists($post, 'getPhotoUrlAttribute') && $post->photo_url) {
                    $imgs[] = $post->photo_url;
                }
                foreach ($post->images as $img) {
                    if ($img->url) { $imgs[] = $img->url; }
                }
                $appendImages($pageUrl, array_values(array_unique($imgs)));
            }
        } catch (\Throwable $e) {}

        $imageXml .= '</urlset>';

        $imagesPath = public_path('sitemap-images.xml');
        File::put($imagesPath, $imageXml);
        $this->info("Image sitemap generated at: {$imagesPath}");
        $this->info("Public URL: ".url('/sitemap-images.xml'));

        return 0;
    }
}

if (!function_exists('route_exists')) {
    function route_exists(string $name): bool {
        try {
            return app('router')->has($name);
        } catch (\Throwable $e) {
            return false;
        }
    }
}


