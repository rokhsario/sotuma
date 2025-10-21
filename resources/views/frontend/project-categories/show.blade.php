@extends('frontend.layouts.master')

@section('title', $category->name . ' - ' . __('frontend.projects'))

@section('main-content')

    <!-- SEO: Breadcrumb + ItemList for Projects in Category -->
    <script type="application/ld+json">
    {!! json_encode([
      '@context' => 'https://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => [
        ['@type' => 'ListItem','position' => 1,'name' => __('frontend.home') ?? 'Accueil','item' => url('/')],
        ['@type' => 'ListItem','position' => 2,'name' => __('frontend.project_categories') ?? 'Catégories de Projets','item' => route('project-categories.index')],
        ['@type' => 'ListItem','position' => 3,'name' => $category->name,'item' => url()->current()],
      ]
    ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
    </script>
    <script type="application/ld+json">
    {!! json_encode([
      '@context' => 'https://schema.org',
      '@type' => 'ItemList',
      'name' => $category->name . ' - Projets',
      'itemListElement' => $projects->map(function($p, $i){
        return [
          '@type' => 'ListItem',
          'position' => $i+1,
          'url' => route('projects.show', $p),
          'name' => $p->title,
        ];
      })->values()->all()
    ], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
    </script>

<style>
.project-categories-show-page,
.project-categories-show-page *,
.project-categories-show-page *::before,
.project-categories-show-page *::after {
    box-sizing: border-box !important;
    margin: 0 !important;
    padding: 0 !important;
}

.project-categories-show-page {
    font-family: Arial, Helvetica, sans-serif !important;
    line-height: 1.5 !important;
    color: #333 !important;
    background: #fff !important;
    font-size: 14px !important;
}

/* Hero Section - EXACT MAS */
.project-categories-show-page .hero-section {
    background: url('{{ asset("images/herroooo.jpg") }}') center center fixed !important;
    background-size: cover !important;
    padding: 180px 0 120px !important;
    position: relative !important;
    color: #fff !important;
    text-align: center !important;
    min-height: 700px !important;
}

.project-categories-show-page .hero-section::before {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    background: rgba(0, 0, 0, 0.5) !important;
    z-index: 1 !important;
}

.project-categories-show-page .hero-content {
    max-width: 100% !important;
    margin: 0 auto !important;
    padding: 0 30px !important;
    position: relative !important;
    z-index: 2 !important;
}

/* Force padding override */
.project-categories-show-page .hero-content {
    padding-left: 80px !important;
    padding-right: 80px !important;
    padding: 0 80px !important;
}

.project-categories-show-page .hero-title {
    font-size: 4.5rem !important;
    font-weight: 700 !important;
    color: rgb(164, 117, 87) !important;
    margin: 0 0 20px 0 !important;
    text-align: center !important;
    line-height: 1.2 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    text-transform: uppercase !important;
}

.project-categories-show-page .hero-subtitle {
    font-size: 1.2rem !important;
    color: rgba(255, 255, 255, 0.9) !important;
    text-align: center !important;
    margin: 0 !important;
    line-height: 1.5 !important;
    font-weight: normal !important;
    max-width: 900px !important;
    margin: 0 auto !important;
    font-family: Arial, Helvetica, sans-serif !important;
}

/* Breadcrumb - EXACT MAS */
.project-categories-show-page .breadcrumb-section {
    background: #fff !important;
    padding: 35px 0 !important;
    border-bottom: 1px solid #ddd !important;
}

.project-categories-show-page .breadcrumb-container {
    max-width: 100% !important;
    margin: 0 auto !important;
    padding: 0 30px !important;
}

/* Force padding override */
.project-categories-show-page .breadcrumb-container {
    padding-left: 80px !important;
    padding-right: 80px !important;
    padding: 0 80px !important;
}

.project-categories-show-page .breadcrumb {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    font-size: 1.2rem !important;
    color: #666 !important;
    list-style: none !important;
    font-family: 'Calibri', 'Candara', 'Segoe', 'Segoe UI', 'Optima', Arial, sans-serif !important;
    font-weight: 500 !important;
    justify-content: flex-end !important;
}

.project-categories-show-page .breadcrumb a {
    color: #3498db !important;
    text-decoration: none !important;
    font-family: 'Calibri', 'Candara', 'Segoe', 'Segoe UI', 'Optima', Arial, sans-serif !important;
    font-weight: 500 !important;
}

.project-categories-show-page .breadcrumb a:hover {
    color: #2980b9 !important;
}

.project-categories-show-page .breadcrumb .separator {
    color: #999 !important;
}



/* Projects Grid - EXACT MAS */
.project-categories-show-page .projects-section {
    padding: 60px 0 !important;
    background: #ffffff !important;
}

.project-categories-show-page .projects-container {
    max-width: 100% !important;
    margin: 0 auto !important;
    padding: 0 80px !important;
}

/* Force padding override */
.project-categories-show-page .projects-container {
    padding-left: 80px !important;
    padding-right: 80px !important;
    padding: 0 80px !important;
}

/* Extra force override */
.project-categories-show-page .hero-content,
.project-categories-show-page .breadcrumb-container,
.project-categories-show-page .projects-container {
    padding-left: 80px !important;
    padding-right: 80px !important;
    padding: 0 80px !important;
}

.project-categories-show-page .projects-grid {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 60px !important;
    margin-top: 0 !important;
    justify-content: center !important;
    max-width: 100% !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
    width: 100% !important;
}

/* Project Card - EXACT MAS ENTERPRISE */
.project-categories-show-page .project-card {
    background: #fff !important;
    border-radius: 0 !important;
    overflow: hidden !important;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
    transition: all 0.3s ease-in-out !important;
    position: relative !important;
    cursor: pointer !important;
    border: none !important;
    height: 100% !important;
    display: flex !important;
    flex-direction: column !important;
}

/* Sort Handle for Projects - Hidden by default */
.project-categories-show-page .sort-handle {
    position: absolute !important;
    top: 10px !important;
    right: 10px !important;
    background: rgba(0, 0, 0, 0.7) !important;
    color: white !important;
    padding: 8px !important;
    border-radius: 4px !important;
    cursor: move !important;
    z-index: 10 !important;
    font-size: 14px !important;
    opacity: 0 !important;
    transition: opacity 0.3s ease !important;
    display: none !important; /* Hidden by default */
}

/* Show sort handle only for admin users on desktop */
@auth
@if(auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin')
@media (min-width: 769px) {
    .project-categories-show-page .sort-handle {
        display: block !important;
    }
    
    .project-categories-show-page .project-card:hover .sort-handle {
        opacity: 1 !important;
    }
}
@endif
@endauth

.project-categories-show-page .sort-handle:hover {
    background: rgba(0, 0, 0, 0.9) !important;
}

/* Drag and Drop Styles for Projects */
.project-categories-show-page .project-card.ui-sortable-helper {
    transform: rotate(5deg) !important;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3) !important;
    z-index: 1000 !important;
    cursor: move !important;
}

.project-categories-show-page .ui-sortable-placeholder {
    background: #f0f0f0 !important;
    border: 2px dashed #ccc !important;
    border-radius: 0 !important;
    min-height: 400px !important;
    opacity: 0.7 !important;
}

.project-categories-show-page .project-card:hover {
    /* No movement - cards stay fixed */
}

.project-categories-show-page .project-image-container {
    position: relative !important;
    overflow: hidden !important;
    height: 650px !important;
    flex-shrink: 0 !important;
}

.project-categories-show-page .project-image {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    transition: all 0.6s ease !important;
    display: block !important;
}

.project-categories-show-page .project-card:hover .project-image {
    transform: scale(1.15) !important;
}



.project-categories-show-page .project-content {
    position: absolute !important;
    bottom: 0 !important;
    left: 0 !important;
    right: 0 !important;
    z-index: 3 !important;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.8) 0%, rgba(0, 0, 0, 0.6) 50%, transparent 100%) !important;
    padding: 30px 20px 20px !important;
    display: flex !important;
    flex-direction: column !important;
    text-align: center !important;
    justify-content: flex-end !important;
    align-items: center !important;
    transition: all 0.3s ease-in-out !important;
}

.project-categories-show-page .project-card:hover .project-content {
    opacity: 0 !important;
    transform: translateY(20px) !important;
}

.project-categories-show-page .project-title {
    font-size: 1.4rem !important;
    font-weight: 600 !important;
    color: #ffffff !important;
    margin: 0 0 8px 0 !important;
    text-transform: none !important;
    letter-spacing: 0 !important;
    line-height: 1.3 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    text-align: center !important;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.5) !important;
}

.project-categories-show-page .project-card:hover .project-title {
    /* No color change - title stays white */
}

.project-categories-show-page .project-architect {
    font-size: 1rem !important;
    color: rgba(255, 255, 255, 0.9) !important;
    line-height: 1.4 !important;
    margin: 0 !important;
    font-weight: normal !important;
    font-family: Arial, Helvetica, sans-serif !important;
    text-align: center !important;
    max-width: 100% !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5) !important;
}

