	<!-- Latest Font Awesome CDN (TikTok supported) -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
	<footer class="footer" style="width:100vw;position:relative;left:50%;right:50%;margin-left:-50vw;margin-right:-50vw;background:#f8f8f8;">
		<div class="footer-bg" style="background:rgb(130,4,3);width:100%;padding:0;margin:0;">
			<div class="container" style="max-width:1400px;margin:0 auto;padding:0 40px;">
				<div class="footer-content" style="display:flex;flex-wrap:wrap;justify-content:space-between;align-items:stretch;gap:0;padding:56px 0 24px 0;min-height:220px;">
					<!-- Left: SOTUMA Title & Short About -->
					<div class="footer-section" style="flex:1 1 0;min-width:220px;display:flex;flex-direction:column;justify-content:flex-start;align-items:flex-start;">
						<h1 style="font-size:2.7rem;font-weight:900;letter-spacing:2px;margin-bottom:18px;color:#fff;line-height:1;">SOTUMA</h1>
						<p style="font-size:1.08rem;line-height:1.7;margin-bottom:0;color:#fbe9e7;max-width:320px;font-weight:400;">
							Aluminium sur mesure, qualité et innovation pour vos projets architecturaux.
						</p>
					</div>
					<!-- Center: Contact Info -->
					<div class="footer-section" style="flex:1 1 0;min-width:220px;display:flex;flex-direction:column;align-items:center;justify-content:center;">
						<h3 style="color:#fff;margin-bottom:18px;font-size:1.25rem;font-weight:700;letter-spacing:1px;">Contact</h3>
						<ul style="list-style:none;padding:0;margin:0;font-size:1.08rem;width:100%;">
							<li style="margin-bottom:14px;display:flex;align-items:center;justify-content:center;gap:10px;">
								<i class="fa fa-map-marker" style="color:#fff;font-size:1.2rem;"></i>
								<span style="color:#fbe9e7;">Route gremda km8, Sfax, TUNISIE</span>
							</li>
							<li style="margin-bottom:14px;display:flex;align-items:center;justify-content:center;gap:10px;">
								<i class="fa fa-phone" style="color:#fff;font-size:1.2rem;"></i>
								<span style="color:#fbe9e7;">+216 58 844 717</span>
							</li>
							<li style="display:flex;align-items:center;justify-content:center;gap:10px;">
								<i class="fa fa-envelope" style="color:#fff;font-size:1.2rem;"></i>
								<a href="mailto:anis.fakhfakh@yahoo.fr" style="color:#fbe9e7;text-decoration:underline;">anis.fakhfakh@yahoo.fr</a>
							</li>
						</ul>
					</div>
					<!-- Right: Social Media -->
					<div class="footer-section" style="flex:1 1 0;min-width:220px;display:flex;flex-direction:column;align-items:flex-end;justify-content:flex-start;">
						<h3 style="color:#fff;margin-bottom:18px;font-size:1.25rem;font-weight:700;letter-spacing:1px;text-align:right;width:100%;">Suivez-nous</h3>
						<div style="display:flex;gap:32px;justify-content:flex-end;width:100%;">
							<a href="https://www.instagram.com/sotuma_aluminium/" target="_blank" style="color:#fff;font-size:2.3rem;transition:color 0.2s;"><i class="fab fa-instagram"></i></a>
							<a href="https://www.facebook.com/sotumasfax" target="_blank" style="color:#fff;font-size:2.3rem;transition:color 0.2s;"><i class="fab fa-facebook-f"></i></a>
							<a href="https://www.tiktok.com/@sotumasotuma" target="_blank" style="color:#fff;font-size:2.3rem;transition:color 0.2s;"><i class="fab fa-tiktok"></i></a>
						</div>
					</div>
				</div>
				<hr style="border-color:rgba(255,255,255,0.18);margin:0 0 12px 0;">
				<div class="footer-bottom" style="text-align:center;padding:12px 0 18px 0;font-size:1.08rem;opacity:0.97;color:#fff;letter-spacing:1px;">
					&copy; {{ date('Y') }} SOTUMA. Tous droits réservés.
				</div>
			</div>
		</div>
	</footer>

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