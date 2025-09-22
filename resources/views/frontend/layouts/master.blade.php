<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
	@include('frontend.layouts.head')	
</head>
<body class="js">
	
	<!-- Preloader -->
	<div class="preloader">
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
			<div class="social-icon">
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
	
	@include('frontend.layouts.footer')

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
	.cookie-banner {
		position: fixed;
		bottom: 0;
		left: 0;
		right: 0;
		background: linear-gradient(135deg, #820403 0%, #d4af37 100%);
		color: white;
		padding: 20px;
		z-index: 999999;
		transform: translateY(100%);
		transition: transform 0.3s ease-in-out;
		box-shadow: 0 -4px 20px rgba(0,0,0,0.15);
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
		margin: 0 0 8px 0;
		font-size: 1.2rem;
		font-weight: 700;
	}
	.cookie-text p {
		margin: 0;
		font-size: 0.95rem;
		line-height: 1.4;
		opacity: 1;
		color: #fff;
	}
	.cookie-buttons {
		display: flex;
		gap: 12px;
		flex-shrink: 0;
	}
	.btn-accept, .btn-decline {
		padding: 10px 24px;
		border: none;
		border-radius: 6px;
		font-weight: 600;
		font-size: 0.9rem;
		cursor: pointer;
		transition: all 0.2s ease;
	}
	.btn-accept {
		background: transparent;
		color: #fff;
		border: 2px solid #fff;
	}
	.btn-accept:hover {
		background: rgba(255,255,255,0.1);
		transform: translateY(-1px);
	}
	.btn-decline {
		background: transparent;
		color: #fff;
		border: 2px solid #fff;
	}
	.btn-decline:hover {
		background: rgba(255,255,255,0.1);
	}
	@media (max-width: 768px) {
		.cookie-content {
			flex-direction: column;
			text-align: center;
		}
		.cookie-buttons {
			width: 100%;
			justify-content: center;
		}
		.cookie-text h4 {
			font-size: 1.1rem;
		}
		.cookie-text p {
			font-size: 0.9rem;
		}
	}
	
	/* All content is LTR regardless of language */
	</style>

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
	
	<!-- Responsive JavaScript -->
	<script src="{{ asset('js/frontend-responsive.js') }}"></script>
	<script src="{{ asset('js/mobile-social.js') }}"></script>
	<script src="{{ asset('js/frontend-mobile-enhancements.js') }}"></script>

</body>
</html>