<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProjectCategory;
use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Cache::remember('seo.sitemap.xml', 3600, function () {
            $xml = '<?xml version="1.0" encoding="UTF-8"?>';
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';
        
            // Static pages (use existing route names)
            $homeUrl = \Illuminate\Support\Facades\Route::has('home') ? route('home') : url('/');
            $staticPages = [
                ['url' => $homeUrl, 'priority' => '1.0', 'changefreq' => 'daily'],
                // About page is named 'about-us'
                ['url' => route('about-us'), 'priority' => '0.8', 'changefreq' => 'monthly'],
                ['url' => route('contact'), 'priority' => '0.8', 'changefreq' => 'monthly'],
                // Products listing
                ['url' => route('products.all'), 'priority' => '0.9', 'changefreq' => 'weekly'],
                // Project and product category indexes
                ['url' => route('project-categories.index'), 'priority' => '0.9', 'changefreq' => 'weekly'],
                ['url' => route('categories.index'), 'priority' => '0.9', 'changefreq' => 'weekly'],
                // Blog index uses 'media'
                ['url' => route('media'), 'priority' => '0.7', 'changefreq' => 'weekly'],
                ['url' => route('certificates'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ];
        
            foreach ($staticPages as $page) {
                $xml .= '<url>';
                $xml .= '<loc>' . htmlspecialchars($page['url'], ENT_XML1) . '</loc>';
                $xml .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
                $xml .= '<changefreq>' . $page['changefreq'] . '</changefreq>';
                $xml .= '<priority>' . $page['priority'] . '</priority>';
                $xml .= '</url>';
            }
        
            // Project categories
            $projectCategories = ProjectCategory::query()->get();
            foreach ($projectCategories as $category) {
                $xml .= '<url>';
                $xml .= '<loc>' . htmlspecialchars(route('project-categories.show', $category->slug), ENT_XML1) . '</loc>';
                $xml .= '<lastmod>' . optional($category->updated_at)->format('Y-m-d') . '</lastmod>';
                $xml .= '<changefreq>weekly</changefreq>';
                $xml .= '<priority>0.8</priority>';
                $xml .= '</url>';
            }
        
            // Projects
            $projects = Project::query()->get();
            foreach ($projects as $project) {
                $xml .= '<url>';
                $xml .= '<loc>' . htmlspecialchars(route('projects.show', $project), ENT_XML1) . '</loc>';
                $xml .= '<lastmod>' . optional($project->updated_at)->format('Y-m-d') . '</lastmod>';
                $xml .= '<changefreq>monthly</changefreq>';
                $xml .= '<priority>0.7</priority>';
                $xml .= '</url>';
            }
        
            // Product categories
            $categories = Category::query()->get();
            foreach ($categories as $category) {
                $xml .= '<url>';
                $xml .= '<loc>' . htmlspecialchars(route('categories.show', $category->slug), ENT_XML1) . '</loc>';
                $xml .= '<lastmod>' . optional($category->updated_at)->format('Y-m-d') . '</lastmod>';
                $xml .= '<changefreq>weekly</changefreq>';
                $xml .= '<priority>0.8</priority>';
                $xml .= '</url>';
            }
        
            // Products (avec images pour meilleur SEO)
            $products = Product::query()->get();
            foreach ($products as $product) {
                $xml .= '<url>';
                $xml .= '<loc>' . htmlspecialchars(route('product-detail', $product->slug), ENT_XML1) . '</loc>';
                $xml .= '<lastmod>' . optional($product->updated_at)->format('Y-m-d') . '</lastmod>';
                $xml .= '<changefreq>weekly</changefreq>'; // Augmenté à weekly pour meilleure indexation
                $xml .= '<priority>0.9</priority>'; // Augmenté à 0.9 car les produits sont prioritaires
                // Ajouter l'image du produit pour le SEO images
                if ($product->image) {
                    $imageUrl = str_starts_with($product->image, 'http') ? $product->image : url($product->image);
                    $xml .= '<image:image>';
                    $xml .= '<image:loc>' . htmlspecialchars($imageUrl, ENT_XML1) . '</image:loc>';
                    $xml .= '<image:title>' . htmlspecialchars($product->title . ' - SOTUMA', ENT_XML1) . '</image:title>';
                    $xml .= '<image:caption>' . htmlspecialchars($product->title . ' - Menuiserie Aluminium SOTUMA', ENT_XML1) . '</image:caption>';
                    $xml .= '</image:image>';
                }
                $xml .= '</url>';
            }

            // Blog posts (media)
            try {
                $posts = Post::query()->where('status', 'active')->get();
                foreach ($posts as $post) {
                    $xml .= '<url>';
                    $xml .= '<loc>' . htmlspecialchars(route('media.detail', $post->slug), ENT_XML1) . '</loc>';
                    $xml .= '<lastmod>' . optional($post->updated_at)->format('Y-m-d') . '</lastmod>';
                    $xml .= '<changefreq>monthly</changefreq>';
                    $xml .= '<priority>0.6</priority>';
                    $xml .= '</url>';
                }
            } catch (\Throwable $e) {
                // Ignore blog if tables/routes not present
            }
        
            $xml .= '</urlset>';
            return $xml;
        });

        return response($sitemap, 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }
}
