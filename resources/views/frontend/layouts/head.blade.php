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



<script src="{{ asset('frontend/js/script.js') }}"></script>
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
