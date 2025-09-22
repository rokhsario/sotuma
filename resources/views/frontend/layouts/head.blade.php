<!-- Meta Tag -->
@yield('meta')
<!-- Title Tag  -->
<title>@yield('title')</title>
<!-- Favicon -->
<link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}?v=1">
<link rel="icon" type="image/x-icon" href="{{ asset('images/favicon-new.ico') }}?v=1">
<!-- Web Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

<!-- StyleSheet -->
<link rel="manifest" href="/manifest.json">
<!-- Bootstrap -->
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.css')}}">
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

<!-- SENIOR LEVEL MOBILE OVERRIDE - NUCLEAR OPTION -->
<style>
/* Force ALL grids to 2 columns on tablet and below - MAXIMUM SPECIFICITY */
@media (max-width: 1200px) {
    *[class*="grid"] {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 25px !important;
    }
    
    .products-grid,
    .project-info-container,
    .categories-grid,
    .aluprof-category-grid,
    .main-content .products-grid,
    .main-content .project-info-container,
    .main-content .categories-grid,
    .main-content .aluprof-category-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 25px !important;
        display: grid !important;
    }
    
    /* Special override for auto-fit grids */
    [style*="repeat(auto-fit"],
    [style*="repeat(auto-fit"],
    .products-grid[style*="auto-fit"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    
    /* Override any inline styles */
    [style*="grid-template-columns"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}

/* Force ALL grids to 2 columns on mobile - MAXIMUM SPECIFICITY */
@media (max-width: 768px) {
    *[class*="grid"] {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 20px !important;
    }
    
    .products-grid,
    .project-info-container,
    .categories-grid,
    .aluprof-category-grid,
    .main-content .products-grid,
    .main-content .project-info-container,
    .main-content .categories-grid,
    .main-content .aluprof-category-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 20px !important;
        display: grid !important;
    }
    
    /* Special override for auto-fit grids */
    [style*="repeat(auto-fit"],
    [style*="repeat(auto-fit"],
    .products-grid[style*="auto-fit"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    
    /* Override any inline styles */
    [style*="grid-template-columns"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
}

@media (max-width: 480px) {
    *[class*="grid"] {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 15px !important;
    }
    
    .products-grid,
    .project-info-container,
    .categories-grid,
    .aluprof-category-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 15px !important;
    }
}

/* Debug indicators removed */

/* NUCLEAR OPTION: Force products grid to 2 columns */
@media (max-width: 1200px) {
    .products-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 25px !important;
    }
    
    /* Override any auto-fit in products grid */
    .products-grid[style*="auto-fit"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    
    /* Force all products grid children to half width */
    .products-grid > * {
        width: 100% !important;
        max-width: 100% !important;
    }
}

@media (max-width: 768px) {
    .products-grid {
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 20px !important;
    }
    
    /* Override any auto-fit in products grid */
    .products-grid[style*="auto-fit"] {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    
    /* Force all products grid children to half width */
    .products-grid > * {
        width: 100% !important;
        max-width: 100% !important;
    }
}

/* ===== RESPONSIVE HEADER SIDEBAR ===== */
/* Tablet and below - show sidebar */
@media (max-width: 1200px) {
    /* Show mobile menu toggle */
    .mobile-menu-toggle {
        display: flex !important;
    }
    
    /* Hide desktop navigation */
    .nav-menu {
        display: none !important;
    }
    
    /* Hide desktop auth */
    .nav-auth {
        display: none !important;
    }
    
    /* Adjust logo size for tablet */
    .logo img {
        height: 120px !important;
        max-width: 400px !important;
    }
    
    /* Adjust nav container padding */
    .nav-container {
        padding: 0 15px !important;
    }
}

@media (max-width: 768px) {
    /* Further adjust logo for mobile */
    .logo img {
        height: 80px !important;
        max-width: 250px !important;
    }
    
    /* Adjust mobile sidebar width */
    .mobile-sidebar {
        width: 280px !important;
    }
}

@media (max-width: 480px) {
    /* Mobile sidebar full width on small screens */
    .mobile-sidebar {
        width: 100% !important;
    }
    
    /* Smaller logo for small mobile */
    .logo img {
        height: 60px !important;
        max-width: 200px !important;
    }
}

/* Hamburger animation */
.mobile-menu-toggle.active .hamburger-line:nth-child(1) {
    transform: rotate(-45deg) translate(-5px, 6px);
}

.mobile-menu-toggle.active .hamburger-line:nth-child(2) {
    opacity: 0;
}

.mobile-menu-toggle.active .hamburger-line:nth-child(3) {
    transform: rotate(45deg) translate(-5px, -6px);
}

/* Sidebar animations */
.mobile-sidebar.active {
    left: 0 !important;
}

.mobile-sidebar-overlay.active {
    display: block !important;
}

/* Prevent body scroll when sidebar is open */
body.sidebar-open {
    overflow: hidden;
}

/* ULTRA-AGGRESSIVE PRODUCTS GRID OVERRIDE */
@media (max-width: 1200px) {
    .products-grid,
    .products-grid[style*="auto-fit"],
    .products-grid[style*="minmax(250px"],
    .products-grid[style*="minmax(300px"],
    .products-grid[style*="repeat(4, 1fr)"],
    .products-grid[style*="repeat(3, 1fr)"],
    .products-grid[style*="repeat(2, 1fr)"] {
        grid-template-columns: 1fr !important;
        gap: 25px !important;
    }
    
    .products-grid > * {
        width: 100% !important;
        max-width: 100% !important;
        flex: none !important;
    }
}
</style>



<script src="{{ asset('frontend/js/script.js') }}"></script>

<!-- SENIOR LEVEL MOBILE FORCE SCRIPT -->
<script>
(function() {
    'use strict';
    
    // Senior level debugging and force function
    function forceMobileLayout() {
        const isMobile = window.innerWidth <= 768;
        const isTablet = window.innerWidth <= 1200 && window.innerWidth > 768;
        const isTabletOrMobile = window.innerWidth <= 1200;
        
        // Debug logging removed
        
        if (isTabletOrMobile) {
            // Find ALL grid elements (excluding media grids)
            const gridSelectors = [
                '.products-grid',
                '.project-info-container', 
                '.categories-grid',
                '.aluprof-category-grid',
                '[class*="grid"]:not(.tiktok-feed-grid)'
            ];
            
            let gridsFound = 0;
            let gridsForced = 0;
            
            gridSelectors.forEach(selector => {
                const grids = document.querySelectorAll(selector);
                grids.forEach(grid => {
                    gridsFound++;
                    
                    // Check if this is a products grid with auto-fit
                    const isProductsGrid = grid.classList.contains('products-grid');
                    const hasAutoFit = grid.style.gridTemplateColumns && grid.style.gridTemplateColumns.includes('auto-fit');
                    
                    // Remove any existing inline styles
                    grid.style.removeProperty('grid-template-columns');
                    grid.style.removeProperty('grid-template-rows');
                    
                    // Force 2 columns with special handling for products grid
                    if (isProductsGrid) {
                        // Force 2 columns - no auto-fit on tablet/mobile
                        grid.style.setProperty('grid-template-columns', 'repeat(2, 1fr)', 'important');
                    } else {
                        grid.style.setProperty('grid-template-columns', 'repeat(2, 1fr)', 'important');
                    }
                    
                    // Set gap based on screen size
                    const gap = isMobile ? '20px' : '25px';
                    grid.style.setProperty('gap', gap, 'important');
                    grid.style.setProperty('display', 'grid', 'important');
                    
                    // Add tracking attribute
                    grid.setAttribute('data-mobile-forced', 'true');
                    
                    gridsForced++;
                });
            });
            
            // Handle media grids with flexbox for proper centering
            const mediaGrids = document.querySelectorAll('.tiktok-feed-grid');
            mediaGrids.forEach(grid => {
                // Remove any existing inline styles
                grid.style.removeProperty('grid-template-columns');
                grid.style.removeProperty('display');
                
                // Force flexbox with centered layout
                grid.style.setProperty('display', 'flex', 'important');
                grid.style.setProperty('flex-wrap', 'wrap', 'important');
                grid.style.setProperty('justify-content', 'center', 'important');
                grid.style.setProperty('gap', '15px', 'important');
                
                // Set items to 45% width for 2 columns
                const items = grid.querySelectorAll('.tiktok-feed-item');
                items.forEach(item => {
                    item.style.setProperty('width', '45%', 'important');
                    item.style.setProperty('max-width', '45%', 'important');
                    item.style.setProperty('flex', '0 0 45%', 'important');
                });
                
                grid.setAttribute('data-mobile-forced', 'true');
            });
            
            // Visual debugging removed
        }
    }
    
    // Run immediately
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', forceMobileLayout);
    } else {
        forceMobileLayout();
    }
    
    // Run on resize
    let resizeTimeout;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(forceMobileLayout, 100);
    });
    
    // Run every 500ms for first 5 seconds to catch any late-loading content
    let interval = setInterval(forceMobileLayout, 500);
    setTimeout(() => clearInterval(interval), 5000);
    
    // Expose function globally for debugging
    window.SOTUMAMobileForce = forceMobileLayout;
    
})();

