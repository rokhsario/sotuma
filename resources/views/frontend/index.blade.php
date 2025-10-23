@extends('frontend.layouts.master')
@section('title','SOTUMA')
@section('main-content')
<!-- Enhanced Hero Section with Video Background -->
<section class="hero-video-section position-relative" style="min-height:100vh;overflow:hidden;">
    <!-- Slogan in Top Left Corner - Outside Container -->
    <div class="hero-slogan position-absolute" style="top:40px;left:0;z-index:10;color:#fff;text-align:left;padding-left:115px;">
        <div class="slogan-text" style="font-size:clamp(1.8rem,3.5vw,2.5rem);font-weight:700;color:#fff;text-shadow:0 4px 16px rgba(0,0,0,0.8);letter-spacing:2px;line-height:1.4;max-width:700px;text-align:justify;word-spacing:0.3em;">
            @if($settings && $settings->hero_slogan)
                @php
                    $slogan = $settings->hero_slogan;
                    // Split the slogan into two balanced lines
                    if ($slogan === 'Le monde se reflète dans nos créations') {
                        $line1 = 'LE MONDE SE REFLETE';
                        $line2 = 'DANS NOS CREATIONS';
                    } else {
                        // For other slogans, try to split at the middle
                        $words = explode(' ', strtoupper($slogan));
                        $mid = ceil(count($words) / 2);
                        $line1 = implode(' ', array_slice($words, 0, $mid));
                        $line2 = implode(' ', array_slice($words, $mid));
                    }
                @endphp
                <div style="text-align:justify;margin-bottom:8px;">{{ $line1 }}</div>
                <div style="text-align:justify;">{{ $line2 }}</div>
            @else
                <div style="text-align:justify;margin-bottom:8px;">LE MONDE SE REFLETE</div>
                <div style="text-align:justify;">DANS NOS CREATIONS</div>
            @endif
        </div>
    </div>
    
    <!-- Video Background -->
    <video class="hero-bg-video" autoplay loop muted playsinline style="object-fit:cover;width:100vw;height:100vh;position:absolute;top:0;left:0;z-index:1;">
        <source src="{{ asset('images/video1.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    
    <!-- Main Content -->
    <div class="container h-100 d-flex flex-column justify-content-center align-items-center position-relative" style="z-index:3;min-height:100vh;">
        <!-- Scroll Indicator -->
        <div class="hero-scroll-indicator mt-5" style="position:absolute;bottom:40px;left:50%;transform:translateX(-50%);color:#fff;text-align:center;">
            <div class="scroll-text mb-2" style="font-size:0.9rem;font-weight:300;letter-spacing:1px;">{{ __('frontend.discover_more') }}</div>
            <div class="scroll-arrow" style="width:2px;height:30px;background:linear-gradient(to bottom,#d4a574,transparent);margin:0 auto;animation:scrollBounce 2s infinite;"></div>
        </div>
    </div>
    
        <style>
            html {
                scroll-behavior: smooth;
            }
            
            .hero-btn-box {
            background: rgba(255, 255, 255, 0.12);
                border: 2.5px solid #d4a574;
                border-radius: 28px;
            box-shadow: 0 8px 40px 0 rgba(130,4,3,0.15), 0 1.5px 16px 0 #d4a57455;
                backdrop-filter: blur(12px);
                padding: 18px 18px 10px 18px;
                display: flex;
                align-items: center;
                justify-content: center;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                min-width: 220px;
                max-width: 320px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-btn-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .hero-btn-box:hover::before {
            left: 100%;
        }
        
            .hero-btn-box:hover {
                box-shadow: 0 16px 60px 0 #d4a57499, 0 2px 24px 0 #c4946433;
                border: 2.5px solid #c49464;
            transform: translateY(-6px) scale(1.05);
            }
        
            .hero-btn {
                width: 100%;
                text-align: center;
                font-size: 1.25rem;
                font-weight: 700;
                letter-spacing: 1px;
                border-radius: 24px;
                box-shadow: none;
                border: none;
            position: relative;
            z-index: 2;
        }
        
        .hero-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.3);
        }
        
        @keyframes scrollBounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
        
            @media (max-width: 768px) {
            .hero-btn-box { 
                min-width: 0; 
                max-width: 100%; 
                width: 100%; 
                margin-bottom: 18px; 
            }
            .d-flex.flex-md-row { 
                flex-direction: column !important; 
            }
            .hero-main-title {
                font-size: 3rem !important;
                letter-spacing: 2px !important;
            }
            .hero-subtitle {
                font-size: 1.5rem !important;
            }
            .hero-tagline {
                font-size: 1.1rem !important;
            }
            
            .hero-slogan {
                top: 30px !important;
                padding-left: 75px !important;
            }
            
            .slogan-text {
                font-size: clamp(1.4rem, 3vw, 2rem) !important;
                letter-spacing: 1.5px !important;
                word-spacing: 0.2em !important;
            }
        }
        
        @media (max-width: 480px) {
            .hero-slogan {
                top: 20px !important;
                padding-left: 55px !important;
            }
            
            .slogan-text {
                font-size: clamp(1.2rem, 2.5vw, 1.6rem) !important;
                letter-spacing: 1px !important;
                word-spacing: 0.1em !important;
                max-width: 300px !important;
            }
        }
        
        /* Animation classes for entrance effects */
        .fade-in-up {
            animation: fadeInUp 1s ease-out;
        }
        
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
</section>


<style>
/* Premium Aluprof-Style Offer Grid - Google Senior Developer Level */
.offer-grid-section {
    position: relative;
    background: linear-gradient(135deg, #fafafa 0%, #ffffff 50%, #f8f9fa 100%);
    padding: 120px 0 100px;
    overflow: hidden;
    margin-top: -60px;
    padding-top: 180px;
}

/* Floating Guarantee Image */
.floating-guarantee {
    position: absolute;
    left: 600px;
    top: 15%;
    width: 250px;
    height: 250px;
    background: url('{{ asset('images/10.png') }}') center/contain no-repeat;
    border-radius: 50%;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    animation: floatEnhanced 8s ease-in-out infinite;
    filter: drop-shadow(0 0 20px rgba(212, 165, 116, 0.3));
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 5;
}

.floating-guarantee:hover {
    transform: translateY(-50%) scale(1.1) rotate(5deg);
    filter: drop-shadow(0 0 30px rgba(212, 165, 116, 0.5));
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes glow {
    0% { filter: drop-shadow(0 0 20px rgba(212, 165, 116, 0.3)); }
    100% { filter: drop-shadow(0 0 30px rgba(212, 165, 116, 0.6)); }
}

.offer-grid-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, #e0e0e0 50%, transparent 100%);
}

.offer-grid-header {
    text-align: center;
    margin-bottom: 80px;
    padding: 0 24px;
}

.offer-grid-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 16px 0;
    letter-spacing: -0.02em;
    line-height: 1.1;
    position: relative;
}

/* Removed gold underline from offer grid title */

.offer-grid-subtitle {
    font-size: 1.25rem;
    color: #666;
    margin: 0;
    font-weight: 400;
    line-height: 1.5;
}

.offer-grid {
    display: flex;
    gap: 0;
    position: relative;
    height: 600px;
    overflow: hidden;
    padding: 0;
    width: 100%;
    margin: 0;
}

.offer-card {
    position: relative;
    flex: 1;
    min-width: 200px;
    height: 600px;
    cursor: pointer;
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 1;
    margin-right: -100px;
}

.offer-card:hover {
    flex: 2;
    min-width: 450px;
    margin-right: -50px;
    z-index: 100;
}

.offer-card:first-child {
    margin-left: 0;
}

.offer-card:last-child {
    margin-right: 0;
}

.offer-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.offer-card:hover .offer-card-inner {
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
    border-radius: 16px;
}

.offer-image-container {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.offer-image-link {
    display: block;
    width: 100%;
    height: 100%;
    text-decoration: none;
    cursor: pointer;
}

.offer-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    filter: brightness(0.9) contrast(1.1);
}

.offer-card:hover .offer-image {
    filter: brightness(1) contrast(1.2);
}

.offer-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        180deg,
        transparent 0%,
        transparent 40%,
        rgba(0, 0, 0, 0.3) 70%,
        rgba(0, 0, 0, 0.8) 100%
    );
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 2;
}

.offer-card:hover .offer-image-overlay {
    background: linear-gradient(
        180deg,
        transparent 0%,
        transparent 30%,
        rgba(0, 0, 0, 0.4) 60%,
        rgba(0, 0, 0, 0.9) 100%
    );
}

.offer-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 3;
    padding: 0 24px 24px;
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.offer-content-inner {
    transform: translateY(0);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.offer-card:hover .offer-content-inner {
    transform: translateY(-8px);
}

.offer-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 8px 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    height: 2.4rem;
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.offer-card:hover .offer-title {
    font-size: 1.3rem;
    margin-bottom: 8px;
    text-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
    height: 2.4rem;
    display: flex;
    align-items: center;
    justify-content: flex-start;
}

.offer-description {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0 0 16px 0;
    line-height: 1.4;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    transition-delay: 0.1s;
}

.offer-card:hover .offer-description {
    opacity: 1;
    transform: translateY(0);
}

.offer-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #d4a574;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 8px 0;
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    opacity: 0.9;
    position: relative;
}

.offer-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: #d4a574;
    transition: width 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.offer-card:hover .offer-link {
    opacity: 1;
    color: #fff;
}

.offer-card:hover .offer-link::after {
    width: 100%;
}

.offer-link-icon {
    width: 16px;
    height: 16px;
    transition: transform 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.offer-card:hover .offer-link-icon {
    transform: translateX(4px);
}

.offer-card-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.1);
    opacity: 0;
    transition: opacity 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    pointer-events: none;
    z-index: 1;
}

.offer-card:hover .offer-card-backdrop {
    opacity: 1;
}

/* Responsive Design - Google Level */
@media (max-width: 1400px) {
    .offer-grid {
        height: 550px;
        padding: 0;
    }
    
    .offer-card {
        flex: 1;
        min-width: 180px;
        height: 550px;
        margin-right: -50px;
    }
    
    .offer-card:hover {
        flex: 2;
        min-width: 400px;
        margin-right: -25px;
    }
}

@media (max-width: 1200px) {
    .offer-grid {
        height: 500px;
        padding: 0;
    }
    
    .offer-card {
        flex: 1;
        min-width: 160px;
        height: 500px;
        margin-right: -45px;
    }
    
    .offer-card:hover {
        flex: 2;
        min-width: 350px;
        margin-right: -20px;
    }
}

@media (max-width: 768px) {
    .offer-grid-section {
        padding: 80px 0 60px;
    }
    
    .offer-grid-header {
        margin-bottom: 60px;
    }
    
    .offer-grid {
        height: 400px;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        padding: 0;
        -webkit-overflow-scrolling: touch;
        width: 100%;
    }
    
    .offer-card {
        flex: 1;
        min-width: 150px;
        height: 400px;
        scroll-snap-align: start;
        margin-right: -35px;
    }
    
    .offer-card:hover {
        flex: 2;
        min-width: 280px;
        margin-right: -10px;
    }
    
    .offer-content {
        padding: 0 20px 20px;
    }
    
    .offer-title {
        font-size: 1rem;
    }
    
    .offer-card:hover .offer-title {
        font-size: 1.2rem;
    }
}

@media (max-width: 480px) {
    .offer-grid-section {
        padding: 60px 0 40px;
    }
    
    .offer-grid-header {
        margin-bottom: 40px;
        padding: 0 16px;
    }
    
    .offer-grid {
        height: 350px;
        padding: 0;
        width: 100%;
    }
    
    .offer-card {
        flex: 1;
        min-width: 130px;
        height: 350px;
        margin-right: -30px;
    }
    
    .offer-card:hover {
        flex: 2;
        min-width: 220px;
        margin-right: -5px;
    }
    
    .offer-content {
        padding: 0 16px 16px;
    }
    
    .offer-title {
        font-size: 0.9rem;
    }
    
    .offer-card:hover .offer-title {
        font-size: 1.1rem;
    }
    
    .offer-description {
        font-size: 0.75rem;
    }
    
    .offer-link {
        font-size: 0.75rem;
    }
}

/* Performance Optimizations */
.offer-card {
    will-change: transform;
    backface-visibility: hidden;
    perspective: 1000px;
}

.offer-image {
    will-change: transform;
    backface-visibility: hidden;
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
    .offer-card,
    .offer-image,
    .offer-content,
    .offer-link {
        transition: none;
    }
}

/* High DPI Displays */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .offer-image {
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }
}

/* Premium Projects Categories Grid - Google Senior Developer Level */
.projects-categories-grid-section {
    position: relative;
    background: linear-gradient(135deg, #f8f5f0 0%, #fff 100%);
    padding: 120px 0 100px;
    overflow: hidden;
}

.projects-categories-grid-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, #e0e0e0 50%, transparent 100%);
}

.projects-categories-grid-header {
    text-align: center;
    margin-bottom: 80px;
    padding: 0 24px;
}

