@extends('frontend.layouts.master')

@section('title', __('frontend.product_categories'))

@section('main-content')

<style>
/* Aluprof-Inspired Categories Page */
:root {
    --primary-color: #2c3e50;
    --primary-dark: #1a252f;
    --secondary-color: #3498db;
    --text-primary: #2c3e50;
    --text-secondary: #7f8c8d;
    --background-light: #f8f9fa;
    --white: #ffffff;
    --shadow-light: 0 2px 4px rgba(0,0,0,0.1);
    --shadow-medium: 0 4px 8px rgba(0,0,0,0.15);
    --shadow-heavy: 0 8px 16px rgba(0,0,0,0.2);
    --border-radius: 8px;
    --transition: all 0.3s ease;
}





@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Corner to Corner Line Animation */
@keyframes drawLine {
    0% {
        width: 0;
        height: 0;
    }
    50% {
        width: 100%;
        height: 0;
    }
    100% {
        width: 100%;
        height: 100%;
    }
}

/* Hero Section - Exact Aluprof Style */
.hero-section {
    background: url('/images/offer_bg.webp') center center/cover no-repeat;
    padding: 200px 0 120px;
    position: relative;
    color: #fff;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    z-index: 1;
}

.hero-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    position: relative;
    z-index: 2;
}

.hero-title {
    font-size: 4rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 16px 0;
    text-align: center;
    line-height: 1.1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.hero-subtitle {
    font-size: 1.4rem;
    color: rgba(255, 255, 255, 0.9);
    text-align: center;
    margin: 0;
    line-height: 1.4;
    font-weight: 400;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

/* Breadcrumb Section - Aluprof Style */
.breadcrumb-section {
    background: #fff;
    padding: 15px 0;
    border-bottom: 1px solid #e0e0e0;
}

.breadcrumb-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.breadcrumb-nav {
    margin: 0;
}

.breadcrumb {
    display: flex;
    align-items: center;
    list-style: none;
    padding: 0;
    margin: 0;
    gap: 8px;
    font-size: 0.9rem;
    color: #666;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
}

.breadcrumb-item:not(:last-child)::after {
    content: '•';
    margin-left: 8px;
    color: #999;
    font-weight: 300;
}

.breadcrumb-item a {
    color: #666;
    text-decoration: none;
    transition: color 0.3s ease;
    font-weight: 400;
}

.breadcrumb-item a:hover {
    color: #333;
    text-decoration: none;
}

.breadcrumb-item.active {
    color: #333;
    font-weight: 500;
}

/* Categories Grid */
.categories-section {
    padding: 80px 0 120px;
    background: #f8f9fa;
    position: relative;
}

.categories-container {
    max-width: none;
    margin: 0;
    padding: 0 200px;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 35px;
    margin-top: 80px;
}

.category-card {
    background: #fff;
    border: none;
    border-radius: 0;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    position: relative;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
    display: block;
    aspect-ratio: 1;
    min-height: 300px;
    max-width: 400px;
    margin: 0 auto;
}

.category-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.category-image-container {
    position: relative;
    height: 100%;
    overflow: hidden;
    background: #f8f9fa;
}

.category-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.3s ease;
}

.category-card:hover .category-image {
    transform: scale(1.02);
}

.category-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.25);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 2;
    pointer-events: none;
}

.category-card:hover::before {
    opacity: 1;
}

.category-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, 
        rgba(26, 115, 232, 0.9) 0%, 
        rgba(52, 168, 83, 0.9) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
    z-index: 2;
}

.category-card:hover .category-overlay {
    opacity: 1;
}

.category-overlay-content {
    text-align: center;
    color: var(--white);
    transform: translateY(20px);
    transition: var(--transition);
}

.category-card:hover .category-overlay-content {
    transform: translateY(0);
}

.category-overlay-icon {
    font-size: 2.5rem;
    margin-bottom: 12px;
    display: block;
    opacity: 0.9;
}

.category-overlay-text {
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.category-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 20px;
    background: linear-gradient(transparent, rgba(0,0,0,0.7));
    z-index: 4;
    display: flex;
    align-items: flex-end;
    justify-content: flex-start;
    text-align: left;
}

.category-title {
    font-size: 1rem;
    font-weight: 600;
    color: #fff;
    margin: 0;
    line-height: 1.2;
    transition: all 0.3s ease;
    text-transform: uppercase;
    text-shadow: 0 1px 2px rgba(0,0,0,0.5);
}

.category-card:hover .category-title {
    color: #fff;
}

.category-description {
    color: #7f8c8d;
    line-height: 1.5;
    font-size: 0.9rem;
    margin-bottom: 0;
    transition: all 0.3s ease;
}

.category-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 20px;
    border-top: 1px solid #e8eaed;
}

.category-products-count {
    color: var(--text-secondary);
    font-size: 0.9rem;
    font-weight: 500;
}

.category-view-more {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
    color: var(--white);
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: var(--transition);
    box-shadow: 0 2px 8px rgba(26, 115, 232, 0.3);
}

.category-card:hover .category-view-more {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(26, 115, 232, 0.4);
}

/* Section Header */
.section-header {
    text-align: center;
    margin-bottom: 80px;
    animation: slideInUp 0.8s ease-out 0.4s both;
}

