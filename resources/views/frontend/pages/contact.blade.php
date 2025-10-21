@extends('frontend.layouts.master')

@section('title', __('frontend.contact_us'))

@section('main-content')

<!-- SEO: LocalBusiness + ContactPage JSON-LD -->
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'LocalBusiness',
  'name' => 'SOTUMA',
  'image' => asset('images/sotuma-logo.jpg'),
  'url' => url('/'),
  'telephone' => $settings->phone ?? '',
  'email' => $settings->email ?? '',
  'address' => [
    '@type' => 'PostalAddress',
    'streetAddress' => $settings->address ?? 'Sfax',
    'addressLocality' => 'Sfax',
    'addressRegion' => 'SF',
    'addressCountry' => 'TN'
  ],
  'geo' => [
    '@type' => 'GeoCoordinates',
    'latitude' => 34.811397,
    'longitude' => 10.707046
  ],
  'openingHoursSpecification' => [
    ['@type' => 'OpeningHoursSpecification','dayOfWeek' => ['Monday','Tuesday','Wednesday','Thursday','Friday'],'opens' => '08:00','closes' => '18:00'],
    ['@type' => 'OpeningHoursSpecification','dayOfWeek' => 'Saturday','opens' => '08:00','closes' => '14:00']
  ],
  'sameAs' => array_values(array_filter([
    $settings->facebook ?? null,
    $settings->instagram ?? null,
    'https://www.linkedin.com/company/sotuma/'
  ])),
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
</script>
<script type="application/ld+json">
{!! json_encode([
  '@context' => 'https://schema.org',
  '@type' => 'ContactPage',
  'name' => 'Contact SOTUMA',
  'url' => url()->current(),
  'breadcrumb' => [
    '@type' => 'BreadcrumbList',
    'itemListElement' => [
      ['@type' => 'ListItem','position' => 1,'name' => __('frontend.home') ?? 'Accueil','item' => url('/')],
      ['@type' => 'ListItem','position' => 2,'name' => __('frontend.contact') ?? 'Contact','item' => url()->current()],
    ]
  ]
], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES) !!}
</script>

<style>
/* Modern Contact Page - Google Maps First Design */
:root {
    --sotuma-red: #FF0000;
    --sotuma-gold: #D2B48C;
    --facebook-blue: #1877f2;
    --instagram-purple: #e4405f;
    --tiktok-black: #000000;
    --whatsapp-green: #25d366;
    --glass-bg: rgba(255,255,255,0.95);
    --glass-blur: blur(15px);
    --card-shadow: 0 12px 40px rgba(255,0,0,0.15);
    --border-radius: 20px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

/* Google Maps Section - First Section */
.map-section {
    position: relative;
    height: 500px;
    width: 100%;
    margin-bottom: 0;
    overflow: hidden;
    border-radius: 0;
    box-shadow: 0 8px 32px rgba(0,0,0,0.15);
}

.map-container {
    position: relative;
    width: 100%;
    height: 100%;
}

.map-container iframe {
    width: 100%;
    height: 100%;
    border: 0;
    display: block;
}

.map-overlay {
    position: absolute;
    top: 20px;
    left: 80px;
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    padding: 20px;
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    border: 1px solid rgba(255,255,255,0.2);
    z-index: 10;
    max-width: 300px;
}

.map-overlay h3 {
    color: var(--sotuma-red);
    font-size: 1.8rem;
    font-weight: 800;
    margin: 0 0 15px 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.map-overlay p {
    color: #333;
    font-size: 0.95rem;
    margin: 0;
    line-height: 1.5;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.map-overlay .address {
    font-weight: 700;
    color: var(--sotuma-red);
    margin-bottom: 12px;
    font-size: 1.1rem;
    text-shadow: 0 1px 2px rgba(0,0,0,0.1);
}

/* Directions Button */
.directions-btn {
    background: linear-gradient(135deg, var(--sotuma-red), #CC0000);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 12px 20px;
    font-size: 0.95rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 15px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    box-shadow: 0 4px 15px rgba(255,0,0,0.3);
}

.directions-btn:hover {
    background: linear-gradient(135deg, #CC0000, var(--sotuma-red));
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255,0,0,0.4);
}

.directions-btn i {
    font-size: 1rem;
}


/* Contact Info Section */
.contact-info-section {
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
    padding: 80px 0 60px 0;
    position: relative;
}

.contact-info-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 30px;
}

.section-title {
    text-align: center;
    margin-bottom: 60px;
}

.section-title h2 {
    font-size: 2.8rem;
    font-weight: 800;
    color: var(--sotuma-red);
    margin: 0 0 15px 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    text-transform: uppercase;
    letter-spacing: -1px;
}

.section-title p {
    font-size: 1.2rem;
    color: #666;
    margin: 0;
    font-weight: 500;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Contact Cards Grid */
.contact-cards-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 0;
    margin-bottom: 60px;
    justify-items: center;
    max-width: 900px;
    margin-left: auto;
    margin-right: auto;
}

.contact-card {
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border-radius: var(--border-radius);
    padding: 35px 25px;
    text-align: center;
    box-shadow: var(--card-shadow);
    border: 1px solid rgba(255,255,255,0.3);
    transition: var(--transition);
    position: relative;
    overflow: hidden;
}

.contact-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--sotuma-red), var(--sotuma-gold));
    transform: scaleX(0);
    transition: var(--transition);
}

