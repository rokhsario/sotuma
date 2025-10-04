<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AboutUsImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = AboutUsImage::orderBy('sort_order')->get();
        return view('admin.about-us-images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = [
            'hero_bg' => 'Hero Background',
            'section_image' => 'Section Image',
            'team_image' => 'Team Image',
            'process_image' => 'Process Image',
            'feature_image' => 'Feature Image'
        ];
        
        return view('admin.about-us-images.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120', // Increased max size and added webp
            'type' => 'required|in:hero_bg,section_image,team_image,process_image,feature_image',
            'alt_text' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean'
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $image = $request->file('image');
                
                // Get file extension safely
                $extension = $image->getClientOriginalExtension();
                if (empty($extension)) {
                    $extension = $image->guessExtension();
                }
                
                $imageName = time() . '_' . Str::slug($request->title) . '.' . $extension;
                $destinationPath = public_path('images/about-us');
                
                // Create directory if it doesn't exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                
                // Move uploaded file to public directory
                if ($image->move($destinationPath, $imageName)) {
                    $imagePath = 'images/about-us/' . $imageName;
                } else {
                    throw new \Exception('Failed to move uploaded file');
                }
            } else {
                throw new \Exception('No valid image file uploaded');
            }

            AboutUsImage::create([
                'title' => $request->title,
                'image_path' => $imagePath,
                'type' => $request->type,
                'alt_text' => $request->alt_text,
                'description' => $request->description,
                'sort_order' => $request->sort_order ?? 0,
                'is_active' => $request->boolean('is_active', true)
            ]);

            return redirect()->route('about-us-images.index')
                ->with('success', 'About Us image created successfully.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to upload image: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutUsImage $aboutUsImage)
    {
        return view('admin.about-us-images.show', compact('aboutUsImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutUsImage $aboutUsImage)
    {
        $types = [
            'hero_bg' => 'Hero Background',
            'section_image' => 'Section Image',
            'team_image' => 'Team Image',
            'process_image' => 'Process Image',
            'feature_image' => 'Feature Image'
        ];
        
        return view('admin.about-us-images.edit', compact('aboutUsImage', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutUsImage $aboutUsImage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120', // Increased max size and added webp
            'type' => 'required|in:hero_bg,section_image,team_image,process_image,feature_image',
            'alt_text' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean'
        ]);

        try {
            $imagePath = $aboutUsImage->image_path;
            
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                // Delete old image
                if ($aboutUsImage->image_path && File::exists(public_path($aboutUsImage->image_path))) {
                    File::delete(public_path($aboutUsImage->image_path));
                }
                
                // Store new image
                $image = $request->file('image');
                
                // Get file extension safely
                $extension = $image->getClientOriginalExtension();
                if (empty($extension)) {
                    $extension = $image->guessExtension();
                }
                
                $imageName = time() . '_' . Str::slug($request->title) . '.' . $extension;
                $destinationPath = public_path('images/about-us');
                
                // Create directory if it doesn't exist
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }
                
                // Move uploaded file to public directory
                if ($image->move($destinationPath, $imageName)) {
                    $imagePath = 'images/about-us/' . $imageName;
                } else {
                    throw new \Exception('Failed to move uploaded file');
                }
            }

            $aboutUsImage->update([
                'title' => $request->title,
                'image_path' => $imagePath,
                'type' => $request->type,
                'alt_text' => $request->alt_text,
                'description' => $request->description,
                'sort_order' => $request->sort_order ?? 0,
                'is_active' => $request->boolean('is_active', true)
            ]);

            return redirect()->route('about-us-images.index')
                ->with('success', 'About Us image updated successfully.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update image: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUsImage $aboutUsImage)
    {
        // Delete image file
        if ($aboutUsImage->image_path && File::exists(public_path($aboutUsImage->image_path))) {
            File::delete(public_path($aboutUsImage->image_path));
        }
        
        $aboutUsImage->delete();

        return redirect()->route('about-us-images.index')
            ->with('success', 'About Us image deleted successfully.');
    }

    /**
     * Update sort order of images
     */
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'images' => 'required|array',
            'images.*.id' => 'required|exists:about_us_images,id',
            'images.*.sort_order' => 'required|integer|min:0'
        ]);

        foreach ($request->images as $imageData) {
            AboutUsImage::where('id', $imageData['id'])
                ->update(['sort_order' => $imageData['sort_order']]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Toggle active status
     */
    public function toggleActive(AboutUsImage $aboutUsImage)
    {
        $aboutUsImage->update(['is_active' => !$aboutUsImage->is_active]);
        
        return response()->json([
            'success' => true,
            'is_active' => $aboutUsImage->is_active
        ]);
    }
}
