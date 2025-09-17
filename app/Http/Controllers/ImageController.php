<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function serveProjectImage($filename)
    {
        $path = public_path('images/projects/' . $filename);
        
        if (!File::exists($path)) {
            abort(404);
        }
        
        $file = File::get($path);
        $type = File::mimeType($path);
        
        return response($file, 200)
            ->header('Content-Type', $type)
            ->header('Cache-Control', 'public, max-age=31536000');
    }
    
    public function serveProjectCategoryImage($filename)
    {
        $path = public_path('images/project-categories/' . $filename);
        
        if (!File::exists($path)) {
            abort(404);
        }
        
        $file = File::get($path);
        $type = File::mimeType($path);
        
        return response($file, 200)
            ->header('Content-Type', $type)
            ->header('Cache-Control', 'public, max-age=31536000');
    }
} 