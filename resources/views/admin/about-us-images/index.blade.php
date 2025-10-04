@extends('backend.layouts.master')

@section('title')
About Us Images Management
@endsection

@section('main-content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-images"></i> About Us Images Management
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('about-us-images.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Add New Image
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="15%">Image</th>
                                    <th width="20%">Title</th>
                                    <th width="15%">Type</th>
                                    <th width="10%">Sort Order</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Created</th>
                                    <th width="10%">Actions</th>
                                </tr>
                            </thead>
                            <tbody id="sortable-images">
                                @forelse($images as $index => $image)
                                    <tr data-id="{{ $image->id }}">
                                        <td>
                                            <i class="fas fa-grip-vertical text-muted" style="cursor: move;"></i>
                                        </td>
                                        <td>
                                            @if($image->image_path)
                                                <img src="{{ asset($image->image_path) }}" 
                                                     alt="{{ $image->alt_text }}" 
                                                     class="img-thumbnail" 
                                                     style="width: 60px; height: 45px; object-fit: cover;">
                                            @else
                                                <div class="bg-light d-flex align-items-center justify-content-center" 
                                                     style="width: 60px; height: 45px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $image->title }}</strong>
                                            @if($image->description)
                                                <br><small class="text-muted">{{ Str::limit($image->description, 50) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-info">
                                                {{ ucfirst(str_replace('_', ' ', $image->type)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-secondary">{{ $image->sort_order }}</span>
                                        </td>
                                        <td>
                                            <button type="button" 
                                                    class="btn btn-sm toggle-active {{ $image->is_active ? 'btn-success' : 'btn-secondary' }}"
                                                    data-id="{{ $image->id }}"
                                                    data-active="{{ $image->is_active }}">
                                                <i class="fas {{ $image->is_active ? 'fa-check' : 'fa-times' }}"></i>
                                                {{ $image->is_active ? 'Active' : 'Inactive' }}
                                            </button>
                                        </td>
                                        <td>
                                            <small class="text-muted">
                                                {{ $image->created_at->format('M d, Y') }}
                                            </small>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('about-us-images.show', $image) }}" 
                                                   class="btn btn-info btn-sm" title="View">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('about-us-images.edit', $image) }}" 
                                                   class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" 
                                                        class="btn btn-danger btn-sm delete-image" 
                                                        data-id="{{ $image->id }}" 
                                                        data-title="{{ $image->title }}"
                                                        title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            <i class="fas fa-images fa-3x mb-3"></i>
                                            <br>No images found. <a href="{{ route('about-us-images.create') }}">Create your first image</a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
$(document).ready(function() {
    // Sortable functionality
    const sortable = Sortable.create(document.getElementById('sortable-images'), {
        handle: '.fa-grip-vertical',
        animation: 150,
        onEnd: function(evt) {
            const images = [];
            $('#sortable-images tr').each(function(index) {
                const id = $(this).data('id');
                if (id) {
                    images.push({
                        id: id,
                        sort_order: index
                    });
                }
            });
            
            $.ajax({
                url: '{{ route("about-us-images.update-sort-order") }}',
                method: 'POST',
                data: {
                    images: images,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Update sort order badges
                        $('#sortable-images tr').each(function(index) {
                            $(this).find('.badge-secondary').text(index);
                        });
                        
                        // Show success message
                        showAlert('Sort order updated successfully!', 'success');
                    }
                },
                error: function() {
                    showAlert('Error updating sort order!', 'danger');
                    location.reload(); // Reload to restore original order
                }
            });
        }
    });

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
                        button.html('<i class="fas fa-check"></i> Active');
                    } else {
                        button.removeClass('btn-success').addClass('btn-secondary');
                        button.find('i').removeClass('fa-check').addClass('fa-times');
                        button.html('<i class="fas fa-times"></i> Inactive');
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

    // Auto-hide alerts
    setTimeout(function() {
        $('.alert').fadeOut();
    }, 5000);

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
