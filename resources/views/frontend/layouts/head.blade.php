<!-- Meta Tag -->
@yield('meta')
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="google-site-verification" content="16b216fpPJRe0uC3gZZ6WOXJJwvMEwFCPDDLuhQEjms">
<!-- iOS/Safari mobile enhancements -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telephone=no">
<meta name="msapplication-tap-highlight" content="no">
<meta name="theme-color" content="#FF0000">

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-XXXXXXX');</script>
<!-- End Google Tag Manager -->

<!-- SEO Meta Tags -->
@php
    $seoService = app(\App\Services\SeoService::class);
    $seoData = $seoService->getMetaTags($page ?? 'home', $seoData ?? []);
@endphp

<meta name="description" content="{{ $seoData['description'] ?? 'SOTUMA - Leader en menuiserie aluminium à Sfax, Tunisie' }}">
<meta name="keywords" content="{{ $seoData['keywords'] ?? 'aluminium, sotuma, menuiserie, volets roulants, sfax, tunisie' }}">
<meta name="author" content="SOTUMA">
<meta name="robots" content="index, follow">
<meta name="language" content="fr">
<meta name="revisit-after" content="7 days">

<!-- Open Graph Meta Tags -->
<meta property="og:type" content="website">
<meta property="og:site_name" content="SOTUMA">
<meta property="og:title" content="{{ $seoData['og_title'] ?? $seoData['title'] ?? 'SOTUMA - Menuiserie Aluminium Sfax' }}">
<meta property="og:description" content="{{ $seoData['og_description'] ?? $seoData['description'] ?? 'SOTUMA - Leader en menuiserie aluminium à Sfax' }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:image" content="{{ $seoData['og_image'] ?? asset('images/sotuma-logo.jpg') }}">
<meta property="og:locale" content="fr_FR">

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@sotuma_aluminium">
<meta name="twitter:title" content="{{ $seoData['title'] ?? 'SOTUMA - Menuiserie Aluminium Sfax' }}">
<meta name="twitter:description" content="{{ $seoData['description'] ?? 'SOTUMA - Leader en menuiserie aluminium à Sfax' }}">
<meta name="twitter:image" content="{{ $seoData['og_image'] ?? asset('images/sotuma-logo.jpg') }}">

<!-- Canonical URL -->
<link rel="canonical" href="{{ $seoData['canonical'] ?? url()->current() }}">

<!-- Mobile Safari/iOS CSS fixes -->
<style>
  html, body { height: -webkit-fill-available; }
  body { -webkit-text-size-adjust: 100%; text-size-adjust: 100%; }
  .vh-safe-100 { min-height: 100vh; min-height: -webkit-fill-available; }
  .ios-scroll { -webkit-overflow-scrolling: touch; }
  img { image-rendering: -webkit-optimize-contrast; }
  /* Safe area helpers */
  .pad-safe { padding: max(16px, env(safe-area-inset-top)) max(16px, env(safe-area-inset-right)) max(16px, env(safe-area-inset-bottom)) max(16px, env(safe-area-inset-left)); }
</style>

<!-- JSON-LD Organization schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "SOTUMA",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('images/sotuma-logo.jpg') }}",
  "sameAs": [
    "https://www.instagram.com/sotuma_aluminium/",
    "https://www.facebook.com/sotumasfax",
    "https://www.linkedin.com/company/sotuma/"
  ],
  "contactPoint": [{
    "@type": "ContactPoint",
    "contactType": "customer support",
    "telephone": "{{ $settings->phone ?? '' }}",
    "email": "{{ $settings->email ?? '' }}"
  }],
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ $settings->address ?? '' }}",
    "addressCountry": "TN"
  }
}
</script>

<!-- Structured Data -->
<script type="application/ld+json">
{!! $seoService->getStructuredData($page ?? 'home', $seoData ?? []) !!}
</script>

<!-- Title Tag  -->
<title>{{ $seoData['title'] ?? 'SOTUMA - Menuiserie Aluminium Sfax' }}</title>
<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=1">
<link rel="icon" type="image/x-icon" href="{{ asset('images/favicon-new.ico') }}?v=1">
<script>
// Mobile scroll unlock failsafe: ensure body/html aren't stuck with overflow:hidden when no overlay is active
document.addEventListener('DOMContentLoaded', function() {
    function hasBlockingOverlay() {
        return document.querySelector('.mobile-menu.active, .mobile-overlay.active, .nav-menu.active, .modal.show, body.modal-open, .popup.show');
    }
    function unlockScrollIfNeeded() {
        if (window.innerWidth <= 1024 && !hasBlockingOverlay()) {
            if (document.body.style.overflow === 'hidden' || getComputedStyle(document.body).overflow === 'hidden') {
                document.body.style.overflow = '';
            }
            if (document.documentElement.style.overflow === 'hidden' || getComputedStyle(document.documentElement).overflow === 'hidden') {
                document.documentElement.style.overflow = '';
            }
        }
    }
    unlockScrollIfNeeded();
    window.addEventListener('resize', unlockScrollIfNeeded, { passive: true });
    window.addEventListener('orientationchange', unlockScrollIfNeeded);
    window.addEventListener('pageshow', unlockScrollIfNeeded);
    document.addEventListener('click', unlockScrollIfNeeded, true);
});
</script>
<!-- Web Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

<!-- StyleSheet -->
<link rel="manifest" href="/manifest.json">
<style>
/* Ensure mobile scrolling is always enabled when no overlay/menu is open */
@media (max-width: 1024px) {
    html, body { 
        overflow-y: auto !important; 
        -webkit-overflow-scrolling: touch !important;
        overscroll-behavior-y: auto !important;
    }
    /* Defensive: hide any preloader on mobile */
    .preloader { display: none !important; }
}
/* Reduce layout shifts on load */
html { overflow-anchor: none; }
</style>

