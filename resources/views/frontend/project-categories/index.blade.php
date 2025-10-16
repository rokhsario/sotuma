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
    gap: 50px !important;
    margin-top: 0 !important;
    padding: 0 80px !important;
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

   /* Sort Handle - Hidden by default */
   .project-categories-page .sort-handle {
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
       .project-categories-page .sort-handle {
           display: block !important;
       }
       
       .project-categories-page .category-card:hover .sort-handle {
           opacity: 1 !important;
       }
   }
   @endif
   @endauth

   .project-categories-page .sort-handle:hover {
       background: rgba(0, 0, 0, 0.9) !important;
   }

   /* Drag and Drop Styles */
   .project-categories-page .category-card.ui-sortable-helper {
       transform: rotate(5deg) !important;
       box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3) !important;
       z-index: 1000 !important;
       cursor: move !important;
   }

   .project-categories-page .ui-sortable-placeholder {
       background: #f0f0f0 !important;
       border: 2px dashed #ccc !important;
       border-radius: 0 !important;
       min-height: 550px !important;
       opacity: 0.7 !important;
   }

         .project-categories-page .category-card:hover {
        /* No movement - cards stay fixed */
    }

                                                               .project-categories-page .category-image-container {
            position: relative !important;
            overflow: hidden !important;
            height: 450px !important;
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
        padding: 30px !important;
        position: relative !important;
        z-index: 2 !important;
        background: #2b2931 !important;
        flex-grow: 1 !important;
        display: flex !important;
        flex-direction: column !important;
        text-align: center !important;
        justify-content: center !important;
        align-items: center !important;
        min-height: 100px !important;
    }

           .project-categories-page .category-title {
        font-size: 1.6rem !important;
        font-weight: bold !important;
        color: #ffffff !important;
        margin: 0 0 12px 0 !important;
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
@media (max-width: 1024px) {
    .project-categories-page .categories-container {
        padding: 0 5px !important; /* 5px side margins on tablets */
        box-sizing: border-box !important;
    }
    .project-categories-page .categories-grid {
        padding: 0 5px !important; /* 5px side margins on tablets */
        box-sizing: border-box !important;
        gap: 20px !important;
    }
}
@media (max-width: 768px) {
    .project-categories-page .hero-section {
        padding: 72px 0 48px !important; /* Reduced by 2.5x: 180px->72px, 120px->48px */
        min-height: 280px !important; /* Reduced by 2.5x: 700px->280px */
    }
    
    .project-categories-page .hero-title {
        font-size: 1.8rem !important;
    }
    
    .project-categories-page .hero-subtitle {
        display: none !important; /* Hide subtitle on mobile/tablet */
    }
    
    .project-categories-page .categories-intro h2 {
        display: none !important; /* Hide "DÉCOUVREZ NOS PROJETS" title on mobile/tablet */
    }
    
    .project-categories-page .categories-grid {
        display: block !important;
        grid-template-columns: none !important;
        gap: 20px !important;
        padding: 0 5px !important; /* ensure 5px sides on mobile */
        margin: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        overflow: visible !important;
        box-sizing: border-box !important;
    }
    
    .project-categories-page .category-card {
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

    .project-categories-page .category-image-container {
        width: 100% !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
    }
    
    .project-categories-page .category-content {
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
    
    .project-categories-page .category-title {
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
    
    .project-categories-page .category-image-container {
        height: 350px !important;
    }
    
    /* Hide drag handle for non-admin users on mobile/tablet */
    .project-categories-page .sort-handle {
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
    .project-categories-page .hero-section {
        padding: 16px 0 12px !important; /* Reduced by 2.5x: 40px->16px, 30px->12px */
        min-height: 120px !important; /* Reduced by 2.5x: 300px->120px */
    }
    
    .project-categories-page .hero-title {
        font-size: 1.5rem !important;
    }
    
    .project-categories-page .hero-subtitle {
        display: none !important; /* Hide subtitle on mobile */
    }
    
    .project-categories-page .categories-section {
        padding: 30px 0 !important;
    }
    
    .project-categories-page .categories-container {
        padding: 0 15px !important; /* 15px side margins */
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        overflow: visible !important;
    }
    
    .project-categories-page .categories-grid {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow: visible !important;
        gap: 15px !important;
        box-sizing: border-box !important;
    }
    
    .project-categories-page .category-card {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 15px 15px 15px !important; /* 15px side margins */
        border-radius: 0 !important;
        background: #fff !important;
        border: none !important;
        box-shadow: none !important;
        overflow: visible !important;
    }

    .project-categories-page .category-image-container {
        width: calc(100% - 30px) !important;
        margin-left: 15px !important;
        margin-right: 15px !important;
    }
    
    .project-categories-page .category-content {
        position: relative !important;
        bottom: auto !important;
        left: auto !important;
        right: auto !important;
        background: #fff !important;
        padding: 15px !important;
        z-index: 1 !important;
        text-align: center !important;
        display: block !important;
    }
    
    .project-categories-page .category-title {
        color: #333 !important;
        font-size: 0.75rem !important;
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
    
    .project-categories-page .category-image-container {
        height: 300px !important;
    }
    
    /* Hide drag handle for non-admin users on mobile */
    .project-categories-page .sort-handle {
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
            

             
             <div id="sortable-categories" class="categories-grid">
                 @foreach($categories as $category)
                 <div class="category-card sortable-item" data-category-id="{{$category->id}}" onclick="window.location.href='{{ route('project-categories.show', $category->slug) }}'">
                     <div class="sort-handle">
                         <i class="fas fa-grip-vertical"></i>
                     </div>
                     <div class="category-image-container" data-mobile-pad>
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

@push('scripts')
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize sortable for categories
    $("#sortable-categories").sortable({
        handle: '.sort-handle',
        placeholder: 'ui-sortable-placeholder',
        tolerance: 'pointer',
        cursor: 'move',
        update: function(event, ui) {
            // Get the new order
            const categoryIds = [];
            $('#sortable-categories .category-card').each(function() {
                categoryIds.push($(this).data('category-id'));
            });
            
            // Save the new order via AJAX
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
                    // Show success message
                    showNotification('Ordre des catégories mis à jour avec succès!', 'success');
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                    showNotification('Erreur lors de la mise à jour', 'error');
                }
            });
        }
    });

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

// Force symmetric 15px side padding only on the grid/container; let images be 100% of their card
document.addEventListener('DOMContentLoaded', function() {
    function enforceSidePadding() {
        var isMobile = window.innerWidth <= 1024;
        var grid = document.querySelector('.project-categories-page .categories-grid');
        var container = document.querySelector('.project-categories-page .categories-container');
        if (container) {
            if (isMobile) {
                container.style.setProperty('padding-left', '5px', 'important');
                container.style.setProperty('padding-right', '5px', 'important');
            } else {
                container.style.removeProperty('padding-left');
                container.style.removeProperty('padding-right');
            }
        }
        if (grid) {
            if (isMobile) {
                grid.style.setProperty('padding-left', '5px', 'important');
                grid.style.setProperty('padding-right', '5px', 'important');
                grid.style.setProperty('box-sizing', 'border-box', 'important');
            } else {
                grid.style.removeProperty('padding-left');
                grid.style.removeProperty('padding-right');
                grid.style.removeProperty('box-sizing');
            }
        }
        // Ensure cards/images do NOT add extra margins; force zero with !important
        document.querySelectorAll('.project-categories-page .category-card').forEach(function(card){
            card.style.setProperty('margin-left', '0', 'important');
            card.style.setProperty('margin-right', '0', 'important');
        });
        document.querySelectorAll('.project-categories-page .category-image-container').forEach(function(el){
            el.style.setProperty('margin-left', '0', 'important');
            el.style.setProperty('margin-right', '0', 'important');
            el.style.setProperty('width', '100%', 'important'); // image container full card width
        });
    }
    enforceSidePadding();
    window.addEventListener('resize', enforceSidePadding);

    // Watch for style changes that may override and re-apply container/grid padding
    var gridNode = document.querySelector('.project-categories-page .categories-grid');
    if (gridNode) {
        var observer = new MutationObserver(function(){ enforceSidePadding(); });
        observer.observe(gridNode, { attributes: true, subtree: false, attributeFilter: ['style'] });
    }
});
</script>
@endpush 