@extends('frontend.layouts.master')

@php
    // Définir les variables SEO pour cette page
    $page = 'product-detail';
    $seoData = $seoData ?? [];
    $seoData['title'] = $seoData['title'] ?? ($product->title . ' | SOTUMA - Menuiserie Aluminium Sfax');
    $seoData['description'] = $seoData['description'] ?? (strip_tags($product->description ?? '') ?: 'Découvrez ' . $product->title . ' chez SOTUMA. Qualité premium, installation professionnelle et garantie. Devis gratuit à Sfax.');
    $seoData['og_image'] = $seoData['og_image'] ?? ($product->image ? asset($product->image) : asset('images/sotuma-logo.jpg'));
    $seoData['canonical'] = $seoData['canonical'] ?? route('product-detail', $product->slug);
    $seoData['keywords'] = $seoData['keywords'] ?? implode(', ', [
        strtolower($product->title),
        'menuiserie aluminium',
        'sotuma sfax',
        $product->category->title ?? 'produit aluminium',
        'devis gratuit',
        'installation professionnelle'
    ]);
@endphp

@section('meta')
<meta name="description" content="{{ $seoData['description'] }}">
<meta name="keywords" content="{{ $seoData['keywords'] }}">
<meta name="author" content="SOTUMA">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="product">
<meta property="og:url" content="{{ $seoData['canonical'] }}">
<meta property="og:title" content="{{ $seoData['title'] }}">
<meta property="og:description" content="{{ $seoData['description'] }}">
<meta property="og:image" content="{{ $seoData['og_image'] }}">
<meta property="og:site_name" content="SOTUMA">
<meta property="og:locale" content="fr_FR">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@sotuma_aluminium">
<meta name="twitter:title" content="{{ $seoData['title'] }}">
<meta name="twitter:description" content="{{ $seoData['description'] }}">
<meta name="twitter:image" content="{{ $seoData['og_image'] }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ $seoData['canonical'] }}">

<!-- Hreflang pour multilingue -->
<link rel="alternate" hreflang="fr" href="{{ $seoData['canonical'] }}">
<link rel="alternate" hreflang="x-default" href="{{ $seoData['canonical'] }}">

<!-- Product Schema.org JSON-LD -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": @json($product->title),
  "image": [@json($product->image ? asset($product->image) : asset('images/no-image.png'))],
  "description": @json(strip_tags($product->description ?? '')),
  "brand": {
    "@type": "Brand",
    "name": "SOTUMA"
  },
  @if($product->category)
  "category": @json($product->category->title),
  @endif
  "sku": "{{ $product->slug }}",
  "mpn": "{{ $product->id }}",
  "url": "{{ $seoData['canonical'] }}",
  "offers": {
    "@type": "Offer",
    "availability": "https://schema.org/InStock",
    "priceCurrency": "TND",
    "seller": {
      "@type": "Organization",
      "name": "SOTUMA"
    },
    "url": "{{ $seoData['canonical'] }}"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.5",
    "reviewCount": "10"
  }
}
</script>

<!-- BreadcrumbList Schema.org JSON-LD -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Accueil",
      "item": "{{ url('/') }}"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Produits",
      "item": "{{ route('products.all') }}"
    }@if($product->category),{
      "@type": "ListItem",
      "position": 3,
      "name": @json($product->category->title),
      "item": "{{ route('categories.show', $product->category->slug) }}"
    },{
      "@type": "ListItem",
      "position": 4,
      "name": @json($product->title),
      "item": "{{ $seoData['canonical'] }}"
    }@else,{
      "@type": "ListItem",
      "position": 3,
      "name": @json($product->title),
      "item": "{{ $seoData['canonical'] }}"
    }@endif
  ]
}
</script>
@endsection

@section('title', $seoData['title'])
@section('main-content')

<!-- Product Detail Section -->
<section class="product-detail-section">
    <div class="container">
        <div class="product-detail-wrapper">
            <!-- Product Image -->
            <div class="product-image-section">
                <div class="product-image-container">
                    <picture>
                        <source srcset="{{ $product->image ? asset($product->image) : asset('images/no-image.png') }}" type="image/jpeg">
                        <img src="{{ $product->image ? asset($product->image) : asset('images/no-image.png') }}" 
                             alt="{{ $product->title }} - Menuiserie Aluminium SOTUMA Sfax - {{ $product->category->title ?? 'Produit aluminium' }}" 
                             title="{{ $product->title }} - SOTUMA"
                             class="product-image"
                             loading="lazy"
                             width="500"
                             height="500"
                             fetchpriority="high">
                    </picture>
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

<!-- Structured Data: BreadcrumbList and Product -->
@php
    $productImage = $product->image ? asset($product->image) : asset('images/no-image.png');
    $productCategory = $product->category->title ?? null;
    $productDesc = trim(strip_tags($product->description ?? ''));
@endphp
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {"@type":"ListItem","position":1,"name":"Accueil","item": "{{ url('/') }}"},
    {"@type":"ListItem","position":2,"name":"Produits","item": "{{ route('products.all') }}"},
    {"@type":"ListItem","position":3,"name": @json($product->title),"item": "{{ url()->current() }}"}
  ]
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": @json($product->title),
  "image": [@json($productImage)],
  "description": @json($productDesc),
  "brand": {"@type":"Brand","name":"SOTUMA"},
  @if($productCategory)
  "category": @json($productCategory),
  @endif
  "sku": "{{ $product->id }}",
  "url": "{{ url()->current() }}"
}
</script>

@endsection
