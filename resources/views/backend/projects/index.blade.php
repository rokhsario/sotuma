@extends('backend.layouts.master')
@section('title','SOTUMA || Projets')
@section('main-content')
@php
    use Illuminate\Support\Facades\Storage;
@endphp
<div class="container-fluid">
    @include('backend.layouts.notification')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Projets</h1>
        <div>
            <button id="save-order-btn" class="btn btn-success mr-2" disabled>
                <i class="fas fa-save"></i> Sauvegarder l'ordre
            </button>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Ajouter un projet</a>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            @if($projects->count() > 0)
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                <strong>Instructions:</strong> Glissez-déposez les projets pour les réorganiser. L'ordre sera automatiquement sauvegardé.
            </div>
            
            <div id="save-status" class="mb-3"></div>
            
            <div id="sortable-projects">
                @foreach($projects as $project)
                <div class="card mb-3 project-card" data-project-id="{{$project->id}}">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-md-1">
                                <span class="badge badge-secondary sort-handle">
                                    <i class="fas fa-grip-vertical"></i>
                                </span>
                            </div>
                            <div class="col-md-2">
                                @if($project->image)
                                    <img src="{{ asset($project->image) }}" alt="image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center" style="width: 80px; height: 80px; border-radius: 4px;">
                                        <i class="fas fa-image text-muted fa-2x"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-3">
                                <h6 class="mb-1">{{ $project->title }}</h6>
                                <small class="text-muted">{{ $project->category->name ?? 'Aucune catégorie' }}</small>
                            </div>
                            <div class="col-md-4">
                                <p class="mb-1">{{ Str::limit($project->description, 100) }}</p>
                                <small class="text-muted">
                                    <strong>Ordre actuel:</strong> {{ $project->sort_order ?? 0 }}
                                </small>
                            </div>
                            <div class="col-md-2 text-right">
                                <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-sm btn-info mr-1">Voir</a>
                                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-warning mr-1">Modifier</a>
                                <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce projet ?')">Supprimer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-3">{{ $projects->links() }}</div>
            @else
            <div class="alert alert-info text-center">
                <i class="fas fa-info-circle"></i>
                Aucun projet trouvé. <a href="{{ route('admin.projects.create') }}" class="alert-link">Créer le premier projet</a>
            </div>
            @endif
        </div>
    </div>
</div>

@push('styles')
<style>
    .project-card.ui-sortable-helper {
        transform: rotate(5deg);
        box-shadow: 0 5px 15px rgba(0,0,0,0.3);
    }
    
    .ui-sortable-placeholder {
        background: #f8f9fa;
        border: 2px dashed #dee2e6;
        border-radius: 8px;
        margin-bottom: 1rem;
        min-height: 120px;
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
    $("#sortable-projects").sortable({
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
        
        const projectIds = [];
        $('#sortable-projects .project-card').each(function() {
            projectIds.push($(this).data('project-id'));
        });
        
        $(this).prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Sauvegarde...');
        $('#save-status').html('<span class="text-info"><i class="fas fa-spinner fa-spin"></i> Sauvegarde en cours...</span>');
        
        $.ajax({
            url: '{{ route("admin.projects.update-order") }}',
            method: 'POST',
            data: {
                projects: projectIds.map((id, index) => ({
                    id: parseInt(id),
                    sort_order: index
                })),
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#save-status').html('<span class="text-success"><i class="fas fa-check"></i> Ordre sauvegardé avec succès!</span>');
                isOrderChanged = false;
                
                // Update sort order numbers
                $('#sortable-projects .project-card').each(function(index) {
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