@extends('frontend.layouts.master')

@section('title', $product->title . ' - SOTUMA')
@section('main-content')

<!-- Product Detail Section -->
<section class="product-detail-section">
    <div class="container">
        <div class="product-detail-wrapper">
            <!-- Product Image -->
            <div class="product-image-section">
                <div class="product-image-container">
                    <img src="{{ $product->image ? asset($product->image) : asset('images/no-image.png') }}" 
                         alt="{{ $product->title }}" 
                         class="product-image">
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="product-info-section">
                <h1 class="product-title">{{ $product->title }}</h1>
                
                @if($product->category)
                    <p class="product-category">{{ $product->category->title }}</p>
                @endif
                
                                 @if($product->description)
                     <div class="product-description">
                         {!! $product->description !!}
                     </div>
                @else
                    <div class="no-description">
                        <p>Aucune description disponible pour ce produit.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<style>
.product-detail-section {
    padding: 60px 0;
    background: #f8f9fa;
    min-height: 70vh;
}

.product-detail-wrapper {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    max-width: 1200px;
    margin: 0 auto;
    background: white;
    border-radius: 15px;
    padding: 50px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

/* Product Image Section */
.product-image-section {
    display: flex;
    align-items: center;
    justify-content: center;
}

.product-image-container {
    width: 100%;
    max-width: 500px;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    background: #fff;
    padding: 10px; /* add inner padding to create visual zoom-out */
}

.product-image {
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain; /* ensure full image fits */
    transform: none; /* default desktop - no zoom-out */
    transform-origin: center center;
}

/* Ensure 20% zoom-out specifically on mobile and tablets */
@media (max-width: 1024px) {
    .product-image-container {
        padding: 10px !important;
    }
    .product-image {
        transform: scale(0.8) !important; /* zoomed out ~20% on <=1024px */
        transform-origin: center center !important;
    }
}

/* Product Info Section */
.product-info-section {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
}

.product-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 15px 0;
    line-height: 1.2;
}

.product-category {
    font-size: 1.1rem;
    color: #666;
    margin: 0 0 30px 0;
    font-weight: 500;
}

.product-description {
    color: #333;
    line-height: 1.8;
    font-size: 1.1rem;
    word-wrap: break-word;
    overflow-wrap: break-word;
    white-space: pre-wrap;
    text-align: left !important;
}

/* Remove any inline absolute-positioned star spans coming from rich text to avoid duplicates */
.product-description span[style*="position: absolute"] {
    display: none !important;
}

/* Force star display for all text content */
.product-description {
    counter-reset: line-counter;
}

.product-description p,
.product-description div {
    counter-increment: line-counter;
    position: relative;
    padding-left: 25px;
    margin-bottom: 12px;
}

/* Single star bullet; apply only to direct children to avoid duplicates */
.product-description > p::before,
.product-description > div::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0.1em; /* slight vertical align */
    color: #000000 !important;
    font-size: 1rem;
    font-weight: 700;
    z-index: 1;
    width: 20px;
    text-align: center;
}

/* Format product description with stars and aligned lines */
.product-description p {
    position: relative;
    padding-left: 25px;
    margin-bottom: 12px;
    text-align: left !important;
}

/* Remove duplicate star definition to prevent overlap */
.product-description p::before { }

.product-description div {
    position: relative;
    padding-left: 25px;
    margin-bottom: 12px;
    text-align: left !important;
}

/* Remove duplicate star definition to prevent overlap */
.product-description div::before { }

.product-description * {
    text-align: left !important;
}

.product-info-section .product-description {
    text-align: left !important;
}

.product-info-section .product-description p {
    text-align: left !important;
    position: relative;
    padding-left: 25px;
    margin-bottom: 12px;
}

/* Keep single star in nested contexts */
.product-info-section .product-description p::before { }

.product-info-section .product-description div {
    text-align: left !important;
    position: relative;
    padding-left: 25px;
    margin-bottom: 12px;
}

.product-info-section .product-description div::before { }

.product-description h1,
.product-description h2,
.product-description h3,
.product-description h4,
.product-description h5,
.product-description h6 {
    color: #1a1a1a;
    margin-top: 25px;
    margin-bottom: 15px;
    font-weight: 600;
}

.product-description h1 {
    font-size: 1.8rem;
    color: #D2B48C;
}

.product-description h2 {
    font-size: 1.6rem;
    color: #820403;
}

.product-description p {
    margin-bottom: 20px;
    text-align: left !important;
    position: relative;
    padding-left: 25px;
}

.product-description p::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    color: #000000;
    font-size: 1rem;
    font-weight: bold;
    z-index: 1;
}

.product-description ul,
.product-description ol {
    margin-bottom: 20px;
    padding-left: 25px;
}

.product-description li {
    margin-bottom: 10px;
    line-height: 1.6;
}

.product-description strong {
    color: #820403;
    font-weight: 600;
}

.no-description {
    text-align: center;
    color: #888;
    font-style: italic;
    padding: 40px 0;
    font-size: 1.1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .product-detail-section {
        padding: 40px 0;
    }
    
    .product-detail-wrapper {
        grid-template-columns: 1fr;
        gap: 40px;
        padding: 30px 20px;
        margin: 0 15px;
    }
    
    .product-title {
        font-size: 2rem;
    }
    
    .product-description {
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .product-detail-wrapper {
        padding: 20px 15px;
        margin: 0 10px;
    }
    
    .product-title {
        font-size: 1.8rem;
    }
}
</style>

<script>
// Add stars to product description lines
document.addEventListener('DOMContentLoaded', function() {
    const productDescription = document.querySelector('.product-description');
    
    if (productDescription) {
        // Get all text content and split by lines
        const textContent = productDescription.textContent || productDescription.innerText;
        const lines = textContent.split('\n').filter(line => line.trim() !== '');
        
        // Clear the content
        productDescription.innerHTML = '';
        
        // Add each line with a star
        lines.forEach(line => {
            if (line.trim() !== '') {
                const lineDiv = document.createElement('div');
                lineDiv.style.cssText = `
                    position: relative;
                    padding-left: 25px;
                    margin-bottom: 12px;
                    text-align: left;
                    line-height: 1.8;
                    font-size: 1.1rem;
                    color: #333;
                `;
                
                // Add star
                const star = document.createElement('span');
                star.innerHTML = '';
                star.style.cssText = `
                    position: absolute;
                    left: 0;
                    top: 0;
                    color: #000000;
                    font-size: 1rem;
                    font-weight: bold;
                    width: 20px;
                    text-align: center;
                `;
                
                // Add text
                const text = document.createElement('span');
                text.textContent = line.trim();
                
                lineDiv.appendChild(star);
                lineDiv.appendChild(text);
                productDescription.appendChild(lineDiv);
            }
        });
    }
});
</script>

@endsection
