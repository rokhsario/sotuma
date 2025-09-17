@extends('backend.layouts.master')
@section('title','Modifier le projet')
@section('main-content')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Modifier le projet</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">Titre <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" value="{{ $project->title }}" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" class="form-control" rows="6" required>{{ $project->description }}</textarea>
                                </div>
                                
                                <div class="form-group">
                                    <label for="project_category_id">Catégorie <span class="text-danger">*</span></label>
                                    <select name="project_category_id" class="form-control" required>
                                        <option value="">Sélectionner une catégorie</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $project->project_category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Images du projet</label>
                                    
                                    <!-- Existing Images -->
                                    @if($project->images->count() > 0)
                                    <div class="existing-images mb-3">
                                        <h6 class="mb-2">Images existantes:</h6>
                                        <div class="existing-images-grid">
                                            @foreach($project->images as $img)
                                                <div class="existing-image-item" data-image-id="{{ $img->id }}">
                                                    <img src="{{ asset($img->image) }}" alt="Project image" class="img-thumbnail">
                                                    <div class="image-overlay">
                                                        <button type="button" class="btn btn-sm btn-danger delete-image-btn" 
                                                                data-image-id="{{ $img->id }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-primary set-main-btn" 
                                                                data-image-path="{{ $img->image }}" data-image-id="{{ $img->id }}">
                                                            @if($img->image === $project->image)
                                                                <i class="fas fa-star"></i> Principale
                                                            @else
                                                                <i class="fas fa-star-o"></i> Définir
                                                            @endif
                                                        </button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                    
                                    <!-- New Images Upload -->
                                    <div class="new-images-upload">
                                        <h6 class="mb-2">Ajouter de nouvelles images:</h6>
                                        <div class="image-upload-container">
                                            <div class="upload-area" id="uploadArea">
                                                <div class="upload-content">
                                                    <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                                                    <p class="text-muted mb-1 small">Glissez-déposez ou cliquez</p>
                                                    <button type="button" class="btn btn-outline-primary btn-sm" id="browseBtn">
                                                        <i class="fas fa-plus"></i> Ajouter
                                                    </button>
                                                </div>
                                                <input type="file" id="imageInput" name="images[]" multiple accept="image/*" style="display: none;">
                                            </div>
                                            
                                            <div class="image-preview-container mt-3" id="imagePreviewContainer" style="display: none;">
                                                <h6 class="mb-2">Nouvelles images:</h6>
                                                <div class="image-preview-grid" id="imagePreviewGrid"></div>
                                            </div>
                                            
                                            <!-- Main Image Selection -->
                                            <div class="main-image-selection mt-3" id="mainImageSelection" style="display: none;">
                                                <h6 class="mb-2">Sélectionner l'image principale:</h6>
                                                <div class="main-image-options" id="mainImageOptions"></div>
                                                <input type="hidden" name="main_image_index" id="mainImageIndex" value="0">
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Formats: JPG, PNG, GIF, SVG, WEBP. Max: 50MB par image.
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Hidden inputs for form data -->
                        <input type="hidden" name="images_to_delete" id="imagesToDelete" value="">
                        <input type="hidden" name="existing_main_image" id="existingMainImage" value="{{ $project->image }}">

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Mettre à jour
                            </button>
                            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.existing-images-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 10px;
    max-height: 300px;
    overflow-y: auto;
}

.existing-image-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
    border: 2px solid transparent;
}

.existing-image-item:hover {
    transform: scale(1.05);
}

.existing-image-item img {
    width: 100%;
    height: 100px;
    object-fit: cover;
}

.existing-image-item .image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.2s ease;
    gap: 5px;
}

.existing-image-item:hover .image-overlay {
    opacity: 1;
}

.delete-image-btn, .set-main-btn {
    border: none;
    border-radius: 4px;
    padding: 4px 8px;
    font-size: 11px;
    cursor: pointer;
    transition: background 0.2s ease;
}

.delete-image-btn {
    background: rgba(220, 53, 69, 0.9);
    color: white;
}

.delete-image-btn:hover {
    background: rgba(220, 53, 69, 1);
}

.set-main-btn {
    background: rgba(0, 123, 255, 0.9);
    color: white;
}

.set-main-btn:hover {
    background: rgba(0, 123, 255, 1);
}

