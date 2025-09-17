<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;
use Illuminate\Support\Str;

class ProjectCategoryController extends Controller
{
    public function index()
    {
        $categories = ProjectCategory::orderBy('id', 'desc')->paginate(10);
        return view('backend.projectcategory.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.projectcategory.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        
        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/project-categories'), $filename);
            $validated['image'] = 'images/project-categories/' . $filename;
        }
        
        ProjectCategory::create($validated);
        return redirect()->route('admin.projectcategory.index')->with('success', 'Catégorie de projet ajoutée avec succès.');
    }

    public function edit($id)
    {
        $category = ProjectCategory::findOrFail($id);
        return view('backend.projectcategory.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = ProjectCategory::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);
        
        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);
        
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image && file_exists(public_path($category->image))) {
                @unlink(public_path($category->image));
            }
            $file = $request->file('image');
            $filename = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('images/project-categories'), $filename);
            $validated['image'] = 'images/project-categories/' . $filename;
        } else {
            unset($validated['image']);
        }
        
        $category->update($validated);
        return redirect()->route('admin.projectcategory.index')->with('success', 'Catégorie de projet modifiée avec succès.');
    }

    public function destroy($id)
    {
        $category = ProjectCategory::findOrFail($id);
        
        // Delete image if exists
        if ($category->image && file_exists(public_path($category->image))) {
            @unlink(public_path($category->image));
        }
        
        $category->delete();
        return redirect()->route('admin.projectcategory.index')->with('success', 'Catégorie de projet supprimée avec succès.');
    }
} 