// ===== RESPONSIVE HEADER SIDEBAR FUNCTIONALITY =====
(function() {
    'use strict';
    
    function initSidebar() {
        const menuToggle = document.querySelector('.mobile-menu-toggle');
        const sidebar = document.querySelector('.mobile-sidebar');
        const overlay = document.querySelector('.mobile-sidebar-overlay');
        const closeBtn = document.querySelector('.sidebar-close');
        const body = document.body;
        
        if (!menuToggle || !sidebar || !overlay) {
            return;
        }
        
        function openSidebar() {
            sidebar.classList.add('active');
            overlay.classList.add('active');
            menuToggle.classList.add('active');
            body.classList.add('sidebar-open');
            // Sidebar opened
        }
        
        function closeSidebar() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            menuToggle.classList.remove('active');
            body.classList.remove('sidebar-open');
            // Sidebar closed
        }
        
        // Toggle sidebar
        menuToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            if (sidebar.classList.contains('active')) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });
        
        // Close sidebar
        closeBtn.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);
        
        // Close on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                closeSidebar();
            }
        });
        
        // Close on window resize to desktop
        window.addEventListener('resize', function() {
            if (window.innerWidth > 1200 && sidebar.classList.contains('active')) {
                closeSidebar();
            }
        });
        
        // Close sidebar when clicking on sidebar links
        const sidebarLinks = sidebar.querySelectorAll('a');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                setTimeout(closeSidebar, 100); // Small delay for better UX
            });
        });
        
        // Sidebar functionality initialized
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initSidebar);
    } else {
        initSidebar();
    }
    
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

/* Email - Red */
.social-icon a[href*="mailto"] {
    background: #ea4335;
    color: #fff;
    border-color: #ea4335;
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



/* Responsive for sidebar */
@media (max-width: 768px) {
    .social-sidebar {
        left: -70px;
        transition: left 0.3s ease;
    }
    
    .social-sidebar:hover {
        left: 0;
        transform: translateY(-50%);
    }
    
    .social-sidebar-content {
        padding: 15px 12px;
        gap: 12px;
    }
    
    .social-icon a {
        font-size: 1.4rem;
        width: 40px;
        height: 40px;
    }
    
    .social-header span {
        font-size: 0.7rem;
    }
}

@media (max-width: 480px) {
    .social-sidebar {
        left: -65px;
    }
    
    .social-icon a {
        font-size: 1.3rem;
        width: 35px;
        height: 35px;
    }
}
</style>