.contact-card:hover::before {
    transform: scaleX(1);
}

.contact-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(255,0,0,0.25);
}

.contact-card-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px auto;
    font-size: 2rem;
    color: white;
    position: relative;
    transition: var(--transition);
}

.contact-card-icon.address-icon {
    background: linear-gradient(135deg, var(--sotuma-red), #CC0000);
}

.contact-card-icon.phone-icon {
    background: linear-gradient(135deg, var(--whatsapp-green), #20c997);
}

.contact-card-icon.email-icon {
    background: linear-gradient(135deg, var(--sotuma-red), #CC0000);
}

.contact-card-icon.facebook-icon {
    background: linear-gradient(135deg, var(--facebook-blue), #0056b3);
}

.contact-card-icon.instagram-icon {
    background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
}

.contact-card-icon.tiktok-icon {
    background: linear-gradient(135deg, var(--tiktok-black), #333);
}

.contact-card-icon.linkedin-icon {
    background: linear-gradient(135deg, #0077b5, #005885);
}





.contact-card:hover .contact-card-icon {
    transform: scale(1.1) rotate(5deg);
}

.contact-card h3 {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--sotuma-red);
    margin: 0 0 15px 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.contact-card p, .contact-card a {
    font-size: 1rem;
    color: #555;
    margin: 0;
    line-height: 1.6;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    text-decoration: none;
    transition: var(--transition);
}

.contact-card a:hover {
    color: var(--sotuma-red);
    font-weight: 600;
}

/* Clickable Card Styles */
.clickable-card {
    text-decoration: none;
    color: inherit;
    display: block;
    cursor: pointer;
    transition: var(--transition);
}

.clickable-card:hover {
    text-decoration: none;
    color: inherit;
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(255,0,0,0.25);
}

.clickable-card:hover .contact-card-icon {
    transform: scale(1.1) rotate(5deg);
}

.clickable-card:hover h3 {
    color: var(--sotuma-red);
}

.clickable-card:hover p {
    color: var(--sotuma-red);
    font-weight: 600;
}

/* Social Media Rows */
.social-media-row {
    display: flex;
    justify-content: center;
    gap: 30px;
    margin-bottom: 30px;
    max-width: 1000px;
    margin-left: auto;
    margin-right: auto;
}

.social-media-row:last-child {
    margin-bottom: 60px;
}

.social-media-row .contact-card {
    flex: 1;
    max-width: 300px;
    min-width: 250px;
}

/* Contact Form Section */
.contact-form-section {
    background: var(--glass-bg);
    backdrop-filter: var(--glass-blur);
    border-radius: var(--border-radius);
    box-shadow: var(--card-shadow);
    padding: 50px 40px;
    max-width: 800px;
    margin: 0 auto;
    border: 1px solid rgba(255,255,255,0.3);
}

.contact-form-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--sotuma-red);
    margin-bottom: 30px;
    text-align: center;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.contact-form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
}

.contact-form-group {
    position: relative;
}

.contact-form-group label {
    display: block;
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--sotuma-red);
    margin-bottom: 8px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.contact-form-group.full-width {
    grid-column: 1 / -1;
}

.contact-form input, 
.contact-form textarea {
    width: 100%;
    border: 2px solid #e9ecef;
    border-radius: 12px;
    padding: 18px 20px;
    font-size: 1rem;
    background: rgba(255,255,255,0.8);
    transition: var(--transition);
    outline: none;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.contact-form input:focus, 
.contact-form textarea:focus {
    border-color: var(--sotuma-red);
    background: white;
    box-shadow: 0 0 0 4px rgba(255,0,0,0.1);
}

.contact-form textarea {
    min-height: 120px;
    resize: vertical;
    grid-column: 1 / -1;
}

.contact-form button {
    background: linear-gradient(135deg, var(--sotuma-red), #CC0000);
    color: white;
    border: none;
    border-radius: 12px;
    padding: 18px 40px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: var(--transition);
    grid-column: 1 / -1;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.contact-form button:hover {
    background: linear-gradient(135deg, #CC0000, var(--sotuma-red));
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255,0,0,0.3);
}

/* File Upload */
.file-upload-area {
    border: 2px dashed var(--sotuma-red);
    border-radius: 12px;
    background: linear-gradient(135deg, #fff5f5, #ffe8e8);
    padding: 30px 20px;
    text-align: center;
    cursor: pointer;
    transition: var(--transition);
    grid-column: 1 / -1;
    position: relative;
}

.file-upload-area:hover,
.file-upload-area.dragover {
    border-color: var(--sotuma-gold);
    background: linear-gradient(135deg, #fff8e1, #fff3cd);
    box-shadow: 0 4px 15px rgba(255,0,0,0.1);
}

.file-upload-area i {
    font-size: 2.5rem;
    color: var(--sotuma-red);
    margin-bottom: 10px;
    display: block;
    transition: var(--transition);
}

.file-upload-area:hover i {
    color: var(--sotuma-gold);
    transform: scale(1.1);
}

.file-upload-area span {
    color: #333;
    font-size: 1rem;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    font-weight: 500;
    line-height: 1.5;
}

/* Login Required Section */
.login-required-section {
    text-align: center;
    padding: 40px 20px;
}

.login-required-icon {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--sotuma-red), var(--sotuma-gold));
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px auto;
    font-size: 2rem;
    color: white;
    box-shadow: var(--card-shadow);
}

.login-required-section h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--sotuma-red);
    margin: 0 0 15px 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.login-required-section p {
    font-size: 1rem;
    color: #666;
    margin: 0 0 30px 0;
    line-height: 1.6;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.login-required-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.btn-login, .btn-register {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 15px 30px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    transition: var(--transition);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.btn-login {
    background: linear-gradient(135deg, var(--sotuma-red), #CC0000);
    color: white;
}

.btn-login:hover {
    background: linear-gradient(135deg, #CC0000, var(--sotuma-red));
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(255,0,0,0.3);
}

.btn-register {
    background: linear-gradient(135deg, var(--sotuma-gold), #f39c12);
    color: #333;
}

.btn-register:hover {
    background: linear-gradient(135deg, #f39c12, var(--sotuma-gold));
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(247,201,72,0.3);
}



/* ===== RESPONSIVE DESIGN ===== */

/* Tablet and below - show sidebar */
@media (max-width: 1200px) {
    .map-section {
        display: none !important; /* Hide map section on tablets */
    }
    
    .map-container iframe {
        width: 100%;
        height: 100%;
        min-height: 450px;
    }
    
    .map-overlay {
        top: 18px;
        left: 18px;
        max-width: 280px;
        padding: 18px;
    }
    
    .map-overlay h3 {
        font-size: 1.2rem;
    }
    
    .map-overlay p {
        font-size: 0.95rem;
    }
    
    .contact-cards-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
    }
    
    .social-media-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 25px;
        max-width: 600px;
    }
    
    .social-media-row .contact-card {
        max-width: 100%;
        min-width: auto;
    }
    
    .contact-form {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .contact-form-section {
        padding: 40px 30px;
        margin: 0 20px;
    }
    
    .contact-info-section {
        padding: 70px 0 50px 0;
    }
    
    .contact-info-container {
        padding: 0 25px;
    }
    
    .section-title h2 {
        font-size: 2.4rem;
    }
}

/* Mobile responsive */
@media (max-width: 768px) {
    .map-section {
        display: none !important; /* Hide map section on mobile/tablets */
    }
    
    .map-container {
        width: 100%;
        height: 100%;
    }
    
    .map-container iframe {
        width: 100%;
        height: 100%;
        min-height: 400px;
    }
    
    .map-overlay {
        top: 15px;
        left: 15px;
        right: 15px;
        max-width: none;
        padding: 15px;
        position: absolute;
        z-index: 10;
    }
    
    .map-overlay h3 {
        font-size: 1.1rem;
        margin-bottom: 8px;
    }
    
    .map-overlay p {
        font-size: 0.9rem;
        line-height: 1.4;
    }
    
    .directions-btn {
        padding: 10px 16px;
        font-size: 0.9rem;
        margin-top: 12px;
    }
    
    .section-title h2 {
        font-size: 2.2rem;
    }
    
    .section-title p {
        font-size: 1.1rem;
    }
    
    .contact-cards-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .social-media-row {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
        max-width: 100%;
    }
    
    .social-media-row .contact-card {
        max-width: 100%;
        min-width: auto;
    }
    
    .contact-form {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .contact-form-section {
        padding: 30px 20px;
        margin: 0 15px;
    }
    
    .contact-info-section {
        padding: 60px 0 40px 0;
    }
    
    .contact-info-container {
        padding: 0 20px;
    }
    
    .contact-card {
        padding: 25px 20px;
    }
    
    .contact-card-icon {
        width: 70px;
        height: 70px;
        font-size: 1.8rem;
    }
    
    .contact-card h3 {
        font-size: 1.2rem;
    }
    
    .contact-card p {
        font-size: 0.95rem;
    }
    
    .contact-form input, 
    .contact-form textarea {
        padding: 15px 18px;
        font-size: 0.95rem;
    }
    
    .contact-form button {
        padding: 15px 35px;
        font-size: 1rem;
    }
    
    .file-upload-area {
        padding: 25px 15px;
    }
    
    .file-upload-area i {
        font-size: 2rem;
    }
    
    .file-upload-area span {
        font-size: 0.9rem;
    }
}

/* Small mobile responsive */
@media (max-width: 480px) {
    .map-section {
        display: none !important; /* Hide map section on small mobile */
    }
    
    .map-container {
        width: 100%;
        height: 100%;
    }
    
    .map-container iframe {
        width: 100%;
        height: 100%;
        min-height: 350px;
    }
    
    .map-overlay {
        top: 10px;
        left: 10px;
        right: 10px;
        padding: 12px;
        position: absolute;
        z-index: 10;
    }
    
    .map-overlay h3 {
        font-size: 1rem;
        margin-bottom: 6px;
    }
    
    .map-overlay p {
        font-size: 0.85rem;
        line-height: 1.3;
    }
    
    .directions-btn {
        padding: 8px 14px;
        font-size: 0.85rem;
        margin-top: 10px;
    }
    
    .section-title h2 {
        font-size: 1.8rem;
    }
    
    .section-title p {
        font-size: 1rem;
    }
    
    .social-media-row {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .contact-form-section {
        padding: 25px 15px;
        margin: 0 10px;
    }
    
    .contact-info-section {
        padding: 50px 0 30px 0;
    }
    
    .contact-info-container {
        padding: 0 15px;
    }
    
    .contact-card {
        padding: 20px 15px;
    }
    
    .contact-card-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .contact-card h3 {
        font-size: 1.1rem;
    }
    
    .contact-card p {
        font-size: 0.9rem;
    }
    
    .contact-form input, 
    .contact-form textarea {
        padding: 12px 15px;
        font-size: 0.9rem;
    }
    
    .contact-form button {
        padding: 12px 30px;
        font-size: 0.95rem;
    }
    
    .file-upload-area {
        padding: 20px 12px;
    }
    
    .file-upload-area i {
        font-size: 1.8rem;
    }
    
    .file-upload-area span {
        font-size: 0.85rem;
    }
    
    .login-required-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-login, .btn-register {
        width: 100%;
        max-width: 250px;
        justify-content: center;
    }
}
</style>

<!-- Google Maps Section - First Section -->
<section class="map-section">
    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3275.783147715462!2d10.707045780123575!3d34.811397183960686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1301d5004eb1eeef%3A0x462a50075141490c!2sSOTUMA!5e0!3m2!1sen!2stn!4v1758808157206!5m2!1sen!2stn&hl=fr&zoom=19"
            width="100%" 
            height="100%" 
            style="border:0; display:block; width:100%; height:100%;" 
            allowfullscreen="" 
            loading="lazy" 
            referrerpolicy="no-referrer-when-downgrade"
            title="SOTUMA Location Map">
        </iframe>
        
        <div class="map-overlay">
            <h3>📍 Notre Localisation</h3>
            <p class="address">{{ $settings->address ?? 'Route gremda km8, Sfax, TUNISIE' }}</p>
            <p>Venez nous rendre visite !</p>
            <button class="directions-btn" onclick="openDirections()">
                <i class="fas fa-directions"></i>
                Obtenir l'itinéraire
            </button>
        </div>
    </div>
</section>

<!-- Contact Info Section -->
<section class="contact-info-section">
    <div class="contact-info-container">
        <div class="section-title">
            <h2>Contactez SOTUMA</h2>
                            <p>{{ __('frontend.project_question') }}</p>
        </div>
        
                 <!-- Contact Cards Grid - Removed Address, Phone, and Email cards -->
         
                   <!-- Social Media Cards Grid - Single Row (4 cards) -->
          <div class="social-media-row">
              <!-- Facebook Card -->
              <a href="{{ $settings->facebook ?? 'https://www.facebook.com/sotumasfax' }}" target="_blank" class="contact-card clickable-card">
                  <div class="contact-card-icon facebook-icon">
                      <i class="fab fa-facebook-f"></i>
                  </div>
                  <h3>Facebook</h3>
                  <p>SOTUMA</p>
              </a>
              
              <!-- Instagram Card -->
              <a href="{{ $settings->instagram ?? 'https://www.instagram.com/sotuma_aluminium/' }}" target="_blank" class="contact-card clickable-card">
                  <div class="contact-card-icon instagram-icon">
                      <i class="fab fa-instagram"></i>
                  </div>
                  <h3>Instagram</h3>
                  <p>SOTUMA</p>
              </a>
              
              <!-- LinkedIn Card -->
              <a href="https://www.linkedin.com/company/sotuma/" target="_blank" class="contact-card clickable-card">
                  <div class="contact-card-icon linkedin-icon">
                      <i class="fab fa-linkedin-in"></i>
                  </div>
                  <h3>LinkedIn</h3>
                  <p>SOTUMA</p>
              </a>
              
              <!-- TikTok Card -->
              <a href="{{ $settings->tiktok ?? 'https://www.tiktok.com/@sotumasotuma' }}" target="_blank" class="contact-card clickable-card">
                  <div class="contact-card-icon tiktok-icon">
                      <i class="fab fa-tiktok"></i>
                  </div>
                  <h3>TikTok</h3>
                  <p>SOTUMA</p>
              </a>
          </div>
          
        
        <!-- Contact Form -->
        <div class="contact-form-section">
            <div class="contact-form-title">Envoyez-nous un message</div>
            
            <!-- Show form for all users -->
            <form class="contact-form" method="POST" action="{{ route('contact.store') }}" enctype="multipart/form-data" id="contactForm">
                @csrf
                
                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger" style="grid-column: 1 / -1; margin-bottom: 20px; padding: 15px; border-radius: 8px; background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24;">
                        <h6 style="margin: 0 0 10px 0; font-weight: bold;">Erreurs de validation:</h6>
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <!-- Display success message -->
                @if (session('success'))
                    <div class="alert alert-success" style="grid-column: 1 / -1; margin-bottom: 20px; padding: 15px; border-radius: 8px; background: #d4edda; border: 1px solid #c3e6cb; color: #155724;">
                        <strong>Succès!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="contact-form-group">
                    <label for="name">Nom *</label>
                    <input type="text" name="name" id="name" required @auth value="{{ auth()->user()->name }}" @endauth>
                </div>
                <div class="contact-form-group">
                    <label for="email">Email *</label>
                    <input type="email" name="email" id="email" required @auth value="{{ auth()->user()->email }}" @endauth>
                </div>
                <div class="contact-form-group">
                    <label for="phone">Téléphone</label>
                    <input type="tel" name="phone" id="phone">
                </div>
                <div class="contact-form-group full-width">
                    <label for="subject">Sujet *</label>
                    <input type="text" name="subject" id="subject" required>
                </div>
                <div class="contact-form-group full-width">
                    <label for="message">Message *</label>
                    <textarea name="message" id="message" required minlength="20"></textarea>
                </div>
                <div class="contact-form-group full-width">
                    <div class="file-upload-area" id="file-upload-area">
                        <i class="fas fa-paperclip"></i>
                        <span id="file-upload-text">Fichier PDF ou pièce jointe (glissez-déposez ou cliquez ici)</span>
                        <input type="file" name="attachment" id="attachment" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" style="opacity:0;position:absolute;left:0;top:0;width:100%;height:100%;cursor:pointer;">
                    </div>
                </div>
                <button type="submit" id="submitBtn">{{ __('frontend.send') }} le message</button>
            </form>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
<script>
// File upload drag & drop effect
const fileUploadArea = document.getElementById('file-upload-area');
const fileInput = document.getElementById('attachment');
const fileText = document.getElementById('file-upload-text');

if(fileUploadArea && fileInput && fileText) {
    fileUploadArea.addEventListener('dragover', function(e) {
        e.preventDefault();
        fileUploadArea.classList.add('dragover');
    });
    
    fileUploadArea.addEventListener('dragleave', function(e) {
        fileUploadArea.classList.remove('dragover');
    });
    
    fileUploadArea.addEventListener('drop', function(e) {
        e.preventDefault();
        fileUploadArea.classList.remove('dragover');
        if(e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            fileText.textContent = e.dataTransfer.files[0].name;
        }
    });
    
    fileInput.addEventListener('change', function(e) {
        if(fileInput.files.length) {
            fileText.textContent = fileInput.files[0].name;
        } else {
            fileText.textContent = 'Fichier PDF ou pièce jointe (glissez-déposez ou cliquez ici)';
        }
    });
}



// Smooth scroll for contact cards
document.querySelectorAll('.contact-card a').forEach(link => {
    link.addEventListener('click', function(e) {
        if (this.href.startsWith('tel:') || this.href.startsWith('mailto:')) {
            return; // Allow phone and email links
        }
        // Add smooth transition for external links
        this.style.transition = 'all 0.3s ease';
    });
});

// Enhanced click effects for clickable cards
document.querySelectorAll('.clickable-card').forEach(card => {
    card.addEventListener('click', function(e) {
        // Add a subtle click animation
        this.style.transform = 'scale(0.98)';
        setTimeout(() => {
            this.style.transform = '';
        }, 150);
    });
    
    // Add keyboard accessibility
    card.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            this.click();
        }
    });
    
    // Make cards focusable
    card.setAttribute('tabindex', '0');
    card.setAttribute('role', 'button');
});

// Open Google Maps with directions to SOTUMA
function openDirections() {
    // SOTUMA coordinates: 34.811397183960686, 10.707045780123575
    const latitude = 34.811397183960686;
    const longitude = 10.707045780123575;
    const address = "SOTUMA, Route gremda km8, Sfax, TUNISIE";
    
    // Check if user is on mobile device
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    
    if (isMobile) {
        // Open in Google Maps app on mobile
        const mapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${latitude},${longitude}&destination_place_id=ChIJN1t_tDeuRUcRkM8G_kgVGF0`;
        window.open(mapsUrl, '_blank');
    } else {
        // Open in new tab on desktop
        const mapsUrl = `https://www.google.com/maps/dir/?api=1&destination=${latitude},${longitude}&destination_place_id=ChIJN1t_tDeuRUcRkM8G_kgVGF0`;
        window.open(mapsUrl, '_blank');
    }
}

// Real-time form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const messageField = document.getElementById('message');
    const nameField = document.getElementById('name');
    const emailField = document.getElementById('email');
    const subjectField = document.getElementById('subject');
    
    // Validation functions
    function validateName() {
        const name = nameField.value.trim();
        if (name.length < 2) {
            showFieldError(nameField, 'Le nom doit contenir au moins 2 caractères');
            return false;
        } else {
            clearFieldError(nameField);
            return true;
        }
    }
    
    function validateEmail() {
        const email = emailField.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            showFieldError(emailField, 'Veuillez entrer une adresse email valide');
            return false;
        } else {
            clearFieldError(emailField);
            return true;
        }
    }
    
    function validateSubject() {
        const subject = subjectField.value.trim();
        if (subject.length < 1) {
            showFieldError(subjectField, 'Le sujet est requis');
            return false;
        } else {
            clearFieldError(subjectField);
            return true;
        }
    }
    
    function validateMessage() {
        const message = messageField.value.trim();
        if (message.length < 20) {
            showFieldError(messageField, 'Le message doit contenir au moins 20 caractères (' + message.length + '/20)');
            return false;
        } else {
            clearFieldError(messageField);
            return true;
        }
    }
    
    function showFieldError(field, message) {
        clearFieldError(field);
        field.style.borderColor = '#dc3545';
        field.style.backgroundColor = '#fff5f5';
        
        const errorDiv = document.createElement('div');
        errorDiv.className = 'field-error';
        errorDiv.style.color = '#dc3545';
        errorDiv.style.fontSize = '0.875rem';
        errorDiv.style.marginTop = '5px';
        errorDiv.textContent = message;
        
        field.parentNode.appendChild(errorDiv);
    }
    
    function clearFieldError(field) {
        field.style.borderColor = '#e9ecef';
        field.style.backgroundColor = 'rgba(255,255,255,0.8)';
        
        const existingError = field.parentNode.querySelector('.field-error');
        if (existingError) {
            existingError.remove();
        }
    }
    
    // Add event listeners for real-time validation
    nameField.addEventListener('blur', validateName);
    nameField.addEventListener('input', function() {
        if (this.value.trim().length >= 2) {
            clearFieldError(this);
        }
    });
    
    emailField.addEventListener('blur', validateEmail);
    emailField.addEventListener('input', function() {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailRegex.test(this.value.trim())) {
            clearFieldError(this);
        }
    });
    
    subjectField.addEventListener('blur', validateSubject);
    subjectField.addEventListener('input', function() {
        if (this.value.trim().length >= 1) {
            clearFieldError(this);
        }
    });
    
    messageField.addEventListener('blur', validateMessage);
    messageField.addEventListener('input', function() {
        if (this.value.trim().length >= 20) {
            clearFieldError(this);
        } else {
            showFieldError(this, 'Le message doit contenir au moins 20 caractères (' + this.value.trim().length + '/20)');
        }
    });
    
    // Form submission validation
    form.addEventListener('submit', function(e) {
        let isValid = true;
        
        if (!validateName()) isValid = false;
        if (!validateEmail()) isValid = false;
        if (!validateSubject()) isValid = false;
        if (!validateMessage()) isValid = false;
        
        if (!isValid) {
            e.preventDefault();
            showFormError('Veuillez corriger les erreurs ci-dessous avant de soumettre le formulaire.');
        }
    });
    
    function showFormError(message) {
        // Remove existing form error
        const existingError = form.querySelector('.form-error');
        if (existingError) {
            existingError.remove();
        }
        
        // Create new error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'form-error';
        errorDiv.style.gridColumn = '1 / -1';
        errorDiv.style.marginBottom = '20px';
        errorDiv.style.padding = '15px';
        errorDiv.style.borderRadius = '8px';
        errorDiv.style.background = '#f8d7da';
        errorDiv.style.border = '1px solid #f5c6cb';
        errorDiv.style.color = '#721c24';
        errorDiv.innerHTML = '<strong>Erreur:</strong> ' + message;
        
        // Insert at the beginning of the form
        form.insertBefore(errorDiv, form.firstChild);
        
        // Scroll to error
        errorDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});
</script>

@endsection