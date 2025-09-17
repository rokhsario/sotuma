<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificates = \App\Models\Certificate::latest()->get();
        return view('backend.certificate.index', compact('certificates'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.certificate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:51200', // 50MB
            'description' => 'required|string',
        ]);
        
        $data = $request->only(['title', 'description']);
        
        // Handle image upload like products/projects
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('images/certificates');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Move file to public directory (creates a copy)
            $file->move($uploadPath, $filename);
            $data['image'] = 'images/certificates/' . $filename;
        }
        
        \App\Models\Certificate::create($data);
        
        return redirect()->route('admin.certificate.index')->with('success', 'Certificat ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $certificate = \App\Models\Certificate::findOrFail($id);
        return view('backend.certificate.edit', compact('certificate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $certificate = \App\Models\Certificate::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:51200', // 50MB
            'description' => 'required|string',
        ]);
        
        $data = $request->only(['title', 'description']);
        
        // Handle new image upload like products/projects
        if ($request->hasFile('image')) {
            // Delete old image file if it exists
            if ($certificate->image && file_exists(public_path($certificate->image))) {
                @unlink(public_path($certificate->image));
            }
            
            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            
            // Create directory if it doesn't exist
            $uploadPath = public_path('images/certificates');
            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }
            
            // Move file to public directory (creates a copy)
            $file->move($uploadPath, $filename);
            $data['image'] = 'images/certificates/' . $filename;
        }
        
        $certificate->update($data);
        return redirect()->route('admin.certificate.index')->with('success', 'Certificat mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $certificate = \App\Models\Certificate::findOrFail($id);
        
        // Delete image file if it exists
        if ($certificate->image && file_exists(public_path($certificate->image))) {
            @unlink(public_path($certificate->image));
        }
        
        $certificate->delete();
        return redirect()->route('admin.certificate.index')->with('success', 'Certificat supprimé avec succès.');
    }
}