.projects-categories-grid-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 16px 0;
    letter-spacing: -0.02em;
    line-height: 1.1;
    position: relative;
}

/* Removed gold underline from projects categories title */

.projects-categories-grid-subtitle {
    font-size: 1.25rem;
    color: #666;
    margin: 0;
    font-weight: 400;
    line-height: 1.5;
}

.projects-categories-grid {
    display: flex;
    gap: 0;
    position: relative;
    height: 600px;
    overflow: hidden;
    padding: 0;
    width: 100%;
    margin: 0;
}

.projects-categories-card {
    position: relative;
    flex: 1;
    min-width: 200px;
    height: 600px;
    cursor: pointer;
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 1;
    margin-right: -100px;
}

.projects-categories-card:hover {
    flex: 2;
    min-width: 450px;
    margin-right: -50px;
    z-index: 100;
}

.projects-categories-card:first-child {
    margin-left: 0;
}

.projects-categories-card:last-child {
    margin-right: 0;
}

.projects-categories-card-inner {
    position: relative;
    width: 100%;
    height: 100%;
    border-radius: 12px;
    overflow: hidden;
    background: #fff;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.projects-categories-card:hover .projects-categories-card-inner {
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.25);
    border-radius: 16px;
}

.projects-categories-image-container {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.projects-categories-image-link {
    display: block;
    width: 100%;
    height: 100%;
    text-decoration: none;
    cursor: pointer;
}

.projects-categories-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    filter: brightness(0.9) contrast(1.1);
}

.projects-categories-card:hover .projects-categories-image {
    filter: brightness(1) contrast(1.2);
}

.projects-categories-image-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(
        180deg,
        transparent 0%,
        transparent 40%,
        rgba(0, 0, 0, 0.3) 70%,
        rgba(0, 0, 0, 0.8) 100%
    );
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 2;
}

.projects-categories-card:hover .projects-categories-image-overlay {
    background: linear-gradient(
        180deg,
        transparent 0%,
        transparent 30%,
        rgba(0, 0, 0, 0.4) 60%,
        rgba(0, 0, 0, 0.9) 100%
    );
}

.projects-categories-content {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 3;
    padding: 0 24px 24px;
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.projects-categories-content-inner {
    transform: translateY(0);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.projects-categories-card:hover .projects-categories-content-inner {
    transform: translateY(-8px);
}

.projects-categories-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #fff;
    margin: 0 0 8px 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    height: 2.4rem;
    display: flex;
    align-items: center;
    justify-content: center; /* centered on desktop */
}

.projects-categories-card:hover .projects-categories-title {
    font-size: 1.3rem;
    margin-bottom: 8px;
    text-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
    height: 2.4rem;
    display: flex;
    align-items: center;
    justify-content: center; /* keep centered on hover */
}

.projects-categories-description {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.9);
    margin: 0 0 16px 0;
    line-height: 1.4;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    transition-delay: 0.1s;
}

.projects-categories-card:hover .projects-categories-description {
    opacity: 1;
    transform: translateY(0);
}

.projects-categories-link {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #d4a574;
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    transition-delay: 0.2s;
}

.projects-categories-card:hover .projects-categories-link {
    opacity: 1;
    transform: translateY(0);
}

.projects-categories-link:hover {
    color: #fff;
    transform: translateX(4px);
}

.projects-categories-link-icon {
    width: 16px;
    height: 16px;
    transition: transform 0.3s ease;
}

.projects-categories-link:hover .projects-categories-link-icon {
    transform: translateX(4px);
}

.projects-categories-card-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(212, 165, 116, 0.1), rgba(196, 148, 100, 0.1));
    opacity: 0;
    transition: opacity 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 1;
}

.projects-categories-card:hover .projects-categories-card-backdrop {
    opacity: 1;
}

/* Responsive Design for Projects Categories Grid */
@media (max-width: 1024px) {
    .projects-categories-grid {
        height: 500px;
    }
    
    .projects-categories-card {
        height: 500px;
        margin-right: -60px;
    }
    
    .projects-categories-card:hover {
        min-width: 350px;
        margin-right: -30px;
    }
}

@media (max-width: 768px) {
    .projects-categories-grid-section {
        padding: 80px 0 60px;
    }
    
    .projects-categories-grid-header {
        margin-bottom: 60px;
        padding: 0 20px;
    }
    
    .projects-categories-grid {
        height: 400px;
        flex-direction: column;
        gap: 20px;
    }
    
    .projects-categories-card {
        flex: none;
        height: 200px;
        min-width: 100%;
        margin-right: 0;
    }
    
    .projects-categories-card:hover {
        flex: none;
        min-width: 100%;
        margin-right: 0;
    }
    
    .projects-categories-content {
        padding: 0 20px 20px;
    }
    
    .projects-categories-title {
        font-size: 1rem;
    }
    
    .projects-categories-card:hover .projects-categories-title {
        font-size: 1.2rem;
    }
    
    .projects-categories-description {
        font-size: 0.8rem;
    }
    
    .projects-categories-link {
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    .projects-categories-grid-section {
        padding: 60px 0 40px;
    }
    
    .projects-categories-grid-header {
        margin-bottom: 40px;
        padding: 0 16px;
    }
    
    .projects-categories-grid {
        height: 350px;
        padding: 0;
        width: 100%;
    }
    
    .projects-categories-card {
        flex: 1;
        min-width: 130px;
        height: 350px;
        margin-right: -30px;
    }
    
    .projects-categories-card:hover {
        flex: 2;
        min-width: 220px;
        margin-right: -5px;
    }
    
    .projects-categories-content {
        padding: 0 16px 16px;
    }
    
    .projects-categories-title {
        font-size: 0.9rem;
    }
    
    .projects-categories-card:hover .projects-categories-title {
        font-size: 1.1rem;
    }
    
    .projects-categories-description {
        font-size: 0.75rem;
    }
    
    .projects-categories-link {
        font-size: 0.75rem;
    }
}

/* Performance Optimizations for Projects Categories */
.projects-categories-card {
    will-change: transform;
    backface-visibility: hidden;
    perspective: 1000px;
}

.projects-categories-image {
    will-change: transform;
    backface-visibility: hidden;
}

/* Accessibility for Projects Categories */
@media (prefers-reduced-motion: reduce) {
    .projects-categories-card,
    .projects-categories-image,
    .projects-categories-content,
    .projects-categories-link {
        transition: none;
    }
}

/* High DPI Displays for Projects Categories */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
    .projects-categories-image {
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }
}

/* Présentation Section - Full Width */
.presentation-section {
    position: relative;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    padding: 100px 0;
    overflow: hidden;
    margin-top: 0;
    z-index: 1;
    width: 100vw;
    margin-left: calc(-50vw + 50%);
}

.presentation-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, #e0e0e0 50%, transparent 100%);
}

.presentation-container {
    width: 100%;
    padding: 0 80px;
    position: relative;
    z-index: 2;
}

.presentation-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 80px;
    align-items: center;
    min-height: 600px;
    max-width: 1600px;
    margin: 0 auto;
}

.presentation-text {
    padding: 40px;
    background: linear-gradient(135deg, #ffffff, #fafafa);
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(212, 165, 116, 0.1);
}

.presentation-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 30px 0;
    letter-spacing: -0.02em;
    line-height: 1.2;
    position: relative;
}

/* Removed gold underline from presentation title */

.presentation-description {
    font-size: 1.1rem;
    color: #555;
    line-height: 1.7;
    margin: 0 0 25px 0;
    font-weight: 400;
}

.presentation-description:last-of-type {
    margin-bottom: 0;
}