/* Empty State */
.project-categories-show-page .empty-state {
    text-align: center !important;
    padding: 80px 0 !important;
}

.project-categories-show-page .empty-state-icon {
    font-size: 4rem !important;
    color: #7f8c8d !important;
    margin-bottom: 20px !important;
}

.project-categories-show-page .empty-state-title {
    font-size: 1.5rem !important;
    font-weight: 700 !important;
    color: #2c3e50 !important;
    margin: 0 0 16px 0 !important;
}

.project-categories-show-page .empty-state-description {
    font-size: 1rem !important;
    color: #7f8c8d !important;
    line-height: 1.6 !important;
    margin: 0 !important;
}

/* Responsive - EXACT MAS */
@media (max-width: 1024px) {
    .project-categories-show-page .projects-container {
        padding: 0 5px !important; /* 5px side margins on tablets */
    }
    .project-categories-show-page .projects-grid {
        padding: 0 5px !important; /* 5px side margins on tablets */
        box-sizing: border-box !important;
    }
    .project-categories-show-page .project-card {
        margin-left: 0 !important;
        margin-right: 0 !important;
        width: 100% !important;
    }
}
@media (max-width: 768px) {
    .project-categories-show-page .hero-title {
        font-size: 1.8rem !important;
    }
    
    .project-categories-show-page .hero-subtitle {
        font-size: 0.9rem !important;
    }
    
    .project-categories-show-page .projects-container {
        padding: 0 5px !important; /* 5px side margins */
    }
    
    .project-categories-show-page .projects-grid {
        grid-template-columns: 1fr !important;
        gap: 20px !important;
        justify-content: center !important;
        max-width: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 5px !important; /* ensure symmetric side padding */
        box-sizing: border-box !important;
    }
    
    .project-categories-show-page .project-card {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 0 20px 0 !important; /* rely on grid padding */
        border-radius: 0 !important;
    }
    
    .project-categories-show-page .project-content {
        padding: 20px 5px 15px !important;
    }
    
    .project-categories-show-page .project-title {
        font-size: 1.1rem !important;
    }
    
    .project-categories-show-page .project-architect {
        font-size: 0.9rem !important;
    }
    
    .project-categories-show-page .project-image-container {
        height: 320px !important;
        width: 100% !important;
        margin: 0 !important;
    }
}

