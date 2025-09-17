	<!-- Latest Font Awesome CDN (TikTok supported) -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

	<style>
	/* SENIOR DEVELOPER FOOTER - PROPER POSITIONING */
	.footer-modern {
	    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
	    color: #ffffff;
	    width: 100%;
	    position: relative;
	    margin: 0;
	    padding: 0;
	    clear: both;
	    overflow: hidden;
	}

	.footer-modern::before {
	    content: '';
	    position: absolute;
	    top: 0;
	    left: 0;
	    right: 0;
	    bottom: 0;
	    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.03)" stroke-width="0.5"/></pattern></defs><rect width="100" height="100" fill="url(%23grid)"/></svg>');
	    pointer-events: none;
	}

	.footer-container {
	    max-width: 1600px;
	    margin: 0 auto;
	    padding: 0 20px;
	    position: relative;
	    z-index: 2;
	}

	.footer-main {
	    display: grid;
	    grid-template-columns: repeat(4, 1fr);
	    gap: 160px;
	    padding: 80px 0 60px 0;
	    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
	}

	.footer-brand {
	    display: flex;
	    flex-direction: column;
	    gap: 24px;
	    min-width: 0;
	    overflow: visible;
	}

	.footer-logo {
	    font-size: 3rem;
	    font-weight: 900;
	    background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
	    -webkit-background-clip: text;
	    -webkit-text-fill-color: transparent;
	    background-clip: text;
	    letter-spacing: 2px;
	    text-shadow: 0 4px 8px rgba(0,0,0,0.3);
	    position: relative;
	    line-height: 1;
	    margin-bottom: 10px;
	    display: block;
	    width: 100%;
	}

	.footer-logo::after {
	    content: '';
	    position: absolute;
	    bottom: -8px;
	    left: 0;
	    width: 60px;
	    height: 3px;
	    background: linear-gradient(90deg, #ff6b35, #f7931e);
	    border-radius: 2px;
	}

	.footer-description {
	    font-size: 1.1rem;
	    line-height: 1.8;
	    color: #b0b0b0;
	    max-width: 400px;
	    font-weight: 300;
	}

	.footer-stats {
	    display: flex;
	    gap: 40px;
	    margin-top: 20px;
	}

	.stat-item {
	    text-align: center;
	}

	.stat-number {
	    font-size: 2rem;
	    font-weight: 700;
	    color: #ff6b35;
	    display: block;
	    margin-bottom: 4px;
	}

	.stat-label {
	    font-size: 0.9rem;
	    color: #888;
	    text-transform: uppercase;
	    letter-spacing: 1px;
	}

	.footer-section {
	    display: flex;
	    flex-direction: column;
	    gap: 24px;
	}

	.footer-section h3 {
	    font-size: 1.4rem;
	    font-weight: 700;
	    color: #ffffff;
	    margin-bottom: 20px;
	    position: relative;
	    padding-bottom: 12px;
	}

	.footer-section h3::after {
	    content: '';
	    position: absolute;
	    bottom: 0;
	    left: 0;
	    width: 40px;
	    height: 2px;
	    background: linear-gradient(90deg, #ff6b35, #f7931e);
	    border-radius: 1px;
	}

	.footer-links {
	    list-style: none;
	    padding: 0;
	    margin: 0;
	    display: flex;
	    flex-direction: column;
	    gap: 12px;
	}

	.footer-links li a {
	    color: #b0b0b0;
	    text-decoration: none;
	    font-size: 1rem;
	    transition: all 0.3s ease;
	    display: flex;
	    align-items: center;
	    gap: 8px;
	    padding: 8px 0;
	    position: relative;
	}

	.footer-links li a::before {
	    content: '';
	    position: absolute;
	    left: -12px;
	    top: 50%;
	    transform: translateY(-50%);
	    width: 0;
	    height: 2px;
	    background: #ff6b35;
	    transition: width 0.3s ease;
	}

	.footer-links li a:hover {
	    color: #ffffff;
	    transform: translateX(8px);
	}

	.footer-links li a:hover::before {
	    width: 8px;
	}

	.contact-info {
	    display: flex;
	    flex-direction: column;
	    gap: 16px;
	}

	.contact-item {
	    display: flex;
	    align-items: center;
	    gap: 12px;
	    padding: 12px 0;
	    transition: all 0.3s ease;
	}

	.contact-item:hover {
	    transform: translateX(8px);
	}

	.contact-icon {
	    width: 40px;
	    height: 40px;
	    background: linear-gradient(135deg, #ff6b35, #f7931e);
	    border-radius: 50%;
	    display: flex;
	    align-items: center;
	    justify-content: center;
	    color: white;
	    font-size: 1.1rem;
	    flex-shrink: 0;
	}

	.contact-details {
	    display: flex;
	    flex-direction: column;
	    gap: 2px;
	}

	.contact-label {
	    font-size: 0.8rem;
	    color: #888;
	    text-transform: uppercase;
	    letter-spacing: 1px;
	}

	.contact-value {
	    font-size: 1rem;
	    color: #ffffff;
	    font-weight: 500;
	}

	.contact-value a {
	    color: #ffffff;
	    text-decoration: none;
	    transition: color 0.3s ease;
	}

	.contact-value a:hover {
	    color: #ff6b35;
	}

	.social-grid {
	    display: grid;
	    grid-template-columns: repeat(3, 1fr);
	    gap: 16px;
	    margin-top: 20px;
	}

	.social-item {
	    width: 50px;
	    height: 50px;
	    background: rgba(255, 255, 255, 0.1);
	    border-radius: 12px;
	    display: flex;
	    align-items: center;
	    justify-content: center;
	    color: #ffffff;
	    font-size: 1.3rem;
	    text-decoration: none;
	    transition: all 0.3s ease;
	    position: relative;
	    overflow: hidden;
	}

	.social-item::before {
	    content: '';
	    position: absolute;
	    top: 0;
	    left: -100%;
	    width: 100%;
	    height: 100%;
	    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
	    transition: left 0.5s ease;
	}

	.social-item:hover::before {
	    left: 100%;
	}

	.social-item:hover {
	    background: linear-gradient(135deg, #ff6b35, #f7931e);
	    transform: translateY(-3px);
	    box-shadow: 0 8px 25px rgba(255, 107, 53, 0.3);
	}

	/* Social {{ __('frontend.media') }} Real Brand Colors */
	.social-item[href*="instagram.com"] {
	    background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
	    color: #ffffff;
	}

	.social-item[href*="instagram.com"]:hover {
	    background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
	    transform: translateY(-3px);
	    box-shadow: 0 8px 25px rgba(220, 39, 67, 0.4);
	}

	.social-item[href*="facebook.com"] {
	    background: #1877f2;
	    color: #ffffff;
	}

	.social-item[href*="facebook.com"]:hover {
	    background: #1877f2;
	    transform: translateY(-3px);
	    box-shadow: 0 8px 25px rgba(24, 119, 242, 0.4);
	}

	.social-item[href*="tiktok.com"] {
	    background: linear-gradient(45deg, #000000 0%, #25f4ee 50%, #fe2c55 100%);
	    color: #ffffff;
	}

	.social-item[href*="tiktok.com"]:hover {
	    background: linear-gradient(45deg, #000000 0%, #25f4ee 50%, #fe2c55 100%);
	    transform: translateY(-3px);
	    box-shadow: 0 8px 25px rgba(254, 44, 85, 0.4);
	}

	.social-item[href*="linkedin.com"] {
	    background: #0077b5;
	    color: #ffffff;
	}

	.social-item[href*="linkedin.com"]:hover {
	    background: #0077b5;
	    transform: translateY(-3px);
	    box-shadow: 0 8px 25px rgba(0, 119, 181, 0.4);
	}

	.social-item[href*="mailto:"] {
	    background: #ea4335;
	    color: #ffffff;
	}

	.social-item[href*="mailto:"]:hover {
	    background: #ea4335;
	    transform: translateY(-3px);
	    box-shadow: 0 8px 25px rgba(234, 67, 53, 0.4);
	}

	.social-item[href*="tel:"] {
	    background: #34a853;
	    color: #ffffff;
	}

	.social-item[href*="tel:"]:hover {
	    background: #34a853;
	    transform: translateY(-3px);
	    box-shadow: 0 8px 25px rgba(52, 168, 83, 0.4);
	}

	.footer-bottom {
	    padding: 30px 0;
	    display: flex;
	    justify-content: space-between;
	    align-items: center;
	    flex-wrap: wrap;
	    gap: 20px;
	}

	.footer-copyright {
	    color: #888;
	    font-size: 0.95rem;
	}

	.footer-legal {
	    display: flex;
	    gap: 30px;
	    flex-wrap: wrap;
	}

	.footer-legal a {
	    color: #888;
	    text-decoration: none;
	    font-size: 0.9rem;
	    transition: color 0.3s ease;
	}

	.footer-legal a:hover {
	    color: #ff6b35;
	}

	.back-to-top {
	    position: fixed;
	    bottom: 30px;
	    right: 30px;
	    width: 120px;
	    height: 60px;
	    background: linear-gradient(135deg, #d2b48c, #bc8f8f);
	    border-radius: 12px;
	    display: flex;
	    align-items: center;
	    justify-content: center;
	    color: white;
	    text-decoration: none;
	    font-size: 1.5rem;
	    font-weight: bold;
	    opacity: 0;
	    visibility: hidden;
	    transform: translateY(20px);
	    transition: all 0.3s ease;
	    z-index: 1000;
	    box-shadow: 0 6px 20px rgba(247, 201, 72, 0.4);
	    border: 2px solid rgba(255, 255, 255, 0.2);
	}

	.back-to-top.visible {
	    opacity: 1;
	    visibility: visible;
	    transform: translateY(0);
	}

	.back-to-top:hover {
	    transform: translateY(-5px) scale(1.05);
	    box-shadow: 0 10px 30px rgba(210, 180, 140, 0.6);
	    background: linear-gradient(135deg, #bc8f8f, #d2b48c);
	}

	/* Responsive Design */
	@media (max-width: 1200px) {
	    .footer-main {
	        grid-template-columns: repeat(2, 1fr);
	        gap: 100px;
	    }
	}
	
	@media (max-width: 768px) {
	    .footer-main {
	        grid-template-columns: 1fr;
	        gap: 40px;
	        padding: 60px 0 40px 0;
	    }
	    
	    .footer-stats {
	        justify-content: center;
	        gap: 30px;
	    }
	    
	    .footer-bottom {
	        flex-direction: column;
	        text-align: center;
	    }
	    
	    .social-grid {
	        grid-template-columns: repeat(3, 1fr);
	        max-width: 200px;
	        margin: 20px auto 0;
	    }
	}

	/* Animation Classes */
	.fade-in-up {
	    animation: fadeInUp 0.8s ease forwards;
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

	.stagger-animation > * {
	    opacity: 0;
	    animation: fadeInUp 0.6s ease forwards;
	}

	.stagger-animation > *:nth-child(1) { animation-delay: 0.1s; }
	.stagger-animation > *:nth-child(2) { animation-delay: 0.2s; }
	.stagger-animation > *:nth-child(3) { animation-delay: 0.3s; }
	.stagger-animation > *:nth-child(4) { animation-delay: 0.4s; }
	</style>

	<footer class="footer-modern">
	    <div class="footer-container">
	        <div class="footer-main">
	            <!-- Brand Section -->
	            <div class="footer-brand fade-in-up">
	                <div class="footer-logo">SOTUMA</div>
	                <p class="footer-description">
	                    Leader en solutions aluminium sur mesure, nous transformons vos visions architecturales en réalités durables. 
	                    Innovation, qualité et excellence depuis plus de 15 ans.
	                </p>
	                                <div class="footer-stats">
                    <div class="stat-item">
                        <span class="stat-number" data-count="{{ $settings->warranty_years ?? 10 }}">0</span>
                        <span class="stat-label">{{ __('frontend.warranty_years') }}</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-count="{{ $settings->experience_years ?? 15 }}">0</span>
                        <span class="stat-label">Ans Expérience</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number" data-count="{{ $settings->projects_count ?? 50 }}">0</span>
                        <span class="stat-label">Projets</span>
                    </div>
                </div>
	            </div>

	            <!-- Quick Links -->
	            <div class="footer-section stagger-animation">
	                <h3>{{ __('frontend.quick_links') }}</h3>
	                <ul class="footer-links">
	                    <li><a href="{{ route('home') }}"><i class="fas fa-home"></i> {{ __('frontend.home') }}</a></li>
	                    <li><a href="{{ route('project-categories.index') }}"><i class="fas fa-building"></i> {{ __('frontend.projects') }}</a></li>
	                    <li><a href="{{ route('about-us') }}"><i class="fas fa-info-circle"></i> {{ __('frontend.about') }}</a></li>
	                    <li><a href="{{ route('contact') }}"><i class="fas fa-envelope"></i> {{ __('frontend.contact') }}</a></li>
	                    <li><a href="{{ route('media') }}"><i class="fas fa-newspaper"></i> {{ __('frontend.media') }}</a></li>
	                    <li><a href="{{ route('categories.index') }}"><i class="fas fa-th-large"></i> {{ __('frontend.products') }}</a></li>
	                </ul>
	            </div>

	                        <!-- {{ __('frontend.contact') }} {{ __('frontend.info') }} -->
            <div class="footer-section stagger-animation">
                <h3>{{ __('frontend.contact_us') }}</h3>
                <div class="contact-info">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">{{ __('frontend.address') }}</span>
                            <span class="contact-value">{{ $settings->address ?? 'Route gremda km8, Sfax, TUNISIE' }}</span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">{{ __('frontend.phone') }}</span>
                            <span class="contact-value">
                                <a href="tel:{{ $settings->phone ?? '+216 58 844 717' }}">{{ $settings->phone ?? '+216 58 844 717' }}</a>
                            </span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">{{ __('frontend.email') }}</span>
                            <span class="contact-value">
                                <a href="mailto:{{ $settings->email ?? 'anis.fakhfakh@yahoo.fr' }}">{{ $settings->email ?? 'anis.fakhfakh@yahoo.fr' }}</a>
                            </span>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="contact-details">
                            <span class="contact-label">{{ __('frontend.hours') }}</span>
                            <span class="contact-value">Lun-Ven: 8h-18h</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social {{ __('frontend.media') }} -->
            <div class="footer-section stagger-animation">
                <h3>{{ __('frontend.follow_us') }}</h3>
                <p style="color: #b0b0b0; margin-bottom: 20px; line-height: 1.6;">
                    {{ __('frontend.stay_connected') }}
                </p>
                <div class="social-grid">
                    <a href="https://www.instagram.com/sotuma_aluminium/" target="_blank" class="social-item" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.facebook.com/sotumasfax" target="_blank" class="social-item" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.tiktok.com/@sotumasotuma" target="_blank" class="social-item" title="TikTok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/sotuma/" target="_blank" class="social-item" title="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="mailto:{{ $settings->email ?? 'anis.fakhfakh@yahoo.fr' }}" class="social-item" title="{{ __('frontend.email') }}">
                        <i class="fas fa-envelope"></i>
                    </a>
                    <a href="tel:{{ str_replace(' ', '', $settings->phone ?? '+216 58 844 717') }}" class="social-item" title="{{ __('frontend.call') }}">
                        <i class="fas fa-phone"></i>
                    </a>
                </div>
            </div>
	        </div>

	        <!-- Footer Bottom -->
	        <div class="footer-bottom">
	            <div class="footer-copyright">
	                &copy; {{ date('Y') }} SOTUMA. {{ __('frontend.all_rights_reserved') }}. | Conçu avec <i class="fas fa-heart" style="color: #ff6b35;"></i> en Tunisie
	            </div>
	            <div class="footer-legal">
	                <a href="{{ route('about-us') }}">{{ __('frontend.about') }}</a>
	                <a href="{{ route('contact') }}">{{ __('frontend.contact') }}</a>
	                <a href="{{ route('media') }}">{{ __('frontend.media') }}</a>
	            </div>
	        </div>
	    </div>
	</footer>

	<!-- Back to Top Button -->
	<a href="#" class="back-to-top" id="backToTop" title="{{ __('frontend.back') }} en haut">
	    <i class="fas fa-chevron-up"></i>
	</a>

	<!-- Jquery -->
	<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery-migrate-3.0.0.js')}}"></script>
	<script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
	<!-- Popper JS -->
	<script src="{{asset('frontend/js/popper.min.js')}}"></script>
	<!-- Bootstrap JS -->
	<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
	<!-- Color JS -->
	<script src="{{asset('frontend/js/colors.js')}}"></script>
	<!-- Slicknav JS -->
	<script src="{{asset('frontend/js/slicknav.min.js')}}"></script>
	<!-- Owl Carousel JS -->
	<script src="{{asset('frontend/js/owl-carousel.js')}}"></script>
	<!-- Magnific Popup JS -->
	<script src="{{asset('frontend/js/magnific-popup.js')}}"></script>
	<!-- Waypoints JS -->
	<script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
	<!-- Countdown JS -->
	<script src="{{asset('frontend/js/finalcountdown.min.js')}}"></script>
	<!-- Nice Select JS -->
	<script src="{{asset('frontend/js/nicesellect.js')}}"></script>
	<!-- Flex Slider JS -->
	<script src="{{asset('frontend/js/flex-slider.js')}}"></script>
	<!-- ScrollUp JS -->
	<script src="{{asset('frontend/js/scrollup.js')}}"></script>
	<!-- Onepage Nav JS -->
	<script src="{{asset('frontend/js/onepage-nav.min.js')}}"></script>
	{{-- Isotope --}}
	<script src="{{asset('frontend/js/isotope/isotope.pkgd.min.js')}}"></script>
	<!-- Easing JS -->
	<script src="{{asset('frontend/js/easing.js')}}"></script>

	<!-- Active JS -->
	<script src="{{asset('frontend/js/active.js')}}"></script>

	@stack('scripts')

	<script>
	// Senior Level Footer JavaScript
	// Back to Top functionality
	const backToTop = document.getElementById('backToTop');

	window.addEventListener('scroll', function() {
	    if (window.pageYOffset > 300) {
	        backToTop.classList.add('visible');
	    } else {
	        backToTop.classList.remove('visible');
	    }
	});

	backToTop.addEventListener('click', function(e) {
	    e.preventDefault();
	    window.scrollTo({
	        top: 0,
	        behavior: 'smooth'
	    });
	});

	// Animated counter for stats
	const counters = document.querySelectorAll('.stat-number');
	const observerOptions = {
	    threshold: 0.5,
	    rootMargin: '0px 0px -50px 0px'
	};

	const observer = new IntersectionObserver(function(entries) {
	    entries.forEach(entry => {
	        if (entry.isIntersecting) {
	            const counter = entry.target;
	            const target = parseInt(counter.getAttribute('data-count'));
	            const duration = 2000;
	            const step = target / (duration / 16);
	            let current = 0;

	            const timer = setInterval(() => {
	                current += step;
	                if (current >= target) {
	                    current = target;
	                    clearInterval(timer);
	                }
	                counter.textContent = Math.floor(current);
	            }, 16);
	            
	            observer.unobserve(counter);
	        }
	    });
	}, observerOptions);

	counters.forEach(counter => {
	    observer.observe(counter);
	});

	// Smooth scroll for footer links
	document.querySelectorAll('.footer-links a[href^="#"]').forEach(anchor => {
	    anchor.addEventListener('click', function (e) {
	        e.preventDefault();
	        const target = document.querySelector(this.getAttribute('href'));
	        if (target) {
	            target.scrollIntoView({
	                behavior: 'smooth',
	                block: 'start'
	            });
	        }
	    });
	});

	// Hover effects for social icons
	document.querySelectorAll('.social-item').forEach(item => {
	    item.addEventListener('mouseenter', function() {
	        this.style.transform = 'translateY(-3px) scale(1.1)';
	    });
	    
	    item.addEventListener('mouseleave', function() {
	        this.style.transform = 'translateY(0) scale(1)';
	    });
	});

	// Existing scripts
	setTimeout(function(){
	  $('.alert').slideUp();
	},5000);

	$(function() {
	// ------------------------------------------------------- //
	// Multi Level dropdowns
	// ------------------------------------------------------ //
	    $("ul.dropdown-menu [data-toggle='dropdown']").on("click", function(event) {
	        event.preventDefault();
	        event.stopPropagation();

	        $(this).siblings().toggleClass("show");

	        if (!$(this).next().hasClass('show')) {
	        $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	        }
	        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
	        $('.dropdown-submenu .show').removeClass("show");
	        });
	    });
	});
	</script>