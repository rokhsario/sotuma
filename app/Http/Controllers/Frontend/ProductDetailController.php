<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\SeoService;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function show($slug)
    {
        $product = Product::where('slug', $slug)
            ->with('category')
            ->first();
            
        if (!$product) {
            abort(404, 'Product not found');
        }
        
        // Préparer les données SEO pour la vue
        $seoService = app(SeoService::class);
        $seoData = $seoService->getMetaTags('product-detail', ['product' => $product]);
        
        return view('frontend.pages.product-detail', compact('product', 'seoData'));
    }
}
