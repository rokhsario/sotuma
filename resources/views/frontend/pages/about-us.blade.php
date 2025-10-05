@extends('frontend.layouts.master')

@section('title','SOTUMA')

@section('main-content')

<!-- Hero Section -->
<section class="about-hero position-relative" style="min-height:60vh; background:url('{{ isset($settings) && $settings->about_hero_bg ? asset($settings->about_hero_bg) : asset('images/about-us/hero-bg-default.jpg') }}') center/67% no-repeat;">
    <!-- Media layer: contains the visual hero only -->
    <div class="hero-media position-absolute w-100 h-100" style="inset:0; z-index:0; pointer-events:none;">
        <!-- Mobile/Tablet hero image element for better rendering -->
        <img class="about-hero-img d-block d-lg-none" src="{{ isset($settings) && $settings->about_hero_bg ? asset($settings->about_hero_bg) : asset('images/about-us/hero-bg-default.jpg') }}" alt="A propos" style="position:absolute; inset:0; width:100%; height:100%; object-fit:contain; object-position:top center;"/>
        <!-- Overlay limited to hero media on desktop only -->
        <div class="hero-overlay d-none d-lg-block position-absolute w-100 h-100" style="background: rgba(30, 30, 30, 0.55); touch-action: manipulation !important;"></div>
    </div>
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative" style="z-index:2;">
        <h1 class="display-3 text-white font-weight-bold mb-3" style="letter-spacing: 2px; touch-action: manipulation !important; white-space: nowrap !important; overflow: hidden !important; text-overflow: ellipsis !important; line-height: 1.2 !important; max-width: 100% !important; text-align: center !important; margin: 0px auto !important; display: block !important; box-sizing: border-box !important;">À propos</h1>
        <p class="lead text-white" style="font-size:1.5rem; max-width:700px;">{{ __('frontend.about_excellence') }}</p>
    </div>
</section>

