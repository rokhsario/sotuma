<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
	@include('frontend.layouts.head')	
</head>
<body class="js">
	
    <!-- Google Tag Manager (noscript) -->
    @if(config('services.google_tag_manager_id'))
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id={{ config('services.google_tag_manager_id') }}"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    @endif
    <!-- End Google Tag Manager (noscript) -->
    
    <!-- Preloader (desktop only) -->
    <div class="preloader d-none d-lg-flex">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <div class="sotuma-logo">
                    <span class="letter">S</span>
                    <span class="letter">O</span>
                    <span class="letter">T</span>
                    <span class="letter">U</span>
                    <span class="letter">M</span>
                    <span class="letter">A</span>
                </div>
                <div class="loading-dots">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
    <!-- End Preloader -->
	
	@include('frontend.layouts.notification')
	
	<!-- Global Sticky Social Media Sidebar -->
	<div class="social-sidebar">
		<div class="social-sidebar-content">
			<div class="social-header">
				<span>{{ __('frontend.follow_us') }}</span>
			</div>
			<div class="social-icon">
				<a href="https://www.instagram.com/sotuma_aluminium/" target="_blank" title="Instagram">
					<i class="fab fa-instagram"></i>
				</a>
			</div>
			<div class="social-icon">
				<a href="https://www.facebook.com/sotumasfax" target="_blank" title="Facebook">
					<i class="fab fa-facebook-f"></i>
				</a>
			</div>
			<div class="social-icon">
				<a href="https://www.tiktok.com/@sotumasotuma" target="_blank" title="TikTok">
					<i class="fab fa-tiktok"></i>
				</a>
			</div>
			<div class="social-icon">
				<a href="https://www.linkedin.com/company/sotuma/" target="_blank" title="LinkedIn">
					<i class="fab fa-linkedin-in"></i>
				</a>
			</div>
			<div class="social-icon email-icon">
				<a href="mailto:anis.fakhfakh@yahoo.fr" title="Email">
					<i class="fas fa-envelope"></i>
				</a>
			</div>
			<div class="social-icon">
				<a href="https://wa.me/21658844717" target="_blank" title="WhatsApp">
					<i class="fab fa-whatsapp"></i>
				</a>
			</div>
		</div>
	</div>
	
	<!-- Header -->
	@include('frontend.layouts.header-final')
	<!--/ End Header -->
	@yield('main-content')
	
    <!-- Desktop footer hidden on mobile; mobile footer below -->
    <div class="desktop-footer-wrapper">
        @include('frontend.layouts.footer')
    </div>
    @include('frontend.layouts.footer-mobile')

	<!-- Cookie Consent Banner -->
	<div id="cookie-banner" class="cookie-banner">
		<div class="cookie-content">
					<div class="cookie-text">
			<h4>{{ __('frontend.cookie_title') }}</h4>
			<p>{{ __('frontend.cookie_text') }}</p>
		</div>
		<div class="cookie-buttons">
			<button id="accept-cookies" class="btn-accept">{{ __('frontend.accept') }}</button>
			<button id="decline-cookies" class="btn-decline">{{ __('frontend.decline') }}</button>
		</div>
		</div>
	</div>

    <style>
	/* Optimized preloader fade behavior for desktop */
	.preloader { 
		opacity: 1; 
		visibility: visible; 
		transition: opacity 0.15s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.15s cubic-bezier(0.4, 0, 0.2, 1);
		will-change: opacity, visibility;
	}
	.preloader.is-hidden { 
		opacity: 0; 
		visibility: hidden; 
		transition: opacity 0.2s cubic-bezier(0.4, 0, 0.2, 1), visibility 0.2s cubic-bezier(0.4, 0, 0.2, 1);
	}
    /* Desktop preloader optimizations */
    @media (min-width: 1025px) {
        .preloader {
            transition: opacity 0.1s cubic-bezier(0.25, 0.46, 0.45, 0.94), visibility 0.1s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            will-change: opacity, visibility;
        }
        .preloader.is-hidden {
            transition: opacity 0.15s cubic-bezier(0.25, 0.46, 0.45, 0.94), visibility 0.15s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        .preloader-inner {
            transform: translateZ(0);
            -webkit-transform: translateZ(0);
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
        }
        
        /* Desktop SOTUMA Logo Animation */
        .sotuma-logo {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }
        
        .sotuma-logo .letter {
            font-size: 2.5rem;
            font-weight: 900;
            color: #FF0000;
            text-shadow: 0 4px 20px rgba(255,0,0,0.3);
            animation: desktopLetterBounce 2s ease-in-out infinite;
            display: inline-block;
        }
        
        .sotuma-logo .letter:nth-child(1) { animation-delay: 0s; }
        .sotuma-logo .letter:nth-child(2) { animation-delay: 0.1s; }
        .sotuma-logo .letter:nth-child(3) { animation-delay: 0.2s; }
        .sotuma-logo .letter:nth-child(4) { animation-delay: 0.3s; }
        .sotuma-logo .letter:nth-child(5) { animation-delay: 0.4s; }
        .sotuma-logo .letter:nth-child(6) { animation-delay: 0.5s; }
        
        /* Desktop Loading Dots Animation */
        .loading-dots {
            display: flex;
            gap: 12px;
            justify-content: center;
            align-items: center;
        }
        
        .loading-dots span {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #FF0000;
            animation: desktopDotBounce 1.4s ease-in-out infinite both;
        }
        
        .loading-dots span:nth-child(1) { animation-delay: -0.32s; }
        .loading-dots span:nth-child(2) { animation-delay: -0.16s; }
        .loading-dots span:nth-child(3) { animation-delay: 0s; }

		/* Desktop preloader warnings */
		.preloader-warning {
			margin-top: 6px;
			font-size: 0.85rem;
			font-weight: 700;
			color: #c0392b;
		}
    }
    
    /* Desktop Animation Keyframes */
    @keyframes desktopLetterBounce {
        0%, 100% {
            transform: translateY(0) scale(1);
            opacity: 0.7;
        }
        50% {
            transform: translateY(-10px) scale(1.1);
            opacity: 1;
        }
    }
    
    @keyframes desktopDotBounce {
        0%, 80%, 100% {
            transform: scale(0.8);
            opacity: 0.5;
        }
        40% {
            transform: scale(1.2);
            opacity: 1;
        }
    }

    /* Explicitly disable preloader on mobile/tablet */
    @media (max-width: 1024px) {
        .preloader { display: none !important; }
    }

    /* Mobile-fit preloader */
    @media (max-width: 767px) {
        .preloader {
            position: fixed;
            inset: 0;
            width: 100%;
			height: 100svh;
			height: calc(var(--vh, 1vh) * 100);
            background: #ffffff;
            z-index: 1000000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: max(16px, env(safe-area-inset-top)) max(16px, env(safe-area-inset-right)) max(16px, env(safe-area-inset-bottom)) max(16px, env(safe-area-inset-left));
        }
		.preloader-inner { transform: translateZ(0) scale(0.6); -webkit-transform: translateZ(0) scale(0.6); transform-origin: center center; -webkit-transform-origin: center center; display:flex; flex-direction:column; align-items:center; gap: 10px; max-width: 84vw; }
		.preloader-icon { max-width: 84vw; display:flex; flex-direction:column; align-items:center; gap: 8px; }
		.sotuma-logo { display:flex; gap: 6px; font-weight: 900; letter-spacing: 1px; font-size: clamp(18px, 7vw, 28px); color:#111; }
		.sotuma-logo .letter { display:inline-block; }
		.loading-dots { display:flex; gap: 6px; align-items:center; justify-content:center; }
		.loading-dots span { width: clamp(6px, 2.2vw, 8px); height: clamp(6px, 2.2vw, 8px); background:#FF0000; border-radius:50%; animation: mobileDot 1s infinite ease-in-out; }
		.loading-dots span:nth-child(2){ animation-delay: .15s; }
		.loading-dots span:nth-child(3){ animation-delay: .3s; }
		@keyframes mobileDot { 0%,80%,100%{ transform: scale(0.6);} 40%{ transform: scale(1);} }
    }
	.cookie-banner {
		position: fixed;
		bottom: 0;
		left: 0;
		right: 0;
		background: #FF0000 !important; /* YouTube Red */
		color: white !important;
		padding: 30px 40px; /* Bigger padding */
		z-index: 999999;
		transform: translateY(100%);
		transition: transform 0.3s ease-in-out;
		box-shadow: 0 -4px 20px rgba(0,0,0,0.15);
		border-top: 3px solid rgba(255, 255, 255, 0.3); /* White border */
	}
	.cookie-banner.show {
		transform: translateY(0);
	}
	.cookie-content {
		max-width: 1200px;
		margin: 0 auto;
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 20px;
	}
	.cookie-text h4 {
		margin: 0 0 12px 0;
		font-size: 1.5rem; /* Bigger title */
		font-weight: 700;
		color: white !important;
		text-shadow: 0 2px 4px rgba(0,0,0,0.3); /* Text shadow for better readability */
	}
	.cookie-text p {
		margin: 0;
		font-size: 1.1rem; /* Bigger text */
		line-height: 1.5;
		opacity: 1;
		color: white !important;
		font-weight: 500;
		text-shadow: 0 1px 2px rgba(0,0,0,0.3); /* Text shadow for better readability */
	}
	.cookie-buttons {
		display: flex;
		gap: 12px;
		flex-shrink: 0;
	}
	.btn-accept, .btn-decline {
		padding: 15px 30px; /* Bigger buttons */
		border: none;
		border-radius: 8px;
		font-weight: 600;
		font-size: 1rem; /* Bigger font */
		cursor: pointer;
		transition: all 0.3s ease;
		min-width: 120px; /* Minimum width for consistency */
		text-transform: uppercase;
		letter-spacing: 0.5px;
	}
	.btn-accept {
		background: white !important;
		color: #FF0000 !important; /* YouTube Red text on white background */
		border: 2px solid white;
		box-shadow: 0 2px 8px rgba(0,0,0,0.2);
	}
	.btn-accept:hover {
		background: #f8f8f8 !important;
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(0,0,0,0.3);
	}
	.btn-decline {
		background: transparent;
		color: white !important;
		border: 2px solid white;
		box-shadow: 0 2px 8px rgba(0,0,0,0.2);
	}
	.btn-decline:hover {
		background: rgba(255,255,255,0.2);
		transform: translateY(-2px);
		box-shadow: 0 4px 12px rgba(0,0,0,0.3);
	}
	/* Hide cookie banner on mobile and tablets */
	@media (max-width: 1024px) {
		.cookie-banner {
			display: none !important;
			visibility: hidden !important;
			opacity: 0 !important;
			pointer-events: none !important;
		}
	}
	
	/* Desktop only styles */
	@media (min-width: 1025px) {
		.cookie-content {
			flex-direction: row;
			text-align: left;
		}
		.cookie-buttons {
			width: auto;
			justify-content: flex-end;
		}
	}
	
    /* All content is LTR regardless of language */
    @media (max-width: 767px) {
        .desktop-footer-wrapper { display:none !important; }
    }

	</style>

<style>
/* Desktop Preloader Quality Optimizations */
@media (min-width: 1025px) {
    .preloader {
        transition: opacity 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94), visibility 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        will-change: opacity, visibility;
    }
    
    .preloader.is-hidden {
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94), visibility 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    .preloader-inner {
        transform: translateZ(0);
        -webkit-transform: translateZ(0);
        backface-visibility: hidden;
        -webkit-backface-visibility: hidden;
    }
}
</style>

	<script>
	// Desktop-only preloader: smooth, non-flashing
	(function(){
		const isDesktop = window.matchMedia('(min-width:1025px)').matches;
		function hidePreloaderSmooth() {
			const p = document.querySelector('.preloader');
			if (!p) return;
			requestAnimationFrame(() => {
				p.classList.add('is-hidden');
				setTimeout(() => { if (p && p.parentNode) p.parentNode.removeChild(p); }, 320);
			});
		}

		if (!isDesktop) {
			const p = document.querySelector('.preloader');
			if (p) p.style.display = 'none';
			return;
		}

		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', () => setTimeout(hidePreloaderSmooth, 1000));
		} else {
			setTimeout(hidePreloaderSmooth, 1000);
		}
		window.addEventListener('load', () => setTimeout(hidePreloaderSmooth, 200));
	})();
	</script>

	<script>
	// Cookie Consent Management
	document.addEventListener('DOMContentLoaded', function() {
		const cookieBanner = document.getElementById('cookie-banner');
		const acceptBtn = document.getElementById('accept-cookies');
		const declineBtn = document.getElementById('decline-cookies');
		
		// Check if user has already made a choice
		const cookieChoice = localStorage.getItem('sotuma-cookie-choice');
		
		if (!cookieChoice) {
			// Show banner after 1 second
			setTimeout(() => {
				cookieBanner.classList.add('show');
			}, 1000);
		}
		
		// Accept cookies
		acceptBtn.addEventListener('click', function() {
			localStorage.setItem('sotuma-cookie-choice', 'accepted');
			localStorage.setItem('sotuma-cookie-date', new Date().toISOString());
			cookieBanner.classList.remove('show');
			
			// Enable analytics or other tracking here if needed
			console.log('Cookies accepted');
		});
		
		// Decline cookies
		declineBtn.addEventListener('click', function() {
			localStorage.setItem('sotuma-cookie-choice', 'declined');
			localStorage.setItem('sotuma-cookie-date', new Date().toISOString());
			cookieBanner.classList.remove('show');
			
			// Disable analytics or other tracking here if needed
			console.log('Cookies declined');
		});
	});
	</script>
	
	<!-- Instant Video Play -->
	<script src="{{ asset('js/video-instant-play.js') }}"></script>
	
	<!-- Auto Desktop Mode Trigger for Mobile -->
	<script src="{{ asset('js/auto-desktop-mode.js') }}"></script>
	
	<!-- Mobile Sidebar Functionality -->
	<script src="{{ asset('js/mobile-sidebar.js') }}"></script>
	
	<!-- Responsive JavaScript -->
	<script src="{{ asset('js/frontend-responsive.js') }}"></script>
	{{-- Mobile social menu removed - social links available in mobile footer --}}
	
	<!-- Global Mobile Social Removal -->
	<script src="{{ asset('js/remove-mobile-social-global.js') }}"></script>
	
	<!-- Mobile Scroll Fix -->
	<link rel="stylesheet" href="{{ asset('css/mobile-scroll-fix.css') }}">
	<script src="{{ asset('js/mobile-scroll-fix.js') }}"></script>
	
	<!-- Hamburger Menu Fix -->
	<link rel="stylesheet" href="{{ asset('css/hamburger-menu-fix.css') }}">
	<script src="{{ asset('js/hamburger-menu-fix.js') }}"></script>
	
	<!-- Mobile Scroll Test (à supprimer en production) -->
	@if(config('app.debug'))
	<script src="{{ asset('js/test-mobile-scroll.js') }}"></script>
	<script src="{{ asset('js/test-hamburger-menu.js') }}"></script>
	<script src="{{ asset('js/hamburger-debug.js') }}"></script>
	<script src="{{ asset('js/hamburger-emergency-fix.js') }}"></script>
	@endif
	
	<script src="{{ asset('js/frontend-mobile-enhancements.js') }}"></script>
	
        <!-- Projects & Products Mobile Enhancement -->
        <script src="{{ asset('js/projects-products-mobile-enhancement.js') }}"></script>
        
        <!-- Hero Titles Mobile Enhancement -->
        <script src="{{ asset('js/hero-titles-mobile.js') }}"></script>

</body>
</html>