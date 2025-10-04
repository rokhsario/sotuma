@extends('backend.layouts.master')

@section('title')
Add New About Us Image
@endsection

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-plus"></i> Add New About Us Image
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('about-us-images.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('about-us-images.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                           id="title" name="title" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="type" class="form-label">Image Type <span class="text-danger">*</span></label>
                                    <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="">Select Image Type</option>
                                        @foreach($types as $key => $label)
                                            <option value="{{ $key }}" {{ old('type') == $key ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Choose the appropriate type for this image to be used in the About Us page.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="alt_text" class="form-label">Alt Text</label>
                                    <input type="text" class="form-control @error('alt_text') is-invalid @enderror" 
                                           id="alt_text" name="alt_text" value="{{ old('alt_text') }}">
                                    @error('alt_text')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Alternative text for accessibility and SEO purposes.
                                    </small>
                                </div>

                                <div class="form-group">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" name="description" rows="4">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sort_order" class="form-label">Sort Order</label>
                                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror" 
                                                   id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0">
                                            @error('sort_order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <small class="form-text text-muted">
                                                Lower numbers appear first.
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="form-check mt-4">
                                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" 
                                                       {{ old('is_active', true) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="is_active">
                                                    Active
                                                </label>
                                            </div>
                                            <small class="form-text text-muted">
                                                Only active images will be displayed on the website.
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('image') is-invalid @enderror" 
                                               id="image" name="image" accept="image/*" required>
                                        <label class="custom-file-label" for="image">Choose image...</label>
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Supported formats: JPEG, PNG, JPG, GIF, SVG, WebP<br>
                                        Max size: 5MB<br>
                                        Recommended: 1920x1080px for hero backgrounds
                                    </small>
                                </div>

                                <div class="form-group">
                                    <div id="image-preview" class="text-center" style="display: none;">
                                        <img id="preview-img" src="" alt="Preview" class="img-fluid img-thumbnail" style="max-height: 200px;">
                                        <p class="mt-2"><small class="text-muted">Image Preview</small></p>
                                    </div>
                                </div>

                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h6 class="card-title mb-0">
                                            <i class="fas fa-info-circle"></i> Image Types Guide
                                        </h6>
                                    </div>
                                    <div class="card-body">
                                        <small>
                                            <strong>Hero Background:</strong> Main background image for the About Us page<br><br>
                                            <strong>Section Image:</strong> Images used in content sections<br><br>
                                            <strong>Team Image:</strong> Team member or company photos<br><br>
                                            <strong>Process Image:</strong> Images showing company processes<br><br>
                                            <strong>Feature Image:</strong> Highlighting company features
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Image
                            </button>
                            <a href="{{ route('about-us-images.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Image preview
    $('#image').change(function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#preview-img').attr('src', e.target.result);
                $('#image-preview').show();
            };
            reader.readAsDataURL(file);
            
            // Update file label
            $('.custom-file-label').text(file.name);
        } else {
            $('#image-preview').hide();
            $('.custom-file-label').text('Choose image...');
        }
    });

    // Auto-generate alt text from title
    $('#title').on('input', function() {
        const title = $(this).val();
        if (!title) return;
        
        // Only auto-fill if alt_text is empty
        if (!$('#alt_text').val()) {
            $('#alt_text').val(title);
        }
    });

    // Form validation
    $('form').submit(function(e) {
        const title = $('#title').val().trim();
        const type = $('#type').val();
        const image = $('#image')[0].files[0];
        
        if (!title) {
            e.preventDefault();
            showAlert('Title is required!', 'danger');
            $('#title').focus();
            return false;
        }
        
        if (!type) {
            e.preventDefault();
            showAlert('Image type is required!', 'danger');
            $('#type').focus();
            return false;
        }
        
        if (!image) {
            e.preventDefault();
            showAlert('Image file is required!', 'danger');
            $('#image').focus();
            return false;
        }
        
        // Validate image size (2MB)
        if (image.size > 2 * 1024 * 1024) {
            e.preventDefault();
            showAlert('Image size must be less than 2MB!', 'danger');
            return false;
        }
    });

    function showAlert(message, type) {
        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="close" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        `;
        $('.card-body').prepend(alertHtml);
        
        setTimeout(function() {
            $('.alert').fadeOut();
        }, 5000);
    }
});
</script>
@endsection