<!-- Présentation Section -->
<section class="about-presentation py-5" style="background:linear-gradient(90deg, #f8f5f0 60%, #fff 100%);">
    <div class="container-fluid px-0">
        <div class="row align-items-center no-gutters">
            <div class="col-lg-6 order-lg-2 d-flex justify-content-center p-0">
                <div class="presentation-image w-100 h-100" style="min-height:400px; background:url('{{ isset($settings) && $settings->about_presentation_image ? asset($settings->about_presentation_image) : asset('images/about-us/hero-bg-default.jpg') }}') center/67% no-repeat;"></div>
            </div>
            <div class="col-lg-6 order-lg-1 d-flex align-items-center p-0">
                <div class="presentation-text p-5 m-4 rounded shadow-lg w-100" style="background:#fffbe9; font-size:1.35rem; line-height:2.1;">
                    <h2 class="section-title mb-4" style="font-size:2.5rem; font-weight:700; letter-spacing:1px;">{{ __('frontend.presentation') }}</h2>
                    <p>{{ __('frontend.presentation_text_1') }}</p>
                    <p>{{ __('frontend.presentation_text_2') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Notre Mission Section -->
<section class="about-mission py-5" style="background:linear-gradient(90deg, #fff 0%, #f8f5f0 40%);">
    <div class="container-fluid px-0">
        <div class="row align-items-center no-gutters">
            <div class="col-lg-6 d-flex justify-content-center p-0">
                <div class="mission-image w-100 h-100" style="min-height:400px; background:url('{{ isset($settings) && $settings->about_mission_image ? asset($settings->about_mission_image) : asset('images/about-us/hero-bg-default.jpg') }}') center/67% no-repeat;"></div>
            </div>
            <div class="col-lg-6 d-flex align-items-center p-0">
                <div class="mission-text p-5 m-4 rounded shadow-lg w-100" style="background:#fffbe9; font-size:1.35rem; line-height:2.1;">
                    <h2 class="section-title mb-4" style="font-size:2.5rem; font-weight:700; letter-spacing:1px;">{{ __('frontend.our_mission') }}</h2>
                    <p>{!! __('frontend.mission_text') !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nos Objectifs Section -->
<section class="about-objectifs py-5" style="background:linear-gradient(90deg, #f8f5f0 60%, #fff 100%);">
    <div class="container-fluid px-0">
        <div class="row align-items-center no-gutters">
            <div class="col-lg-6 d-flex align-items-center p-0">
                <div class="objectifs-text p-5 m-4 rounded shadow-lg w-100" style="background:#fffbe9; font-size:1.35rem; line-height:2.1; min-height:400px;">
                    <h2 class="section-title mb-4" style="font-size:2.5rem; font-weight:700; letter-spacing:1px;">{{ __('frontend.our_objectives') }}</h2>
                    <p>{!! __('frontend.objectives_text_1') !!}<br><br>{!! __('frontend.objectives_text_2') !!}</p>
                </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-center p-0">
                <div class="objectifs-image w-100 h-100" style="min-height:400px; background:url('{{ isset($settings) && $settings->about_objectives_image ? asset($settings->about_objectives_image) : asset('images/about-us/hero-bg-default.jpg') }}') center/67% no-repeat;"></div>
            </div>
        </div>
    </div>
</section>

<!-- Notre Expertise Section -->
<section class="about-expertise py-5" style="background:linear-gradient(90deg, #fff 0%, #f8f5f0 40%);">
    <div class="container-fluid px-0">
        <div class="row align-items-center no-gutters">
            <div class="col-lg-6 d-flex justify-content-center p-0">
                <div class="expertise-image w-100 h-100" style="min-height:400px; background:url('{{ isset($settings) && $settings->about_expertise_image ? asset($settings->about_expertise_image) : asset('images/about-us/hero-bg-default.jpg') }}') center/67% no-repeat;"></div>
            </div>
            <div class="col-lg-6 d-flex align-items-center p-0">
                <div class="expertise-text p-5 m-4 rounded shadow-lg w-100" style="background:#fffbe9; font-size:1.35rem; line-height:2.1; min-height:400px;">
                    <h2 class="section-title mb-4" style="font-size:2.5rem; font-weight:700; letter-spacing:1px;">{{ __('frontend.our_expertise') }}</h2>
                    <p>{!! __('frontend.expertise_text_1') !!}<br><br>{!! __('frontend.expertise_text_2') !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Notre Approche Section -->
<section class="about-approche py-5" style="background:linear-gradient(90deg, #f8f5f0 60%, #fff 100%);">
    <div class="container-fluid px-0">
        <div class="row align-items-center no-gutters">
            <div class="col-lg-6 d-flex align-items-center p-0">
                <div class="approche-text p-5 m-4 rounded shadow-lg w-100" style="background:#fffbe9; font-size:1.35rem; line-height:2.1; min-height:400px;">
                    <h2 class="section-title mb-4" style="font-size:2.5rem; font-weight:700; letter-spacing:1px;">{{ __('frontend.our_approach') }}</h2>
                    <p>{{ __('frontend.approach_text') }}</p>
                </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-center p-0">
                <div class="approche-image w-100 h-100" style="min-height:400px; background:url('{{ isset($settings) && $settings->about_approach_image ? asset($settings->about_approach_image) : asset('images/about-us/hero-bg-default.jpg') }}') center/67% no-repeat;"></div>
            </div>
        </div>
    </div>
</section>
<!-- Separation Line Before Partners -->
<div style="height:2px; background:linear-gradient(90deg, transparent, #ddd, transparent); margin:60px 0;"></div>

<!-- Partners Scrolling Section -->
<section class="partners-scroll py-5" style="background:#f8f5f0;">
    <div class="container-fluid">
        <h2 class="section-title text-center mb-5" style="font-size:2.2rem; font-weight:700;">Nos Partenaires</h2>
        <div class="partners-scroll-container" style="overflow:hidden; position:relative;">
            <div class="partners-scroll-content" style="display:flex; animation:scroll 30s linear infinite; white-space:nowrap;">
                <!-- Partner 1 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par1.png') }}" alt="Partenaire 1" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 2 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par2.png') }}" alt="Partenaire 2" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 3 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par3.jpg') }}" alt="Partenaire 3" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 4 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par4.jpg') }}" alt="Partenaire 4" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 5 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par5.png') }}" alt="Partenaire 5" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 6 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par6.jpg') }}" alt="Partenaire 6" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 7 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par7.png') }}" alt="Partenaire 7" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 8 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par8.jpg') }}" alt="Partenaire 8" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 9 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par9.jpg') }}" alt="Partenaire 9" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 10 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par10.jpg') }}" alt="Partenaire 10" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 11 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par11.jpg') }}" alt="Partenaire 11" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 12 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par12.jpg') }}" alt="Partenaire 12" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Duplicate items for seamless scrolling -->
                <!-- Partner 1 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par1.png') }}" alt="Partenaire 1" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 2 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par2.png') }}" alt="Partenaire 2" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 3 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par3.jpg') }}" alt="Partenaire 3" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 4 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par4.jpg') }}" alt="Partenaire 4" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 5 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par5.png') }}" alt="Partenaire 5" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
                <!-- Partner 6 -->
                <div class="partner-item" style="flex-shrink:0; margin:0 30px; text-align:center; min-width:150px;">
                    <div style="width:120px; height:80px; background:#fff; border-radius:8px; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 10px rgba(0,0,0,0.1);">
                        <img src="{{ asset('images/par6.jpg') }}" alt="Partenaire 6" style="max-width:100%; max-height:100%; object-fit:contain;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Separation Line After Partners -->