<script>
// MobileScrollGuardian: robust scroll unlock for mobile
(function() {
    'use strict';

    function isMobile() {
        return window.matchMedia('(max-width: 1024px)').matches || 'ontouchstart' in window;
    }

    function hasBlockingOverlay() {
        return !!document.querySelector(
            '.mobile-menu.active, .mobile-overlay.active, .nav-menu.active, .navbar-collapse.show, .offcanvas.show, .modal.show, body.modal-open, .popup.show, .lightbox.open, .fancybox-is-open, .swal2-shown'
        );
    }

    function applyTouchHints() {
        if (!isMobile()) return;
        document.documentElement.style.setProperty('-webkit-overflow-scrolling', 'touch', 'important');
        document.documentElement.style.setProperty('overscroll-behavior-y', 'auto', 'important');
        document.documentElement.style.setProperty('touch-action', 'pan-y', 'important');
        document.body.style.setProperty('-webkit-overflow-scrolling', 'touch', 'important');
        document.body.style.setProperty('overscroll-behavior-y', 'auto', 'important');
        document.body.style.setProperty('touch-action', 'pan-y', 'important');
    }

    function unlockScrollIfSafe() {
        if (!isMobile()) return;
        if (!hasBlockingOverlay()) {
            // Clear overflow locks
            if (getComputedStyle(document.body).overflow === 'hidden' || document.body.style.overflow === 'hidden') {
                document.body.style.overflow = '';
            }
            if (getComputedStyle(document.documentElement).overflow === 'hidden' || document.documentElement.style.overflow === 'hidden') {
                document.documentElement.style.overflow = '';
            }
            // Clear modal body lock if no modal is shown
            if (document.body.classList.contains('modal-open')) {
                document.body.classList.remove('modal-open');
            }
            // Defensive: if body was fixed by a script, release it
            if (getComputedStyle(document.body).position === 'fixed') {
                document.body.style.position = '';
                document.body.style.top = '';
                document.body.style.width = '';
            }
        }
    }

    function observeChanges() {
        var observer = new MutationObserver(unlockScrollIfSafe);
        observer.observe(document.body, { attributes: true, attributeFilter: ['style','class'] });
        observer.observe(document.documentElement, { attributes: true, attributeFilter: ['style','class'] });
        ['.mobile-menu', '.mobile-overlay', '.nav-menu', '.navbar-collapse', '.offcanvas', '.modal', '.popup']
            .forEach(function(sel) {
                var el = document.querySelector(sel);
                if (el) observer.observe(el, { attributes: true, attributeFilter: ['style','class'] });
            });
    }

    document.addEventListener('DOMContentLoaded', function() {
        applyTouchHints();
        unlockScrollIfSafe();
        observeChanges();
        // Run a few times during early load instead of continuous polling to avoid jumps
        setTimeout(unlockScrollIfSafe, 50);
        setTimeout(unlockScrollIfSafe, 300);
        setTimeout(unlockScrollIfSafe, 1000);
    });

    ['resize','orientationchange','pageshow','visibilitychange','click','touchstart','touchend','keyup','focusin']
        .forEach(function(evt){ window.addEventListener(evt, unlockScrollIfSafe, { passive: true }); });
})();
</script>
<!-- Bootstrap -->
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<!-- Magnific Popup -->
<link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.min.css')}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.css')}}">
<!-- Fancybox -->
<link rel="stylesheet" href="{{asset('frontend/css/jquery.fancybox.min.css')}}">
<!-- Themify Icons -->
<link rel="stylesheet" href="{{asset('frontend/css/themify-icons.css')}}">
<!-- Nice Select CSS -->
<link rel="stylesheet" href="{{asset('frontend/css/niceselect.css')}}">
<!-- Animate CSS -->
<link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
<!-- Flex Slider CSS -->
<link rel="stylesheet" href="{{asset('frontend/css/flex-slider.min.css')}}">
<!-- Owl Carousel -->
<link rel="stylesheet" href="{{asset('frontend/css/owl-carousel.css')}}">
<!-- Slicknav -->
<link rel="stylesheet" href="{{asset('frontend/css/slicknav.min.css')}}">
<!-- Jquery Ui -->
<link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.css')}}">

<!-- Eshop StyleSheet -->
<link rel="stylesheet" href="{{asset('frontend/css/reset.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
<link rel="stylesheet" href="{{ asset('frontend/css/styles.css') }}">

<!-- SOTUMA Mobile Responsive CSS -->
<link rel="stylesheet" href="{{ asset('css/frontend-mobile-responsive.css') }}">
<link rel="stylesheet" href="{{ asset('css/responsive-global.css') }}">
<link rel="stylesheet" href="{{ asset('css/header-mobile-responsive.css') }}">
<link rel="stylesheet" href="{{ asset('css/ios-mobile-fixes.css') }}">
<link rel="stylesheet" href="{{ asset('css/mobile-preloader.css') }}">

<!-- Hamburger Menu YouTube Red Click Styles -->
<style>
/* Hamburger Menu Click/Hover States - YouTube Red Primary */
@media (max-width: 1200px) {
    /* Normal state - YouTube Red primary */
    .mobile-menu-toggle .hamburger-line {
        background: #FF0000 !important; /* YouTube Red primary */
        transition: all 0.3s ease !important;
    }
    
    /* Hover state - Enhanced YouTube Red */
    .mobile-menu-toggle:hover .hamburger-line {
        background: #FF0000 !important; /* YouTube Red */
        box-shadow: 0 0 15px rgba(255, 0, 0, 0.6) !important; /* Red glow */
        transition: all 0.3s ease !important;
        transform: scale(1.1); /* Slightly bigger on hover */
    }
    
    /* Active/Click state - Enhanced YouTube Red */
    .mobile-menu-toggle:active .hamburger-line,
    .mobile-menu-toggle:focus .hamburger-line {
        background: #CC0000 !important; /* Darker red on click */
        box-shadow: 0 0 20px rgba(255, 0, 0, 0.8) !important; /* Stronger red glow */
        transition: all 0.1s ease !important;
        transform: scale(0.95); /* Slightly smaller on click */
    }
    
    /* Container hover effects */
    .mobile-menu-toggle:hover {
        transform: scale(1.05) !important;
        transition: transform 0.2s ease !important;
        background: rgba(255, 0, 0, 0.1) !important; /* Red background on hover */
    }
    
    .mobile-menu-toggle:active {
        transform: scale(0.95) !important;
        transition: transform 0.1s ease !important;
        background: rgba(255, 0, 0, 0.2) !important; /* Red background on click */
    }
    
    /* Change any brown colors to YouTube red */
    .mobile-menu-toggle * {
        color: #FF0000 !important; /* YouTube Red for any text */
    }
    
    .mobile-menu-toggle:hover * {
        color: #FF0000 !important; /* YouTube Red on hover */
    }
    
    .mobile-menu-toggle:active * {
        color: #FF0000 !important; /* YouTube Red on click */
    }
}