.presentation-image-container {
    position: relative;
    height: 700px;
    width: 100%;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
    background: linear-gradient(135deg, #f8f9fa, #ffffff);
    border: 1px solid rgba(212, 165, 116, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
}

.presentation-image {
    max-width: 100%;
    max-height: 95%;
    object-fit: contain;
    object-position: center;
    transition: all 0.4s ease;
    filter: brightness(1.02) contrast(1.05);
}

.presentation-image-container:hover .presentation-image {
    transform: scale(1.02);
    filter: brightness(1.05) contrast(1.1);
}

.presentation-floating-element {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 80px;
    height: 80px;
    background: url('{{ asset('images/10.png') }}') center/contain no-repeat;
    border-radius: 50%;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    animation: floatEnhanced 6s ease-in-out infinite;
    filter: drop-shadow(0 0 15px rgba(212, 165, 116, 0.2));
    transition: all 0.3s ease;
    z-index: 3;
}

.presentation-floating-element:hover {
    transform: scale(1.05) rotate(3deg);
    filter: drop-shadow(0 0 20px rgba(212, 165, 116, 0.3));
}

/* Responsive Design */
@media (max-width: 1200px) {
    .presentation-container {
        padding: 0 60px;
    }
    
    .presentation-content {
        gap: 60px;
        max-width: 1400px;
    }
    
    .presentation-text {
        padding: 40px;
    }
    
    .presentation-image-container {
        height: 700px;
    }
}

@media (max-width: 768px) {
    .presentation-section {
        padding: 80px 0 60px;
    }
    
    .presentation-container {
        padding: 0 40px;
    }
    
    .presentation-content {
        grid-template-columns: 1fr;
        gap: 50px;
        min-height: auto;
        max-width: 100%;
    }
    
    .presentation-text {
        order: 2;
        padding: 40px;
    }
    
    .presentation-image-container {
        order: 1;
        height: 600px;
    }
    
    .presentation-title {
        font-size: 2.8rem;
        margin-bottom: 30px;
    }
    
    .presentation-description {
        font-size: 1.1rem;
    }
}

@media (max-width: 480px) {
    .presentation-section {
        padding: 60px 0 40px;
    }
    
    .presentation-container {
        padding: 0 20px;
    }
    
    .presentation-content {
        gap: 40px;
    }
    
    .presentation-text {
        padding: 30px;
    }
    
    .presentation-image-container {
        height: 500px;
    }
    
    .presentation-title {
        font-size: 2.2rem;
        margin-bottom: 25px;
    }
    
    .presentation-description {
        font-size: 1rem;
        line-height: 1.7;
    }
    
    .presentation-floating-element {
        width: 70px;
        height: 70px;
        top: 20px;
        right: 20px;
    }
}

.premium-image-container {
    position: relative;
    height: 500px;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
    transform-style: preserve-3d;
    perspective: 1000px;
}

.premium-image-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(212, 165, 116, 0.1) 50%, transparent 70%);
    z-index: 2;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.premium-image-container:hover::before {
    opacity: 1;
}

.premium-main-image {
    width: 100%;
    height: 100%;
    background: url('@if($settings && $settings->presentation_image){{ asset($settings->presentation_image) }}@else{{ asset('images/image3.png') }}@endif') center/cover no-repeat;
    position: relative;
}

.premium-floating-element {
    position: absolute;
    top: 40px;
    right: 40px;
    width: 120px;
    height: 120px;
    background: url('{{ asset('images/10.png') }}') center/contain no-repeat;
    border-radius: 50%;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    animation: float 6s ease-in-out infinite, glow 4s ease-in-out infinite alternate;
    filter: drop-shadow(0 0 20px rgba(212, 165, 116, 0.3));
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.premium-floating-element:hover {
    transform: scale(1.1) rotate(5deg);
    filter: drop-shadow(0 0 30px rgba(212, 165, 116, 0.5));
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

@keyframes glow {
    0% { filter: drop-shadow(0 0 20px rgba(212, 165, 116, 0.3)); }
    100% { filter: drop-shadow(0 0 30px rgba(212, 165, 116, 0.6)); }
}

@keyframes rotate {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 1200px) {
    .premium-about-container {
        padding: 0 40px;
    }
    
    .premium-about-content {
        gap: 60px;
    }
    
    .premium-stats {
        gap: 30px;
    }
}

@media (max-width: 768px) {
    .premium-about-section {
        padding: 80px 0;
    }
    
    .premium-about-container {
        padding: 0 20px;
    }
    
    .premium-about-content {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .premium-about-text {
        padding-right: 0;
        text-align: center;
    }
    
    .premium-stats {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .premium-image-container {
        height: 300px;
    }
    
    .premium-floating-element {
        width: 80px;
        height: 80px;
        top: 20px;
        right: 20px;
    }
}

/* Premium Process Section - God Level CSS */
.premium-process-section {
    background: linear-gradient(135deg, #fafafa 0%, #ffffff 50%, #f8f9fa 100%);
    padding: 140px 0;
    position: relative;
    overflow: hidden;
    box-shadow: inset 0 10px 30px rgba(0, 0, 0, 0.05);
}

.premium-process-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 10% 20%, rgba(212, 165, 116, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 90% 80%, rgba(196, 148, 100, 0.05) 0%, transparent 50%);
    pointer-events: none;
}

.premium-process-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 80px;
    position: relative;
    z-index: 2;
}

.premium-process-header {
    text-align: center;
    margin-bottom: 80px;
}

.premium-process-badge {
    margin-bottom: 24px;
}

.premium-process-badge-text {
    background: linear-gradient(135deg, #820403, #f7c948);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    display: inline-block;
}

.premium-process-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 16px 0;
    line-height: 1.1;
    letter-spacing: -0.02em;
}

.premium-process-subtitle {
    font-size: 1.25rem;
    color: #666;
    margin: 0;
    font-weight: 400;
    line-height: 1.5;
}

.premium-process-timeline {
    position: relative;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 40px;
    align-items: start;
    perspective: 1000px;
}

.premium-process-line {
    position: absolute;
    top: 60px;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #FF0000, #CC0000);
    z-index: 1;
    animation: flowLine 3s ease-in-out infinite;
}

@keyframes flowLine {
    0%, 100% { 
        background: linear-gradient(90deg, #FF0000, #CC0000);
        box-shadow: 0 0 20px rgba(255, 0, 0, 0.3);
    }
    50% { 
        background: linear-gradient(90deg, #CC0000, #FF0000);
        box-shadow: 0 0 30px rgba(255, 0, 0, 0.4);
    }
}

.premium-process-step {
    position: relative;
    z-index: 2;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    transform-style: preserve-3d;
}

.premium-process-step:hover {
    transform: translateY(-10px) rotateX(5deg);
}

.premium-process-icon {
    width: 140px;
    height: 140px;
    background: linear-gradient(135deg, #fff, #f8f9fa);
    border: 4px solid #FF0000;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
    box-shadow: 0 15px 40px rgba(255, 0, 0, 0.3), 0 5px 15px rgba(0, 0, 0, 0.1);
    position: relative;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    transform-style: preserve-3d;
}

.premium-process-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: conic-gradient(from 0deg, transparent, rgba(255, 0, 0, 0.1), transparent);
    animation: rotate 3s linear infinite;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.premium-process-step:hover .premium-process-icon::before {
    opacity: 1;
}

.premium-process-icon:hover {
    transform: translateY(-8px) rotateY(10deg);
    box-shadow: 0 25px 60px rgba(255, 0, 0, 0.4);
    border-color: #CC0000;
    animation: pulseGlow 2s ease-in-out infinite;
}

.premium-process-number {
    position: absolute;
    top: -10px;
    left: -10px;
    background: #FF0000;
    color: #1a1a1a;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
}

.premium-process-icon i {
    font-size: 2rem;
    color: #FF0000;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.premium-process-icon:hover i {
    color: #FF0000;
    transform: scale(1.2);
}

.premium-process-content {
    flex: 1;
}

.premium-process-step-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 12px 0;
    line-height: 1.2;
}

.premium-process-step-description {
    font-size: 1rem;
    color: #666;
    line-height: 1.5;
    margin: 0 0 20px 0;
}

.premium-process-features {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 16px;
}

.premium-process-feature {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
    color: #555;
    transition: all 0.3s ease;
}

.premium-process-feature:hover {
    color: #FF0000;
    transform: translateX(5px);
}

.premium-process-feature i {
    color: #28a745;
    font-size: 0.8rem;
    transition: all 0.3s ease;
}

.premium-process-feature:hover i {
    color: #FF0000;
    transform: scale(1.2);
}

.premium-process-icon-glow {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle, rgba(255, 0, 0, 0.2) 0%, transparent 70%);
    border-radius: 50%;
    opacity: 0;
    transition: all 0.3s ease;
    pointer-events: none;
}

.premium-process-step:hover .premium-process-icon-glow {
    opacity: 1;
    animation: pulseGlow 2s ease-in-out infinite;
}

/* Premium Process CTA Section */
.premium-process-cta {
    margin-top: 80px;
    text-align: center;
    padding: 60px 40px;
    background: linear-gradient(135deg, rgba(255, 0, 0, 0.05) 0%, rgba(204, 0, 0, 0.05) 100%);
    border-radius: 24px;
    border: 2px solid rgba(255, 0, 0, 0.1);
    position: relative;
    overflow: hidden;
}

.premium-process-cta::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(212, 165, 116, 0.05) 50%, transparent 70%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.premium-process-cta:hover::before {
    opacity: 1;
}

.premium-process-cta-content {
    position: relative;
    z-index: 2;
}

.premium-process-cta-content h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 16px 0;
    line-height: 1.2;
}

.premium-process-cta-content p {
    font-size: 1.1rem;
    color: #666;
    margin: 0 0 32px 0;
    line-height: 1.5;
}

.premium-process-cta-btn {
    background: linear-gradient(135deg, #f7c948, #820403);
    color: white;
    padding: 16px 32px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
    border: 2px solid #d4a574;
    display: inline-block;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 30px rgba(212, 165, 116, 0.3);
    position: relative;
    overflow: hidden;
}

.premium-process-cta-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.premium-process-cta-btn:hover::before {
    left: 100%;
}

.premium-process-cta-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(212, 165, 116, 0.4);
    color: white;
    text-decoration: none;
}

/* Responsive Design for Process Section */
@media (max-width: 1200px) {
    .premium-process-container {
        padding: 0 40px;
    }
    
    .premium-process-timeline {
        gap: 30px;
    }
    
    .premium-process-cta {
        margin-top: 60px;
        padding: 40px 30px;
    }
    
    .premium-process-cta-content h3 {
        font-size: 1.8rem;
    }
}

@media (max-width: 768px) {
    .premium-process-section {
        padding: 80px 0;
    }
    
    .premium-process-container {
        padding: 0 20px;
    }
    
    .premium-process-timeline {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .premium-process-line {
        display: none;
    }
    
    .premium-process-icon {
        width: 100px;
        height: 100px;
    }
    
    .premium-process-icon i {
        font-size: 1.5rem;
    }
}

/* Desktop alignment tweaks for Processus d'excellence */
@media (min-width: 1025px) {
    .premium-process-step {
        text-align: left;
        align-items: flex-start;
    }
    .premium-process-content {
        text-align: left;
        align-items: flex-start;
    }
    .premium-process-step-title,
    .premium-process-step-description {
        text-align: left;
    }
    .premium-process-features {
        align-items: flex-start;
    }
}

/* Premium Services Section - God Level CSS */
.premium-services-section {
    background: linear-gradient(135deg, #f8f5f0 0%, #fff 50%, #f8f9fa 100%);
    padding: 140px 0;
    position: relative;
    overflow: hidden;
    box-shadow: inset 0 -10px 30px rgba(0, 0, 0, 0.05);
}

.premium-services-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 30% 70%, rgba(212, 165, 116, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 70% 30%, rgba(196, 148, 100, 0.03) 0%, transparent 50%);
    pointer-events: none;
}

.premium-services-container {
    max-width: 100%;
    margin: 0 auto;
    padding: 0 80px;
    position: relative;
    z-index: 2;
}

.premium-services-header {
    text-align: center;
    margin-bottom: 80px;
}

.premium-services-badge {
    margin-bottom: 24px;
}

.premium-services-badge-text {
    background: linear-gradient(135deg, #d4a574, #c49464);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    display: inline-block;
}

.premium-services-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 16px 0;
    line-height: 1.1;
    letter-spacing: -0.02em;
}

.premium-services-subtitle {
    font-size: 1.25rem;
    color: #666;
    margin: 0;
    font-weight: 400;
    line-height: 1.5;
}

.premium-services-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
    width: 100%;
}

.premium-service-card {
    background: linear-gradient(135deg, #fff, #fafafa);
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1), 0 5px 20px rgba(212, 165, 116, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    transform-style: preserve-3d;
    perspective: 1000px;
    cursor: pointer;
    border: 1px solid rgba(212, 165, 116, 0.1);
    min-width: 280px;
}

.premium-service-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, transparent 0%, rgba(212, 165, 116, 0.05) 50%, transparent 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}

.premium-service-card:hover::before {
    opacity: 1;
}

.premium-service-card:hover {
    transform: translateY(-15px) rotateX(3deg) scale(1.02);
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15), 0 15px 40px rgba(212, 165, 116, 0.2);
    border-color: rgba(212, 165, 116, 0.3);
}

.premium-service-image {
    position: relative;
    height: 250px;
    overflow: hidden;
    z-index: 2;
    border-radius: 16px 16px 0 0;
}

.premium-service-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(196, 148, 100, 0.8), rgba(212, 165, 116, 0.8));
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 3;
    display: flex;
    align-items: center;
    justify-content: center;
}

.premium-service-overlay-content {
    color: white;
    text-align: center;
    transform: translateY(20px);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.premium-service-overlay-content i {
    font-size: 2rem;
    margin-bottom: 8px;
    display: block;
}

.premium-service-overlay-content span {
    font-size: 1.1rem;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.premium-service-card:hover .premium-service-overlay {
    opacity: 1;
}

.premium-service-card:hover .premium-service-overlay-content {
    transform: translateY(0);
}

.premium-service-image::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(212, 165, 116, 0.1) 50%, transparent 70%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}

.premium-service-card:hover .premium-service-image::after {
    opacity: 1;
}

.premium-service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.premium-service-card:hover .premium-service-image img {
    transform: scale(1.05);
}

.premium-service-icon {
    position: absolute;
    bottom: 16px;
    right: 16px;
    width: 50px;
    height: 50px;
    background: rgba(196, 148, 100, 0.9);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.premium-service-icon i {
    color: white;
    font-size: 1.2rem;
}

.premium-service-content {
    padding: 32px;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.premium-service-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
}

.premium-service-badge {
    background: linear-gradient(135deg, #d4a574, #c49464);
    color: white;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.premium-service-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 16px 0;
    line-height: 1.2;
}

.premium-service-description {
    font-size: 1rem;
    color: #666;
    line-height: 1.6;
    margin: 0 0 24px 0;
}

.premium-service-features {
    list-style: none;
    padding: 0;
    margin: 0 0 24px 0;
    flex: 1;
}

.premium-service-features li {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
    font-size: 0.95rem;
    color: #555;
    transition: all 0.3s ease;
}

.premium-service-features li:hover {
    color: #c49464;
    transform: translateX(5px);
}

.premium-service-features li i {
    color: #28a745;
    margin-right: 12px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.premium-service-features li:hover i {
    color: #d4a574;
    transform: scale(1.2);
}

.premium-service-footer {
    margin-top: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
}

.premium-service-btn {
    background: linear-gradient(135deg, #1a1a1a, #333);
    color: #d4a574;
    padding: 12px 20px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    border: 2px solid #d4a574;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 10;
    white-space: nowrap;
}

.premium-service-btn i {
    transition: transform 0.3s ease;
}

.premium-service-btn:hover i {
    transform: translateX(4px);
}

.premium-service-btn:hover {
    background: linear-gradient(135deg, #d4a574, #c49464);
    color: white;
    transform: translateY(-2px);
    text-decoration: none;
}

.premium-service-stats {
    display: flex;
    gap: 16px;
}

.premium-service-stat {
    text-align: center;
    min-width: 60px;
}

.premium-service-stat .stat-number {
    display: block;
    font-size: 1.1rem;
    font-weight: 700;
    color: #d4a574;
    line-height: 1;
}

.premium-service-stat .stat-label {
    display: block;
    font-size: 0.7rem;
    color: #888;
    font-weight: 500;
    margin-top: 2px;
}

/* Premium Services CTA Section */
.premium-services-cta {
    margin-top: 80px;
    text-align: center;
    padding: 60px 40px;
    background: linear-gradient(135deg, rgba(212, 165, 116, 0.05) 0%, rgba(196, 148, 100, 0.05) 100%);
    border-radius: 24px;
    border: 2px solid rgba(212, 165, 116, 0.1);
    position: relative;
    overflow: hidden;
}

.premium-services-cta::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(212, 165, 116, 0.05) 50%, transparent 70%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.premium-services-cta:hover::before {
    opacity: 1;
}

.premium-services-cta-content {
    position: relative;
    z-index: 2;
}

.premium-services-cta-content h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 16px 0;
    line-height: 1.2;
}

.premium-services-cta-content p {
    font-size: 1.1rem;
    color: #666;
    margin: 0 0 32px 0;
    line-height: 1.5;
}

.premium-services-cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.premium-services-cta-btn {
    padding: 16px 32px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1rem;
    letter-spacing: 0.5px;
    border: 2px solid transparent;
    display: inline-block;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.premium-services-cta-btn.primary {
    background: linear-gradient(135deg, #d4a574, #c49464);
    color: white;
    border-color: #d4a574;
    box-shadow: 0 8px 30px rgba(212, 165, 116, 0.3);
}

.premium-services-cta-btn.primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(212, 165, 116, 0.4);
    color: white;
    text-decoration: none;
}

.premium-services-cta-btn.secondary {
    background: transparent;
    color: #c49464;
    border-color: #c49464;
    box-shadow: 0 8px 30px rgba(196, 148, 100, 0.1);
}

.premium-services-cta-btn.secondary:hover {
    background: #c49464;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(196, 148, 100, 0.2);
    text-decoration: none;
}

/* Responsive Design for Services Section */
@media (max-width: 1200px) {
    .premium-services-container {
        padding: 0 30px;
    }
    
    .premium-services-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }
}

@media (max-width: 992px) {
    .premium-services-container {
        padding: 0 20px;
    }
    
    .premium-services-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    
    .premium-service-content {
        padding: 20px;
    }
}

@media (max-width: 768px) {
    .premium-services-section {
        padding: 80px 0;
    }
    
    .premium-services-container {
        padding: 0 15px;
    }
    
    .premium-services-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .premium-service-content {
        padding: 24px;
    }
    
    .premium-service-footer {
        flex-direction: column;
        gap: 16px;
        align-items: stretch;
    }
    
    .premium-service-stats {
        justify-content: center;
    }
    
    .premium-services-cta {
        margin-top: 60px;
        padding: 40px 20px;
    }
    
    .premium-services-cta-content h3 {
        font-size: 1.8rem;
    }
    
    .premium-services-cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .premium-services-cta-btn {
        width: 100%;
        max-width: 300px;
        text-align: center;
    }
}

/* Premium Certificates Section - God Level CSS */
.premium-certificates-section {
    background: linear-gradient(135deg, #fffbe6 0%, #fff 50%, #f8f9fa 100%);
    padding: 140px 0;
    position: relative;
    overflow: hidden;
    box-shadow: inset 0 10px 30px rgba(212, 165, 116, 0.05);
}

.premium-certificates-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(212, 165, 116, 0.04) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(196, 148, 100, 0.04) 0%, transparent 50%);
    pointer-events: none;
}

.premium-certificates-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 80px;
}

.premium-certificates-header {
    text-align: center;
    margin-bottom: 80px;
}

.premium-certificates-badge {
    margin-bottom: 24px;
}

.premium-certificates-badge-text {
    background: linear-gradient(135deg, #c49464, #d4a574);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    display: inline-block;
}

.premium-certificates-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 16px 0;
    line-height: 1.1;
    letter-spacing: -0.02em;
}

.premium-certificates-subtitle {
    font-size: 1.25rem;
    color: #666;
    margin: 0;
    font-weight: 400;
    line-height: 1.5;
}

.premium-certificates-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 40px;
    margin-bottom: 60px;
}

.premium-certificate-card {
    background: linear-gradient(135deg, #fff, #fffbe6);
    border: 3px solid #d4a574;
    border-radius: 24px;
    padding: 50px 40px;
    box-shadow: 0 20px 60px rgba(212, 165, 116, 0.15), 0 10px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    transform-style: preserve-3d;
    perspective: 1000px;
}

.premium-certificate-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, transparent 0%, rgba(212, 165, 116, 0.05) 50%, transparent 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}

.premium-certificate-card:hover::before {
    opacity: 1;
}

.premium-certificate-card:hover {
    transform: translateY(-15px) rotateX(3deg) scale(1.02);
    box-shadow: 0 30px 80px rgba(212, 165, 116, 0.25), 0 15px 40px rgba(196, 148, 100, 0.1);
    border-color: #c49464;
    animation: pulseGlow 3s ease-in-out infinite;
}

.premium-certificate-badge {
    position: absolute;
    top: 20px;
    left: 20px;
    background: linear-gradient(135deg, #d4a574, #fffbe6);
    color: #c49464;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 700;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 20px rgba(212, 165, 116, 0.3);
    z-index: 2;
}

.premium-certificate-image {
    width: 220px;
    height: 160px;
    background: linear-gradient(135deg, #fffbe6, #fff);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
    box-shadow: 0 12px 40px rgba(212, 165, 116, 0.2);
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 2px solid #eee;
    position: relative;
    overflow: hidden;
}

.premium-certificate-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(196, 148, 100, 0.9), rgba(212, 165, 116, 0.9));
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
}

.premium-certificate-overlay-content {
    color: white;
    text-align: center;
    transform: translateY(20px);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.premium-certificate-overlay-content i {
    font-size: 2rem;
    margin-bottom: 8px;
    display: block;
}

.premium-certificate-overlay-content span {
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.premium-certificate-card:hover .premium-certificate-overlay {
    opacity: 1;
}

.premium-certificate-card:hover .premium-certificate-overlay-content {
    transform: translateY(0);
}

.premium-certificate-image:hover {
    transform: scale(1.05);
    box-shadow: 0 12px 40px rgba(212, 165, 116, 0.3);
}

.premium-certificate-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 12px;
}

.premium-certificate-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.premium-certificate-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 16px 0;
    line-height: 1.2;
}

.premium-certificate-description {
    font-size: 1rem;
    color: #666;
    line-height: 1.6;
    margin: 0 0 20px 0;
}

.premium-certificate-features {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 20px;
}

.premium-certificate-feature {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.9rem;
    color: #555;
    transition: all 0.3s ease;
}

.premium-certificate-feature:hover {
    color: #c49464;
    transform: translateX(5px);
}

.premium-certificate-feature i {
    color: #28a745;
    font-size: 0.8rem;
    transition: all 0.3s ease;
}

.premium-certificate-feature:hover i {
    color: #d4a574;
    transform: scale(1.2);
}

.premium-certificate-meta {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding-top: 16px;
    border-top: 1px solid rgba(212, 165, 116, 0.2);
}

.premium-certificate-meta-item {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    font-size: 0.9rem;
    color: #888;
}

.premium-certificate-meta-item i {
    color: #d4a574;
    font-size: 0.8rem;
}

.premium-certificates-cta {
    text-align: center;
    margin-top: 60px;
    padding: 40px;
    background: linear-gradient(135deg, rgba(212, 165, 116, 0.08) 0%, rgba(232, 197, 160, 0.08) 100%);
    border-radius: 20px;
    border: 2px solid rgba(212, 165, 116, 0.2);
    position: relative;
    overflow: hidden;
}

.premium-certificates-cta::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(212, 165, 116, 0.05) 50%, transparent 70%);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.premium-certificates-cta:hover::before {
    opacity: 1;
}

.premium-certificates-btn {
    background: linear-gradient(135deg, #d4a574, #e8c5a0);
    color: #5d4037;
    padding: 16px 32px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
    border: 2px solid #d4a574;
    display: inline-block;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 8px 30px rgba(212, 165, 116, 0.3);
    position: relative;
    overflow: hidden;
}

.premium-certificates-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.premium-certificates-btn:hover::before {
    left: 100%;
}

.premium-certificates-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 40px rgba(212, 165, 116, 0.4);
    color: #3e2723;
    text-decoration: none;
    background: linear-gradient(135deg, #c49464, #dbb894);
}

/* Left Certificate Card - YouTube Red Theme */
.premium-certificate-card:nth-child(1) {
    border: 3px solid #FF0000;
    box-shadow: 0 20px 60px rgba(255, 0, 0, 0.15), 0 10px 30px rgba(0, 0, 0, 0.1);
}

.premium-certificate-card:nth-child(1) .premium-certificate-badge {
    background: linear-gradient(135deg, #FF0000, #CC0000);
}

.premium-certificate-card:nth-child(1) .premium-certificate-feature:hover i {
    color: #FF0000;
}

.premium-certificate-card:nth-child(1) .premium-certificate-meta-item i {
    color: #FF0000;
}

/* Right Certificate Card - YouTube Red Theme */
.premium-certificate-card:nth-child(2) {
    border: 3px solid #FF0000;
    box-shadow: 0 20px 60px rgba(255, 0, 0, 0.15), 0 10px 30px rgba(0, 0, 0, 0.1);
}

.premium-certificate-card:nth-child(2) .premium-certificate-badge {
    background: linear-gradient(135deg, #FF0000, #CC0000);
    color: white;
}

.premium-certificate-card:nth-child(2) .premium-certificate-feature:hover i {
    color: #FF0000;
}

.premium-certificate-card:nth-child(2) .premium-certificate-meta-item i {
    color: #FF0000;
}

/* Card Hover Effects - YouTube Red Theme for Left Card */
.premium-certificate-card:nth-child(1):hover {
    transform: translateY(-15px) rotateX(3deg) scale(1.02);
    box-shadow: 0 30px 80px rgba(255, 0, 0, 0.25), 0 15px 40px rgba(0, 0, 0, 0.15);
}

.premium-certificate-card:nth-child(1)::before {
    background: linear-gradient(135deg, rgba(255, 0, 0, 0.05), rgba(204, 0, 0, 0.05));
}

/* Card Hover Effects - YouTube Red Theme for Right Card */
.premium-certificate-card:nth-child(2):hover {
    transform: translateY(-15px) rotateX(3deg) scale(1.02);
    box-shadow: 0 30px 80px rgba(255, 0, 0, 0.25), 0 15px 40px rgba(0, 0, 0, 0.15);
}

.premium-certificate-card:nth-child(2)::before {
    background: linear-gradient(135deg, rgba(255, 0, 0, 0.05), rgba(204, 0, 0, 0.05));
}

/* Responsive Design for Certificates Section */
@media (max-width: 1200px) {
    .premium-certificates-container {
        padding: 0 40px;
    }
    
    .premium-certificates-grid {
        gap: 30px;
    }
}

@media (max-width: 768px) {
    .premium-certificates-section {
        padding: 80px 0;
    }
    
    .premium-certificates-container {
        padding: 0 20px;
    }
    
    .premium-certificates-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .premium-certificate-card {
        padding: 30px 20px;
    }
    
    .premium-certificate-image {
        width: 160px;
        height: 120px;
    }
}


/* Premium Contact Section - God Level CSS */
.premium-contact-section {
    background: linear-gradient(135deg, #f8f5f0 0%, #fff 50%, #fafafa 100%);
    padding: 140px 0;
    position: relative;
    overflow: hidden;
    box-shadow: inset 0 10px 30px rgba(0, 0, 0, 0.05);
}

.premium-contact-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 25% 75%, rgba(212, 165, 116, 0.03) 0%, transparent 50%),
        radial-gradient(circle at 75% 25%, rgba(196, 148, 100, 0.03) 0%, transparent 50%);
    pointer-events: none;
}

.premium-contact-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 80px;
}

.premium-contact-header {
    text-align: center;
    margin-bottom: 80px;
}

.premium-contact-badge {
    margin-bottom: 24px;
}

.premium-contact-badge-text {
    background: linear-gradient(135deg, #d4a574, #c49464);
    color: white;
    padding: 12px 24px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    display: inline-block;
}

.premium-contact-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    color: #1a1a1a;
    margin: 0 0 16px 0;
    line-height: 1.1;
    letter-spacing: -0.02em;
}

.premium-contact-subtitle {
    font-size: 1.25rem;
    color: #666;
    margin: 0;
    font-weight: 400;
    line-height: 1.5;
}

.premium-contact-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 40px;
}

.premium-contact-card {
    background: linear-gradient(135deg, #fff, #fafafa);
    border-radius: 24px;
    padding: 50px 40px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1), 0 10px 30px rgba(212, 165, 116, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    text-align: center;
    position: relative;
    overflow: hidden;
    transform-style: preserve-3d;
    perspective: 1000px;
    border: 1px solid rgba(212, 165, 116, 0.1);
}

.premium-contact-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, transparent 0%, rgba(212, 165, 116, 0.05) 50%, transparent 100%);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
    pointer-events: none;
}

.premium-contact-card:hover::before {
    opacity: 1;
}

.premium-contact-card:hover {
    transform: translateY(-15px) rotateX(3deg) scale(1.02);
    box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15), 0 15px 40px rgba(212, 165, 116, 0.2);
    border-color: rgba(212, 165, 116, 0.3);
}