<div style="height:2px; background:linear-gradient(90deg, transparent, #ddd, transparent); margin:60px 0;"></div>

<style>
@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

.partners-scroll-container:hover .partners-scroll-content {
    animation-play-state: paused;
}

.partner-item div {
    width: 120px !important;
    height: 100px !important;
}

/* Mobile and Tablet About Us Layout - Image then Paragraph Pattern */
@media (max-width: 1024px) {
    /* Hero Section - Mobile Optimization */
    .about-hero {
        min-height: auto !important;
        background: none !important;
        padding: 0 !important; /* hero only */
    }
    .hero-media {
        position: relative !important; /* keep media as stacking context */
        inset: auto !important;
        width: 100% !important;
        height: auto !important;
    }
    .about-hero-img {
        position: static !important;
        width: 100% !important;
        height: 35vh !important; /* shorter hero height */
        object-fit: contain !important;
        object-position: top center !important;
        display: block !important;
    }
    .about-hero .container {
        position: absolute !important;
        inset: 0 !important;
        min-height: auto !important;
        align-items: flex-start !important;
        justify-content: center !important;
        padding-top: 8px !important;
        max-width: 100% !important;
        text-align: center !important;
        box-sizing: border-box !important;
        pointer-events: none !important; /* title only overlay */
    }
    .about-hero h1 {
        text-transform: uppercase !important;
        font-size: clamp(1.1rem, 6vw, 1.8rem) !important;
        margin: 0 !important;
        padding: 0 10px !important;
        text-shadow: 0 2px 6px rgba(0,0,0,0.5) !important;
    }
    .about-hero .lead { display: none !important; }
    
    .about-hero h1 {
        font-size: clamp(1.5rem, 6vw, 2.5rem) !important;
        letter-spacing: 1px !important;
    }
    
    .about-hero .lead {
        font-size: clamp(1rem, 4vw, 1.3rem) !important;
        padding: 0 20px !important;
    }
    
    /* Présentation Section - Mobile Layout */
    .about-presentation .row {
        flex-direction: column !important;
    }
    
    .about-presentation .col-lg-6 {
        order: unset !important;
        width: 100% !important;
        flex: none !important;
    }
    
    .about-presentation .presentation-image {
        display: none !important;
    }
    
    .about-presentation .presentation-text {
        order: 2 !important;
        margin: 20px !important;
        padding: 30px 20px !important;
        font-size: 1.1rem !important;
        line-height: 1.8 !important;
        min-height: auto !important;
    }
    
    .about-presentation .presentation-text h2 {
        font-size: clamp(1.8rem, 5vw, 2.2rem) !important;
        margin-bottom: 20px !important;
    }
    
    /* Notre Mission Section - Mobile Layout */
    .about-mission .row {
        flex-direction: column !important;
    }
    
    .about-mission .col-lg-6 {
        width: 100% !important;
        flex: none !important;
    }
    
    .about-mission .mission-image {
        order: 1 !important;
        min-height: 300px !important;
        background-size: 80% !important;
        margin-bottom: 0 !important;
    }
    
    .about-mission .mission-text {
        order: 2 !important;
        margin: 20px !important;
        padding: 30px 20px !important;
        font-size: 1.1rem !important;
        line-height: 1.8 !important;
        min-height: auto !important;
    }
    
    .about-mission .mission-text h2 {
        font-size: clamp(1.8rem, 5vw, 2.2rem) !important;
        margin-bottom: 20px !important;
    }
    
    /* Nos Objectifs Section - Mobile Layout */
    .about-objectifs .row {
        flex-direction: column !important;
    }
    
    .about-objectifs .col-lg-6 {
        width: 100% !important;
        flex: none !important;
    }
    /* Force Objectifs image first, then text on mobile/tablet */
    .about-objectifs .row { display: flex !important; flex-direction: column !important; }
    .about-objectifs .col-lg-6:first-child { order: 2 !important; }
    .about-objectifs .col-lg-6:last-child { order: 1 !important; }
    
    .about-objectifs .objectifs-text {
        order: 2 !important;
        margin: 20px !important;
        padding: 30px 20px !important;
        font-size: 1.1rem !important;
        line-height: 1.8 !important;
        min-height: auto !important;
    }
    
    .about-objectifs .objectifs-text h2 {
        font-size: clamp(1.8rem, 5vw, 2.2rem) !important;
        margin-bottom: 20px !important;
    }
    
    .about-objectifs .objectifs-image {
        order: 1 !important;
        min-height: 300px !important;
        background-size: 80% !important;
        margin-bottom: 0 !important;
    }
    
    /* Notre Expertise Section - Mobile Layout */
    .about-expertise .row {
        flex-direction: column !important;
    }
    
    .about-expertise .col-lg-6 {
        width: 100% !important;
        flex: none !important;
    }
    
    .about-expertise .expertise-image {
        order: 1 !important;
        min-height: 300px !important;
        background-size: 80% !important;
        margin-bottom: 0 !important;
    }
    
    .about-expertise .expertise-text {
        order: 2 !important;
        margin: 20px !important;
        padding: 30px 20px !important;
        font-size: 1.1rem !important;
        line-height: 1.8 !important;
        min-height: auto !important;
    }
    
    .about-expertise .expertise-text h2 {
        font-size: clamp(1.8rem, 5vw, 2.2rem) !important;
        margin-bottom: 20px !important;
    }
    
    /* Notre Approche Section - Mobile Layout */
    .about-approche .row {
        flex-direction: column !important;
    }
    
    .about-approche .col-lg-6 {
        width: 100% !important;
        flex: none !important;
    }
    /* Force Approche image first, then text on mobile/tablet */
    .about-approche .row { display: flex !important; flex-direction: column !important; }
    .about-approche .col-lg-6:first-child { order: 2 !important; }
    .about-approche .col-lg-6:last-child { order: 1 !important; }
    
    .about-approche .approche-text {
        order: 2 !important;
        margin: 20px !important;
        padding: 30px 20px !important;
        font-size: 1.1rem !important;
        line-height: 1.8 !important;
        min-height: auto !important;
    }
    
    .about-approche .approche-text h2 {
        font-size: clamp(1.8rem, 5vw, 2.2rem) !important;
        margin-bottom: 20px !important;
    }
    
    .about-approche .approche-image {
        order: 1 !important;
        min-height: 300px !important;
        background-size: 80% !important;
        margin-bottom: 0 !important;
    }
    
    /* Partners Section - Mobile Optimization */
    .partners-scroll h2 {
        font-size: clamp(1.5rem, 5vw, 2rem) !important;
        margin-bottom: 30px !important;
    }
    
    .partner-item {
        margin: 0 15px !important;
        min-width: 120px !important;
    }
    
    .partner-item div {
        width: 100px !important;
        height: 70px !important;
    }
    
    /* CTA Section - Mobile Optimization */
    .about-cta h2 {
        font-size: clamp(1.5rem, 5vw, 2rem) !important;
    }
    
    .about-cta .lead {
        font-size: clamp(1rem, 4vw, 1.2rem) !important;
        padding: 0 20px !important;
    }
    
    .about-cta .btn {
        font-size: 1rem !important;
        padding: 15px 30px !important;
    }
}