@media (max-width: 768px) {
    /* Normal state - YouTube Red primary */
    .mobile-menu-toggle .hamburger-line {
        background: #FF0000 !important; /* YouTube Red primary */
        transition: all 0.3s ease !important;
    }
    
    /* Hover state - Enhanced YouTube Red */
    .mobile-menu-toggle:hover .hamburger-line {
        background: #FF0000 !important; /* YouTube Red */
        box-shadow: 0 0 20px rgba(255, 0, 0, 0.7) !important; /* Enhanced red glow */
        transition: all 0.3s ease !important;
        transform: scale(1.1); /* Slightly bigger on hover */
    }
    
    /* Active/Click state - Enhanced YouTube Red */
    .mobile-menu-toggle:active .hamburger-line,
    .mobile-menu-toggle:focus .hamburger-line {
        background: #CC0000 !important; /* Darker red on click */
        box-shadow: 0 0 25px rgba(255, 0, 0, 0.9) !important; /* Strongest red glow */
        transition: all 0.1s ease !important;
        transform: scale(0.95); /* Slightly smaller on click */
    }
    
    /* Container hover effects */
    .mobile-menu-toggle:hover {
        transform: scale(1.08) !important;
        transition: transform 0.2s ease !important;
        background: rgba(255, 0, 0, 0.15) !important; /* Red background on hover */
    }
    
    .mobile-menu-toggle:active {
        transform: scale(0.92) !important;
        transition: transform 0.1s ease !important;
        background: rgba(255, 0, 0, 0.25) !important; /* Red background on click */
    }
    
    /* Change any brown colors to YouTube red */
    .mobile-menu-toggle * {
        color: #FF0000 !important; /* YouTube Red for any text */
    }
    
    .mobile-menu-toggle:hover * {
        color: #FF0000 !important; /* YouTube Red on hover */
    }
    
    .mobile-menu-toggle:active * {
        color: #FF0000 !important; /* YouTube Red on click */
    }
}

@media (max-width: 480px) {
    /* Normal state - YouTube Red primary */
    .mobile-menu-toggle .hamburger-line {
        background: #FF0000 !important; /* YouTube Red primary */
        transition: all 0.3s ease !important;
    }
    
    /* Hover state - Enhanced YouTube Red */
    .mobile-menu-toggle:hover .hamburger-line {
        background: #FF0000 !important; /* YouTube Red */
        box-shadow: 0 0 25px rgba(255, 0, 0, 0.8) !important; /* Strong red glow */
        transition: all 0.3s ease !important;
        transform: scale(1.1); /* Slightly bigger on hover */
    }
    
    /* Active/Click state - Enhanced YouTube Red */
    .mobile-menu-toggle:active .hamburger-line,
    .mobile-menu-toggle:focus .hamburger-line {
        background: #CC0000 !important; /* Darker red on click */
        box-shadow: 0 0 30px rgba(255, 0, 0, 1) !important; /* Maximum red glow */
        transition: all 0.1s ease !important;
        transform: scale(0.95); /* Slightly smaller on click */
    }
    
    /* Container hover effects */
    .mobile-menu-toggle:hover {
        transform: scale(1.1) !important;
        transition: transform 0.2s ease !important;
        background: rgba(255, 0, 0, 0.2) !important; /* Red background on hover */
    }
    
    .mobile-menu-toggle:active {
        transform: scale(0.9) !important;
        transition: transform 0.1s ease !important;
        background: rgba(255, 0, 0, 0.3) !important; /* Red background on click */
    }
    
    /* Change any brown colors to YouTube red */
    .mobile-menu-toggle * {
        color: #FF0000 !important; /* YouTube Red for any text */
    }
    
    .mobile-menu-toggle:hover * {
        color: #FF0000 !important; /* YouTube Red on hover */
    }
    
    .mobile-menu-toggle:active * {
        color: #FF0000 !important; /* YouTube Red on click */
    }
}

/* Comprehensive Hamburger Menu Color Override - YouTube Red */
@media (max-width: 1200px) {
    /* Override any brown colors in hamburger menu */
    .mobile-menu-toggle,
    .mobile-menu-toggle *,
    .hamburger-line,
    .hamburger-line::before,
    .hamburger-line::after {
        color: #FF0000 !important; /* YouTube Red for text */
        border-color: #FF0000 !important; /* YouTube Red for borders */
    }
    
    /* Override any existing brown/other colors */
    .mobile-menu-toggle[style*="brown"],
    .mobile-menu-toggle[style*="#8B4513"],
    .mobile-menu-toggle[style*="#A0522D"],
    .mobile-menu-toggle[style*="#D2691E"],
    .mobile-menu-toggle[style*="#CD853F"],
    .mobile-menu-toggle[style*="#BC8F8F"],
    .mobile-menu-toggle[style*="#DEB887"] {
        color: #FF0000 !important;
        background: rgba(255, 0, 0, 0.1) !important;
    }
    
    /* Force YouTube red on all states */
    .mobile-menu-toggle:not(:hover):not(:active) {
        color: #FF0000 !important;
    }
    
    .mobile-menu-toggle:hover {
        color: #FF0000 !important;
        background: rgba(255, 0, 0, 0.15) !important;
    }
    
    .mobile-menu-toggle:active {
        color: #FF0000 !important;
        background: rgba(255, 0, 0, 0.25) !important;
    }
}