.premium-contact-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, #d4a574, #c49464);
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 24px;
    box-shadow: 0 12px 40px rgba(212, 165, 116, 0.3);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.premium-contact-icon-glow {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(212, 165, 116, 0.3));
    opacity: 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 24px;
}

.premium-contact-card:hover .premium-contact-icon-glow {
    opacity: 1;
    animation: pulseGlow 2s infinite;
}

.premium-contact-card:hover .premium-contact-icon {
    transform: scale(1.1);
    box-shadow: 0 12px 40px rgba(212, 165, 116, 0.4);
}

.premium-contact-icon i {
    color: white;
    font-size: 1.8rem;
}

.premium-contact-card-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0 0 16px 0;
    line-height: 1.2;
}

.premium-contact-card-text {
    font-size: 1.1rem;
    color: #555;
    line-height: 1.6;
    margin: 0 0 20px 0;
}

.premium-contact-card-text a {
    color: #c49464;
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.premium-contact-card-text a:hover {
    color: #d4a574;
}

.premium-contact-card-subtext {
    font-size: 0.9rem;
    color: #888;
    display: block;
    margin-top: 8px;
}

.premium-contact-features {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin: 16px 0;
    padding: 16px 0;
    border-top: 1px solid rgba(212, 165, 116, 0.1);
    border-bottom: 1px solid rgba(212, 165, 116, 0.1);
}

.premium-contact-feature {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.85rem;
    color: #666;
    transition: all 0.3s ease;
}

.premium-contact-feature:hover {
    color: #c49464;
    transform: translateX(5px);
}

.premium-contact-feature i {
    color: #28a745;
    font-size: 0.8rem;
    transition: all 0.3s ease;
}

.premium-contact-feature:hover i {
    color: #d4a574;
    transform: scale(1.2);
}

.premium-contact-card-btn {
    background: linear-gradient(135deg, #1a1a1a, #333);
    color: #d4a574;
    padding: 14px 28px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    letter-spacing: 0.5px;
    border: 2px solid #d4a574;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 10;
    cursor: pointer;
    overflow: hidden;
}

.premium-contact-card-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.premium-contact-card-btn:hover::before {
    left: 100%;
}

.premium-contact-card-btn:hover {
    background: linear-gradient(135deg, #d4a574, #c49464);
    color: white;
    transform: translateY(-2px);
    text-decoration: none;
}

/* Responsive Design for Contact Section */
@media (max-width: 1200px) {
    .premium-contact-container {
        padding: 0 40px;
    }
    
    .premium-contact-grid {
        gap: 30px;
    }
}

@media (max-width: 768px) {
    .premium-contact-section {
        padding: 80px 0;
    }
    
    .premium-contact-container {
        padding: 0 20px;
    }
    
    .premium-contact-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .premium-contact-card {
        padding: 30px 20px;
    }
}

/* Premium CTA Section - God Level CSS */
.premium-cta-section {
    position: relative;
    padding: 140px 0;
    overflow: hidden;
    box-shadow: inset 0 -10px 30px rgba(0, 0, 0, 0.1);
}

.premium-cta-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background:
        radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.12) 0%, transparent 55%),
        radial-gradient(circle at 80% 20%, rgba(212, 165, 116, 0.18) 0%, transparent 55%);
    z-index: 2;
    pointer-events: none;
}

