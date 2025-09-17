@extends('frontend.layouts.master')

@section('title', 'Nos Projets')

@section('main-content')

<style>

.project-categories-page,
.project-categories-page *,
.project-categories-page *::before,
.project-categories-page *::after {
    box-sizing: border-box !important;
    margin: 0 !important;
    padding: 0 !important;
}

.project-categories-page {
    font-family: Arial, Helvetica, sans-serif !important;
    line-height: 1.5 !important;
    color: #333 !important;
    background: #fff !important;
    font-size: 14px !important;
}

/* Hero Section - EXACT MAS */
.project-categories-page .hero-section {
    background: url('{{ asset("images/1678442453811.jpg") }}') center center fixed !important;
    background-size: cover !important;
    padding: 180px 0 120px !important;
    position: relative !important;
    color: #fff !important;
    text-align: center !important;
    min-height: 700px !important;
}

.project-categories-page .hero-section::before {
    content: '' !important;
    position: absolute !important;
    top: 0 !important;
    left: 0 !important;
    right: 0 !important;
    bottom: 0 !important;
    background: rgba(0, 0, 0, 0.5) !important;
    z-index: 1 !important;
}

.project-categories-page .hero-content {
    max-width: 100% !important;
    margin: 0 auto !important;
    padding: 0 30px !important;
    position: relative !important;
    z-index: 2 !important;
}

.project-categories-page .hero-title {
    font-size: 4.5rem !important;
    font-weight: 700 !important;
    color: rgb(164, 117, 87) !important;
    margin: 0 0 20px 0 !important;
    text-align: center !important;
    line-height: 1.2 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    text-transform: uppercase !important;
}