/* Desktop Scroll Up Button - Big Rectangular 160x160px */
@media (min-width: 769px) {
    #scrollUp {
        background: #FF0000 !important; /* YouTube Red */
        width: 160px !important; /* Exactly 160px width */
        height: 160px !important; /* Exactly 160px height */
        min-width: 160px !important; /* Prevent shrinking */
        min-height: 160px !important; /* Prevent shrinking */
        max-width: 160px !important; /* Prevent growing */
        max-height: 160px !important; /* Prevent growing */
        border-radius: 0 !important; /* Perfect rectangle */
        box-shadow: 0px 6px 25px rgba(255, 0, 0, 0.5) !important;
        border: 2px solid rgba(255, 255, 255, 0.3) !important;
        transition: opacity 0.1s ease, transform 0.1s ease !important; /* Faster transitions */
        opacity: 0;
        transform: translateY(20px);
        position: fixed !important;
        right: 20px !important;
        bottom: 20px !important;
        z-index: 2147483647 !important;
        display: none !important;
        cursor: pointer !important;
        text-decoration: none !important;
        outline: none !important;
    }
    
    #scrollUp:hover {
        background: #CC0000 !important; /* Darker red on hover */
        box-shadow: 0px 8px 30px rgba(255, 0, 0, 0.7) !important;
        transform: translateY(0) scale(1.05) !important;
    }
    
    #scrollUp span {
        width: 160px !important;
        height: 160px !important;
        min-width: 160px !important;
        min-height: 160px !important;
        max-width: 160px !important;
        max-height: 160px !important;
        line-height: 160px !important;
        border-radius: 0 !important; /* Perfect rectangle */
        font-size: 48px !important;
        display: block !important;
        text-align: center !important;
    }
    
    #scrollUp i {
        font-size: 48px !important;
        color: #fff !important;
        line-height: 160px !important;
    }
}

/* Hide desktop scroll up on mobile */
@media (max-width: 768px) {
    #scrollUp {
        display: none !important;
    }
}

/* Desktop scroll up button positioning - handled in main rule above */

/* Hide CTA Overlay on Mobile and Tablet */
@media (max-width: 1024px) {
    .cta-overlay {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        pointer-events: none !important;
    }
}

/* Reduce About Section Title Font Size on Mobile - Override Inline Styles */
@media (max-width: 768px) {
    .about-hero h1[class*="display-3"][style*="letter-spacing:2px"] {
        font-size: 0.8rem !important; /* Override inline styles */
        letter-spacing: 0.3px !important;
        line-height: 1.0 !important;
        max-width: 100% !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        transform: none !important;
        transition: none !important;
        animation: none !important;
    }
    
    /* Alternative selectors for maximum coverage */
    .about-hero .container h1,
    .about-hero .container .display-3,
    .about-hero h1.display-3,
    .about-hero .display-3.text-white.font-weight-bold {
        font-size: 0.8rem !important;
        letter-spacing: 0.3px !important;
        line-height: 1.0 !important;
        max-width: 100% !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
    }
}
    
    .lead.text-white {
        font-size: 1rem !important; /* Further reduced for better mobile fit */
        max-width: 95% !important; /* Better fit on mobile */
        padding: 0 10px !important; /* Add some padding */
        display: none !important; /* Hide paragraph on mobile/tablet */
    }
}

@media (max-width: 480px) {
    .about-hero .display-3.text-white.font-weight-bold,
    .about-hero h1.display-3.text-white.font-weight-bold,
    .about-hero .container .display-3.text-white.font-weight-bold,
    .about-hero .container h1.display-3.text-white.font-weight-bold {
        font-size: 0.7rem !important; /* Fixed size - no clamp */
        letter-spacing: 0.2px !important;
        line-height: 1.0 !important;
        max-width: 100% !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        transform: none !important;
        transition: none !important;
        animation: none !important;
    }
}
    
    .lead.text-white {
        font-size: 0.9rem !important; /* Further reduced for small mobile */
        max-width: 98% !important; /* Better fit on small screens */
        padding: 0 5px !important; /* Minimal padding */
        display: none !important; /* Hide paragraph on mobile/tablet */
    }
}

@media (max-width: 360px) {
    .about-hero .display-3.text-white.font-weight-bold,
    .about-hero h1.display-3.text-white.font-weight-bold,
    .about-hero .container .display-3.text-white.font-weight-bold,
    .about-hero .container h1.display-3.text-white.font-weight-bold {
        font-size: 0.6rem !important; /* Fixed size - no clamp */
        letter-spacing: 0.1px !important;
        line-height: 1.0 !important;
        max-width: 100% !important;
        white-space: nowrap !important;
        overflow: hidden !important;
        text-overflow: ellipsis !important;
        transform: none !important;
        transition: none !important;
        animation: none !important;
    }
}
    
    .lead.text-white {
        font-size: 0.8rem !important; /* Very small for tiny screens */
        max-width: 99% !important; /* Almost full width */
        padding: 0 3px !important; /* Minimal padding for tiny screens */
        line-height: 1.3 !important; /* Better line height for readability */
        display: none !important; /* Hide paragraph on mobile/tablet */
    }
}
</style>

<script>
// Desktop and Mobile Scroll Up Buttons
document.addEventListener('DOMContentLoaded', function() {
    // Wait for preloader to finish before initializing scroll up buttons
    setTimeout(function() {
        initDesktopScrollUpButton();
        initMobileScrollUpButton();
    }, 2500); // Wait 2.5 seconds for preloader
});

// Desktop Scroll Up Button - Big Rectangular 160x160px, optimized performance
function initDesktopScrollUpButton() {
    // Only apply to desktop
    if (window.innerWidth <= 768) return;
    
    const desktopScrollUp = document.getElementById('scrollUp');
    if (!desktopScrollUp) return;
    
    let isVisible = false;
    let isScrolling = false;
    const scrollDistance = 300;
    
    // Throttled scroll handler for better performance
    function handleDesktopScroll() {
        if (isScrolling) return;
        isScrolling = true;
        
        requestAnimationFrame(() => {
            // Only apply to desktop
            if (window.innerWidth <= 768) {
                isScrolling = false;
                return;
            }
            
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > scrollDistance) {
                if (!isVisible) {
                    isVisible = true;
                    desktopScrollUp.style.display = 'block';
                    // Force reflow
                    desktopScrollUp.offsetHeight;
                    desktopScrollUp.style.opacity = '1';
                    desktopScrollUp.style.transform = 'translateY(0)';
                }
            } else {
                if (isVisible) {
                    isVisible = false;
                    desktopScrollUp.style.opacity = '0';
                    desktopScrollUp.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        if (!isVisible) {
                            desktopScrollUp.style.display = 'none';
                        }
                    }, 100); // Faster hide
                }
            }
            
            isScrolling = false;
        });
    }
    
    // Optimized click functionality - instant scroll to top
    desktopScrollUp.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Instant scroll to top for better performance
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Add optimized scroll listener
    window.addEventListener('scroll', handleDesktopScroll, { passive: true });
    
    // Throttled resize handler
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            if (window.innerWidth <= 768) {
                // Hide on mobile
                desktopScrollUp.style.display = 'none';
                isVisible = false;
            } else {
                // Re-check on desktop
                handleDesktopScroll();
            }
        }, 100);
    });
    
    // Initial check
    handleDesktopScroll();
}