.premium-cta-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: linear-gradient(135deg, rgba(212, 165, 116, 0.9), rgba(245, 222, 179, 0.9));
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    z-index: 1;
}

/* Left decorative image for CTA (desktop only) */
.premium-cta-left-image {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    width: 42%;
    background: url('{{ asset('images/hethahou.png') }}') left center / contain no-repeat;
    z-index: 2; /* above gradient, below content */
    pointer-events: none;
}

.premium-cta-container {
    position: relative;
    z-index: 3;
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 80px;
}

/* Bottom-right slogan (desktop) */
.premium-cta-slogan {
    position: absolute;
    right: 220px;
    bottom: 28px;
    z-index: 2; /* under content overlay effects but above background */
    color: #fff;
    font-style: italic;
    font-weight: 900;
    letter-spacing: 5px;
    font-size: clamp(26px, 3.8vw, 56px);
    text-shadow: 0 3px 10px rgba(0,0,0,0.35);
    pointer-events: none;
    user-select: none;
    opacity: 0.95;
    transform: skewX(-8deg);
}

/* Subtle spacing/underline accent for senior style */
.premium-cta-slogan::after {
    content: '';
    display: block;
    margin-top: 10px;
    margin-left: auto;
    width: 100px;
    height: 3px;
    background: linear-gradient(90deg, rgba(255,255,255,0.9), rgba(255,255,255,0.4));
    border-radius: 3px;
}

@media (max-width: 768px) {
    .premium-cta-slogan {
        right: 16px;
        bottom: 16px;
        letter-spacing: 2px;
        font-size: 14px;
        opacity: .9;
    }
    .premium-cta-slogan::after { width: 48px; height: 2px; margin-top: 6px; }
}

.premium-cta-content {
    text-align: center;
}

.premium-cta-title {
    font-size: clamp(2.5rem, 6vw, 4rem);
    font-weight: 900;
    color: white;
    margin: 0 0 32px 0;
    line-height: 1.1;
    letter-spacing: 1px;
    text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    animation: titleGlow 3s ease-in-out infinite;
}

@keyframes titleGlow {
    0%, 100% { 
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        filter: brightness(1);
    }
    50% { 
        text-shadow: 0 4px 30px rgba(212, 165, 116, 0.4);
        filter: brightness(1.1);
    }
}

@keyframes floatEnhanced {
    0%, 100% { 
        transform: translateY(0px) rotate(0deg);
        filter: drop-shadow(0 0 20px rgba(212, 165, 116, 0.3));
    }
    50% { 
        transform: translateY(-20px) rotate(5deg);
        filter: drop-shadow(0 0 30px rgba(212, 165, 116, 0.6));
    }
}

@keyframes pulseGlow {
    0%, 100% { 
        box-shadow: 0 15px 40px rgba(212, 165, 116, 0.3);
        transform: scale(1);
    }
    50% { 
        box-shadow: 0 20px 50px rgba(212, 165, 116, 0.5);
        transform: scale(1.05);
    }
}

