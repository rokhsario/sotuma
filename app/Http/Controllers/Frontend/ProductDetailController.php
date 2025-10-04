<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
        
        return view('frontend.pages.product-detail', compact('product'));
    }
}
