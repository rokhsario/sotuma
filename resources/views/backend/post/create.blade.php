@extends('backend.layouts.master')

@section('main-content')

<div class="card">
    <h5 class="card-header">Add Media</h5>
    <div class="card-body">
      <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data" onsubmit="return validateForm()">
        {{csrf_field()}}
        
        <!-- Basic Information Section -->
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                  <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                  <input id="inputTitle" type="text" name="title" placeholder="Enter media title"  value="{{old('title')}}" class="form-control">
                  @error('title')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="summary" class="col-form-label">Summary</label>
                  <textarea class="form-control" id="summary" name="summary">{{old('summary')}}</textarea>
                  @error('summary')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="description" class="col-form-label">Description</label>
                  <textarea class="form-control" id="description" name="description">{{old('description')}}</textarea>
                  @error('description')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="form-group">
                  <label for="post_cat_id">Category <span class="text-danger">*</span></label>
                  <select name="post_cat_id" class="form-control">
                      <option value="">--Select any category--</option>
                      @foreach($categories as $key=>$data)
                          <option value='{{$data->id}}'>{{$data->title}}</option>
                      @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="added_by">Author</label>
                  <select name="added_by" class="form-control">
                      <option value="">--Select any one--</option>
                      @foreach($users as $key=>$data)
                        <option value='{{$data->id}}' {{($key==0) ? 'selected' : ''}}>{{$data->name}}</option>
                    @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                  <select name="status" class="form-control">
                      <option value="active">Active</option>
                      <option value="inactive">Inactive</option>
                  </select>
                  @error('status')
                  <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
            </div>
        </div>

        <!-- Quote Section -->
        <div class="form-group">
          <label for="quote" class="col-form-label">Quote</label>
          <textarea class="form-control" id="quote" name="quote">{{old('quote')}}</textarea>
          @error('quote')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>

        <!-- Media Files Section -->
        <div class="form-group">
            <label>Media Files (Images & Videos)</label>
            
            <!-- New Media Upload -->
            <div class="new-images-upload">
                <h6 class="mb-2">Add Media Files:</h6>
                <div class="image-upload-container">
                    <div class="upload-area" id="uploadArea">
                        <div class="upload-content">
                            <i class="fas fa-cloud-upload-alt fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-1 small">Drag & drop or click</p>
                            <button type="button" class="btn btn-outline-primary btn-sm" id="browseBtn">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        </div>
                        <input type="file" id="imageInput" name="images[]" multiple accept="image/*,video/mp4,video/avi,video/mov,video/wmv,video/flv,video/webm,video/mkv" style="display: none;">
                    </div>
                    
                    <div class="image-preview-container mt-3" id="imagePreviewContainer" style="display: none;">
                        <h6 class="mb-2">Selected Media Files:</h6>
                        <div class="image-preview-grid" id="imagePreviewGrid"></div>
                    </div>
                    
                    <!-- Main Image Selection -->
                    <div class="main-image-selection mt-3" id="mainImageSelection" style="display: none;">
                        <h6 class="mb-2">Select Main Image (Images Only):</h6>
                        <div class="main-image-options" id="mainImageOptions"></div>
                        <input type="hidden" name="main_image_index" id="mainImageIndex" value="0">
                    </div>
                </div>
                <small class="form-text text-muted">
                    Formats: JPG, PNG, GIF, SVG, WEBP, MP4, AVI, MOV, WMV, FLV, WEBM, MKV. Max: 100MB per file.<br>
                    <strong>Note:</strong> Main image selection only appears when uploading images. Videos don't require a main image.
                </small>
            </div>
        </div>

        <!-- Main Photo Upload (from PC) -->
        <div class="form-group">
          <label for="main_photo" class="col-form-label">Main Photo</label>
          <input type="file" id="main_photo" name="main_photo" accept="image/*" class="form-control">
          <img id="mainPhotoPreview" src="" alt="Main photo preview" style="height: 5rem; margin-top: 10px; display: none;" onerror="this.onerror=null;this.src='/images/no-image.png';">
          @error('main_photo')
          <span class="text-danger">{{$message}}</span>
          @enderror
        </div>
        
        <div class="form-group mb-3">
          <button type="reset" class="btn btn-warning">Reset</button>
           <button class="btn btn-success" type="submit">Submit</button>
        </div>
      </form>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{asset('backend/summernote/summernote.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<style>
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
    .image-preview-grid {
        grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
    }
}
</style>
@endpush

@push('scripts')
<script src="{{asset('backend/summernote/summernote.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<script>
    // Main photo preview
    document.getElementById('main_photo')?.addEventListener('change', function() {
        const [file] = this.files;
        const preview = document.getElementById('mainPhotoPreview');
        if (file && preview) {
            preview.src = URL.createObjectURL(file);
            preview.style.display = 'block';
        }
    });

    $(document).ready(function() {
      $('#summary').summernote({
        placeholder: "Write short description.....",
          tabsize: 2,
          height: 100
      });
    });

    $(document).ready(function() {
      $('#description').summernote({
        placeholder: "Write detail description.....",
          tabsize: 2,
          height: 150
      });
    });

    $(document).ready(function() {
      $('#quote').summernote({
        placeholder: "Write detail Quote.....",
          tabsize: 2,
          height: 100
      });
    });

    // Image Upload Handling (same as projects)
    let selectedFiles = [];
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
            // Filter for both images and videos
            const validFiles = files.filter(file => 
                file.type.startsWith('image/') || file.type.startsWith('video/')
            );
            
            if (validFiles.length === 0) {
                alert('Please select valid image or video files.');
                return;
            }

            selectedFiles = selectedFiles.concat(validFiles);
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
                const previewItem = document.createElement('div');
                previewItem.className = 'image-preview-item';
                
                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                
                if (file.type.startsWith('image/')) {
                    // Handle image files
                    const reader = new FileReader();
                    reader.onload = function(e) {
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
                } else if (file.type.startsWith('video/')) {
                    // Handle video files
                    const videoUrl = URL.createObjectURL(file);
                    previewItem.innerHTML = `
                        <video controls style="width: 100%; height: 120px; object-fit: cover;">
                            <source src="${videoUrl}" type="${file.type}">
                            Your browser does not support the video tag.
                        </video>
                        <button type="button" class="remove-btn" onclick="removeNewImage(${index})">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="image-info">
                            ${fileSize} MB - ${file.type.split('/')[1].toUpperCase()}
                        </div>
                    `;
                    imagePreviewGrid.appendChild(previewItem);
                }
            });
        }

        function updateMainImageSelection() {
            if (selectedFiles.length === 0) {
                mainImageSelection.style.display = 'none';
                return;
            }

            // Check if there are any image files (not videos)
            const imageFiles = selectedFiles.filter(file => file.type.startsWith('image/'));
            
            if (imageFiles.length === 0) {
                // No images, only videos - hide main image selection
                mainImageSelection.style.display = 'none';
                return;
            }

            mainImageSelection.style.display = 'block';
            mainImageOptions.innerHTML = '';

            // Only show image files for main image selection
            let imageIndex = 0;
            selectedFiles.forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const optionItem = document.createElement('div');
                        optionItem.className = `main-image-option ${imageIndex === mainImageIndex ? 'selected' : ''}`;
                        optionItem.onclick = () => selectMainImage(index); // Use original index
                        
                        optionItem.innerHTML = `
                            <img src="${e.target.result}" alt="Main image option">
                            ${imageIndex === mainImageIndex ? '<div class="main-label">MAIN</div>' : ''}
                        `;
                        
                        mainImageOptions.appendChild(optionItem);
                    };
                    reader.readAsDataURL(file);
                    imageIndex++;
                }
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
        
        // Form validation function
        window.validateForm = function() {
            // Ensure files are properly set
            if (selectedFiles.length > 0) {
                updateFileInput();
            }
            
            return true; // Allow form submission
        };
    });
</script>
@endpush