@keyframes slideInUp {
    from {
        opacity: 0;
        transform: translateY(50px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.premium-cta-subtitle {
    font-size: 1.4rem;
    color: white;
    line-height: 1.6;
    margin: 0 0 48px 0;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.premium-cta-buttons {
    display: flex;
    gap: 24px;
    justify-content: center;
    flex-wrap: wrap;
}

.premium-cta-btn {
    padding: 18px 36px;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.1rem;
    letter-spacing: 0.5px;
    border: 3px solid transparent;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.premium-cta-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.premium-cta-btn:hover::before {
    left: 100%;
}

.premium-cta-btn.primary {
    background: linear-gradient(135deg, #111, #2a2a2a);
    color: #fff;
    border-color: #fff;
    box-shadow: 0 10px 34px rgba(0, 0, 0, 0.35);
}

.premium-cta-btn.primary:hover {
    background: linear-gradient(135deg, #fff, #eaeaea);
    color: #1a1a1a;
    transform: translateY(-3px);
    box-shadow: 0 14px 46px rgba(0, 0, 0, 0.28);
    text-decoration: none;
}

.premium-cta-btn.secondary {
    background: transparent;
    color: white;
    border-color: white;
    box-shadow: 0 8px 30px rgba(255, 255, 255, 0.2);
}

.premium-cta-btn.secondary:hover {
    background: white;
    color: #c49464;
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(255, 255, 255, 0.3);
    text-decoration: none;
}

/* Responsive Design for CTA Section */
@media (max-width: 1200px) {
    .premium-cta-container {
        padding: 0 40px;
    }
}

@media (max-width: 768px) {
    .premium-cta-section {
        padding: 80px 0;
    }
    
    .premium-cta-container {
        padding: 0 20px;
    }
    
    /* Hide left image on small screens */
    .premium-cta-left-image { display: none; }
    
    .premium-cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .premium-cta-btn {
        width: 100%;
        max-width: 300px;
        text-align: center;
    }
}
</style>

<!-- Présentation Section -->
<section class="presentation-section" id="presentation">
    <div class="presentation-container">
        <div class="presentation-content">
            <div class="presentation-text">
                <h2 class="presentation-title">{{ __('frontend.presentation') }}</h2>
                <p class="presentation-description">
                    {{ __('frontend.presentation_description_1') }}
                </p>
                <p class="presentation-description">
                    {{ __('frontend.presentation_description_2') }}
                </p>
                <p class="presentation-description">
                    {{ __('frontend.presentation_description_3') }}
                </p>
            </div>
            <div class="presentation-image-container">
                @if($settings && $settings->presentation_image)
                    <img src="{{ asset($settings->presentation_image) }}" alt="SOTUMA {{ __('frontend.presentation') }}" class="presentation-image">
                @else
                    <img src="{{ asset('images/image3.png') }}" alt="SOTUMA {{ __('frontend.presentation') }}" class="presentation-image">
                @endif
                <div class="presentation-floating-element"></div>
            </div>
        </div>
    </div>
</section>

<!-- Premium Projects Categories Grid Section -->
<style>
/* Desktop-only: hide descriptions in Projects and Products grids on the homepage */
@media (min-width: 1025px) {
    .projects-categories-grid .projects-categories-description,
    .offer-grid .offer-description {
        display: none !important;
    }
}
</style>
<section class="projects-categories-grid-section" id="projets">
    <div class="projects-categories-grid-header">
                        <h2 class="projects-categories-grid-title">Nos Projets</h2>
                        <p class="projects-categories-grid-subtitle">{{ __('frontend.discover_realizations') }}</p>
    </div>
    
    <div class="projects-categories-grid">
        @foreach($project_categories as $category)
        <div class="projects-categories-card" data-category="{{ $category->name }}">
            <div class="projects-categories-card-inner">
                <div class="projects-categories-image-container">
                    <a href="{{ route('project-categories.show', $category->slug) }}" class="projects-categories-image-link">
                        <img src="{{ $category->image ? asset($category->image) : asset('images/no-image.png') }}" 
                             alt="{{ $category->name }}" 
                             class="projects-categories-image"
                             loading="lazy">
                        <div class="projects-categories-image-overlay"></div>
                    </a>
                </div>
                <div class="projects-categories-content">
                    <div class="projects-categories-content-inner">
                        <h3 class="projects-categories-title">{{ $category->name }}</h3>
                        <div class="projects-categories-description">{{ $category->description ?? 'Projets professionnels en aluminium' }}</div>
                        <a href="{{ route('project-categories.show', $category->slug) }}" 
                           class="projects-categories-link">
                            <span>VOIR PROJETS</span>
                            <svg class="projects-categories-link-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="projects-categories-card-backdrop"></div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Premium Process Section - God Level Design -->
<section class="premium-process-section">
    <div class="premium-process-container">
        <div class="premium-process-header">
            <h2 class="premium-process-title">{{ __('frontend.excellence_process') }}</h2>
            <p class="premium-process-subtitle">{{ __('frontend.conception_to_installation') }}</p>
        </div>
        
        <div class="premium-process-timeline">
            <div class="premium-process-line"></div>
            
            <div class="premium-process-step">
                <div class="premium-process-icon">
                    <div class="premium-process-number">1</div>
                    <i class="fas fa-pencil-ruler"></i>
                    <div class="premium-process-icon-glow"></div>
                </div>
                <div class="premium-process-content">
                    <h3 class="premium-process-step-title">{{ __('frontend.3d_design') }}</h3>
                    <p class="premium-process-step-description">{{ __('frontend.precise_visualization') }}</p>
                    <div class="premium-process-features">
                        <div class="premium-process-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.advanced_3d_modeling') }}</span>
                        </div>
                        <div class="premium-process-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.photorealistic_rendering') }}</span>
                        </div>
                        <div class="premium-process-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.technical_validation') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="premium-process-step">
                <div class="premium-process-icon">
                    <div class="premium-process-number">2</div>
                    <i class="fas fa-cogs"></i>
                    <div class="premium-process-icon-glow"></div>
                </div>
                <div class="premium-process-content">
                    <h3 class="premium-process-step-title">{{ __('frontend.manufacturing') }}</h3>
                    <p class="premium-process-step-description">{{ __('frontend.production_premium_materials') }}</p>
                    <div class="premium-process-features">
                        <div class="premium-process-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.premium_aluminum') }}</span>
                        </div>
                        <div class="premium-process-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.cnc_technologies') }}</span>
                        </div>
                        <div class="premium-process-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.strict_quality_control') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="premium-process-step">
                <div class="premium-process-icon">
                    <div class="premium-process-number">3</div>
                    <i class="fas fa-tools"></i>
                    <div class="premium-process-icon-glow"></div>
                </div>
                <div class="premium-process-content">
                    <h3 class="premium-process-step-title">{{ __('frontend.installation') }}</h3>
                    <p class="premium-process-step-description">{{ __('frontend.professional_installation') }}</p>
                    <div class="premium-process-features">
                        <div class="premium-process-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.certified_team') }}</span>
                        </div>
                        <div class="premium-process-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.precise_installation') }}</span>
                        </div>
                        <div class="premium-process-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.impeccable_finishes') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="premium-process-step">
                <div class="premium-process-icon">
                    <div class="premium-process-number">4</div>
                    <i class="fas fa-shield-alt"></i>
                    <div class="premium-process-icon-glow"></div>
                </div>
                <div class="premium-process-content">
                    <h3 class="premium-process-step-title">{{ __('frontend.warranty_10_years') }}</h3>
                    <p class="premium-process-step-description">{{ __('frontend.quality_assurance_installation') }}</p>
                    <div class="premium-process-features">
                        <div class="premium-process-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.decennial_warranty') }}</span>
                        </div>
                        <div class="premium-process-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.after_sales_service') }}</span>
                        </div>
                        <div class="premium-process-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.technical_support') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Premium Aluprof-Style Offer Grid Section -->
<section class="offer-grid-section" id="produits">
    <div class="offer-grid-header">
        <h2 class="offer-grid-title">Nos Produits</h2>
                        <p class="offer-grid-subtitle">{{ __('frontend.discover_aluminum_solutions') }}</p>
    </div>
    
    <div class="offer-grid">
        @foreach($category_lists as $category)
        <div class="offer-card" data-category="{{ $category->title }}">
            <div class="offer-card-inner">
                <div class="offer-image-container">
                    <a href="{{ route('categories.show', $category->slug ?? Str::slug($category->title)) }}" class="offer-image-link">
                        <img src="{{ $category->image ? asset($category->image) : asset('images/no-image.png') }}" 
                             alt="{{ $category->title }}" 
                             class="offer-image"
                             loading="lazy">
                        <div class="offer-image-overlay"></div>
                    </a>
                </div>
                <div class="offer-content">
                    <div class="offer-content-inner">
                        <h3 class="offer-title">{{ $category->title }}</h3>
                        <div class="offer-description">{{ $category->description ?? __('frontend.professional_aluminum_solutions') }}</div>
                        <a href="{{ route('categories.show', $category->slug ?? Str::slug($category->title)) }}" 
                           class="offer-link">
                            <span>{{ __('frontend.see_more') }}</span>
                            <svg class="offer-link-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="offer-card-backdrop"></div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Premium Partners Section - Big Grid with Images Only -->
<section class="premium-partners-section" id="partenaires">
    <div class="premium-partners-container">
        <div class="premium-partners-header">
            <h2 class="premium-partners-title">Nos Partenaires</h2>
        </div>
        
        <div class="premium-partners-grid">
            <!-- Partner 1 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par1.png') }}" 
                         alt="Partenaire 1" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 2 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par2.png') }}" 
                         alt="Partenaire 2" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 3 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par3.jpg') }}" 
                         alt="Partenaire 3" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 4 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par4.jpg') }}" 
                         alt="Partenaire 4" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 5 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par5.png') }}" 
                         alt="Partenaire 5" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 6 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par6.jpg') }}" 
                         alt="Partenaire 6" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 7 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par7.png') }}" 
                         alt="Partenaire 7" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 8 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par8.jpg') }}" 
                         alt="Partenaire 8" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 9 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par9.jpg') }}" 
                         alt="Partenaire 9" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 10 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par10.jpg') }}" 
                         alt="Partenaire 10" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 11 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par11.jpg') }}" 
                         alt="Partenaire 11" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 12 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par12.jpg') }}" 
                         alt="Partenaire 12" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 13 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par13.jpg') }}" 
                         alt="Partenaire 13" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 14 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par14.jpg') }}" 
                         alt="Partenaire 14" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 15 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par15.jpg') }}" 
                         alt="Partenaire 15" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 16 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par16.jpg') }}" 
                         alt="Partenaire 16" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 17 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par17.jpg') }}" 
                         alt="Partenaire 17" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 18 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par18.jpg') }}" 
                         alt="Partenaire 18" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 19 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par19.jpg') }}" 
                         alt="Partenaire 19" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 20 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par20.jpg') }}" 
                         alt="Partenaire 20" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 21 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par21.jpg') }}" 
                         alt="Partenaire 21" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>

            <!-- Partner 22 -->
            <div class="premium-partner-card">
                <div class="premium-partner-image-container">
                    <img src="{{ asset('images/par22.jpg') }}" 
                         alt="Partenaire 22" 
                         class="premium-partner-image"
                         loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Premium Certificates Section - God Level Design -->
<section class="premium-certificates-section">
    <div class="premium-certificates-container">
        <div class="premium-certificates-header">
            <h2 class="premium-certificates-title">{{ __('frontend.excellence_certified') }}</h2>
                            <p class="premium-certificates-subtitle">{{ __('frontend.official_certifications') }}</p>
        </div>
        
        <div class="premium-certificates-grid">
            <div class="premium-certificate-card">
                <div class="premium-certificate-badge">
                    <i class="fas fa-certificate"></i>
                    <span>Officiel</span>
                </div>
                <div class="premium-certificate-image" onclick="testModal('{{ asset('images/certif2.png') }}')" title="Cliquez pour agrandir">
                    <img src="{{ asset('images/certif2.png') }}" alt="Certificat SOTUMA">
                    <div class="premium-certificate-overlay">
                        <div class="premium-certificate-overlay-content">
                            <i class="fas fa-search-plus"></i>
                            <span>{{ __('frontend.view_details') }}</span>
                        </div>
                    </div>
                </div>
                <div class="premium-certificate-content">
                    <h3 class="premium-certificate-title">{{ __('frontend.excellence_certificate_title') }}</h3>
                    <p class="premium-certificate-description">{{ __('frontend.excellence_certificate_description') }}</p>
                    <div class="premium-certificate-features">
                        <div class="premium-certificate-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.certified_quality') }}</span>
                        </div>
                        <div class="premium-certificate-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.standards_met') }}</span>
                        </div>
                        <div class="premium-certificate-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Excellence reconnue</span>
                        </div>
                    </div>
                    <div class="premium-certificate-meta">
                        <div class="premium-certificate-meta-item">
                            <i class="fas fa-user-tie"></i>
                            <span>Délivré par TPR</span>
                        </div>
                        <div class="premium-certificate-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Certificat officiel TPR</span>
                        </div>
                        <div class="premium-certificate-meta-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>{{ __('frontend.quality_warranty') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="premium-certificate-card">
                <div class="premium-certificate-badge">
                    <i class="fas fa-certificate"></i>
                    <span>Officiel</span>
                </div>
                <div class="premium-certificate-image" onclick="testModal('{{ asset('images/somfy.png') }}')" title="Cliquez pour agrandir">
                    <img src="{{ asset('images/somfy.png') }}" alt="Certificat SOMFY">
                    <div class="premium-certificate-overlay">
                        <div class="premium-certificate-overlay-content">
                            <i class="fas fa-search-plus"></i>
                            <span>{{ __('frontend.view_details') }}</span>
                        </div>
                    </div>
                </div>
                <div class="premium-certificate-content">
                    <h3 class="premium-certificate-title">{{ __('frontend.somfy_certificate_title') }}</h3>
                    <p class="premium-certificate-description">{{ __('frontend.somfy_certificate_description') }}</p>
                    <div class="premium-certificate-features">
                        <div class="premium-certificate-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>Partenariat officiel</span>
                        </div>
                        <div class="premium-certificate-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.certified_solutions') }}</span>
                        </div>
                        <div class="premium-certificate-feature">
                            <i class="fas fa-check-circle"></i>
                            <span>{{ __('frontend.compliance_guaranteed') }}</span>
                        </div>
                    </div>
                    <div class="premium-certificate-meta">
                        <div class="premium-certificate-meta-item">
                            <i class="fas fa-user-tie"></i>
                            <span>{{ __('frontend.delivered_by_somfy') }}</span>
                        </div>
                        <div class="premium-certificate-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>Certificat officiel SOMFY</span>
                        </div>
                        <div class="premium-certificate-meta-item">
                            <i class="fas fa-handshake"></i>
                            <span>{{ __('frontend.validated_partnership') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="premium-certificates-cta">
            <a href="/certificates" class="premium-certificates-btn">Voir Tous Nos Certificats</a>
        </div>
    </div>
</section>



<!-- Premium CTA Section - God Level Design -->
<section class="premium-cta-section">
    <div class="premium-cta-background"></div>
    <div class="premium-cta-left-image"></div>
    <div class="premium-cta-slogan">Leader of Perfection</div>
    <div class="premium-cta-container">
        <div class="premium-cta-content">
                            <h2 class="premium-cta-title">{{ __('frontend.ready_realize_project') }}</h2>
                            <p class="premium-cta-subtitle">{{ __('frontend.contact_today') }}</p>
            <div class="premium-cta-buttons">
                <a href="/contact" class="premium-cta-btn primary">
                    <i class="fas fa-phone"></i>
                    <span>{{ __('frontend.contact_us_now') }}</span>
                </a>
                <a href="{{ route('about-us') }}" class="premium-cta-btn secondary">
                    <i class="fas fa-info-circle"></i>
                    <span>En savoir plus</span>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
/* Enhanced hover effects */
.service-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 40px rgba(130,4,3,0.15) !important;
}

.contact-info-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 15px 35px rgba(130,4,3,0.1) !important;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .section-title { font-size: 2.2rem !important; }
  .about-image-main { height: 300px !important; }
  .process-timeline .timeline-line { display: none; }
  .process-step { margin-bottom: 2rem; }
}

/* Smooth transitions */
.service-card, .contact-info-card, .certificate-card {
  transition: all 0.3s ease;
}

/* Form styling */
.form-control:focus {
  border-color: #d4a574;
  box-shadow: 0 0 0 0.2rem rgba(212, 165, 116, 0.25);
}

.form-floating > .form-control:focus ~ label {
  color: #c49464;
}

.legacy-god-btn {
  background: linear-gradient(90deg, #222 0%, #000 100%);
  color: #c49464 !important;
  border: 3px solid #d4a574;
  border-radius: 50px;
  font-weight: 800;
  font-size: 1.25rem;
  box-shadow: 0 0 0 4px #fff, 0 8px 32px #000a, 0 2px 16px #d4a57455;
  text-shadow: 0 2px 8px #0002;
  letter-spacing: 1px;
  transition: all 0.22s cubic-bezier(.4,2,.3,1);
  position: relative;
  z-index: 1;
  overflow: hidden;
}
.legacy-god-btn:hover, .legacy-god-btn:focus {
  background: linear-gradient(90deg, #000 0%, #222 100%);
  color: #c49464 !important;
  border-color: #d4a574;
  box-shadow: 0 0 0 6px #d4a57499, 0 12px 48px #000d, 0 4px 24px #d4a57499;
  transform: scale(1.06) translateY(-2px);
  text-shadow: 0 4px 16px #0002;
}
</style>

<!-- Mobile Sections - Only visible on mobile/tablet -->
<!-- Mobile Hero Section -->
<section class="mobile-hero-section" style="display:none;">
    <div class="mobile-hero-container">
        <!-- Hero Logo -->
        <div class="mobile-hero-logo-wrapper">
            <img src="{{ asset('images/hethahou1.png') }}" alt="SOTUMA" class="mobile-hero-logo" loading="lazy">
        </div>
        
        <!-- Hero Slogan -->
        <div class="mobile-hero-slogan-wrapper">
            @php
                $sloganSingle = isset($settings) && $settings->hero_slogan ? strtoupper($settings->hero_slogan) : 'LE MONDE SE REFLÈTE DANS NOS CRÉATIONS';
                // Fix capitalization for accented characters - make è and é capital
                $sloganSingle = str_replace(['è', 'é'], ['È', 'É'], $sloganSingle);
            @endphp
            <h1 class="mobile-hero-slogan">{{ $sloganSingle }}</h1>
        </div>
        
        <!-- Hero Decorative Elements -->
        <div class="mobile-hero-decoration">
            <div class="hero-line hero-line-1"></div>
            <div class="hero-line hero-line-2"></div>
        </div>
    </div>
</section>

<!-- Mobile Projects Categories -->
<section class="mobile-proj-cats" style="display:none;">
    <div class="mobile-section-header">
        <h2 class="mobile-section-title">NOS PROJETS</h2>
    </div>
    
    <div class="mobile-cards-list">
        @foreach($project_categories as $category)
        <a href="{{ route('project-categories.show', $category->slug ?? Str::slug($category->name)) }}" class="mobile-card">
            <div class="mobile-card-media" style="background-image:url('{{ $category->image ? asset($category->image) : asset('images/no-image.png') }}');"></div>
            <div class="mobile-card-info">
                <div class="mobile-card-title">{{ strtoupper($category->name) }}</div>
                <div class="mobile-card-cta">
                    <span>VOIR PROJETS</span>
                    <svg class="arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 17L17 7M17 7H7M17 7V17"/>
                    </svg>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</section>

<!-- Mobile Process Section -->
<section class="mobile-process" style="display:none;">
    <div class="mobile-section-header">
        <h2 class="mobile-section-title">PROCESSUS D'EXCELLENCE</h2>
    </div>
    
    <div class="mobile-process-steps">
        <div class="mobile-process-step">
            <div class="step-number">1</div>
            <div class="step-content">
                <h3>3D Design</h3>
                <p>Visualisation précise et modélisation personnalisée</p>
            </div>
        </div>
        <div class="mobile-process-step">
            <div class="step-number">2</div>
            <div class="step-content">
                <h3>Fabrication</h3>
                <p>Production avec matériaux premium et techniques avancées</p>
            </div>
        </div>
        <div class="mobile-process-step">
            <div class="step-number">3</div>
            <div class="step-content">
                <h3>Installation</h3>
                <p>Installation professionnelle et finitions impeccables</p>
            </div>
        </div>
        <div class="mobile-process-step">
            <div class="step-number">4</div>
            <div class="step-content">
                <h3>Garantie 10 ans</h3>
                <p>Assurance qualité et service après-vente</p>
            </div>
        </div>
    </div>
</section>

<!-- Mobile Products Categories -->
<section class="mobile-prod-cats" style="display:none;">
    <div class="mobile-section-header">
        <h2 class="mobile-section-title">NOS PRODUITS</h2>
    </div>
    
    <div class="mobile-cards-list">
        @foreach($category_lists as $category)
        <a href="{{ route('categories.show', $category->slug ?? Str::slug($category->title)) }}" class="mobile-card">
            <div class="mobile-card-media" style="background-image:url('{{ $category->image ? asset($category->image) : asset('images/no-image.png') }}');"></div>
            <div class="mobile-card-info">
                <div class="mobile-card-title">{{ strtoupper($category->title) }}</div>
                <div class="mobile-card-cta">
                    <span>VOIR PRODUITS</span>
                    <svg class="arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 17L17 7M17 7H7M17 7V17"/>
                    </svg>
                </div>
            </div>
        </a>
        @endforeach
    </div>
</section>

<style>
/* Desktop Only Styles - Ensure desktop elements are visible on desktop */
@media (min-width: 1025px) {
    /* Force show ALL desktop sections on desktop */
    .hero-video-section,
    .presentation-section,
    .premium-presentation-section,
    .projects-categories-grid-section,
    .premium-process-section,
    .offer-grid-section,
    .premium-partners-section,
    .premium-certificates-section,
    .premium-cta-section,
    .floating-guarantee,
    .presentation-floating-element,
    .premium-floating-element,
    .premium-image-container {
        display: block !important;
    }
    
    /* Force hide mobile sections on desktop */
    .mobile-hero-section,
    .mobile-proj-cats,
    .mobile-process,
    .mobile-prod-cats {
        display: none !important;
    }
}

/* Mobile Responsive Styles */
@media (max-width: 1024px) {
    /* Hide desktop sections on mobile/tablet */
    .hero-video-section,
    .partners-slider-section,
    .presentation-section,
    .premium-presentation-section,
    .projects-categories-grid-section,
    .premium-process-section,
    .offer-grid-section,
    .premium-partners-section,
    .premium-certificates-section,
    .premium-cta-section,
    .floating-guarantee,
    .presentation-floating-element,
    .premium-floating-element,
    .premium-image-container {
        display: none !important;
    }
    
    /* Show mobile sections on mobile/tablet */
    .mobile-hero-section,
    .mobile-proj-cats,
    .mobile-process,
    .mobile-prod-cats {
        display: block !important;
    }
    
    /* Mobile Hero Section */
    .mobile-hero-section {
        position: relative;
        width: 100vw;
        height: 280px;
        max-width: 100%;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        padding: 0 1rem 10px 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        box-sizing: border-box;
    }
    
    /* Ensure hero section maintains dimensions on larger screens */
    @media (min-width: 1025px) {
        .mobile-hero-section {
            width: 372px;
            height: 280px;
            max-width: 372px;
            margin: 0 auto;
        }
    }
    
    .mobile-hero-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 100%;
        max-width: 100%;
        padding-top: 0;
        margin-top: 0;
        box-sizing: border-box;
    }
    
    .mobile-hero-logo-wrapper {
        text-align: center;
        margin-bottom: 0.8rem; /* Reduced from 1.5rem */
        padding-top: 0;
        margin-top: 0;
    }
    
    .mobile-hero-logo {
        height: 160px;
        width: 160px;
        max-width: 100%;
        object-fit: contain;
    }
    
    .mobile-hero-slogan {
        font-family: 'Arial', 'Helvetica', sans-serif;
        font-weight: 800;
        font-size: clamp(1rem, 4.2vw, 1.7rem); /* Increased from 0.8rem-1.4rem to 1rem-1.7rem */
        line-height: 1.2;
        letter-spacing: 0.05em;
        margin: 0;
        text-transform: uppercase;
        text-align: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 100%;
        word-spacing: 0.1em;
        
        /* Dark gray that's clearly gray (not near-black) */
        color: #5a5a5a !important;
        background: none !important;
        background-size: auto !important;
        -webkit-background-clip: initial !important;
        background-clip: initial !important;
        -webkit-text-fill-color: inherit !important;
        animation: none;
    }
    
    /* Ensure full width on tablet devices */
    @media (max-width: 1024px) {
        .mobile-hero-section {
            width: 100vw;
            margin: 0;
        }
    }
    
    /* Mobile Hero Responsive Breakpoints */
    @media (max-width: 768px) {
        .mobile-hero-section {
            width: 100vw;
            height: min(280px, 35vh);
            padding: 0 0.5rem 5px 0.5rem; /* Reduced bottom padding from 10px to 5px */
        }
        
        .mobile-hero-logo {
            height: 160px;
            width: 160px;
        }
        
        .mobile-hero-slogan {
            font-size: clamp(0.9rem, 3.8vw, 1.4rem); /* Increased from 0.7rem-1.2rem to 0.9rem-1.4rem */
            letter-spacing: 0.03em;
        }
    }
    
    @media (max-width: 480px) {
        .mobile-hero-section {
            width: 100vw;
            height: min(280px, 30vh);
            padding: 0 0.25rem 5px 0.25rem; /* Reduced bottom padding from 10px to 5px */
        }
        
        .mobile-hero-logo {
            height: 160px;
            width: 160px;
        }
        
        .mobile-hero-slogan {
            font-size: clamp(0.8rem, 3.2vw, 1.2rem); /* Increased from 0.6rem-1rem to 0.8rem-1.2rem */
            letter-spacing: 0.02em;
            word-spacing: 0.05em;
        }
    }
    
    @media (max-width: 360px) {
        .mobile-hero-section {
            width: 100vw;
            height: min(280px, 25vh);
            padding: 0 0.15rem 5px 0.15rem; /* Reduced bottom padding from 10px to 5px */
        }
        
        .mobile-hero-logo {
            height: 160px;
            width: 160px;
        }
        
        .mobile-hero-slogan {
            font-size: clamp(0.7rem, 2.8vw, 1.1rem); /* Increased from 0.5rem-0.9rem to 0.7rem-1.1rem */
            letter-spacing: 0.01em;
        }
    }
    
    /* Mobile Section Headers */
    .mobile-section-header {
        text-align: center;
        margin-bottom: 0.5rem;
        padding: 1rem 1rem 0.5rem 1rem;
    }
    
    /* First mobile section (Nos projets) - ensure proper spacing from hero */
    .mobile-proj-cats .mobile-section-header {
        margin-top: 0;
        padding-top: 0.5rem;
    }
    
    .mobile-section-title {
        color: rgb(164, 117, 87);
        background: none !important;
        background-size: auto !important;
        -webkit-background-clip: initial !important;
        -webkit-text-fill-color: inherit !important;
        background-clip: initial !important;
        font-weight: 900;
        letter-spacing: 1.2px; /* Same as PROCESSUS D'EXCELLENCE */
        font-size: clamp(24px, 6vw, 32px); /* Same as PROCESSUS D'EXCELLENCE */
        white-space: nowrap; /* Same as PROCESSUS D'EXCELLENCE */
        overflow: hidden; /* Same as PROCESSUS D'EXCELLENCE */
        text-overflow: ellipsis; /* Same as PROCESSUS D'EXCELLENCE */
        margin: 0 0 12px 0;
        text-transform: uppercase;
        text-shadow: none;
        animation: none;
    }
    
    /* Specific styling for PROCESSUS D'EXCELLENCE - Smaller text, single line */
    .mobile-process .mobile-section-title {
        font-size: clamp(16px, 4vw, 22px); /* Further reduced from clamp(20px, 5vw, 26px) */
        letter-spacing: 0.8px; /* Reduced from 1px */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 900;
    }
    
    /* Responsive adjustments for ALL mobile section titles */
    @media (max-width: 768px) {
        .mobile-section-title {
            font-size: clamp(22px, 5.5vw, 28px);
            letter-spacing: 0.8px;
        }
        
        /* PROCESSUS D'EXCELLENCE - Smaller on mobile */
        .mobile-process .mobile-section-title {
            font-size: clamp(14px, 3.5vw, 20px) !important; /* Further reduced from clamp(18px, 4.5vw, 24px) */
            letter-spacing: 0.6px !important; /* Reduced from 0.8px */
        }
    }
    
    @media (max-width: 480px) {
        .mobile-section-title {
            font-size: clamp(20px, 5vw, 24px);
            letter-spacing: 0.6px;
        }
        
        /* PROCESSUS D'EXCELLENCE - Smaller for small mobile */
        .mobile-process .mobile-section-title {
            font-size: clamp(12px, 3vw, 16px) !important; /* Further reduced from clamp(16px, 4vw, 20px) */
            letter-spacing: 0.4px !important; /* Reduced from 0.6px */
        }
    }
    
    @media (max-width: 360px) {
        .mobile-section-title {
            font-size: clamp(18px, 4.5vw, 22px);
            letter-spacing: 0.4px;
        }
        
        /* PROCESSUS D'EXCELLENCE - Very small mobile */
        .mobile-process .mobile-section-title {
            font-size: clamp(10px, 2.5vw, 14px) !important; /* Further reduced from clamp(14px, 3.5vw, 18px) */
            letter-spacing: 0.3px !important; /* Reduced from 0.5px */
        }
    }
    
    @keyframes gradientShift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }
    
    @keyframes metallic-shine {
        0%, 100% { 
            background-position: 0% 50%;
            filter: brightness(1);
        }
        50% { 
            background-position: 100% 50%;
            filter: brightness(1.2);
        }
    }
    
    .mobile-section-sub {
        color: #666;
        font-size: 1rem;
        margin: 0;
    }
    
    /* Mobile Cards List - Original Edge to Edge Taller Design */
    .mobile-cards-list {
        display: flex;
        flex-direction: column;
        gap: 0;
        padding: 0 15px; /* 15px side margins */
        margin: 0;
        width: 100%;
        padding-bottom: 2rem;
    }
    
    .mobile-card {
        background: #fff;
        border-radius: 0;
        overflow: hidden;
        box-shadow: none;
        transition: background-color 0.3s ease;
        border-bottom: 1px solid #eee;
        margin: 0;
        text-decoration: none;
        color: inherit;
        display: block;
        width: 100%;
    }
    
    .mobile-card:last-child {
        border-bottom: none;
    }
    
    .mobile-card:hover {
        background: #f8f9fa;
        text-decoration: none;
        color: inherit;
    }
    
    .mobile-card-media {
        height: 350px;
        overflow: hidden;
        width: 100%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    
    .mobile-card-info {
        padding: 2rem 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        justify-content: center;
        min-height: 140px;
        background: #fff;
    }
    
    .mobile-card-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 1.5rem;
        line-height: 1.3;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .mobile-card-cta {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #FF0000;
        font-weight: 600;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .arrow-icon {
        transition: transform 0.3s ease;
    }
    
    .mobile-card:hover .arrow-icon {
        transform: translateX(4px);
    }
    
    /* Mobile Cards - Tablet Responsive */
    @media (max-width: 768px) {
        .mobile-card-media {
            height: 300px;
        }
        
        .mobile-card-info {
            padding: 1.75rem 1.25rem;
            min-height: 130px;
        }
        
        .mobile-card-title {
            font-size: 1rem;
            margin-bottom: 1.25rem;
        }
        
        .mobile-card-cta {
            font-size: 0.85rem;
        }
    }
    
    /* Mobile Cards - Small Mobile Responsive */
    @media (max-width: 480px) {
        .mobile-card-media {
            height: 280px;
        }
        
        .mobile-card-info {
            padding: 1.5rem 1rem;
            min-height: 120px;
        }
        
        .mobile-card-title {
            font-size: 0.95rem;
            margin-bottom: 1rem;
        }
        
        .mobile-card-cta {
            font-size: 0.8rem;
        }
    }
    
    /* Hide Mobile Social Menu on Index Page - Maximum Force */
    .mobile-social-toggle,
    .mobile-social-menu,
    .mobile-social-overlay {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        position: absolute !important;
        left: -9999px !important;
        top: -9999px !important;
        width: 0 !important;
        height: 0 !important;
        overflow: hidden !important;
        pointer-events: none !important;
        z-index: -1 !important;
    }
    
    /* Hide social sidebar only on mobile/tablet for index page */
    @media (max-width: 1024px) {
        .social-sidebar {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
            position: absolute !important;
            left: -9999px !important;
            top: -9999px !important;
            width: 0 !important;
            height: 0 !important;
            overflow: hidden !important;
            pointer-events: none !important;
            z-index: -1 !important;
        }
    }
    
    /* Additional targeting for any dynamically created elements */
    button[class*="mobile-social"],
    div[class*="mobile-social"],
    [aria-label*="Toggle social media menu"],
    [aria-label*="social media"] {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
    }
    
    /* Mobile Process Steps - Simple Design */
    .mobile-process-steps {
        padding: 0 1rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .mobile-process-step {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: #fff;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-left: 4px solid #FF0000;
    }
    
    .step-number {
        background: linear-gradient(135deg, #FF0000, #CC0000);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    .step-content h3 {
        margin: 0 0 0.3rem 0;
        color: #333;
        font-size: 1.1rem;
        font-weight: 600;
    }
    
    .step-content p {
        margin: 0;
        color: #666;
        font-size: 0.85rem;
        line-height: 1.4;
    }
}

/* Show desktop sections on desktop */
@media (min-width: 1025px) {
    .hero-video-section,
    .partners-slider-section,
    .premium-presentation-section,
    .projects-categories-grid-section,
    .offer-grid-section,
    .premium-partners-section,
    .premium-certificates-section,
    .premium-cta-section {
        display: block !important;
    }
    
    .mobile-hero-section,
    .mobile-proj-cats,
    .mobile-process,
    .mobile-prod-cats {
        display: none !important;
    }
}
</style>

<!-- Remove Mobile Social Menu Script - Index Page Only -->
<script src="{{ asset('js/remove-mobile-social.js') }}"></script>

@endsection

<script>
// Advanced Scroll Animations and Micro-interactions
document.addEventListener('DOMContentLoaded', function() {
    // Responsive behavior handler
    function handleResponsive() {
        const isDesktop = window.innerWidth >= 1025;
        
        if (isDesktop) {
            // Force show desktop sections on desktop
            const desktopSections = document.querySelectorAll('.hero-video-section, .partners-slider-section, .presentation-section, .premium-presentation-section, .projects-categories-grid-section, .premium-process-section, .offer-grid-section, .premium-partners-section, .premium-certificates-section, .premium-cta-section, .floating-guarantee, .presentation-floating-element, .premium-floating-element, .premium-image-container');
            desktopSections.forEach(section => {
                if (section) {
                    section.style.display = 'block';
                    section.style.visibility = 'visible';
                    section.style.opacity = '1';
                }
            });
            
            // Force hide mobile sections on desktop
            const mobileSections = document.querySelectorAll('.mobile-hero-section, .mobile-proj-cats, .mobile-process, .mobile-prod-cats');
            mobileSections.forEach(section => {
                if (section) {
                    section.style.display = 'none';
                    section.style.visibility = 'hidden';
                    section.style.opacity = '0';
                }
            });
        } else {
            // Force hide desktop sections on mobile/tablet
            const desktopSections = document.querySelectorAll('.hero-video-section, .partners-slider-section, .presentation-section, .premium-presentation-section, .projects-categories-grid-section, .premium-process-section, .offer-grid-section, .premium-partners-section, .premium-certificates-section, .premium-cta-section, .floating-guarantee, .presentation-floating-element, .premium-floating-element, .premium-image-container');
            desktopSections.forEach(section => {
                if (section) {
                    section.style.display = 'none';
                    section.style.visibility = 'hidden';
                    section.style.opacity = '0';
                }
            });
            
            // Force show mobile sections on mobile/tablet
            const mobileSections = document.querySelectorAll('.mobile-hero-section, .mobile-proj-cats, .mobile-process, .mobile-prod-cats');
            mobileSections.forEach(section => {
                if (section) {
                    section.style.display = 'block';
                    section.style.visibility = 'visible';
                    section.style.opacity = '1';
                }
            });
        }
    }
    
    // Run on load
    handleResponsive();
    
    // Run on resize
    window.addEventListener('resize', handleResponsive);
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
                entry.target.style.animation = 'slideInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
            }
        });
    }, observerOptions);

    // Observe all premium sections
    document.querySelectorAll('.premium-about-section, .premium-process-section, .premium-services-section, .premium-certificates-section, .premium-contact-section').forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(50px)';
        section.style.transition = 'all 1s cubic-bezier(0.4, 0, 0.2, 1)';
        observer.observe(section);
    });

    // Parallax effect for floating elements
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.premium-floating-element');
        
        parallaxElements.forEach(element => {
            const speed = 0.5;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });

    // Smooth reveal for stats
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const statNumbers = entry.target.querySelectorAll('.premium-stat-number');
                statNumbers.forEach((stat, index) => {
                    setTimeout(() => {
                        stat.style.opacity = '1';
                        stat.style.transform = 'scale(1)';
                    }, index * 200);
                });
            }
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('.premium-stats').forEach(stats => {
        const statNumbers = stats.querySelectorAll('.premium-stat-number');
        statNumbers.forEach(stat => {
            stat.style.opacity = '0';
            stat.style.transform = 'scale(0.8)';
            stat.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        });
        statsObserver.observe(stats);
    });

    // Enhanced hover effects for cards
    document.querySelectorAll('.premium-service-card, .premium-certificate-card, .premium-contact-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-15px) rotateX(3deg) scale(1.02)';
            this.style.boxShadow = '0 30px 80px rgba(0, 0, 0, 0.15), 0 15px 40px rgba(212, 165, 116, 0.2)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) rotateX(0deg) scale(1)';
            this.style.boxShadow = '';
        });
    });

    // Magnetic effect for buttons
    document.querySelectorAll('.premium-cta-btn').forEach(btn => {
        btn.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            this.style.transform = `translate(${x * 0.1}px, ${y * 0.1}px)`;
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translate(0, 0)';
        });
    });

    // Typing effect for titles
    const titles = document.querySelectorAll('.premium-title, .premium-process-title, .premium-services-title, .premium-certificates-title, .premium-contact-title');
    titles.forEach(title => {
        const text = title.textContent;
        title.textContent = '';
        title.style.opacity = '1';
        
        let i = 0;
        const typeWriter = () => {
            if (i < text.length) {
                title.textContent += text.charAt(i);
                i++;
                setTimeout(typeWriter, 50);
            }
        };
        
        const titleObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    typeWriter();
                    titleObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        titleObserver.observe(title);
    });
});
</script>