.project-categories-page .hero-subtitle {
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
.project-categories-page .breadcrumb-section {
    background: #fff !important;
    padding: 35px 0 !important;
    border-bottom: 1px solid #ddd !important;
}

.project-categories-page .breadcrumb-container {
    max-width: 100% !important;
    margin: 0 auto !important;
    padding: 0 30px !important;
}

.project-categories-page .breadcrumb {
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

.project-categories-page .breadcrumb a {
    color: #3498db !important;
    text-decoration: none !important;
    font-family: 'Calibri', 'Candara', 'Segoe', 'Segoe UI', 'Optima', Arial, sans-serif !important;
    font-weight: 500 !important;
}

.project-categories-page .breadcrumb a:hover {
    color: #2980b9 !important;
}

.project-categories-page .breadcrumb .separator {
    color: #999 !important;
}

/* Categories Section - EXACT MAS */
.project-categories-page .categories-section {
    padding: 60px 0 !important;
    background: #f5f5f5 !important;
}

.project-categories-page .categories-container {
    max-width: 100% !important;
    margin: 0 auto !important;
    padding: 0 20px !important;
}

.project-categories-page .hero-content {
    max-width: 100% !important;
    margin: 0 auto !important;
    padding: 0 20px !important;
    position: relative !important;
    z-index: 2 !important;
}

.project-categories-page .breadcrumb-container {
    max-width: 100% !important;
    margin: 0 auto !important;
    padding: 0 20px !important;
}

/* Force padding override */
.project-categories-page .hero-content {
    padding-left: 80px !important;
    padding-right: 80px !important;
    padding: 0 80px !important;
}

.project-categories-page .breadcrumb-container {
    padding-left: 80px !important;
    padding-right: 80px !important;
    padding: 0 80px !important;
}

.project-categories-page .categories-container {
    padding-left: 80px !important;
    padding-right: 80px !important;
    padding: 0 80px !important;
}

/* Extra force override */
.project-categories-page .hero-content,
.project-categories-page .breadcrumb-container,
.project-categories-page .categories-container {
    padding-left: 80px !important;
    padding-right: 80px !important;
    padding: 0 80px !important;
}

.project-categories-page .categories-intro {
    text-align: center !important;
    margin-bottom: 50px !important;
}

 .project-categories-page .categories-intro h2 {
     font-weight: 700 !important;
     color: rgb(164, 117, 87) !important;
     letter-spacing: 0.05em !important;
     margin: 0 0 15px 0 !important;
     text-transform: uppercase !important;
     font-size: 3.5rem !important;
     font-family: Arial, Helvetica, sans-serif !important;
 }

.project-categories-page .categories-intro p {
    font-size: 1.1rem !important;
    color: #666 !important;
    line-height: 1.5 !important;
    max-width: 900px !important;
    margin: 0 auto !important;
    font-weight: normal !important;
    font-family: Arial, Helvetica, sans-serif !important;
}

/* Grid - EXACT MAS */
.project-categories-page .categories-grid {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 40px !important;
    margin-top: 0 !important;
}

   /* Card - EXACT MAS ENTERPRISE */
     .project-categories-page .category-card {
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

         .project-categories-page .category-card:hover {
        /* No movement - cards stay fixed */
    }

                                                               .project-categories-page .category-image-container {
            position: relative !important;
            overflow: hidden !important;
            height: 600px !important;
            flex-shrink: 0 !important;
        }

 .project-categories-page .category-image {
     width: 100% !important;
     height: 100% !important;
     object-fit: cover !important;
     transition: all 0.2s ease !important;
     display: block !important;
 }

       .project-categories-page .category-card:hover .category-image {
       transform: scale(1.05) !important;
   }

                                                                                                                               .project-categories-page .category-overlay {
         position: absolute !important;
         top: 100% !important;
         left: 0 !important;
         right: 0 !important;
         bottom: 0 !important;
         background: linear-gradient(to top, rgba(255, 255, 255, 0.4) 0%, rgba(255, 255, 255, 0.4) 100%) !important;
         transition: all 0.3s ease-in-out !important;
         display: flex !important;
         align-items: center !important;
         justify-content: center !important;
     }

 .project-categories-page .category-card:hover .category-overlay {
     top: 0 !important;
 }

                       .project-categories-page .category-content {
        padding: 40px !important;
        position: relative !important;
        z-index: 2 !important;
        background: #2b2931 !important;
        flex-grow: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        text-align: center !important;
        justify-content: center !important;
        align-items: center !important;
        min-height: 120px !important;
    }

           .project-categories-page .category-title {
        font-size: 1.8rem !important;
        font-weight: bold !important;
        color: #ffffff !important;
        margin: 0 0 15px 0 !important;
        text-transform: none !important;
        letter-spacing: 0 !important;
        line-height: 1.3 !important;
        font-family: Arial, Helvetica, sans-serif !important;
        text-align: center !important;
    }

     .project-categories-page .category-card:hover .category-title {
       /* No color change - title stays white */
   }

  .project-categories-page .category-description {
      font-size: 1.2rem !important;
      color: #666 !important;
      line-height: 1.4 !important;
      margin: 0 !important;
      flex-grow: 1 !important;
      font-weight: normal !important;
      font-family: Arial, Helvetica, sans-serif !important;
      text-align: center !important;
      max-width: 100% !important;
  }

/* Responsive - EXACT MAS */
@media (max-width: 768px) {
    .project-categories-page .hero-title {
        font-size: 1.8rem !important;
    }
    
    .project-categories-page .hero-subtitle {
        font-size: 0.9rem !important;
    }
    
    .project-categories-page .categories-intro h2 {
        font-size: 1.5rem !important;
    }
    
    .project-categories-page .categories-grid {
        grid-template-columns: 1fr !important;
        gap: 15px !important;
    }
    
    .project-categories-page .category-content {
        padding: 12px !important;
    }
    
    .project-categories-page .category-title {
        font-size: 1rem !important;
    }
    
    .project-categories-page .category-image-container {
        height: 160px !important;
    }
}

@media (max-width: 480px) {
    .project-categories-page .hero-section {
        padding: 40px 0 30px !important;
    }
    
    .project-categories-page .hero-title {
        font-size: 1.5rem !important;
    }
    
    .project-categories-page .categories-section {
        padding: 30px 0 !important;
    }
    
    .project-categories-page .categories-container {
        padding: 0 10px !important;
    }
    
    .project-categories-page .category-image-container {
        height: 140px !important;
    }
}
</style>

<div class="project-categories-page">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
                         <h1 class="hero-title">{{ __('frontend.our_projects') }}</h1>
             <p class="hero-subtitle">{{ __('frontend.projects_tunisia') }}</p>
        </div>
    </section>

    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="breadcrumb-container">
            <nav class="breadcrumb">
                <a href="{{ route('home') }}">{{ __('frontend.home') }}</a>
                <span class="separator">/</span>
                <span>{{ __('frontend.projects') }}</span>
            </nav>
        </div>
    </section>

    <!-- Categories Grid -->
    <section class="categories-section">
        <div class="categories-container">
                                      <div class="categories-intro">
                 <h2>{{ __('frontend.discover_projects') }}</h2>
             </div>
            

             
             <div class="categories-grid">
                 @foreach($categories as $category)
                                   <div class="category-card" onclick="window.location.href='{{ route('project-categories.show', $category->slug) }}'">
                      <div class="category-image-container">
                          <img src="{{ $category->image ? asset($category->image) : asset('images/10.png') }}" 
                               alt="{{ $category->name }}" 
                               class="category-image"
                               loading="lazy">
                                                   <div class="category-overlay">
                           </div>
                       </div>
                                          <div class="category-content">
                          <h3 class="category-title">{{ $category->name }}</h3>
                      </div>
                 </div>
                 @endforeach
             </div>
        </div>
    </section>
</div>

@endsection 