function initMobileScrollUpButton() {
    // Only apply to mobile/tablet
    if (window.innerWidth > 768) return;
    
    // Create mobile scroll up button
    let mobileScrollUp = document.getElementById('mobileScrollUp');
    if (!mobileScrollUp) {
        mobileScrollUp = document.createElement('a');
        mobileScrollUp.id = 'mobileScrollUp';
        mobileScrollUp.href = '#top';
        mobileScrollUp.innerHTML = '<span><i class="fa fa-angle-up"></i></span>';
        mobileScrollUp.setAttribute('title', 'Scroll to top');
        document.body.appendChild(mobileScrollUp);
    }
    
    // Apply optimized mobile styles
    mobileScrollUp.style.position = 'fixed';
    mobileScrollUp.style.right = '15px';
    mobileScrollUp.style.bottom = '20px';
    mobileScrollUp.style.zIndex = '2147483647';
    mobileScrollUp.style.display = 'none';
    mobileScrollUp.style.cursor = 'pointer';
    mobileScrollUp.style.transition = 'opacity 0.1s ease, transform 0.1s ease'; // Faster transitions
    mobileScrollUp.style.textDecoration = 'none';
    mobileScrollUp.style.outline = 'none';
    mobileScrollUp.style.willChange = 'opacity, transform'; // Optimize for animations
    
    // Style the span and icon - Rounded
    const span = mobileScrollUp.querySelector('span');
    const icon = mobileScrollUp.querySelector('i');
    
    if (span) {
        span.style.display = 'block';
        span.style.height = '50px';
        span.style.width = '50px';
        span.style.lineHeight = '50px';
        span.style.background = '#FF0000'; // YouTube Red
        span.style.color = '#fff';
        span.style.borderRadius = '50%'; // Rounded
        span.style.boxShadow = '0px 6px 25px rgba(255, 0, 0, 0.5)';
        span.style.border = '2px solid rgba(255, 255, 255, 0.3)';
        span.style.textAlign = 'center';
        span.style.fontSize = '20px';
        span.style.transition = 'transform 0.1s ease, background 0.1s ease'; // Faster transitions
        span.style.willChange = 'transform, background'; // Optimize for animations
    }
    
    if (icon) {
        icon.style.color = '#fff';
        icon.style.fontSize = '20px';
    }
    
    // Optimized scroll functionality
    let isVisible = false;
    let isScrolling = false;
    const scrollDistance = 300;
    
    function handleScroll() {
        if (isScrolling) return;
        isScrolling = true;
        
        requestAnimationFrame(() => {
            // Only apply to mobile/tablet
            if (window.innerWidth > 768) {
                isScrolling = false;
                return;
            }
            
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > scrollDistance) {
                if (!isVisible) {
                    isVisible = true;
                    mobileScrollUp.style.display = 'block';
                    // Force reflow
                    mobileScrollUp.offsetHeight;
                    mobileScrollUp.style.opacity = '1';
                    mobileScrollUp.style.transform = 'translateY(0)';
                }
            } else {
                if (isVisible) {
                    isVisible = false;
                    mobileScrollUp.style.opacity = '0';
                    mobileScrollUp.style.transform = 'translateY(20px)';
                    setTimeout(() => {
                        if (!isVisible) {
                            mobileScrollUp.style.display = 'none';
                        }
                    }, 100); // Faster hide
                }
            }
            
            isScrolling = false;
        });
    }
    
    // Optimized click functionality - instant scroll
    mobileScrollUp.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Use native smooth scroll for better performance
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Touch events for better mobile support
    mobileScrollUp.addEventListener('touchstart', function(e) {
        if (span) {
            span.style.transform = 'scale(0.95)';
            span.style.background = '#CC0000';
            span.style.transition = 'all 0.1s ease';
        }
    });
    
    mobileScrollUp.addEventListener('touchend', function(e) {
        if (span) {
            span.style.transform = 'scale(1)';
            span.style.background = '#FF0000';
            span.style.transition = 'all 0.15s ease';
        }
    });
    
    // Add scroll listener
    window.addEventListener('scroll', handleScroll, { passive: true });
    
    // Throttled resize handler
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            if (window.innerWidth > 768) {
                // Hide on desktop
                mobileScrollUp.style.display = 'none';
                isVisible = false;
            } else {
                // Re-check on mobile
                handleScroll();
            }
        }, 100);
    });
    
    // Initial check
    handleScroll();
}
</script>
        <link rel="stylesheet" href="{{ asset('css/mobile-cards-enhancement.css') }}">
        <link rel="stylesheet" href="{{ asset('css/projects-products-mobile-enhancement.css') }}">
        <link rel="stylesheet" href="{{ asset('css/hero-titles-mobile.css') }}">
        <link rel="stylesheet" href="{{ asset('css/enhanced-mobile-cards.css') }}">