.image-upload-container {
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 15px;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.image-upload-container:hover {
    border-color: #007bff;
    background: #f0f8ff;
}

.upload-area {
    text-align: center;
    padding: 15px;
    border-radius: 6px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.upload-area.dragover {
    background: #e3f2fd;
    border: 2px dashed #2196f3;
}

.upload-content {
    pointer-events: none;
}

.upload-content button {
    pointer-events: auto;
}

.image-preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 8px;
    max-height: 200px;
    overflow-y: auto;
}

.image-preview-item {
    position: relative;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
}

.image-preview-item:hover {
    transform: scale(1.05);
}

.image-preview-item img {
    width: 100%;
    height: 80px;
    object-fit: cover;
}

.image-preview-item .remove-btn {
    position: absolute;
    top: 3px;
    right: 3px;
    background: rgba(220, 53, 69, 0.9);
    color: white;
    border: none;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    font-size: 10px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s ease;
}

.image-preview-item .remove-btn:hover {
    background: rgba(220, 53, 69, 1);
}

.main-image-options {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
    gap: 8px;
    max-height: 150px;
    overflow-y: auto;
}

.main-image-option {
    position: relative;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    cursor: pointer;
    transition: all 0.2s ease;
    border: 2px solid transparent;
}

.main-image-option:hover {
    transform: scale(1.05);
    border-color: #007bff;
}

.main-image-option.selected {
    border-color: #28a745;
    box-shadow: 0 0 0 2px rgba(40, 167, 69, 0.3);
}

.main-image-option img {
    width: 100%;
    height: 60px;
    object-fit: cover;
}

.main-image-option .main-label {
    position: absolute;
    top: 2px;
    left: 2px;
    background: #28a745;
    color: white;
    font-size: 8px;
    padding: 2px 4px;
    border-radius: 3px;
    font-weight: bold;
}

@media (max-width: 768px) {
    .existing-images-grid,
    .image-preview-grid {
        grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
    }
}
</style>

@push('scripts')
<script>
let selectedFiles = [];
let imagesToDelete = [];
let mainImageIndex = 0;

document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const imageInput = document.getElementById('imageInput');
    const browseBtn = document.getElementById('browseBtn');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const imagePreviewGrid = document.getElementById('imagePreviewGrid');
    const mainImageSelection = document.getElementById('mainImageSelection');
    const mainImageOptions = document.getElementById('mainImageOptions');
    const mainImageIndexInput = document.getElementById('mainImageIndex');

    // Delete existing image
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-image-btn')) {
            const btn = e.target.closest('.delete-image-btn');
            const imageId = btn.getAttribute('data-image-id');
            
            if (confirm('Êtes-vous sûr de vouloir supprimer cette image ?')) {
                imagesToDelete.push(imageId);
                btn.closest('.existing-image-item').style.display = 'none';
                updateImagesToDeleteInput();
            }
        }
    });

    // Set main image from existing images
    document.addEventListener('click', function(e) {
        if (e.target.closest('.set-main-btn')) {
            const btn = e.target.closest('.set-main-btn');
            const imagePath = btn.getAttribute('data-image-path');
            
            document.getElementById('existingMainImage').value = imagePath;
            
            // Update visual feedback
            document.querySelectorAll('.set-main-btn').forEach(b => {
                b.innerHTML = '<i class="fas fa-star-o"></i> Définir';
            });
            btn.innerHTML = '<i class="fas fa-star"></i> Principale';
        }
    });

    // Form submit
    document.querySelector('form').addEventListener('submit', function(e) {
        updateImagesToDeleteInput();
    });

    function updateImagesToDeleteInput() {
        document.getElementById('imagesToDelete').value = imagesToDelete.join(',');
    }

    // Upload area functionality
    uploadArea.addEventListener('click', function(e) {
        if (e.target !== browseBtn && !browseBtn.contains(e.target)) {
            imageInput.click();
        }
    });

    browseBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        imageInput.click();
    });

    // Drag and drop
    uploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        uploadArea.classList.remove('dragover');
        const files = Array.from(e.dataTransfer.files);
        handleFiles(files);
    });

    // File input change
    imageInput.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);
        handleFiles(files);
    });

    function handleFiles(files) {
        const imageFiles = files.filter(file => file.type.startsWith('image/'));
        
        if (imageFiles.length === 0) {
            alert('Veuillez sélectionner des fichiers image valides.');
            return;
        }

        selectedFiles = selectedFiles.concat(imageFiles);
        updateImagePreview();
        updateMainImageSelection();
        updateFileInput();
    }

    function updateImagePreview() {
        if (selectedFiles.length === 0) {
            imagePreviewContainer.style.display = 'none';
            return;
        }

        imagePreviewContainer.style.display = 'block';
        imagePreviewGrid.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'image-preview-item';
                
                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                
                previewItem.innerHTML = `
                    <img src="${e.target.result}" alt="Preview">
                    <button type="button" class="remove-btn" onclick="removeNewImage(${index})">
                        <i class="fas fa-times"></i>
                    </button>
                    <div class="image-info">
                        ${fileSize} MB
                    </div>
                `;
                
                imagePreviewGrid.appendChild(previewItem);
            };
            reader.readAsDataURL(file);
        });
    }

    function updateMainImageSelection() {
        if (selectedFiles.length === 0) {
            mainImageSelection.style.display = 'none';
            return;
        }

        mainImageSelection.style.display = 'block';
        mainImageOptions.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const optionItem = document.createElement('div');
                optionItem.className = `main-image-option ${index === mainImageIndex ? 'selected' : ''}`;
                optionItem.onclick = () => selectMainImage(index);
                
                optionItem.innerHTML = `
                    <img src="${e.target.result}" alt="Main image option">
                    ${index === mainImageIndex ? '<div class="main-label">PRINCIPALE</div>' : ''}
                `;
                
                mainImageOptions.appendChild(optionItem);
            };
            reader.readAsDataURL(file);
        });
    }

    function selectMainImage(index) {
        mainImageIndex = index;
        mainImageIndexInput.value = index;
        updateMainImageSelection();
    }

    function updateFileInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        imageInput.files = dt.files;
    }

    // Global function to remove new image
    window.removeNewImage = function(index) {
        selectedFiles.splice(index, 1);
        
        if (index <= mainImageIndex && mainImageIndex > 0) {
            mainImageIndex--;
            mainImageIndexInput.value = mainImageIndex;
        } else if (index < mainImageIndex) {
            mainImageIndex--;
            mainImageIndexInput.value = mainImageIndex;
        }
        
        updateImagePreview();
        updateMainImageSelection();
        updateFileInput();
    };
});
</script>
@endpush

@endsection 