<style>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.9);
    z-index: 99999;
    display: none;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(5px);
}

.modal-overlay.active {
    display: flex;
    animation: fadeIn 0.3s ease;
}

.modal-box {
    background: white;
    padding: 30px;
    border-radius: 15px;
    max-width: 95%;
    max-height: 95%;
    position: relative;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    animation: slideIn 0.3s ease;
}

.modal-image {
    max-width: 100%;
    max-height: 85vh;
    display: block;
    border-radius: 8px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.close-btn {
    position: absolute;
    top: -15px;
    right: -15px;
    background: #d4a574;
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    cursor: pointer;
    font-size: 20px;
    font-weight: bold;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.close-btn:hover {
    background: #c49464;
    transform: scale(1.1);
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideIn {
    from { 
        opacity: 0; 
        transform: scale(0.8) translateY(-20px);
    }
    to { 
        opacity: 1; 
        transform: scale(1) translateY(0);
    }
}


.premium-certificate-image {
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    z-index: 1;
}

.premium-certificate-image:hover {
    transform: scale(1.05);
    box-shadow: 0 15px 40px rgba(212, 165, 116, 0.3);
}

.premium-certificate-image::before {
    content: '🔍 Voir';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(212, 165, 116, 0.9);
    color: #c49464;
    padding: 12px 20px;
    border-radius: 25px;
    font-size: 14px;
    font-weight: 600;
    opacity: 0;
    transition: all 0.3s ease;
    z-index: 2;
    white-space: nowrap;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    pointer-events: none; 
}

.premium-certificate-image:hover::before {
    opacity: 1;
}

.premium-certificate-image::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(196, 148, 100, 0.2);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none; 
}

.premium-certificate-image:hover::after {
    opacity: 1;
}

/* Ensure the image itself is clickable */
.premium-certificate-image img {
    pointer-events: auto;
    position: relative;
    z-index: 1;
}

/* Partners Slider Styles */
.partners-slider-section {
    width: 100%;
    height: 80px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    border-top: 1px solid rgba(212, 165, 116, 0.1);
    border-bottom: 1px solid rgba(212, 165, 116, 0.1);
    overflow: hidden;
    position: relative;
    z-index: 10;
}

.partners-slider-container {
    width: 100%;
    height: 100%;
    overflow: hidden;
    position: relative;
}

.partners-slider-track {
    display: flex;
    align-items: center;
    height: 100%;
    animation: slidePartners 60s linear infinite;
    width: max-content;
}

.partner-slide {
    flex-shrink: 0;
    height: 60px;
    margin: 0 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.partner-slide:hover {
    transform: scale(1.1);
}

.partner-image {
    max-height: 100%;
    max-width: 120px;
    object-fit: contain;
    transition: all 0.3s ease;
}

.partner-slide:hover .partner-image {
    transform: scale(1.05);
}

@keyframes slidePartners {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .partners-slider-section {
        height: 60px;
    }
    
    .partner-slide {
        height: 40px;
        margin: 0 20px;
    }
    
    .partner-image {
        max-width: 80px;
    }
    
    .partners-slider-track {
        animation-duration: 40s;
    }
}

@media (max-width: 480px) {
    .partners-slider-section {
        height: 50px;
    }
    
    .partner-slide {
        height: 35px;
        margin: 0 15px;
    }
    
    .partner-image {
        max-width: 60px;
    }
    
    .partners-slider-track {
        animation-duration: 30s;
    }
}

/* Premium Partners Section - Senior Developer Level Styling */
.premium-partners-section {
    padding: 80px 0 80px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 50%, #f8f9fa 100%);
    position: relative;
    overflow: hidden;
}

.premium-partners-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 20% 80%, rgba(212, 165, 116, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(196, 148, 100, 0.02) 0%, transparent 50%);
    pointer-events: none;
}

.premium-partners-container {
    max-width: 1600px;
    margin: 0 auto;
    padding: 0 40px;
    position: relative;
    z-index: 2;
}

.premium-partners-header {
    text-align: center;
    margin-bottom: 60px;
}

.premium-partners-title {
    font-size: clamp(2.5rem, 5vw, 3.5rem);
    font-weight: 800;
    color: #1a1a1a;
    margin: 0;
    line-height: 1.1;
    letter-spacing: -0.02em;
}

.premium-partners-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 30px;
    align-items: center;
    background: #fff;
    border-radius: 20px;
    padding: 40px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
    border: 2px solid #d4a574;
}

.premium-partner-card {
    background: #fff;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    border: 1px solid rgba(212, 165, 116, 0.3);
    aspect-ratio: 1;
}

.premium-partner-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    border-color: rgba(212, 165, 116, 0.5);
}