<!-- Mobile Menu Z-Index Override: ensure it overlays everything -->
<style>
/* Force mobile menu and overlay above any UI (scrollUp, modals, etc.) */
.mobile-menu {
    z-index: 2147483648 !important; /* Above any existing UI including #scrollUp */
    position: fixed !important; /* Escape any ancestor positioning */
    pointer-events: auto !important; /* Menu remains interactive */
    height: 100vh !important; /* Its own scroll context */
    overflow-y: auto !important; /* Scroll inside menu */
}
.mobile-menu.active { left: 0 !important; }
.mobile-overlay {
    z-index: 2147483647 !important; /* Below menu, above page */
    position: fixed !important;
    top: 0; left: 0; right: 0; bottom: 0;
    pointer-events: none !important; /* Default non-blocking */
    background: transparent !important; /* No shade until active */
}
.mobile-overlay.active {
    pointer-events: none !important; /* keep non-blocking even when active */
    background: transparent !important; /* Fully transparent when active */
}

/* Lower z-index of scroll-to-top buttons so overlay/menu stay on top */
#mobileScrollUp {
    z-index: 2147483645 !important;
}
#scrollUp {
    z-index: 2147483645 !important;
}
</style>

<!-- Scroll lock styles for mobile menu -->
<style>
/* Prevent background scroll when menu is open */
.is-locked {
    overflow: hidden !important;
    touch-action: none !important;
}
</style>

<!-- Mobile Menu Width Override - SENIOR LEVEL NUCLEAR OPTION -->
<style>
/* Make the ACTUAL mobile menu responsive */
.mobile-menu {
    width: 600px !important;
    max-width: 600px !important;
    min-width: 600px !important;
}
@media (max-width: 991px) {
    .mobile-menu {
        width: 100vw !important;
        max-width: 100vw !important;
        min-width: 100vw !important;
    }
}

.mobile-menu-content {
    max-height: 100vh !important;
    overflow-y: auto !important;
    overflow-x: visible !important;
}

.mobile-nav-list {
    overflow: visible !important;
    max-height: none !important;
}

.mobile-menu.active {
    transform: translateX(0) !important;
}

/* Make mobile menu buttons smaller */
.mobile-nav-link {
    padding: 15px 20px !important;
    font-size: 16px !important;
    font-weight: 500 !important;
    min-height: 50px !important;
    display: flex !important;
    align-items: center !important;
}

.mobile-nav-link i {
    font-size: 18px !important;
    margin-right: 12px !important;
}

.mobile-nav-link span {
    font-size: 16px !important;
}

/* Make dropdown links smaller */
.mobile-dropdown-link {
    padding: 12px 25px !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    min-height: 45px !important;
    display: flex !important;
    align-items: center !important;
}

.mobile-dropdown-link img {
    width: 16px !important;
    height: 16px !important;
    margin-right: 10px !important;
}

.mobile-dropdown-link span {
    font-size: 14px !important;
}

.mobile-dropdown-link i {
    font-size: 12px !important;
    margin-left: auto !important;
}

/* Fix dropdown menu overflow - but keep closed by default */
.mobile-dropdown-menu {
    max-height: 0 !important;
    overflow: hidden !important;
    transition: max-height 0.3s ease !important;
}

.mobile-dropdown-item {
    overflow: visible !important;
}

.mobile-dropdown-item .mobile-dropdown-menu {
    max-height: none !important;
    overflow: visible !important;
    height: auto !important;
}

/* When dropdown is open, show all items */
.mobile-dropdown-item.open .mobile-dropdown-menu,
.mobile-dropdown-item[aria-expanded="true"] .mobile-dropdown-menu,
.mobile-dropdown-menu.show {
    max-height: 1000px !important;
    overflow: visible !important;
}

/* Make auth buttons smaller */
.mobile-auth-link {
    padding: 12px 20px !important;
    font-size: 14px !important;
    font-weight: 600 !important;
    min-height: 45px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
}

.mobile-auth-link i {
    font-size: 16px !important;
    margin-right: 8px !important;
}

.mobile-auth-link span {
    font-size: 14px !important;
}

/* Make dropdown triggers smaller */
.mobile-dropdown-trigger {
    padding: 15px 20px !important;
    font-size: 16px !important;
    font-weight: 500 !important;
    min-height: 50px !important;
}

.mobile-dropdown-label {
    font-size: 16px !important;
}

.mobile-dropdown-label i {
    font-size: 18px !important;
    margin-right: 12px !important;
}

.mobile-dropdown-label span {
    font-size: 16px !important;
}

/* Make language switch buttons smaller */
.mobile-lang-dropdown .mobile-dropdown-trigger {
    padding: 15px 20px !important;
    font-size: 16px !important;
    font-weight: 600 !important;
    min-height: 50px !important;
}

.mobile-lang-dropdown .mobile-dropdown-label {
    font-size: 16px !important;
}

.mobile-lang-dropdown .mobile-dropdown-label img {
    width: 20px !important;
    height: 15px !important;
    margin-right: 10px !important;
}

.mobile-lang-dropdown .mobile-dropdown-label span {
    font-size: 16px !important;
}

.mobile-lang-dropdown .mobile-dropdown-link {
    padding: 12px 25px !important;
    font-size: 14px !important;
    font-weight: 500 !important;
    min-height: 45px !important;
    display: flex !important;
    align-items: center !important;
}

.mobile-lang-dropdown .mobile-dropdown-link img {
    width: 16px !important;
    height: 12px !important;
    margin-right: 10px !important;
}

.mobile-lang-dropdown .mobile-dropdown-link span {
    font-size: 14px !important;
}

    .mobile-lang-dropdown .mobile-dropdown-link i {
        font-size: 12px !important;
        margin-left: auto !important;
    }

    /* Mobile Touch Scrolling Fix - No Viewport Needed */
    @media (max-width: 768px) {
        html, body {
            -webkit-overflow-scrolling: touch !important;
            overflow-x: hidden !important;
            overflow-y: auto !important;
            touch-action: pan-y !important;
            overscroll-behavior: none !important;
            scroll-behavior: smooth !important;
            -webkit-text-size-adjust: 100% !important;
            -ms-text-size-adjust: 100% !important;
        }
        
        * {
            -webkit-overflow-scrolling: touch !important;
            touch-action: manipulation !important;
        }
        
        /* Ensure all scrollable elements work smoothly */
        .container, .row, .col, section, div {
            -webkit-overflow-scrolling: touch !important;
            scroll-behavior: smooth !important;
        }
        
        /* Fix for any fixed positioned elements */
        .fixed, [style*="position: fixed"] {
            -webkit-transform: translateZ(0) !important;
            transform: translateZ(0) !important;
        }
        
        /* Prevent scroll blocking */
        .modal, .popup, .overlay {
            touch-action: pan-y !important;
            -webkit-overflow-scrolling: touch !important;
        }
        
        /* Fix for mobile browsers */
        body {
            position: relative !important;
            height: auto !important;
            min-height: 100vh !important;
        }
    }
    </style>