@media (max-width: 480px) {
    .project-categories-show-page .hero-section {
        padding: 40px 0 30px !important;
    }
    
    .project-categories-show-page .hero-title {
        font-size: 1.5rem !important;
    }
    
    .project-categories-show-page .projects-section {
        padding: 30px 0 !important;
    }
    
    .project-categories-show-page .projects-container {
        padding: 0 5px !important; /* 5px side margins */
    }
    
    .project-categories-show-page .projects-grid {
        display: block !important;
        grid-template-columns: none !important;
        gap: 15px !important;
        justify-content: center !important;
        max-width: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 5px !important; /* symmetric sides */
        overflow: visible !important;
        box-sizing: border-box !important;
    }
    
    .project-categories-show-page .project-card {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 0 20px 0 !important; /* rely on grid padding */
        border-radius: 0 !important;
        background: #fff !important;
        border: none !important;
        box-shadow: none !important;
        overflow: visible !important;
    }
    
    .project-categories-show-page .project-image-container {
        height: 350px !important;
        width: 100% !important;
        overflow: hidden !important;
        position: relative !important;
        margin: 0 !important;
    }
    
    .project-categories-show-page .project-content {
        position: relative !important;
        bottom: auto !important;
        left: auto !important;
        right: auto !important;
        background: #fff !important;
        padding: 20px !important;
        z-index: 1 !important;
        text-align: center !important;
        display: block !important;
    }
    
    .project-categories-show-page .project-title {
        color: #333 !important;
        font-size: 0.85rem !important;
        font-weight: bold !important;
        text-align: center !important;
        margin: 0 !important;
        text-shadow: none !important;
        text-transform: uppercase !important;
        letter-spacing: 0.5px !important;
        position: relative !important;
        display: block !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        line-height: 1.2 !important;
    }
    
    .project-categories-show-page .project-architect {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        height: 0 !important;
        overflow: hidden !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    /* Hide drag handle for non-admin users on mobile/tablet */
    .project-categories-show-page .sort-handle {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        position: absolute !important;
        left: -9999px !important;
        top: -9999px !important;
        width: 0 !important;
        height: 0 !important;
        overflow: hidden !important;
    }
}

@media (max-width: 480px) {
    .project-categories-show-page .project-image-container {
        height: 300px !important;
        width: 100% !important;
        margin: 0 !important;
    }
    
    .project-categories-show-page .project-content {
        padding: 15px !important;
    }
    
    .project-categories-show-page .project-title {
        font-size: 0.75rem !important;
    }
    
    /* Hide drag handle for non-admin users on mobile */
    .project-categories-show-page .sort-handle {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        position: absolute !important;
        left: -9999px !important;
        top: -9999px !important;
        width: 0 !important;
        height: 0 !important;
        overflow: hidden !important;
    }
}
</style>

<div class="project-categories-show-page">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1 class="hero-title">{{ $category->name }}</h1>
        </div>
    </section>

    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="breadcrumb-container">
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">{{ __('frontend.home') }}</a>
                <span class="separator">/</span>
                <a href="{{ route('project-categories.index') }}">{{ __('frontend.project_categories') }}</a>
                <span class="separator">/</span>
                <span>{{ $category->name }}</span>
            </nav>
        </div>
    </section>



    <!-- Projects Grid -->
    <section class="projects-section">
        <div class="projects-container">
            @if($projects->count() > 0)
            @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin'))
            <div class="alert alert-info mb-3">
                <i class="fas fa-info-circle"></i>
                <strong>Mode Admin:</strong> Vous pouvez glisser-déposer les projets pour les réorganiser.
            </div>
            @endif
            <div id="sortable-projects" class="projects-grid">
                @foreach($projects as $project)
                <div class="project-card {{ auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin') ? 'sortable-item' : '' }}" data-project-id="{{$project->id}}" onclick="window.location.href='{{ route('projects.show', $project) }}'">
                    @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin'))
                    <div class="sort-handle">
                        <i class="fas fa-grip-vertical"></i>
                    </div>
                    @endif
                    <div class="project-image-container">
                        @if($project->image)
                            <img src="{{ asset($project->image) }}" 
                                 alt="{{ $project->title }}" 
                                 class="project-image"
                                 loading="lazy">
                        @else
                            <img src="{{ asset('images/10.png') }}" 
                                 alt="{{ $project->title }}" 
                                 class="project-image"
                                 loading="lazy">
                        @endif
                    </div>
                    <div class="project-content">
                        <h3 class="project-title">{{ $project->title }}</h3>
                        @if($project->architect)
                            <p class="project-architect">Architecte: {{ $project->architect }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="empty-state">
                <div class="empty-state-icon">🏗️</div>
                <h3 class="empty-state-title">Aucun projet disponible</h3>
                <p class="empty-state-description">{{ __('frontend.no_projects_category') }}</p>
            </div>
            @endif
        </div>
    </section>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
$(document).ready(function() {
    // Only initialize sortable for admin users
    @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin'))
    $("#sortable-projects").sortable({
        handle: '.sort-handle',
        placeholder: 'ui-sortable-placeholder',
        tolerance: 'pointer',
        cursor: 'move',
        update: function(event, ui) {
            // Get the new order
            const projectIds = [];
            $('#sortable-projects .project-card').each(function() {
                projectIds.push($(this).data('project-id'));
            });
            
            // Save the new order via AJAX
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
                    // Show success message
                    showNotification('Ordre des projets mis à jour avec succès!', 'success');
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    showNotification('Erreur lors de la mise à jour', 'error');
                }
            });
        }
    });
    @endif

    // Prevent click on sort handle from triggering card click
    $('.sort-handle').on('click', function(e) {
        e.stopPropagation();
    });

    // Function to show notifications
    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
        notification.style.position = 'fixed';
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.zIndex = '9999';
        notification.innerHTML = `
            ${message}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        `;
        
        document.body.appendChild(notification);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 3000);
    }
});
</script>
@endpush 