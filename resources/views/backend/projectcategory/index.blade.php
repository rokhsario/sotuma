@extends('backend.layouts.master')

@section('main-content')
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Liste des Catégories de Projets</h6>
        <div class="float-right">
            <button id="save-order-btn" class="btn btn-success btn-sm mr-2" disabled>
                <i class="fas fa-save"></i> Sauvegarder l'ordre
            </button>
            <a href="{{route('admin.projectcategory.create')}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="{{ __('admin.add_category') }} de Projet"><i class="fas fa-plus"></i> {{ __('admin.add_category') }}</a>
        </div>
    </div>
    <div class="card-body">
        @if(count($categories)>0)
        <div class="alert alert-info">
            <i class="fas fa-info-circle"></i>
            <strong>Instructions:</strong> Glissez-déposez les catégories pour les réorganiser. L'ordre sera automatiquement sauvegardé.
        </div>
        
        <div id="save-status" class="mb-3"></div>
        
        <div id="sortable-categories">
            @foreach($categories as $category)
            <div class="card mb-3 category-card" data-category-id="{{$category->id}}">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-1">
                            <span class="badge badge-secondary sort-handle">
                                <i class="fas fa-grip-vertical"></i>
                            </span>
                        </div>
                        <div class="col-md-2">
                            @if($category->image)
                            <img src="{{asset($category->image)}}" alt="{{$category->name}}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                            @else
                            <div class="bg-light d-flex align-items-center justify-content-center" style="width: 60px; height: 60px; border-radius: 4px;">
                                <i class="fas fa-image text-muted"></i>
                            </div>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <h6 class="mb-1">{{$category->name}}</h6>
                            <small class="text-muted">{{$category->slug}}</small>
                        </div>
                        <div class="col-md-4">
                            <p class="mb-1">{{Str::limit($category->description, 100)}}</p>
                            <small class="text-muted">
                                <strong>Ordre actuel:</strong> {{$category->sort_order ?? 0}}
                            </small>
                        </div>
                        <div class="col-md-2 text-right">
                            <a href="{{route('admin.projectcategory.edit',$category->id)}}" class="btn btn-primary btn-sm mr-1" data-toggle="tooltip" title="modifier" data-placement="bottom"><i class="fas fa-edit"></i></a>
                            <form method="POST" action="{{route('admin.projectcategory.destroy',[$category->id])}}" style="display:inline-block;">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm dltBtn" data-id={{$category->id}} data-toggle="tooltip" data-placement="bottom" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
            <span style="float:right">{{$categories->links()}}</span>
            @else
            <h6 class="text-center">Aucune catégorie de projet trouvée ! Veuillez en créer une.</h6>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .category-card.ui-sortable-helper {
        transform: rotate(5deg);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    
    .ui-sortable-placeholder {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        margin-bottom: 1rem;
        min-height: 100px;
    }
    
    .sort-handle {
        cursor: move;
        user-select: none;
    }
    
    .sort-handle:hover {
        background-color: #6c757d !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
$(document).ready(function() {
    let isOrderChanged = false;
    
    // Initialize sortable
    $("#sortable-categories").sortable({
        handle: '.sort-handle',
        placeholder: 'ui-sortable-placeholder',
        tolerance: 'pointer',
        update: function(event, ui) {
            isOrderChanged = true;
            $('#save-order-btn').prop('disabled', false);
            $('#save-status').html('<span class="text-warning"><i class="fas fa-exclamation-triangle"></i> Ordre modifié - Sauvegardez les changements</span>');
        }
    });
    
    // Save order
    $('#save-order-btn').click(function() {
        if (!isOrderChanged) return;
        
        const categoryIds = [];
        $('#sortable-categories .category-card').each(function() {
            categoryIds.push($(this).data('category-id'));
        });
        
        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Sauvegarde...');
        $('#save-status').html('<span class="text-info"><i class="fas fa-spinner fa-spin"></i> Sauvegarde en cours...</span>');
        
        $.ajax({
            url: '{{ route("admin.projectcategory.update-order") }}',
            method: 'POST',
            data: {
                categories: categoryIds.map((id, index) => ({
                    id: parseInt(id),
                    sort_order: index
                })),
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#save-status').html('<span class="text-success"><i class="fas fa-check"></i> Ordre sauvegardé avec succès!</span>');
                isOrderChanged = false;
                
                // Update sort order numbers
                $('#sortable-categories .category-card').each(function(index) {
                    $(this).find('.text-muted small').html('<strong>Ordre actuel:</strong> ' + index);
                });
                
                setTimeout(function() {
                    $('#save-status').html('');
                }, 3000);
            },
            error: function(xhr) {
                $('#save-status').html('<span class="text-danger"><i class="fas fa-times"></i> Erreur lors de la sauvegarde</span>');
                console.error('Error:', xhr.responseText);
            },
            complete: function() {
                $('#save-order-btn').prop('disabled', false).html('<i class="fas fa-save"></i> Sauvegarder l\'ordre');
            }
        });
    });
});
</script>
@endpush
@endsection 