<!-- CONFLICTING 2-COLUMN GRID STYLES REMOVED - SINGLE COLUMN LAYOUT ENFORCED -->
<style>



<script src="{{ asset('frontend/js/script.js') }}"></script>

<!-- iOS/Safari viewport height fix -->
<script>
// Set --vh to account for iOS dynamic toolbars
(function() {
    function setDocVh() {
        var vh = window.innerHeight * 0.01;
        document.documentElement.style.setProperty('--vh', vh + 'px');
    }
    setDocVh();
    window.addEventListener('resize', setDocVh);
    window.addEventListener('orientationchange', setDocVh);
    window.addEventListener('pageshow', setDocVh);
})();
</script>

<style>
    /* Multilevel dropdown */
    .dropdown-submenu {
    position: relative;
    }

    .dropdown-submenu>a:after {
    content: "\f0da";
    float: right;
    border: none;
    font-family: 'FontAwesome';
    }

    .dropdown-submenu>.dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: 0px;
    margin-left: 0px;
    }

    /*
</style>
@stack('styles')

<style>
/* Global Sticky Social Media Sidebar */
.social-sidebar {
    position: fixed;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1000;
    background: rgba(255, 255, 255, 0.95);
    border-radius: 0 15px 15px 0;
    box-shadow: 2px 0 15px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.social-sidebar:hover {
    background: rgba(255, 255, 255, 1);
    box-shadow: 2px 0 20px rgba(0, 0, 0, 0.25);
    transform: translateY(-50%) translateX(5px);
}

.social-sidebar-content {
    padding: 20px 15px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.social-header {
    text-align: center;
    margin-bottom: 5px;
}

.social-header span {
    font-size: 0.8rem;
    font-weight: 600;
    color: #333;
    text-transform: uppercase;
    letter-spacing: 1px;
    writing-mode: vertical-rl;
    text-orientation: mixed;
    transform: rotate(180deg);
}

.social-icon {
    display: flex;
    align-items: center;
    justify-content: center;
}

.social-icon a {
    color: #fff;
    font-size: 1.6rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    border: 1px solid rgba(0, 0, 0, 0.1);
}

/* Instagram - Pink/Orange gradient */
.social-icon a[href*="instagram"] {
    background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
    color: #fff;
    border-color: transparent;
}

/* Facebook - Blue */
.social-icon a[href*="facebook"] {
    background: #1877f2;
    color: #fff;
    border-color: #1877f2;
}

/* TikTok - Black */
.social-icon a[href*="tiktok"] {
    background: #000;
    color: #fff;
    border-color: #000;
}

/* LinkedIn - Blue */
.social-icon a[href*="linkedin"] {
    background: #0077b5;
    color: #fff;
    border-color: #0077b5;
}

/* Email - Purple */
.social-icon a[href*="mailto"] {
    background: #8e44ad;
    color: #fff;
    border-color: #8e44ad;
}

/* WhatsApp - Green */
.social-icon a[href*="wa.me"] {
    background: #25d366;
    color: #fff;
    border-color: #25d366;
}

/* Hover effects - just scale and shadow */
.social-icon a:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}



/* Hide social sidebar on mobile and tablets */
@media (max-width: 1024px) {
    .social-sidebar {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
    }
    
    /* Force hide mobile social toggle and menu on all pages */
    .mobile-social-toggle,
    .mobile-social-menu,
    .mobile-social-overlay,
    button[class*="mobile-social"],
    div[class*="mobile-social"],
    [aria-label*="Toggle social media menu"],
    [aria-label*="social media menu"],
    button i.fa-share-alt,
    button .fas.fa-share-alt {
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
        transform: scale(0) !important;
        margin: 0 !important;
        padding: 0 !important;
        border: none !important;
        background: transparent !important;
    }
}

/* SENIOR LEVEL DROPDOWN CAPITALIZATION FIX */
/* This CSS will override ANY other CSS rules */
.dropdown-item,
.dropdown-menu a,
.dropdown-menu .dropdown-item,
.nav-item.dropdown .dropdown-menu a,
.nav-item.dropdown .dropdown-menu .dropdown-item,
.dropdown-menu a.dropdown-item,
.dropdown-menu .dropdown-item a,
.navbar .dropdown-item,
.navbar .dropdown-menu a,
.navbar .dropdown-menu .dropdown-item,
.dropdown-item.text-uppercase,
.dropdown-menu a.text-uppercase,
.dropdown-menu .dropdown-item.text-uppercase,
.navbar .dropdown-item.text-uppercase,
.navbar .dropdown-menu a.text-uppercase,
.navbar .dropdown-menu .dropdown-item.text-uppercase {
    text-transform: capitalize !important;
    font-variant: normal !important;
    text-rendering: optimizeLegibility !important;
}

/* Override any global CSS that might be affecting dropdowns */
*[class*="dropdown"] a,
*[class*="dropdown"] .dropdown-item,
.dropdown-menu *,
.nav-item.dropdown * {
    text-transform: capitalize !important;
}
</style>

<script>
// SENIOR LEVEL DROPDOWN CAPITALIZATION - ULTRA AGGRESSIVE
(function() {
    'use strict';
    
    function forceCapitalizeDropdowns() {
        // Get ALL possible dropdown elements
        const allSelectors = [
            '.dropdown-item',
            '.dropdown-menu a',
            '.dropdown-menu .dropdown-item',
            '.nav-item.dropdown .dropdown-menu a',
            '.nav-item.dropdown .dropdown-menu .dropdown-item',
            '.dropdown-menu a.dropdown-item',
            '.dropdown-menu .dropdown-item a',
            '.navbar .dropdown-item',
            '.navbar .dropdown-menu a',
            '.navbar .dropdown-menu .dropdown-item',
            'a.dropdown-item',
            '.dropdown-menu a.dropdown-item',
            '.nav-item.dropdown a',
            '.dropdown a'
        ];
        
        allSelectors.forEach(function(selector) {
            const elements = document.querySelectorAll(selector);
            elements.forEach(function(element) {
                if (element && element.textContent) {
                    // Force the style with maximum priority
                    element.style.setProperty('text-transform', 'capitalize', 'important');
                    element.style.setProperty('font-variant', 'normal', 'important');
                    element.style.setProperty('text-rendering', 'optimizeLegibility', 'important');
                    
                    // Also capitalize the text content programmatically
                    const text = element.textContent.trim();
                    if (text) {
                        // First convert to lowercase, then capitalize first letter of each word
                        const lowerText = text.toLowerCase();
                        const capitalized = lowerText.replace(/\b\w/g, function(l) {
                            return l.toUpperCase();
                        });
                        if (capitalized !== text) {
                            element.textContent = capitalized;
                        }
                    }
                }
            });
        });
    }
    
    // Run immediately when script loads
    forceCapitalizeDropdowns();
    
    // Run when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', forceCapitalizeDropdowns);
    } else {
        forceCapitalizeDropdowns();
    }
    
    // Run after a delay to catch any dynamically loaded content
    setTimeout(forceCapitalizeDropdowns, 100);
    setTimeout(forceCapitalizeDropdowns, 500);
    setTimeout(forceCapitalizeDropdowns, 1000);
    setTimeout(forceCapitalizeDropdowns, 2000);
    
    // Run when dropdowns are opened/closed
    document.addEventListener('click', function(e) {
        if (e.target.closest('.dropdown') || e.target.closest('.nav-item')) {
            setTimeout(forceCapitalizeDropdowns, 50);
        }
    });
    
    // Run when mouse hovers over dropdowns
    document.addEventListener('mouseover', function(e) {
        if (e.target.closest('.dropdown') || e.target.closest('.nav-item')) {
            setTimeout(forceCapitalizeDropdowns, 10);
        }
    });
    
    // Run periodically to catch any changes
    setInterval(forceCapitalizeDropdowns, 3000);
    
    // Run when window gains focus (in case of tab switching)
    window.addEventListener('focus', forceCapitalizeDropdowns);
    
})();