@media (max-width: 768px) {
    /* Further mobile optimizations */
    .about-hero {
        min-height: 42vh !important;
        background-size: contain !important;
        background-position: center top !important;
        background-repeat: no-repeat !important;
    }
    
    .about-presentation .presentation-image,
    .about-mission .mission-image,
    .about-objectifs .objectifs-image,
    .about-expertise .expertise-image,
    .about-approche .approche-image {
        min-height: 250px !important;
        background-size: 85% !important;
    }
    
    .about-presentation .presentation-text,
    .about-mission .mission-text,
    .about-objectifs .objectifs-text,
    .about-expertise .expertise-text,
    .about-approche .approche-text {
        margin: 15px !important;
        padding: 25px 15px !important;
        font-size: 1rem !important;
    }
    
    .partner-item {
        margin: 0 10px !important;
        min-width: 100px !important;
    }
    
    .partner-item div {
        width: 80px !important;
        height: 60px !important;
    }
}

@media (max-width: 480px) {
    /* Small mobile optimizations */
    .about-hero {
        min-height: 38vh !important;
        background-size: contain !important;
        background-position: center top !important;
        background-repeat: no-repeat !important;
    }
    
    .about-presentation .presentation-image,
    .about-mission .mission-image,
    .about-objectifs .objectifs-image,
    .about-expertise .expertise-image,
    .about-approche .approche-image {
        min-height: 200px !important;
        background-size: 90% !important;
    }
    
    .about-presentation .presentation-text,
    .about-mission .mission-text,
    .about-objectifs .objectifs-text,
    .about-expertise .expertise-text,
    .about-approche .approche-text {
        margin: 10px !important;
        padding: 20px 15px !important;
        font-size: 0.95rem !important;
        line-height: 1.7 !important;
    }
    
    .about-presentation .presentation-text h2,
    .about-mission .mission-text h2,
    .about-objectifs .objectifs-text h2,
    .about-expertise .expertise-text h2,
    .about-approche .approche-text h2 {
        font-size: clamp(1.4rem, 6vw, 1.8rem) !important;
        margin-bottom: 15px !important;
    }
}
/* Desktop centering for hero title */
@media (min-width: 1025px) {
    .about-hero {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        min-height: 60vh !important;
    }
    .about-hero .container {
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        height: auto !important; /* prevent extra vertical stretch */
    }
    .about-hero h1 {
        text-align: center !important;
        margin-left: auto !important;
        margin-right: auto !important;
        font-size: clamp(2.2rem, 6vw, 4rem) !important; /* bigger desktop title */
        letter-spacing: 2px !important;
    }
}
</style>


<!-- Call to Action / Contact Info Section - Hidden on Mobile and Tablet -->
<section class="about-cta py-5 position-relative d-none d-lg-block" style="background:#f8f5f0;">
    <div class="cta-overlay position-absolute w-100 h-100" style="background:rgba(139,69,19,0.3); top:0;"></div>
    <div class="container text-center position-relative" style="z-index:2;">
        <h2 class="section-title mb-4" style="font-size:2.3rem; font-weight:700; color:#333;">{{ __('frontend.contact_us') }}</h2>
        <p class="lead mb-4" style="font-size:1.3rem; color:#666;">{{ __('frontend.contact_text') }}</p>
        <a href="/contact" class="btn btn-lg btn-primary px-5 py-3" style="font-size:1.2rem; font-weight:600; letter-spacing:1px;">{{ __('frontend.contact_button') }}</a>
    </div>
</section>
@endsection
