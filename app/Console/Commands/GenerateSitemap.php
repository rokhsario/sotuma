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

        // Write file
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


