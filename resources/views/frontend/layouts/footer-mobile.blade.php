<!-- Mobile Footer (Rosace Style Design) -->
<style>
@media (max-width: 1024px) {
    .footer-mobile { 
        display: block; 
        background: #fff; 
        color: #333; 
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        border-top: 1px solid #f0f0f0;
    }
    
    .footer-mobile-inner { 
        max-width: 100%;
        margin: 0;
        padding: 0;
    }
    
    /* FOOTER LOGO SECTION - FIXED CONTAINER SOLUTION */
    .footer-logo-social-section {
        text-align: center;
        padding: 40px 20px;
        background: #fff;
        border-bottom: 1px solid #f0f0f0;
    }
    
    .footer-logo-container {
        margin: 0 auto 0 auto; /* No margin bottom - touching the text */
        padding: 0;
        display: block;
        max-width: 100%;
        width: 100%;
        height: 120px; /* Further reduced for better fit */
        background-image: url('{{ asset("images/hethahou1.png") }}');
        background-size: 70%; /* Smaller logo */
        background-repeat: no-repeat;
        background-position: center top;
        position: relative;
        overflow: hidden;
    }
    
    .footer-logo {
        display: none;
    }
    
    .footer-social-title {
        position: static;
        bottom: auto;
        left: auto;
        transform: none;
        font-size: 14px;
        line-height: 1;
        font-weight: 600;
        color: #333;
        margin: 0; /* No margin - touching the logo */
        padding: 8px 16px;
        text-transform: uppercase;
        letter-spacing: 1px;
        white-space: nowrap;
        z-index: 10;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 4px;
        backdrop-filter: blur(5px);
        text-align: center;
        display: block;
    }
    
    .footer-social-links {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin: 0;
        font-size: 14px; /* Reset font size */
    }
    
    .footer-social-links a {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #ffffff;
        color: #333;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: transform 0.25s ease, box-shadow 0.25s ease, color 0.25s ease, background 0.25s ease;
        font-size: 18px;
        border: 1px solid #e9e9e9;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .footer-social-links a:hover {
        background: #FF0000;
        color: #fff;
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 8px 18px rgba(255,0,0,0.25);
        border-color: #FF0000;
    }
    
    .footer-social-links a:active {
        transform: translateY(-1px) scale(0.98);
        box-shadow: 0 4px 10px rgba(255,0,0,0.2);
    }
    
    /* Footer Dropdown Sections - Rosace Style */
    .footer-dropdowns-section {
        background: #fff;
        border-top: 1px solid #f0f0f0;
    }
    
    /* Minimal list style exactly like reference */
    .footer-dropdown { position: relative; margin: 0; border: none; border-radius: 0; background:#fff; box-shadow:none; }
    
    .footer-dropdown:last-child {
        border-bottom: none;
    }
    
    .footer-dropdown-btn { width:100%; display:flex; justify-content:space-between; align-items:center; padding:14px 12px; background:#fff; border:none; border-bottom:2px solid #e39b9b; cursor:pointer; font-size:16px; font-weight:400; color:#111; text-align:left; border-radius:0; transition:background .15s ease; }
    .footer-dropdown-btn:hover { background:#fafafa; }
    .footer-dropdown-btn.active { background:#f9f9f9; }
    
    .footer-dropdown-btn span:first-child { font-weight:400; color:#222; }
    
    .dropdown-icon { font-size:22px; font-weight:400; color:#111; transition: none; width:auto; height:auto; border:none; }
    /* keep plus as plus in reference (no rotation) */
    
    
    .footer-dropdown-content { max-height:0; overflow:hidden; transition:max-height .3s ease, padding .2s ease; background:#fff; padding:0 0; }
    
    .footer-dropdown-content.active { max-height:380px; padding:10px 0 12px 0; }
    
    .footer-dropdown-content ul { list-style:none; margin:0; padding:0 12px 8px 12px; }
    
    .footer-dropdown-content li { margin-bottom: 10px; }
    .footer-dropdown-content li + li { border-top: 1px dashed #ececec; padding-top: 10px; }
    
    .footer-dropdown-content a { color:#111; text-decoration:none; font-size:15px; line-height:1.5; display:block; padding:8px 0; }
    .footer-dropdown-content a:hover { color:#FF0000; }

    /* Add subtle divider hover and active accents */
    .footer-dropdown:hover::before { opacity: 0.9; filter: saturate(1.2); }
    
    /* Contact Items with Icons */
    .contact-item {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
        min-height: 24px; /* Ensure consistent height */
    }
    
    .contact-item i {
        color: #FF0000;
        width: 18px; /* Increased width for better alignment */
        text-align: center;
        font-size: 16px; /* Ensure consistent icon size */
        flex-shrink: 0; /* Prevent icon from shrinking */
        display: flex;
        align-items: center;
        justify-content: center;
        height: 18px; /* Match icon container height */
    }
    
    .contact-item a {
        color: #333;
        font-weight: 500;
        margin: 0;
        line-height: 1.4; /* Ensure consistent line height */
        display: flex;
        align-items: center; /* Center text vertically */
        min-height: 18px; /* Match icon height */
    }
    
    .contact-item a:hover {
        color: #FF0000;
    }

    /* Brand colors for "Suivez Nous" dropdown */
    #socials-content .contact-item { color: inherit; }
    #socials-content .contact-item i { color: inherit; }
    #socials-content .contact-item a { color: inherit; }
    #socials-content .contact-item a:hover { color: inherit !important; }

    #socials-content .social-facebook { color: #1877F2; }
    #socials-content .social-instagram { color: #E4405F; }
    #socials-content .social-linkedin { color: #0A66C2; }
    #socials-content .social-tiktok { color: #000000; }
    #socials-content .social-whatsapp { color: #25D366; }
    
    
    /* Map Section */
    .footer-map-section {
        position: relative;
        height: 250px;
        background: #f8f9fa;
        border-top: 1px solid #f0f0f0;
    }
    
    .footer-map-container {
        position: relative;
        width: 100%;
        height: 100%;
    }
    
    .footer-map-container iframe {
        width: 100%;
        height: 100%;
        border: 0;
        display: block;
    }
    
    .footer-map-overlay {
        position: absolute;
        bottom: 15px;
        left: 15px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 12px 16px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        border: 1px solid rgba(255,255,255,0.3);
        z-index: 10;
        max-width: 200px;
    }
    
    .footer-map-overlay h5 {
        color: #FF0000;
        font-size: 14px;
        font-weight: 600;
        margin: 0 0 5px 0;
    }
    
    .footer-map-overlay p {
        color: #333;
        font-size: 12px;
        margin: 0;
        line-height: 1.3;
    }
    
    /* Directions Button */
    .footer-directions-btn {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: linear-gradient(135deg, #FF0000, #CC0000);
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 12px rgba(255,0,0,0.3);
        transition: all 0.3s ease;
        z-index: 10;
    }
    
    .footer-directions-btn:hover { background: linear-gradient(135deg, #CC0000, #FF0000); transform: translateY(-1px); box-shadow: 0 6px 16px rgba(255,0,0,0.4); color: white; text-decoration: none; }
    .footer-directions-btn:active { transform: translateY(0); box-shadow: 0 3px 10px rgba(255,0,0,0.25); }
    
    .footer-directions-btn i {
        font-size: 12px;
    }
    
    /* Mobile Footer Logo Responsive Adjustments */
    @media (max-width: 768px) {
        .footer-logo-container {
            height: 100px !important; /* Further reduced for better fit */
            max-width: 90% !important;
            margin: 0 auto 0 auto !important; /* No margin bottom - touching text */
            background-size: 65% !important; /* Smaller logo */
        }
        
        .footer-social-title {
            font-size: 13px !important;
            padding: 6px 12px !important;
            margin: 0 !important; /* No margin - touching the logo */
        }
    }
    
    @media (max-width: 480px) {
        .footer-logo-container {
            height: 90px !important; /* Further reduced for better fit */
            max-width: 95% !important;
            margin: 0 auto 0 auto !important; /* No margin bottom - touching text */
            background-size: 60% !important; /* Smaller logo */
        }
        
        .footer-social-title {
            font-size: 12px !important;
            padding: 5px 10px !important;
            margin: 0 !important; /* No margin - touching the logo */
        }
    }
    
    /* Bottom Section */
    .footer-bottom-section {
        padding: 20px;
        background: #333;
        color: #fff;
        text-align: center;
        border-top: 1px solid #444;
    }
    
    
    .footer-copyright {
        font-size: 12px;
        color: #999;
        margin: 0;
    }
}

@media (min-width: 1025px) { 
    .footer-mobile, .footer-map-section { 
        display: none; 
    } 
}
</style>

<footer class="footer-mobile">
    <div class="footer-mobile-inner">
        <!-- Logo and Social Section -->
            <div class="footer-logo-social-section">
                <div class="footer-logo-container">
                </div>
                <h3 class="footer-social-title">SUIVEZ-NOUS</h3>
                <div class="footer-social-links">
                <a href="https://www.facebook.com/sotumasfax" target="_blank" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/sotuma_aluminium/" target="_blank" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/company/sotuma/" target="_blank" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="https://www.tiktok.com/@sotumasotuma" target="_blank" title="TikTok"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>

        <!-- Footer Dropdown Sections - Rosace Style -->
        <div class="footer-dropdowns-section">
            <!-- Découvrez Plus Dropdown -->
            <div class="footer-dropdown">
                <button class="footer-dropdown-btn" onclick="toggleDropdown('discover')">
                    <span>Découvrez plus</span>
                    <span class="dropdown-icon">+</span>
                </button>
                <div class="footer-dropdown-content" id="discover-content">
                    <ul>
                        <li><a href="{{ route('about-us') }}">À Propos</a></li>
                    </ul>
                </div>
            </div>


            <!-- Suivez Nous Dropdown -->
            <div class="footer-dropdown">
                <button class="footer-dropdown-btn" onclick="toggleDropdown('socials')">
                    <span>Suivez Nous</span>
                    <span class="dropdown-icon">+</span>
                </button>
                <div class="footer-dropdown-content" id="socials-content">
                    <ul>
                        <li class="contact-item social-facebook">
                            <i class="fab fa-facebook-f"></i>
                            <a href="https://www.facebook.com/sotumasfax" target="_blank" rel="noopener">Facebook</a>
                        </li>
                        <li class="contact-item social-instagram">
                            <i class="fab fa-instagram"></i>
                            <a href="https://www.instagram.com/sotuma_aluminium/" target="_blank" rel="noopener">Instagram</a>
                        </li>
                        <li class="contact-item social-tiktok">
                            <i class="fab fa-tiktok"></i>
                            <a href="https://www.tiktok.com/@sotumasotuma" target="_blank" rel="noopener">TikTok</a>
                        </li>
                        <li class="contact-item social-linkedin">
                            <i class="fab fa-linkedin-in"></i>
                            <a href="https://www.linkedin.com/company/sotuma/" target="_blank" rel="noopener">LinkedIn</a>
                        </li>
                        <li class="contact-item social-whatsapp">
                            <i class="fab fa-whatsapp"></i>
                            <a href="https://wa.me/21658844717" target="_blank" rel="noopener">WhatsApp</a>
                        </li>
                    </ul>
                </div>
            </div>


            <!-- Contactez Nous Dropdown -->
            <div class="footer-dropdown">
                <button class="footer-dropdown-btn" onclick="toggleDropdown('contact')">
                    <span>Contactez Nous</span>
                    <span class="dropdown-icon">+</span>
                </button>
                <div class="footer-dropdown-content" id="contact-content">
                    <ul>
                        <li class="contact-item">
                            <i class="fas fa-phone"></i>
                            <a href="tel:+21658844717">+216 58 844 717</a>
                        </li>
                        <li class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:anis.fakhfakh@yahoo.fr">anis.fakhfakh@yahoo.fr</a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- Map Section -->
        <div class="footer-map-section">
            <div class="footer-map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3275.783147715462!2d10.707045780123575!3d34.811397183960686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1301d5004eb1eeef%3A0x462a50075141490c!2sSOTUMA!5e0!3m2!1sen!2stn!4v1758808157206!5m2!1sen!2stn&hl=fr&zoom=19"
                    width="100%" 
                    height="100%" 
                    style="border:0; display:block; width:100%; height:100%;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                
                <div class="footer-map-overlay">
                    <h5>📍 Notre Localisation</h5>
                    <p>Route gremda km8, Sfax, TUNISIE</p>
                </div>
                
                <a href="https://www.google.com/maps/dir/?api=1&destination=34.811397183960686,10.707045780123575&destination_place_id=ChIJN1t_tDeuRUcRkM8G_kgVGF0" target="_blank" class="footer-directions-btn">
                    <i class="fas fa-directions"></i>
                    Itinéraire
                </a>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="footer-bottom-section">
            <p class="footer-copyright">&copy; {{ date('Y') }} SOTUMA. Tous droits réservés.</p>
        </div>
    </div>
</footer>

<script>
function toggleDropdown(id) {
    const content = document.getElementById(id + '-content');
    const button = content.previousElementSibling;
    
    // Toggle active class on button
    button.classList.toggle('active');
    
    // Toggle active class on content
    content.classList.toggle('active');
    
    // Close other dropdowns
    const allContents = document.querySelectorAll('.footer-dropdown-content');
    const allButtons = document.querySelectorAll('.footer-dropdown-btn');
    
    allContents.forEach(item => {
        if (item !== content) {
            item.classList.remove('active');
        }
    });
    
    allButtons.forEach(item => {
        if (item !== button) {
            item.classList.remove('active');
        }
    });
}
</script>