@extends('backend.layouts.master')

@section('title')
View About Us Image
@endsection

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-eye"></i> About Us Image Details
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('about-us-images.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-sm-3">
                                    <strong>Title:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $aboutUsImage->title }}
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <strong>Type:</strong>
                                </div>
                                <div class="col-sm-9">
                                    <span class="badge badge-info">
                                        {{ ucfirst(str_replace('_', ' ', $aboutUsImage->type)) }}
                                    </span>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <strong>Alt Text:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $aboutUsImage->alt_text ?? 'Not provided' }}
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <strong>Description:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $aboutUsImage->description ?? 'Not provided' }}
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <strong>Sort Order:</strong>
                                </div>
                                <div class="col-sm-9">
                                    <span class="badge badge-secondary">{{ $aboutUsImage->sort_order }}</span>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <strong>Status:</strong>
                                </div>
                                <div class="col-sm-9">
                                    <span class="badge {{ $aboutUsImage->is_active ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $aboutUsImage->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <strong>Created:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $aboutUsImage->created_at->format('F d, Y \a\t h:i A') }}
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <strong>Last Updated:</strong>
                                </div>
                                <div class="col-sm-9">
                                    {{ $aboutUsImage->updated_at->format('F d, Y \a\t h:i A') }}
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-3">
                                    <strong>Image Path:</strong>
                                </div>
                                <div class="col-sm-9">
                                    <code>{{ $aboutUsImage->image_path }}</code>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Image Preview</h5>
                                </div>
                                <div class="card-body text-center">
                                    @if($aboutUsImage->image_path)
                                        <img src="{{ asset($aboutUsImage->image_path) }}" 
                                             alt="{{ $aboutUsImage->alt_text }}" 
                                             class="img-fluid img-thumbnail" 
                                             style="max-height: 300px;">
                                        <p class="mt-2">
                                            <small class="text-muted">
                                                {{ $aboutUsImage->title }}
                                            </small>
                                        </p>
                                    @else
                                        <div class="bg-light d-flex align-items-center justify-content-center" 
                                             style="height: 200px;">
                                            <div class="text-center">
                                                <i class="fas fa-image fa-3x text-muted"></i>
                                                <p class="mt-2 text-muted">No image uploaded</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Quick Actions</h5>
                                </div>
                                <div class="card-body">
                                    <div class="btn-group-vertical w-100" role="group">
                                        <a href="{{ route('about-us-images.edit', $aboutUsImage) }}" 
                                           class="btn btn-warning btn-sm mb-2">
                                            <i class="fas fa-edit"></i> Edit Image
                                        </a>
                                        
                                        <button type="button" 
                                                class="btn btn-sm mb-2 toggle-active {{ $aboutUsImage->is_active ? 'btn-success' : 'btn-secondary' }}"
                                                data-id="{{ $aboutUsImage->id }}"
                                                data-active="{{ $aboutUsImage->is_active }}">
                                            <i class="fas {{ $aboutUsImage->is_active ? 'fa-check' : 'fa-times' }}"></i>
                                            {{ $aboutUsImage->is_active ? 'Deactivate' : 'Activate' }}
                                        </button>
                                        
                                        <button type="button" 
                                                class="btn btn-danger btn-sm delete-image" 
                                                data-id="{{ $aboutUsImage->id }}" 
                                                data-title="{{ $aboutUsImage->title }}">
                                            <i class="fas fa-trash"></i> Delete Image
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">
                                        <i class="fas fa-info-circle"></i> Image Type Info
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <small>
                                        @switch($aboutUsImage->type)
                                            @case('hero_bg')
                                                <strong>Hero Background:</strong> This image will be used as the main background for the About Us page hero section. Recommended size: 1920x1080px.
                                                @break
                                            @case('section_image')
                                                <strong>Section Image:</strong> This image will be displayed in content sections of the About Us page.
                                                @break
                                            @case('team_image')
                                                <strong>Team Image:</strong> This image represents team members or company personnel.
                                                @break
                                            @case('process_image')
                                                <strong>Process Image:</strong> This image illustrates company processes or workflows.
                                                @break
                                            @case('feature_image')
                                                <strong>Feature Image:</strong> This image highlights company features or services.
                                                @break
                                        @endswitch
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the image "<span id="delete-title"></span>"?</p>
                <p class="text-danger"><strong>This action cannot be undone!</strong></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="delete-form" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Toggle active status
    $('.toggle-active').click(function() {
        const button = $(this);
        const imageId = button.data('id');
        const isActive = button.data('active');
        
        $.ajax({
            url: `/admin/about-us-images/${imageId}/toggle-active`,
            method: 'PATCH',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    button.data('active', response.is_active);
                    
                    if (response.is_active) {
                        button.removeClass('btn-secondary').addClass('btn-success');
                        button.find('i').removeClass('fa-times').addClass('fa-check');
                        button.html('<i class="fas fa-check"></i> Deactivate');
                        
                        // Update status badge
                        $('.badge-secondary, .badge-success').removeClass('badge-secondary badge-success').addClass('badge-success').text('Active');
                    } else {
                        button.removeClass('btn-success').addClass('btn-secondary');
                        button.find('i').removeClass('fa-check').addClass('fa-times');
                        button.html('<i class="fas fa-times"></i> Activate');
                        
                        // Update status badge
                        $('.badge-secondary, .badge-success').removeClass('badge-secondary badge-success').addClass('badge-secondary').text('Inactive');
                    }
                    
                    showAlert('Status updated successfully!', 'success');
                }
            },
            error: function() {
                showAlert('Error updating status!', 'danger');
            }
        });
    });

    // Delete confirmation
    $('.delete-image').click(function() {
        const imageId = $(this).data('id');
        const imageTitle = $(this).data('title');
        
        $('#delete-title').text(imageTitle);
        $('#delete-form').attr('action', `/admin/about-us-images/${imageId}`);
        $('#deleteModal').modal('show');
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
        }, 3000);
    }
});
</script>
@endsection
