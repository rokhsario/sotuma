@extends('frontend.layouts.master')

@section('title', $category->title)

@section('main-content')
<style>
/* Category Detail Page Styles - Aluprof Style */
.category-hero {
    background: url('/images/offer_bg.webp') center center/cover no-repeat;
    padding: 200px 0 120px;
    position: relative;
    color: #fff;
}

.category-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    z-index: 1;
}

.category-hero-content {
    position: relative;
    z-index: 2;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
}

.category-title-large {
    font-size: 4rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 16px 0;
    text-align: center;
    line-height: 1.1;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
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

/* Products Section */
.products-section {
    padding: 80px 0;
    background: #f8f9fa;
    width: 100%;
    margin: 0;
}

.products-section .container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 10px;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 60px;
    margin-top: 50px;
    width: 100%;
    margin-left: 0;
    margin-right: 0;
    padding: 0;
}

.product-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    position: relative;
    cursor: pointer;
    transform: translateX(0);
    display: flex;
    flex-direction: column;
    height: 100%;
}

.product-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: #000;
    transition: all 0.6s ease;
    z-index: 1;
}

.product-card::after {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 2px;
    height: 0;
    background: #000;
    transition: all 0.6s ease;
    z-index: 1;
}

.product-card:hover {
    transform: translateX(15px) translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,0,0,0.15);
}

.product-card:hover::before {
    width: 100%;
}

.product-card:hover::after {
    height: 100%;
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

.product-image-container {
    position: relative;
    overflow: hidden;
    height: 400px;
    padding: 0;
    margin: 0;
    width: 100%;
    box-sizing: border-box;
}

.product-image {
    width: 90% !important;
    height: 90%;
    object-fit: contain;
    transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    display: block;
    margin: auto;
    padding: 0;
    border: none;
    box-sizing: border-box;
    max-width: none !important;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.product-card:hover .product-image {
    transform: translate(-50%, -50%) scale(1.08);
}

/* Product overlay for details functionality */
.product-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    cursor: pointer;
    z-index: 10;
}

.product-card:hover .product-overlay {
    opacity: 1;
}

.product-card.clickable {
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-card.clickable:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.product-overlay-content {
    color: white;
    text-align: center;
    transform: translateY(20px);
    transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.product-overlay-content i {
    font-size: 2rem;
    margin-bottom: 8px;
    display: block;
}

.product-overlay-content span {
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.product-card:hover .product-overlay-content {
    transform: translateY(0);
}

.product-detail-indicator {
    margin-top: auto;
    padding-top: 15px;
}

.detail-badge {
    background: linear-gradient(135deg, #d2b48c, #bc8f8f);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.product-content {
    padding: 40px;
    position: relative;
    transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    display: flex;
    flex-direction: column;
    flex-grow: 1;
}

.product-card:hover .product-content {
    transform: translateX(5px);
}

.product-title {
    font-size: 1.6rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 12px;
    line-height: 1.3;
}

.product-category {
    color: #6c757d;
    font-size: 0.95rem;
    font-weight: 500;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}



/* Subcategories Section (Optional) */
.subcategories-section {
    padding: 60px 0;
    background: #f8f9fa;
}

.subcategories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 25px;
    margin-top: 30px;
}

.subcategory-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    text-decoration: none;
    color: inherit;
    display: block;
}

.subcategory-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    text-decoration: none;
    color: inherit;
}

.subcategory-image {
    width: 100%;
    height: 150px;
    object-fit: cover;
    position: relative;
}

.subcategory-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.8) 0%, rgba(118, 75, 162, 0.8) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.subcategory-card:hover .subcategory-overlay {
    opacity: 1;
}

.subcategory-overlay-icon {
    color: white;
    font-size: 2rem;
}

.subcategory-content {
    padding: 20px;
}

.subcategory-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #333;
    margin-bottom: 8px;
}

.subcategory-description {
    color: #666;
    line-height: 1.5;
    margin-bottom: 15px;
    font-size: 0.9rem;
}

.subcategory-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: #888;
    font-size: 0.8rem;
}

.subcategory-products-count {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 4px 10px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.75rem;
}

/* Section Headers */
.section-header {
    text-align: center;
    margin-bottom: 50px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 15px;
}

.section-subtitle {
    font-size: 1.1rem;
    color: #666;
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 80px 0;
    color: #666;
}

.empty-state-icon {
    font-size: 4rem;
    color: #ddd;
    margin-bottom: 20px;
}

.empty-state-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 10px;
}

.empty-state-description {
    font-size: 1rem;
    opacity: 0.8;
}

@media (max-width: 768px) {
    .category-hero {
        padding: 60px 0 40px;
    }
    
    .category-hero-content {
        padding: 0 16px;
    }
    
    .breadcrumb-custom {
        font-size: 0.8rem;
        margin-bottom: 24px;
    }
    
    .category-title-large {
        font-size: clamp(1.5rem, 4vw, 2.5rem);
    }
    
    .products-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 40px;
        padding: 0 10px;
    }
    
    .product-content {
        padding: 30px;
    }
    
    .product-title {
        font-size: 1.1rem;
    }
    
    .subcategories-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .section-title {
        font-size: 2rem;
    }
}

@media (max-width: 480px) {
    .products-grid {
        grid-template-columns: 1fr;
        gap: 30px;
        padding: 0 10px;
    }
    
    .product-image-container {
        height: 300px;
    }
    
    .product-content {
        padding: 25px;
    }
}
</style>

<!-- Hero Section -->
<section class="category-hero">
    <div class="category-hero-content">
        <h1 class="category-title-large">{{ $category->title }}</h1>
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
                <li class="breadcrumb-item">
                    <a href="{{ route('categories.index') }}">{{ __('frontend.products') }}</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->title }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Products Section (Show First) -->
@if($products->count() > 0)
<section class="products-section">
    <div class="container">
        <div class="products-grid">
            @foreach($products as $product)
            <div class="product-card {{ $product->has_details && $product->slug ? 'clickable' : '' }}" {{ $product->has_details && $product->slug ? 'onclick="console.log(\'Card clicked for: ' . $product->title . '\'); window.location.href=\'' . route('product-detail', $product->slug) . '\'"' : '' }}>
                <div class="product-image-container">
                    <img src="{{ $product->image ? asset($product->image) : asset('images/no-image.png') }}" 
                         alt="{{ $product->title }}" 
                         class="product-image">
                    @if($product->has_details && $product->slug)
                        <div class="product-overlay" onclick="console.log('Overlay clicked for: {{ $product->title }}'); window.location.href='{{ route('product-detail', $product->slug) }}'">
                            <div class="product-overlay-content">
                                <i class="fas fa-eye"></i>
                                <span>{{ __('frontend.view_details') }}</span>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="product-content">
                    <h3 class="product-title">{{ $product->title }}</h3>
                    @if($product->category)
                        <p class="product-category">{{ $product->category->title }}</p>
                    @endif
                    @if($product->has_details && $product->slug)
                        <div class="product-detail-indicator">
                            <span class="detail-badge">{{ __('frontend.view_details') }}</span>
                        </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@else
<!-- Empty State -->
<section class="products-section">
    <div class="empty-state">
            <i class="fas fa-box-open empty-state-icon"></i>
            <h3 class="empty-state-title">{{ __('frontend.no_products_found') }}</h3>
            <p class="empty-state-description">
                {{ __('frontend.no_products_available') }}
            </p>
            </div>
</section>
@endif

@endsection 