// ULTRA AGGRESSIVE DROPDOWN WIDTH OVERRIDE
(function() {
    function forceWideDropdowns() {
        const dropdowns = document.querySelectorAll('.dropdown-menu, .dropdown-content');
        dropdowns.forEach(dropdown => {
            dropdown.style.minWidth = '500px !important';
            dropdown.style.width = '500px !important';
            dropdown.style.maxWidth = '500px !important';
            dropdown.style.padding = '25px 0 !important';
        });
        
        // Also target the links inside dropdown-content
        const dropdownLinks = document.querySelectorAll('.dropdown-content a');
        dropdownLinks.forEach(link => {
            link.style.padding = '20px 40px !important';
            link.style.display = 'block !important';
            link.style.marginBottom = '12px !important';
        });
    }
    
    // Run immediately
    forceWideDropdowns();
    
    // Run on DOM changes
    const observer = new MutationObserver(forceWideDropdowns);
    observer.observe(document.body, { childList: true, subtree: true });
    
    // Run on hover
    document.addEventListener('mouseover', function(e) {
        if (e.target.closest('.dropdown') || e.target.closest('.nav-item')) {
            setTimeout(forceWideDropdowns, 10);
        }
    });
    
    // Run periodically
    setInterval(forceWideDropdowns, 1000);
})();

</script>

<style>
/* ULTRA AGGRESSIVE DROPDOWN WIDTH OVERRIDE */
.dropdown-menu,
.dropdown-content {
    min-width: 500px !important;
    width: 500px !important;
    max-width: 500px !important;
}

.nav-item.dropdown .dropdown-menu,
.dropdown .dropdown-content {
    min-width: 500px !important;
    width: 500px !important;
    max-width: 500px !important;
}

.dropdown-menu[aria-labelledby="projectsDropdown"],
.dropdown-menu[aria-labelledby="productsDropdown"],
.dropdown-content {
    min-width: 500px !important;
    width: 500px !important;
    max-width: 500px !important;
}

/* TARGET THE ACTUAL RENDERED CLASSES */
.dropdown .dropdown-content {
    min-width: 500px !important;
    width: 500px !important;
    max-width: 500px !important;
    padding: 25px 0 !important;
}

/* ENHANCED DROPDOWN ANIMATION */
.dropdown-content a {
    padding: 20px 40px !important;
    display: block !important;
    margin-bottom: 12px !important;
    position: relative !important;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
    border-left: 4px solid transparent !important;
    overflow: hidden !important;
}

.dropdown-content a::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(220, 53, 69, 0.1), transparent);
    transition: left 0.6s ease;
    z-index: 0;
}

.dropdown-content a:hover {
    background: linear-gradient(90deg, #dc3545 0%, #dc3545 8px, rgba(220, 53, 69, 0.05) 8px) !important;
    border-left: 8px solid #dc3545 !important;
    border-right: 8px solid #dc3545 !important;
    margin-right: 8px !important;
    transform: translateX(8px) scale(1.02) !important;
    color: #dc3545 !important;
    box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2) !important;
}

.dropdown-content a:hover::before {
    left: 100%;
}

</style>

<script>
// FINAL CAPITALIZATION FIX
document.addEventListener('DOMContentLoaded', function() {
    function fixAllText() {
        // Fix all dropdown content
        const allLinks = document.querySelectorAll('.dropdown-content a, .dropdown-item, .mobile-dropdown-link');
        allLinks.forEach(function(link) {
            const text = link.textContent.trim();
            if (text && text !== 'Tous' && text !== 'All' && /[a-z].*[A-Z]|[A-Z].*[a-z]/.test(text)) {
                const words = text.split(' ');
                const fixed = words.map(word => {
                    return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
                }).join(' ');
                link.textContent = fixed;
            }
        });
    }
    
    // Run multiple times to be sure
    setTimeout(fixAllText, 100);
    setTimeout(fixAllText, 500);
});
</script>

