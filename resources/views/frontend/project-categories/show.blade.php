@extends('frontend.layouts.master')

@section('title', $category->name . ' - ' . __('frontend.projects'))

@section('main-content')

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
    max-width: 1400px !important;
    margin: 0 auto !important;
    padding: 0 20px !important;
}

/* Force padding override */
.project-categories-show-page .projects-container {
    padding-left: 20px !important;
    padding-right: 20px !important;
    padding: 0 20px !important;
}

/* Extra force override */
.project-categories-show-page .hero-content,
.project-categories-show-page .breadcrumb-container,
.project-categories-show-page .projects-container {
    padding-left: 20px !important;
    padding-right: 20px !important;
    padding: 0 20px !important;
}

.project-categories-show-page .projects-grid {
    display: grid !important;
    grid-template-columns: repeat(4, 1fr) !important;
    gap: 50px !important;
    margin-top: 0 !important;
    justify-content: center !important;
    max-width: 100% !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
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
@media (max-width: 768px) {
    .project-categories-show-page .hero-title {
        font-size: 1.8rem !important;
    }
    
    .project-categories-show-page .hero-subtitle {
        font-size: 0.9rem !important;
    }
    
    .project-categories-show-page .projects-container {
        padding: 0 20px !important;
    }
    
    .project-categories-show-page .projects-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 25px !important;
        justify-content: center !important;
        max-width: 100% !important;
    }
    
    .project-categories-show-page .project-content {
        padding: 20px 15px 15px !important;
    }
    
    .project-categories-show-page .project-title {
        font-size: 1.1rem !important;
    }
    
    .project-categories-show-page .project-architect {
        font-size: 0.9rem !important;
    }
    
    .project-categories-show-page .project-image-container {
        height: 320px !important;
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
        padding: 0 15px !important;
    }
    
    .project-categories-show-page .projects-grid {
        grid-template-columns: 1fr !important;
        gap: 20px !important;
        justify-content: center !important;
        max-width: 100% !important;
    }
    
    .project-categories-show-page .project-content {
        padding: 15px 12px 12px !important;
    }
    
    .project-categories-show-page .project-title {
        font-size: 1rem !important;
    }
    
    .project-categories-show-page .project-architect {
        font-size: 0.8rem !important;
    }
    
    .project-categories-show-page .project-image-container {
        height: 280px !important;
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
            <div class="projects-grid">
                @foreach($projects as $project)
                <div class="project-card" onclick="window.location.href='{{ route('projects.show', $project) }}'">
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