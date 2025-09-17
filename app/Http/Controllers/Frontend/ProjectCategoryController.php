<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectCategory;

class ProjectCategoryController extends Controller
{
    // Frontend: show all project categories as cards
    public function index()
    {
        $categories = ProjectCategory::orderBy('name', 'ASC')->get();
        return view('frontend.project-categories.index', compact('categories'));
    }

    // Frontend: show project category detail with projects
    public function show($slug)
    {
        $category = ProjectCategory::where('slug', $slug)
            ->with('projects.images')
            ->first();
            
        if (!$category) {
            // Try to find by ID as fallback
            $category = ProjectCategory::find($slug);
            if (!$category) {
                abort(404, 'Catégorie de projet non trouvée');
            }
        }
            
        // Get all projects from this category
        $projects = $category->projects;
        
        return view('frontend.project-categories.show', compact('category', 'projects'));
    }
} 