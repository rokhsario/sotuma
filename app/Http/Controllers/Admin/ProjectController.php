<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectImage;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::with('category')->orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(10);
        return view('backend.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = ProjectCategory::all();
        return view('backend.projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_category_id' => 'required|exists:project_categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:51200', // 50MB
            'main_image_index' => 'nullable|integer|min:0',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        try {
            $project = Project::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'project_category_id' => $validated['project_category_id'],
                'sort_order' => $validated['sort_order'] ?? 0,
                'image' => '', // Will be set after first image upload
            ]);

            $mainImage = null;
            $uploadedImages = [];
            
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $i => $image) {
                    // Create directory if it doesn't exist
                    $uploadPath = public_path('images/projects');
                    if (!file_exists($uploadPath)) {
                        mkdir($uploadPath, 0755, true);
                    }
                    
                    // Generate unique filename like products system
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    
                    // Move file to public directory (creates a copy)
                    $image->move($uploadPath, $filename);
                    $imagePath = 'images/projects/' . $filename;
                    
                    // Store the image path for later use
                    $uploadedImages[] = $imagePath;
                    
                    // Create project image record
                    $project->images()->create(['image' => $imagePath]);
                }
                
                // Set main image based on user selection
                $mainImageIndex = $request->input('main_image_index', 0);
                if (isset($uploadedImages[$mainImageIndex])) {
                    $mainImage = $uploadedImages[$mainImageIndex];
                    $project->update(['image' => $mainImage]);
                } elseif (!empty($uploadedImages)) {
                    // Fallback to first image if selection is invalid
                    $project->update(['image' => $uploadedImages[0]]);
                }
            }

            return redirect()->route('admin.projects.index')
                           ->with('success', 'Projet ajouté avec succès avec ' . ($request->hasFile('images') ? count($request->file('images')) : 0) . ' image(s).');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Erreur lors de la création du projet: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $project->load('images', 'category');
        return view('backend.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $categories = ProjectCategory::all();
        $project->load('images');
        return view('backend.projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'project_category_id' => 'required|exists:project_categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:51200',
            'images_to_delete' => 'nullable|string',
            'main_image_index' => 'nullable|integer|min:0',
            'existing_main_image' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        try {
            // Update basic project info
            $project->update([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'project_category_id' => $validated['project_category_id'],
                'sort_order' => $validated['sort_order'] ?? $project->sort_order,
            ]);

            // Handle image deletions
            if ($request->filled('images_to_delete')) {
                \Log::info('Images to delete: ' . $request->images_to_delete);
                $imagesToDelete = explode(',', $request->images_to_delete);
                foreach ($imagesToDelete as $imageId) {
                    $image = $project->images()->find($imageId);
                    if ($image) {
                        \Log::info('Deleting image: ' . $image->image . ' (ID: ' . $imageId . ')');
                        // Delete file from public directory
                        if (file_exists(public_path($image->image))) {
                            @unlink(public_path($image->image));
                            \Log::info('File deleted from disk: ' . $image->image);
                        } else {
                            \Log::warning('File not found on disk: ' . $image->image);
                        }
                        $image->delete();
                        \Log::info('Image record deleted from database');
                    } else {
                        \Log::warning('Image not found in database: ' . $imageId);
                    }
                }
            } else {
                \Log::info('No images to delete');
            }

            // Handle new image uploads
            $newImagesCount = 0;
            $uploadedImages = [];
            if ($request->hasFile('images')) {
                // Create directory if it doesn't exist
                $uploadPath = public_path('images/projects');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                foreach ($request->file('images') as $image) {
                    // Generate unique filename like products system
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    
                    // Move file to public directory (creates a copy)
                    $image->move($uploadPath, $filename);
                    $imagePath = 'images/projects/' . $filename;
                    
                    $project->images()->create(['image' => $imagePath]);
                    $uploadedImages[] = $imagePath;
                    $newImagesCount++;
                }
            }

            // Handle main image selection
            $mainImage = null;
            if ($request->hasFile('images') && $request->filled('main_image_index')) {
                // New images uploaded, use selected index
                $mainImageIndex = $request->input('main_image_index', 0);
                if (isset($uploadedImages[$mainImageIndex])) {
                    $mainImage = $uploadedImages[$mainImageIndex];
                    $project->update(['image' => $mainImage]);
                } elseif (!empty($uploadedImages)) {
                    // Fallback to first image if selection is invalid
                    $project->update(['image' => $uploadedImages[0]]);
                }
            } elseif ($request->filled('existing_main_image')) {
                // Existing image selected as main
                $existingMainImage = $request->input('existing_main_image');
                if ($project->images()->where('image', $existingMainImage)->exists()) {
                    $project->update(['image' => $existingMainImage]);
                }
            } else {
                // Update main image if current one was deleted
                \Log::info('Checking main image: ' . $project->image);
                if (!$project->image || !$project->images()->where('image', $project->image)->exists()) {
                    \Log::info('Main image was deleted, updating to first available image');
                    $firstImage = $project->images()->first();
                    if ($firstImage) {
                        $project->update(['image' => $firstImage->image]);
                        \Log::info('Updated main image to: ' . $firstImage->image);
                    } else {
                        \Log::warning('No images left, clearing main image');
                        $project->update(['image' => '']);
                    }
                } else {
                    \Log::info('Main image still exists: ' . $project->image);
                }
            }

            $message = 'Projet modifié avec succès.';
            if ($newImagesCount > 0) {
                $message .= " $newImagesCount nouvelle(s) image(s) ajoutée(s).";
            }
            if ($request->filled('images_to_delete')) {
                $message .= " Image(s) supprimée(s).";
            }

            return redirect()->route('admin.projects.index')->with('success', $message);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Erreur lors de la modification du projet: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            // Delete all project images from public directory
            foreach ($project->images as $image) {
                if (file_exists(public_path($image->image))) {
                    @unlink(public_path($image->image));
                }
            }
            
            // Delete the project (cascade will delete image records)
            $project->delete();
            
            return redirect()->route('admin.projects.index')->with('success', 'Projet supprimé avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression du projet: ' . $e->getMessage());
        }
    }

    /**
     * Remove a specific image from a project.
     */
    public function destroyImage($id)
    {
        try {
            $image = ProjectImage::findOrFail($id);
            $project = $image->project;
            
            // Delete file from public directory
            if (file_exists(public_path($image->image))) {
                @unlink(public_path($image->image));
            }
            
            $image->delete();
            
            // Update main image if this was the main image
            if ($project->image === $image->image) {
                $firstImage = $project->images()->first();
                if ($firstImage) {
                    $project->update(['image' => $firstImage->image]);
                } else {
                    $project->update(['image' => '']);
                }
            }
            
            return back()->with('success', 'Image supprimée avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la suppression de l\'image: ' . $e->getMessage());
        }
    }

    /**
     * Set an image as the main image for a project.
     */
    public function setMainImage($projectId, $imageId)
    {
        try {
            $project = Project::findOrFail($projectId);
            $image = $project->images()->findOrFail($imageId);
            
            $project->update(['image' => $image->image]);
            
            return back()->with('success', 'Image principale mise à jour avec succès.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de la mise à jour de l\'image principale: ' . $e->getMessage());
        }
    }

    public function updateOrder(Request $request)
    {
        $request->validate([
            'projects' => 'required|array',
            'projects.*.id' => 'required|integer|exists:projects,id',
            'projects.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->projects as $projectData) {
            Project::where('id', $projectData['id'])
                ->update(['sort_order' => $projectData['sort_order']]);
        }

        return response()->json(['success' => true, 'message' => 'Ordre des projets mis à jour avec succès.']);
    }

    public function updateImageOrder(Request $request, $projectId)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*.id' => 'required|integer|exists:project_images,id',
            'images.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->images as $imageData) {
            ProjectImage::where('id', $imageData['id'])
                ->update(['sort_order' => $imageData['sort_order']]);
        }

        return response()->json(['success' => true, 'message' => 'Ordre des images mis à jour avec succès.']);
    }
}
