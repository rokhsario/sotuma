<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProjectCategory;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>';
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        
        // Static pages
        $staticPages = [
            ['url' => route('home'), 'priority' => '1.0', 'changefreq' => 'daily'],
            ['url' => route('about'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('contact'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['url' => route('products'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('project-categories'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('categories'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['url' => route('blog'), 'priority' => '0.7', 'changefreq' => 'weekly'],
            ['url' => route('certificates'), 'priority' => '0.6', 'changefreq' => 'monthly'],
        ];
        
        foreach ($staticPages as $page) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . $page['url'] . '</loc>';
            $sitemap .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>' . $page['changefreq'] . '</changefreq>';
            $sitemap .= '<priority>' . $page['priority'] . '</priority>';
            $sitemap .= '</url>';
        }
        
        // Project categories
        $projectCategories = ProjectCategory::where('is_active', true)->get();
        foreach ($projectCategories as $category) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . route('project-categories.show', $category->slug) . '</loc>';
            $sitemap .= '<lastmod>' . $category->updated_at->format('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>weekly</changefreq>';
            $sitemap .= '<priority>0.8</priority>';
            $sitemap .= '</url>';
        }
        
        // Projects
        $projects = Project::where('is_active', true)->get();
        foreach ($projects as $project) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . route('projects.show', $project->slug) . '</loc>';
            $sitemap .= '<lastmod>' . $project->updated_at->format('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>monthly</changefreq>';
            $sitemap .= '<priority>0.7</priority>';
            $sitemap .= '</url>';
        }
        
        // Product categories
        $categories = Category::where('is_active', true)->get();
        foreach ($categories as $category) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . route('categories.show', $category->slug) . '</loc>';
            $sitemap .= '<lastmod>' . $category->updated_at->format('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>weekly</changefreq>';
            $sitemap .= '<priority>0.8</priority>';
            $sitemap .= '</url>';
        }
        
        // Products
        $products = Product::where('is_active', true)->get();
        foreach ($products as $product) {
            $sitemap .= '<url>';
            $sitemap .= '<loc>' . route('product-detail', $product->slug) . '</loc>';
            $sitemap .= '<lastmod>' . $product->updated_at->format('Y-m-d') . '</lastmod>';
            $sitemap .= '<changefreq>monthly</changefreq>';
            $sitemap .= '<priority>0.7</priority>';
            $sitemap .= '</url>';
        }
        
        $sitemap .= '</urlset>';
        
        return response($sitemap, 200)->header('Content-Type', 'application/xml');
    }
}
