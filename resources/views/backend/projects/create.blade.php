@extends('backend.layouts.master')
@section('title','Ajouter un projet')
@section('main-content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Ajouter un projet</h6>
                </div>
                <div class="card-body">
                    {{-- Show validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title">Titre <span class="text-danger">*</span></label>
                                    <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="description">Description <span class="text-danger">*</span></label>
                                    <textarea name="description" id="description" class="form-control" rows="6" required>{{ old('description') }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="project_category_id">Catégorie <span class="text-danger">*</span></label>
                                    <select name="project_category_id" id="project_category_id" class="form-control" required>
                                        <option value="">Sélectionner une catégorie</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('project_category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="images">Images du projet</label>
                                    <div class="image-upload-container">
                                        <div class="upload-area" id="uploadArea">
                                            <div class="upload-content">
                                                <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                                <p class="text-muted mb-2">Glissez-déposez vos images ici</p>
                                                <p class="text-muted small">ou</p>
                                                <button type="button" class="btn btn-outline-primary btn-sm" id="browseBtn">
                                                    <i class="fas fa-folder-open"></i> Parcourir
                                                </button>
                                            </div>
                                            <input type="file" id="imageInput" name="images[]" multiple accept="image/*" style="display: none;">
                                            <input type="hidden" id="mainImageIndex" name="main_image_index" value="0">
                                        </div>
                                        
                                        <div class="image-preview-container mt-3" id="imagePreviewContainer" style="display: none;">
                                            <h6 class="mb-2">Images sélectionnées:</h6>
                                            <div class="image-preview-grid" id="imagePreviewGrid"></div>
                                            <div class="main-image-selection mt-3" id="mainImageSelection" style="display: none;">
                                                <h6 class="mb-2">Image principale:</h6>
                                                <div class="main-image-options" id="mainImageOptions"></div>
                                                <small class="form-text text-muted">
                                                    Sélectionnez l'image qui sera affichée en premier pour ce projet.
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="form-text text-muted">
                                        Formats acceptés: JPG, PNG, GIF, SVG, WEBP. Taille max: 50MB par image.
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Ajouter le projet
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
.image-upload-container {
    border: 2px dashed #dee2e6;
    border-radius: 8px;
    padding: 20px;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.image-upload-container:hover {
    border-color: #007bff;
    background: #f0f8ff;
}

.upload-area {
    text-align: center;
    padding: 20px;
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
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 10px;
    max-height: 300px;
    overflow-y: auto;
}

.image-preview-item {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.2s ease;
}

.image-preview-item:hover {
    transform: scale(1.05);
}

.image-preview-item img {
    width: 100%;
    height: 100px;
    object-fit: cover;
}

.image-preview-item .remove-btn {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(220, 53, 69, 0.9);
    color: white;
    border: none;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    font-size: 12px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s ease;
}

.image-preview-item .remove-btn:hover {
    background: rgba(220, 53, 69, 1);
}

.image-preview-item .image-info {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 4px 8px;
    font-size: 11px;
    text-align: center;
}

.main-image-options {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 10px;
    margin-top: 10px;
}

.main-image-option {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    cursor: pointer;
    transition: all 0.2s ease;
    border: 3px solid transparent;
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
    height: 80px;
    object-fit: cover;
}

.main-image-option .main-label {
    position: absolute;
    top: 5px;
    left: 5px;
    background: rgba(40, 167, 69, 0.9);
    color: white;
    border-radius: 12px;
    padding: 2px 6px;
    font-size: 10px;
    font-weight: bold;
}

@media (max-width: 768px) {
    .image-preview-grid {
        grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    }
}
</style>

@push('scripts')
<script>
let selectedFiles = [];
let mainImageIndex = 0; // Default to first image

document.addEventListener('DOMContentLoaded', function() {
    const uploadArea = document.getElementById('uploadArea');
    const imageInput = document.getElementById('imageInput');
    const browseBtn = document.getElementById('browseBtn');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');
    const imagePreviewGrid = document.getElementById('imagePreviewGrid');
    const mainImageSelection = document.getElementById('mainImageSelection');
    const mainImageOptions = document.getElementById('mainImageOptions');

    // Make upload area clickable
    uploadArea.addEventListener('click', function(e) {
        // Don't trigger if clicking on the browse button (it has its own handler)
        if (e.target !== browseBtn && !browseBtn.contains(e.target)) {
            imageInput.click();
        }
    });

    // Browse button click
    browseBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        imageInput.click();
    });

    // Drag and drop functionality
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

        // Add new files to selected files
        selectedFiles = selectedFiles.concat(imageFiles);
        
        // Update preview
        updateImagePreview();
        
        // Update file input
        updateFileInput();
    }

    function updateImagePreview() {
        if (selectedFiles.length === 0) {
            imagePreviewContainer.style.display = 'none';
            mainImageSelection.style.display = 'none';
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
                    <button type="button" class="remove-btn" onclick="removeImage(${index})">
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

        // Update main image selection
        updateMainImageSelection();
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
                    <img src="${e.target.result}" alt="Main Image Option">
                    ${index === mainImageIndex ? '<div class="main-label">PRINCIPALE</div>' : ''}
                `;
                
                mainImageOptions.appendChild(optionItem);
            };
            reader.readAsDataURL(file);
        });
    }

    function selectMainImage(index) {
        mainImageIndex = index;
        updateMainImageSelection();
        document.getElementById('mainImageIndex').value = index;
    }

    function updateFileInput() {
        // Create a new FileList-like object
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        imageInput.files = dt.files;
    }

    // Global function to remove image
    window.removeImage = function(index) {
        selectedFiles.splice(index, 1);
        
        // Adjust main image index if needed
        if (index <= mainImageIndex && mainImageIndex > 0) {
            mainImageIndex--;
        } else if (index < mainImageIndex) {
            mainImageIndex--;
        }
        
        // If no images left, reset main image index
        if (selectedFiles.length === 0) {
            mainImageIndex = 0;
        }
        
        updateImagePreview();
        updateFileInput();
    };
});
</script>
@endpush
@endsection