.premium-partner-image-container {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background: linear-gradient(135deg, #f8f9fa, #ffffff);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.premium-partner-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    filter: brightness(1);
}

.premium-partner-card:hover .premium-partner-image {
    transform: scale(1.05);
}

/* Responsive Design for Premium Partners */
@media (max-width: 1200px) {
    .premium-partners-grid {
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 25px;
        padding: 30px;
    }
}

@media (max-width: 768px) {
    .premium-partners-section {
        padding: 60px 0 60px;
    }
    
    .premium-partners-container {
        padding: 0 20px;
    }
    
    .premium-partners-header {
        margin-bottom: 40px;
    }
    
    .premium-partners-grid {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 20px;
        padding: 25px;
        border-radius: 15px;
    }
}

@media (max-width: 480px) {
    .premium-partners-section {
        padding: 40px 0 40px;
    }
    
    .premium-partners-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        padding: 20px;
        border-radius: 12px;
    }
}

/* Removed overlay and content styling - images only */

/* Duplicate responsive CSS removed */
</style>

<!-- Simple Certificate Modal -->
<div id="certificateModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.95); z-index: 999999; align-items: center; justify-content: center; backdrop-filter: blur(5px);">
    <div style="position: relative; max-width: 95%; max-height: 95%; background: white; padding: 20px; border-radius: 15px; box-shadow: 0 20px 60px rgba(0,0,0,0.5);">
        <button onclick="closeTestModal()" style="position: absolute; top: -15px; right: -15px; background: #d4a574; color: white; border: none; border-radius: 50%; width: 40px; height: 40px; font-size: 20px; cursor: pointer; box-shadow: 0 4px 12px rgba(0,0,0,0.3); z-index: 10;">×</button>
        <img id="modalImage" style="max-width: 100%; max-height: 80vh; display: block; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
    </div>
</div>

<script>
// Simple test modal function
function testModal(imageSrc) {
    console.log('TEST MODAL - Image:', imageSrc);
    
    const modal = document.getElementById('certificateModal');
    const modalImg = document.getElementById('modalImage');
    
    if (modal && modalImg) {
        // Preload the image to ensure it loads
        const img = new Image();
        img.onload = function() {
            modalImg.src = imageSrc;
            modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
            console.log('Modal opened successfully with image loaded');
        };
        img.onerror = function() {
            console.error('Failed to load image:', imageSrc);
            alert('Failed to load image: ' + imageSrc);
        };
        img.src = imageSrc;
    } else {
        console.error('Modal elements not found');
        alert('Modal elements not found!');
    }
}

function closeTestModal() {
    console.log('Closing test modal');
    const modal = document.getElementById('certificateModal');
    if (modal) {
        modal.style.display = 'none';
    document.body.style.overflow = 'auto';
    }
}

// Close with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeTestModal();
    }
});

// Close when clicking outside
document.getElementById('certificateModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeTestModal();
    }
});

// Debug on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded - checking certificates...');
    const certificates = document.querySelectorAll('.premium-certificate-image');
    console.log('Found certificates:', certificates.length);
    
    certificates.forEach((cert, index) => {
        console.log(`Certificate ${index + 1}:`, cert);
        console.log(`Certificate ${index + 1} onclick:`, cert.onclick);
    });
});
</script>

