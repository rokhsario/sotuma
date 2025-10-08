<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category')->paginate(10); // Paginate for links()
        return view('backend.product.index', compact('products'));
    }

    public function create() {
        $categories = \App\Models\Category::all();
        return view('backend.product.create', compact('categories'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string',
            'title_break_index' => 'nullable|integer|min:0',
            'title_break_index_2' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'has_details' => 'boolean',
            'description' => 'nullable|string',
            'specifications' => 'nullable|string',
            'features' => 'nullable|string',
            'title_line1' => 'nullable|string',
            'title_line2' => 'nullable|string',
            'title_line3' => 'nullable|string',
        ]);
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $filename);
            $validated['image'] = 'images/products/' . $filename;
        }
        
        // Set has_details to false by default if not provided
        $validated['has_details'] = $request->has('has_details');
        
        Product::create($validated);
        return redirect()->route('admin.product.index')->with('success', 'Product created!');
    }

    public function edit($id) {
        $product = \App\Models\Product::findOrFail($id);
        $categories = \App\Models\Category::all();
        return view('backend.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'title' => 'required|string',
            'title_break_index' => 'nullable|integer|min:0',
            'title_break_index_2' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'has_details' => 'boolean',
            'description' => 'nullable|string',
            'specifications' => 'nullable|string',
            'features' => 'nullable|string',
            'title_line1' => 'nullable|string',
            'title_line2' => 'nullable|string',
            'title_line3' => 'nullable|string',
        ]);
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(public_path($product->image))) {
                @unlink(public_path($product->image));
            }
            $file = $request->file('image');
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/products'), $filename);
            $validated['image'] = 'images/products/' . $filename;
        }
        
        // Set has_details based on checkbox
        $validated['has_details'] = $request->has('has_details');
        
        $product->update($validated);
        return redirect()->route('admin.product.index')->with('success', 'Product updated!');
    }

    public function destroy(Product $product) {
        // Delete the product image file if it exists
        if ($product->image && file_exists(public_path($product->image))) {
            @unlink(public_path($product->image));
        }
        
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product deleted!');
    }

    // Frontend: show all categories as cards (for Products button)
    public function showCategories() {
        $categories = Category::all();
        return view('frontend.products.categories', compact('categories'));
    }

    // Frontend: show products for a category
    public function showByCategory(Category $category) {
        $products = $category->products()->orderBy('sort_order', 'asc')->get();
        return view('frontend.products.index', compact('products', 'category'));
    }

    // Frontend: show all products (optionally filtered by category)
    public function showAll(Request $request) {
        $categories = Category::all();
        $products = Product::with('category');
        if ($request->filled('category_id')) {
            $products = $products->where('category_id', $request->category_id);
        }
        $products = $products->get();
        return view('frontend.products.all', compact('products', 'categories'));
    }
}
