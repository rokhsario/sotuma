<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\Media;
use App\Models\PostCategory;
use App\Models\PostTag;
use App\User;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::getAllPost();
        // return $posts;
        return view('backend.post.index')->with('posts',$posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=PostCategory::get();
        $tags=PostTag::get();
        $users=User::get();
        return view('backend.post.create')->with('users',$users)->with('categories',$categories)->with('tags',$tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request,[
            'title'=>'string|required',
            'quote'=>'string|nullable',
            'summary'=>'string|nullable',
            'description'=>'string|nullable',
            'photo'=>'string|nullable',
            'main_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:51200',
            'tags'=>'nullable',
            'added_by'=>'nullable',
            'post_cat_id'=>'required',
            'status'=>'required|in:active,inactive',
            'images.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,mp4,avi,mov,wmv,flv,webm,mkv|max:102400', // 100MB max for videos
            'main_image_index' => 'nullable|integer|min:0',
        ]);

        $data=$request->all();

        $slug=Str::slug($request->title);
        $count=Post::where('slug',$slug)->count();
        if($count>0){
            $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        }
        $data['slug']=$slug;

        $tags=$request->input('tags');
        if($tags){
            $data['tags']=implode(',',$tags);
        }
        else{
            $data['tags']='';
        }

        try {
            $post = Post::create($data);
            
            // Handle main photo uploaded directly
            if ($request->hasFile('main_photo')) {
                $uploadPath = public_path('images/blog');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                $file = $request->file('main_photo');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $filename);
                $mainPhotoPath = 'images/blog/' . $filename;
                $post->update(['photo' => $mainPhotoPath]);
            }
            
            // Handle new image uploads
            $mainImage = null;
            $uploadedImages = [];
            if ($request->hasFile('images')) {
                // Create directory if it doesn't exist
                $uploadPath = public_path('images/blog');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                foreach ($request->file('images') as $image) {
                    // Generate unique filename like products system
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    
                    // Move file to public directory (creates a copy)
                    $image->move($uploadPath, $filename);
                    $imagePath = 'images/blog/' . $filename;
                    
                    $post->images()->create(['image' => $imagePath]);
                    $uploadedImages[] = $imagePath;
                }
                
                // Set main image based on user selection only if no direct main photo was uploaded
                if (!$request->hasFile('main_photo')) {
                    $mainImageIndex = $request->input('main_image_index', 0);
                    if (isset($uploadedImages[$mainImageIndex])) {
                        $mainImage = $uploadedImages[$mainImageIndex];
                        $post->update(['photo' => $mainImage]);
                    } elseif (!empty($uploadedImages)) {
                        // Fallback to first image if selection is invalid
                        $post->update(['photo' => $uploadedImages[0]]);
                    }
                }
                
                // If no main image was set and we have uploaded files, set the first one as main
                if (!$post->photo && !empty($uploadedImages)) {
                    $post->update(['photo' => $uploadedImages[0]]);
                }
            }
            
            $fileCount = $request->hasFile('images') ? count($request->file('images')) : 0;
            $fileType = $fileCount > 0 ? 'media file(s)' : 'media file(s)';
            request()->session()->flash('success','Media Successfully added with ' . $fileCount . ' ' . $fileType . '.');
        } catch (\Exception $e) {
            request()->session()->flash('error','Error creating media: ' . $e->getMessage());
        }
        
        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::with(['media', 'images'])->findOrFail($id);
        $categories=PostCategory::get();
        $tags=PostTag::get();
        $users=User::get();
        return view('backend.post.edit')->with('categories',$categories)->with('users',$users)->with('tags',$tags)->with('post',$post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post=Post::findOrFail($id);
         // return $request->all();
         $this->validate($request,[
            'title'=>'string|required',
            'quote'=>'string|nullable',
            'summary'=>'string|nullable',
            'description'=>'string|nullable',
             'photo'=>'string|nullable',
             'main_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:51200',
            'tags'=>'nullable',
            'added_by'=>'nullable',
            'post_cat_id'=>'required',
            'status'=>'required|in:active,inactive',
            'images.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,webp,mp4,avi,mov,wmv,flv,webm,mkv|max:102400', // 100MB max for videos
            'images_to_delete' => 'nullable|string',
            'main_image_index' => 'nullable|integer|min:0',
            'existing_main_image' => 'nullable|string',
        ]);

        $data=$request->all();
        $tags=$request->input('tags');
        // return $tags;
        if($tags){
            $data['tags']=implode(',',$tags);
        }
        else{
            $data['tags']='';
        }

        try {
            // Update basic post info
            $post->fill($data)->save();

            // Handle image deletions
            if ($request->filled('images_to_delete')) {
                \Log::info('Images to delete: ' . $request->images_to_delete);
                $imagesToDelete = explode(',', $request->images_to_delete);
                foreach ($imagesToDelete as $imageId) {
                    $image = $post->images()->find($imageId);
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
                $uploadPath = public_path('images/blog');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                
                foreach ($request->file('images') as $image) {
                    // Generate unique filename like products system
                    $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                    
                    // Move file to public directory (creates a copy)
                    $image->move($uploadPath, $filename);
                    $imagePath = 'images/blog/' . $filename;
                    
                    $post->images()->create(['image' => $imagePath]);
                    $uploadedImages[] = $imagePath;
                    $newImagesCount++;
                }
            }

            // Handle main image selection or direct main photo upload
            $mainImage = null;
            if ($request->hasFile('main_photo')) {
                // Direct main photo uploaded from PC
                $uploadPath = public_path('images/blog');
                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }
                $file = $request->file('main_photo');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move($uploadPath, $filename);
                $mainPhotoPath = 'images/blog/' . $filename;
                $post->update(['photo' => $mainPhotoPath]);
            } elseif ($request->hasFile('images') && $request->filled('main_image_index')) {
                // New images uploaded, use selected index
                $mainImageIndex = $request->input('main_image_index', 0);
                if (isset($uploadedImages[$mainImageIndex])) {
                    $mainImage = $uploadedImages[$mainImageIndex];
                    $post->update(['photo' => $mainImage]);
                } elseif (!empty($uploadedImages)) {
                    // Fallback to first image if selection is invalid
                    $post->update(['photo' => $uploadedImages[0]]);
                }
            } elseif ($request->filled('existing_main_image')) {
                // Existing image selected as main
                $existingMainImage = $request->input('existing_main_image');
                if ($post->images()->where('image', $existingMainImage)->exists()) {
                    $post->update(['photo' => $existingMainImage]);
                }
            } else {
                // Update main image if current one was deleted
                \Log::info('Checking main image: ' . $post->photo);
                if (!$post->photo || !$post->images()->where('image', $post->photo)->exists()) {
                    \Log::info('Main image was deleted, updating to first available image');
                    $firstImage = $post->images()->first();
                    if ($firstImage) {
                        $post->update(['photo' => $firstImage->image]);
                        \Log::info('Updated main image to: ' . $firstImage->image);
                    } else {
                        \Log::warning('No images left, clearing main image');
                        $post->update(['photo' => '']);
                    }
                } else {
                    \Log::info('Main image still exists: ' . $post->photo);
                }
            }

            $message = 'Media successfully updated.';
            if ($newImagesCount > 0) {
                $message .= " $newImagesCount new image(s) added.";
            }
            if ($request->filled('images_to_delete')) {
                $message .= " Image(s) deleted.";
            }

            request()->session()->flash('success', $message);
        } catch (\Exception $e) {
            request()->session()->flash('error', 'Error updating media: ' . $e->getMessage());
        }
        
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::with('media')->findOrFail($id);
       
        // Delete associated media files
        foreach($post->media as $media){
            $filePath = public_path($media->file_path);
            if(file_exists($filePath)){
                unlink($filePath);
            }
        }
        
        $status=$post->delete();
        
        if($status){
            request()->session()->flash('success','Media successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting media ');
        }
        return redirect()->route('post.index');
    }

    /**
     * Handle media file upload
     */
    private function handleMediaUpload($files, $postId)
    {
        $sortOrder = 0;
        
        foreach($files as $file){
            if (!$file->isValid()) {
                continue; // Skip invalid files
            }
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('images/blog');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Generate unique filename like products system
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Move file to public directory (creates a copy)
            if (!$file->move($uploadPath, $filename)) {
                continue; // Skip if file move failed
            }
            
            $filePath = 'images/blog/' . $filename;
            $fullPath = public_path($filePath);
            
            // Get file info
            $fileType = strtolower($file->getClientOriginalExtension());
            $fileSize = filesize($fullPath);
            $dimensions = null;
            $duration = null;
            
            // Get dimensions for images
            if(in_array($fileType, ['jpg', 'jpeg', 'png', 'gif', 'webp'])){
                if (file_exists($fullPath)) {
                    $imageInfo = getimagesize($fullPath);
                    if($imageInfo){
                        $dimensions = $imageInfo[0] . 'x' . $imageInfo[1];
                    }
                }
            }
            
            // Get duration for videos (basic implementation)
            if(in_array($fileType, ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm', 'mkv'])){
                // For now, we'll set duration as null
                // In a production environment, you might want to use FFmpeg to get actual duration
                $duration = null;
            }
            
            // Create media record
            try {
                Media::create([
                    'post_id' => $postId,
                    'file_path' => $filePath,
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $fileType,
                    'file_size' => $fileSize,
                    'dimensions' => $dimensions,
                    'duration' => $duration,
                    'sort_order' => $sortOrder,
                    'is_featured' => $sortOrder === 0 // First file is featured
                ]);
                
                $sortOrder++;
            } catch (\Exception $e) {
                // Log error and continue with next file
                \Log::error('Error creating media record: ' . $e->getMessage());
                continue;
            }
        }
    }

    /**
     * Delete a specific media file
     */
    public function deleteMedia($mediaId)
    {
        $media = Media::findOrFail($mediaId);
        
        $filePath = public_path($media->file_path);
        if(file_exists($filePath)){
            unlink($filePath);
        }
        
        $media->delete();
        
        return response()->json(['success' => true]);
    }

    /**
     * Update media order
     */
    public function updateMediaOrder(Request $request)
    {
        $mediaIds = $request->input('media_ids', []);
        
        foreach($mediaIds as $index => $mediaId){
            Media::where('id', $mediaId)->update(['sort_order' => $index]);
        }
        
        return response()->json(['success' => true]);
    }
}
