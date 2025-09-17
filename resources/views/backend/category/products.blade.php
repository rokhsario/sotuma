@extends('backend.layouts.master')

@section('main-content')
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('backend.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">
            Gérer les Produits - {{ $category->title }}
        </h6>
        <a href="{{ route('admin.category.index') }}" class="btn btn-secondary btn-sm float-right">
            <i class="fas fa-arrow-left"></i> Retour aux Catégories
        </a>
    </div>
    <div class="card-body">
        @if(count($products) > 0)
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                <strong>Instructions:</strong> Glissez-déposez les produits pour les réorganiser. L'ordre sera automatiquement sauvegardé.
            </div>
            
            <div id="sortable-products" class="row">
                @foreach($products as $product)
                <div class="col-md-6 col-lg-4 mb-4" data-product-id="{{ $product->id }}">
                    <div class="card product-card h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <h6 class="card-title mb-0">{{ $product->title }}</h6>
                                <span class="badge badge-secondary sort-handle">
                                    <i class="fas fa-grip-vertical"></i>
                                </span>
                            </div>
                            
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" class="img-fluid mb-3" style="max-height: 150px; width: 100%; object-fit: cover;" alt="{{ $product->title }}">
                            @else
                                <div class="bg-light d-flex align-items-center justify-content-center mb-3" style="height: 150px;">
                                    <i class="fas fa-image text-muted fa-2x"></i>
                                </div>
                            @endif
                            
                            <div class="mb-3">
                                <small class="text-muted">
                                    <strong>Ordre actuel:</strong> {{ $product->sort_order ?? 0 }}
                                </small>
                            </div>
                            
                            @if($product->description)
                                <p class="card-text small text-muted">
                                    {{ Str::limit(strip_tags($product->description), 100) }}
                                </p>
                            @endif
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    @if($product->has_details)
                                        <span class="badge badge-success">Avec détails</span>
                                    @else
                                        <span class="badge badge-secondary">Sans détails</span>
                                    @endif
                                </small>
                                
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-primary btn-sm" title="Modifier">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('product-detail', $product->slug) }}" class="btn btn-info btn-sm" title="Voir" target="_blank">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-4">
                <button id="save-order-btn" class="btn btn-success" disabled>
                    <i class="fas fa-save"></i> Sauvegarder l'Ordre
                </button>
                <span id="save-status" class="ml-3"></span>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Aucun produit dans cette catégorie</h5>
                <p class="text-muted">Ajoutez des produits à cette catégorie pour pouvoir les gérer.</p>
                <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> {{ __('admin.add_product') }}
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .product-card {
        transition: all 0.3s ease;
        cursor: move;
    }
    
    .product-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .product-card.ui-sortable-helper {
        transform: rotate(5deg);
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    
    .sort-handle {
        cursor: grab;
        padding: 5px;
    }
    
    .sort-handle:active {
        cursor: grabbing;
    }
    
    #save-order-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    
    .ui-sortable-placeholder {
        border: 2px dashed #007bff;
        background: rgba(0,123,255,0.1);
        min-height: 300px;
        border-radius: 8px;
    }
</style>
@endpush

@push('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
$(document).ready(function() {
    let isOrderChanged = false;
    
    // Initialize sortable
    $("#sortable-products").sortable({
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
        
        const productIds = [];
        $('#sortable-products .col-md-6').each(function() {
            productIds.push($(this).data('product-id'));
        });
        
        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Sauvegarde...');
        $('#save-status').html('<span class="text-info"><i class="fas fa-spinner fa-spin"></i> Sauvegarde en cours...</span>');
        
        $.ajax({
            url: '{{ route("admin.category.products.sort", $category->id) }}',
            method: 'POST',
            data: {
                product_ids: productIds,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#save-status').html('<span class="text-success"><i class="fas fa-check"></i> Ordre sauvegardé avec succès!</span>');
                isOrderChanged = false;
                
                // Update sort order numbers
                $('#sortable-products .col-md-6').each(function(index) {
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
                $('#save-order-btn').prop('disabled', true).html('<i class="fas fa-save"></i> Sauvegarder l\'Ordre');
            }
        });
    });
});
</script>
@endpush
