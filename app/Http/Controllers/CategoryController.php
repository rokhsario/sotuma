<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::paginate(10); // Paginate results for links()
        return view('backend.category.index', compact('categories'));
    }

    public function create() {
        return view('backend.category.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:92160', // 90MB
        ]);
        
        // Generate slug from title
        $validated['slug'] = Str::slug($validated['title']);
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/categories'), $filename);
            $validated['image'] = 'images/categories/' . $filename;
        }
        Category::create($validated);
        return redirect()->route('admin.category.index')->with('success', 'Category created!');
    }

    public function edit($id) {
        $category = \App\Models\Category::findOrFail($id);
        return view('backend.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $validated = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:92160', // 90MB
        ]);
        
        // Generate slug from title
        $validated['slug'] = Str::slug($validated['title']);
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && file_exists(public_path($category->image))) {
                @unlink(public_path($category->image));
            }
            $file = $request->file('image');
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/categories'), $filename);
            $validated['image'] = 'images/categories/' . $filename;
        } else {
            unset($validated['image']);
        }
        $category->update($validated);
        return redirect()->route('admin.category.index')->with('success', 'Category updated!');
    }

    public function destroy(Category $category) {
        // Delete the category image file if it exists
        if ($category->image && file_exists(public_path($category->image))) {
            @unlink(public_path($category->image));
        }
        
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category deleted!');
    }

    // Admin: Manage products in a category
    public function manageProducts($id) {
        $category = Category::findOrFail($id);
        $products = $category->products()->orderBy('sort_order', 'asc')->get();
        return view('backend.category.products', compact('category', 'products'));
    }

    // Admin: Sort products in a category
    public function sortProducts(Request $request, $id) {
        $category = Category::findOrFail($id);
        
        $request->validate([
            'product_ids' => 'required|array',
            'product_ids.*' => 'exists:products,id'
        ]);

        foreach ($request->product_ids as $index => $productId) {
            $category->products()->where('id', $productId)->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true, 'message' => 'Products sorted successfully!']);
    }

    // Frontend: show all categories as cards
    public function showAll() {
        $categories = Category::whereNull('parent_id')->orderBy('sort_order','ASC')->orderBy('title','ASC')->get();
        return view('frontend.categories.index', compact('categories'));
    }

    // Frontend: show category detail with products
    public function show($slug) {
        $category = Category::where('slug', $slug)
            ->with('products')
            ->first();
            
        if (!$category) {
            // Try to find by ID as fallback
            $category = Category::find($slug);
            if (!$category) {
                abort(404, 'Category not found');
            }
        }
            
        // Get all products from this category ordered by sort_order
        $products = $category->products()->orderBy('sort_order', 'asc')->get();
        
        return view('frontend.categories.show', compact('category', 'products'));
    }
}