.section-title {
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 16px;
    letter-spacing: -0.02em;
}

.section-subtitle {
    font-size: 1.1rem;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 120px 0;
    color: var(--text-secondary);
    grid-column: 1 / -1;
}

.empty-state-icon {
    font-size: 4rem;
    color: #dadce0;
    margin-bottom: 24px;
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.empty-state-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 12px;
    color: var(--text-primary);
}

.empty-state-description {
    font-size: 1rem;
    opacity: 0.8;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .categories-container {
        padding: 0 120px;
    }
    
    .categories-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 25px;
        margin-top: 50px;
    }
}

@media (max-width: 1200px) {
    .categories-grid {
        grid-template-columns: 1fr !important;
        gap: 25px !important;
        margin-top: 50px !important;
    }
}

@media (max-width: 768px) {
    .hero-section {
        padding: 120px 0 80px;
    }
    
    .hero-title {
        font-size: 3rem;
    }
    
    .hero-subtitle {
        font-size: 1.1rem;
    }
    
    .categories-section {
        padding: 60px 0 100px;
    }
    
    .categories-container {
        padding: 0 60px;
    }
    
    .categories-grid {
        display: block !important;
        grid-template-columns: none !important;
        gap: 0 !important;
        margin-top: 40px !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        overflow: visible !important;
    }
    
    .category-card {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 0 20px 0 !important;
        border-radius: 0 !important;
        background: #fff !important;
        border: none !important;
        box-shadow: none !important;
        overflow: visible !important;
    }
    
    .category-image-container {
        height: 350px !important;
        width: 100% !important;
        overflow: hidden !important;
        position: relative !important;
    }
    
    .category-content {
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
    
    .category-title {
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
    
    .category-description {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        height: 0 !important;
        overflow: hidden !important;
        margin: 0 !important;
        padding: 0 !important;
    }
}

@media (max-width: 480px) {
    .categories-grid {
        display: block !important;
        grid-template-columns: none !important;
        gap: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        overflow: visible !important;
    }
    
    .category-card {
        display: block !important;
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 0 15px 0 !important;
        border-radius: 0 !important;
        background: #fff !important;
        border: none !important;
        box-shadow: none !important;
        overflow: visible !important;
    }
    
    .category-image-container {
        height: 300px !important;
    }
    
    .category-content {
        padding: 15px !important;
    }
    
    .category-title {
        font-size: 0.75rem !important;
    }
    
    .category-meta {
        flex-direction: column;
        gap: 12px;
        align-items: flex-start;
    }
}

/* Loading Animation */
.category-card {
    animation: fadeInUp 0.6s ease-out;
    animation-fill-mode: both;
}

.category-card:nth-child(1) { animation-delay: 0.1s; }
.category-card:nth-child(2) { animation-delay: 0.2s; }
.category-card:nth-child(3) { animation-delay: 0.3s; }
.category-card:nth-child(4) { animation-delay: 0.4s; }
.category-card:nth-child(5) { animation-delay: 0.5s; }
.category-card:nth-child(6) { animation-delay: 0.6s; }
.category-card:nth-child(7) { animation-delay: 0.7s; }
.category-card:nth-child(8) { animation-delay: 0.8s; }
.category-card:nth-child(9) { animation-delay: 0.9s; }

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <h1 class="hero-title">{{ __('frontend.products') }}</h1>
        <p class="hero-subtitle">{{ __('frontend.wide_range_products') }}</p>
    </div>
</section>

<!-- Breadcrumb Section -->
<section class="breadcrumb-section">
    <div class="breadcrumb-container">
        <nav class="breadcrumb-nav" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">{{ __('frontend.home_page') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('frontend.products') }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section">
    <div class="categories-container">
        <div class="categories-grid">
            @forelse($categories as $category)
            <a href="{{ route('categories.show', $category->slug ?? Str::slug($category->title)) }}" class="category-card">
                <div class="category-image-container">
                    <img src="{{ $category->image ? asset($category->image) : asset('images/no-image.png') }}" 
                         alt="{{ $category->title }}" 
                         class="category-image">
                </div>
                <div class="category-content">
                    <h3 class="category-title">{{ $category->title }}</h3>
                </div>
            </a>
            @empty
            <div class="empty-state">
                <i class="fas fa-box-open empty-state-icon"></i>
                <h3 class="empty-state-title">Aucune catégorie trouvée</h3>
                <p class="empty-state-description">Aucune catégorie n'est disponible pour le moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
// Force mobile responsive grids immediately
document.addEventListener('DOMContentLoaded', function() {
    function forceMobileGrids() {
        const isMobile = window.innerWidth <= 768;
        const categoryGrid = document.querySelector('.categories-grid');
        
        if (isMobile && categoryGrid) {
            categoryGrid.style.gridTemplateColumns = '1fr';
            categoryGrid.style.gap = '20px';
            categoryGrid.setAttribute('data-mobile-forced', 'true');
        }
    }
    
    // Run immediately
    forceMobileGrids();
    
    // Run on resize
    window.addEventListener('resize', forceMobileGrids);
    
    // Run every 100ms for first 3 seconds to catch any late-loading content
    let interval = setInterval(forceMobileGrids, 100);
    setTimeout(() => clearInterval(interval), 3000);
});
</script>
@endpush 