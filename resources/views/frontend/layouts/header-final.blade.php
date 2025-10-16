<!DOCTYPE html>
<header class="main-header">
    <nav class="header-nav">
        <!-- Logo Section -->
        <div class="logo-section">
            <a href="{{ route('home') }}" class="logo-link">
                <img src="{{ asset('images/logo2.png') }}" alt="SOTUMA" class="logo-img">
            </a>
        </div>
        
        <!-- Navigation Menu -->
        <ul class="nav-menu">
            <li><a href="{{ route('home') }}">{{ __('frontend.home') }}</a></li>
            <li><a href="{{ route('about-us') }}">{{ __('frontend.about') }}</a></li>
            <li><a href="{{ route('media') }}">{{ __('frontend.media') }}</a></li>
            <li class="dropdown">
                <a href="{{ route('project-categories.index') }}">{{ __('frontend.projects') }} ▼</a>
                <div class="dropdown-content">
                    <a href="{{ route('project-categories.index') }}">{{ __('frontend.all') }}</a>
                    @foreach(\App\Models\ProjectCategory::orderBy('name','ASC')->get() as $cat)
                        <a href="{{ route('project-categories.show', $cat->slug) }}">{{ $cat->name }}</a>
                    @endforeach
                </div>
            </li>
            <li class="dropdown">
                <a href="{{ route('categories.index') }}">{{ __('frontend.products') }} ▼</a>
                <div class="dropdown-content">
                    <a href="{{ route('categories.index') }}">{{ __('frontend.all') }}</a>
                    @foreach(\App\Models\Category::whereNull('parent_id')->orderBy('sort_order','ASC')->orderBy('title','ASC')->get() as $cat)
                        <a href="{{ route('categories.show', $cat->slug ?? Str::slug($cat->title)) }}">{{ $cat->title }}</a>
                    @endforeach
                </div>
            </li>
            <li><a href="{{ route('certificates') }}">{{ __('frontend.certificates') }}</a></li>
            <li><a href="{{ route('contact') }}">{{ __('frontend.contact') }}</a></li>
        </ul>
        
        <!-- Right Section -->
        <div class="right-section">
            <div class="auth-links">
                @if(auth()->check())
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin')
                        <a href="{{ route('register.form') }}">{{ __('frontend.register') }}</a>
                        <span>|</span>
                        <a href="{{ route('admin') }}" class="dashboard-btn">{{ __('frontend.dashboard') }}</a>
                    @else
                        <a href="{{ route('register.form') }}">{{ __('frontend.register') }}</a>
                        <span>|</span>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('frontend.logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    @endif
                @else
                    <a href="{{ route('register.form') }}">{{ __('frontend.register') }}</a>
                    <span>|</span>
                    <a href="{{ route('login.form') }}">{{ __('frontend.login') }}</a>
                @endif
            </div>
            
            <div class="lang-switch">
                @php
                    $currentLang = app()->getLocale();
                    $langs = [
                        'fr' => ['name' => 'Français', 'flag' => asset('flags/fr.svg')],
                        'en' => ['name' => 'English', 'flag' => asset('flags/uk.svg')],
                        'ar' => ['name' => 'العربية', 'flag' => asset('flags/sa.svg')],
                    ];
                @endphp
                <div class="lang-dropdown">
                    <div class="lang-current">
                        <img src="{{ $langs[$currentLang]['flag'] }}" alt="{{ $langs[$currentLang]['name'] }}">
                        <span>{{ $langs[$currentLang]['name'] }}</span>
                        <span>▼</span>
                    </div>
                    <div class="lang-options">
                        @foreach($langs as $code => $lang)
                            <a href="{{ request()->fullUrlWithQuery(['lang' => $code]) }}">
                                <img src="{{ $lang['flag'] }}" alt="{{ $lang['name'] }}">
                                <span>{{ $lang['name'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <button id="fullscreenBtn" class="fullscreen-btn">
                <i class="fas fa-expand"></i>
            </button>
        </div>
        
        <!-- Mobile Navigation - Single Block Design -->
        <div class="mobile-nav-container">
            <!-- Mobile Toggle (Left) -->
            <button class="mobile-toggle" aria-label="Toggle mobile menu" aria-expanded="false">
                <span class="burger-line"></span>
                <span class="burger-line"></span>
                <span class="burger-line"></span>
            </button>
            
            <!-- Mobile Quick Actions (Evenly Spaced) -->
            <a href="{{ route('about-us') }}" class="mobile-nav-btn" title="À Propos">
                <i class="bi bi-info-circle" style="font-size: 20px; color: currentColor;"></i>
            </a>
            
            <a href="{{ route('project-categories.index') }}" class="mobile-nav-btn" title="Projets">
                <i class="bi bi-building" style="font-size: 20px; color: currentColor;"></i>
            </a>
            
            <a href="{{ route('categories.index') }}" class="mobile-nav-btn" title="Produits">
                <i class="bi bi-box-seam" style="font-size: 20px; color: currentColor;"></i>
            </a>
            
            <a href="{{ route('contact') }}" class="mobile-nav-btn" title="Contact">
                <i class="bi bi-envelope" style="font-size: 20px; color: currentColor;"></i>
            </a>
        </div>
    </nav>
    
    <!-- Professional Mobile Menu -->
    <div class="mobile-menu" role="navigation" aria-hidden="true">
        <div class="mobile-menu-header">
            <img src="{{ asset('images/hethahou1.png') }}" alt="SOTUMA" class="mobile-menu-logo">
            <button class="mobile-close" aria-label="Close menu">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="mobile-menu-content">
            <ul class="mobile-nav-list">
                <li class="mobile-nav-item">
                    <a href="{{ route('home') }}" class="mobile-nav-link">
                        <i class="fas fa-home"></i>
                        <span>{{ __('frontend.home') }}</span>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <a href="{{ route('about-us') }}" class="mobile-nav-link">
                        <i class="fas fa-info-circle"></i>
                        <span>{{ __('frontend.about') }}</span>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <a href="{{ route('media') }}" class="mobile-nav-link">
                        <i class="fas fa-images"></i>
                        <span>{{ __('frontend.media') }}</span>
                    </a>
                </li>
                
                <!-- Projects Mobile Dropdown -->
                <li class="mobile-nav-item mobile-dropdown-item">
                    <button class="mobile-dropdown-trigger" aria-expanded="false">
                        <div class="mobile-dropdown-label">
                            <i class="fas fa-project-diagram"></i>
                            <span>{{ __('frontend.projects') }}</span>
                        </div>
                        <i class="fas fa-chevron-down mobile-dropdown-arrow"></i>
                    </button>
                    <ul class="mobile-dropdown-menu">
                        <li><a href="{{ route('project-categories.index') }}" class="mobile-dropdown-link">{{ __('frontend.all') }}</a></li>
                        @foreach(\App\Models\ProjectCategory::orderBy('name','ASC')->get() as $cat)
                            <li><a href="{{ route('project-categories.show', $cat->slug) }}" class="mobile-dropdown-link">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
                
                <!-- Products Mobile Dropdown -->
                <li class="mobile-nav-item mobile-dropdown-item">
                    <button class="mobile-dropdown-trigger" aria-expanded="false">
                        <div class="mobile-dropdown-label">
                            <i class="fas fa-boxes"></i>
                            <span>{{ __('frontend.products') }}</span>
                        </div>
                        <i class="fas fa-chevron-down mobile-dropdown-arrow"></i>
                    </button>
                    <ul class="mobile-dropdown-menu">
                        <li><a href="{{ route('categories.index') }}" class="mobile-dropdown-link">{{ __('frontend.all') }}</a></li>
                        @foreach(\App\Models\Category::whereNull('parent_id')->orderBy('sort_order','ASC')->orderBy('title','ASC')->get() as $cat)
                            <li><a href="{{ route('categories.show', $cat->slug ?? Str::slug($cat->title)) }}" class="mobile-dropdown-link">{{ $cat->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
                
                <li class="mobile-nav-item">
                    <a href="{{ route('certificates') }}" class="mobile-nav-link">
                        <i class="fas fa-certificate"></i>
                        <span>{{ __('frontend.certificates') }}</span>
                    </a>
                </li>
                <li class="mobile-nav-item">
                    <a href="{{ route('contact') }}" class="mobile-nav-link">
                        <i class="fas fa-envelope"></i>
                        <span>{{ __('frontend.contact') }}</span>
                    </a>
                </li>
            </ul>
            
            <!-- Mobile Language Switcher - YouTube Red Theme -->
            <li class="mobile-nav-item">
                <div class="mobile-lang-switcher">
                    <div class="mobile-lang-header">
                        <i class="fas fa-globe"></i>
                        <span>Language</span>
                        <i class="fas fa-chevron-down mobile-lang-arrow"></i>
                    </div>
                    <div class="mobile-lang-options">
                        @php
                            $currentLang = app()->getLocale();
                            $langs = [
                                'fr' => ['name' => 'Français', 'flag' => asset('flags/fr.svg')],
                                'en' => ['name' => 'English', 'flag' => asset('flags/uk.svg')],
                                'ar' => ['name' => 'العربية', 'flag' => asset('flags/sa.svg')],
                            ];
                        @endphp
                        @foreach($langs as $code => $lang)
                            <a href="{{ request()->fullUrlWithQuery(['lang' => $code]) }}" 
                               class="mobile-lang-option {{ $currentLang === $code ? 'active' : '' }}">
                                <div class="mobile-lang-option-content">
                                    <img src="{{ $lang['flag'] }}" 
                                         alt="{{ $lang['name'] }}" 
                                         class="mobile-lang-flag"
                                         onerror="this.src='{{ asset('flags/default.svg') }}';">
                                    <span class="mobile-lang-name">{{ $lang['name'] }}</span>
                                    @if($currentLang === $code)
                                        <i class="fas fa-check mobile-lang-check"></i>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </li>

            <!-- Mobile Auth Section -->
            <div class="mobile-auth-section">
                <div class="mobile-auth-links">
                    @if(auth()->check())
                        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin')
                            <a href="{{ route('admin') }}" class="mobile-auth-link mobile-dashboard-link">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>{{ __('frontend.dashboard') }}</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        @else
                            <a href="{{ route('register.form') }}" class="mobile-auth-link">
                                <i class="fas fa-user-plus"></i>
                                <span>{{ __('frontend.register') }}</span>
                            </a>
                        @endif
                        <a href="{{ route('logout') }}" class="mobile-auth-link" onclick="event.preventDefault(); document.getElementById('mobile-logout').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>{{ __('frontend.logout') }}</span>
                        </a>
                        <form id="mobile-logout" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    @else
                        <a href="{{ route('register.form') }}" class="mobile-auth-link">
                            <i class="fas fa-user-plus"></i>
                            <span>{{ __('frontend.register') }}</span>
                        </a>
                        <a href="{{ route('login.form') }}" class="mobile-auth-link mobile-login-primary">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>{{ __('frontend.login') }}</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    @endif
                </div>
                
            </div>
        </div>
    </div>
    <div class="mobile-overlay"></div>
</header>

<style>
/* Clean Header Styles */
.main-header {
    width: 100%;
    background: #fff;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    position: static;
    z-index: auto;
}

.header-nav {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 5px 20px 10px 20px;
    min-height: 65px;
}

/* Logo - Left with even more padding */
.logo-section {
    padding-left: 50px;
    margin-right: 60px;
}

.logo-img {
    height: 160px;
    max-width: 550px;
}

/* Navigation - Centered */
.nav-menu {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 30px;
    list-style: none;
    margin: 0;
    padding: 0;
    flex: 1;
}

.nav-menu a {
    color: #333;
    text-decoration: none;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 1.1rem;
    letter-spacing: 1px;
    padding: 12px 16px;
    transition: color 0.3s ease;
}

.nav-menu a:hover {
    color: #666;
}

/* Dropdown */
.dropdown {
    position: relative;
}

.dropdown-content {
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 260px;
    background: #fff;
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    border-radius: 0 0 12px 12px;
    padding: 16px 0;
    display: none;
    z-index: 99999;
    border: 1px solid rgba(0,0,0,0.05);
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown-content a {
    display: block;
    padding: 12px 28px;
    color: #333;
    text-decoration: none;
    font-size: 1rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.2s ease;
    margin: 2px 0;
}

.dropdown-content a:hover {
    background: rgba(128, 128, 128, 0.08);
    color: #666;
    padding-left: 32px;
}

/* Right Section */
.right-section {
    display: flex;
    align-items: center;
    gap: 25px;
    margin-left: auto;
    padding-right: 20px;
}

.auth-links {
    display: flex;
    align-items: center;
    gap: 12px;
}

.auth-links a {
    color: #333;
    text-decoration: none;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 1rem;
    letter-spacing: 0.5px;
    padding: 12px 16px;
    transition: color 0.3s ease;
}

.auth-links a:hover {
    color: #666;
}

.dashboard-btn {
    background: linear-gradient(135deg, #FF0000 0%, #FF0000 100%);
    color: white !important;
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(255, 193, 7, 0.3);
}

.dashboard-btn:hover {
    background: rgba(128, 128, 128, 0.9);
    color: white !important;
}

.auth-links span {
    color: #333;
    margin: 0 4px;
}

/* Professional Language Switcher */
.lang-switch {
    position: relative;
}

.lang-dropdown {
    position: relative;
    cursor: pointer;
}

.lang-current {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 16px;
    background: white;
    border: 2px solid rgba(210, 180, 140, 0.2);
    border-radius: 12px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    min-width: 150px;
}

.lang-current:hover {
    background: rgba(210, 180, 140, 0.05);
    border-color: rgba(210, 180, 140, 0.4);
    box-shadow: 0 4px 16px rgba(0,0,0,0.1);
    transform: translateY(-1px);
}

.lang-current img {
    width: 28px;
    height: 21px;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}

.lang-current span:first-of-type {
    font-size: 1rem;
    font-weight: 600;
    color: #333;
    flex: 1;
}

.lang-current span:last-child {
    font-size: 0.8rem;
    color: #666;
    transition: all 0.3s ease;
}

.lang-dropdown:hover .lang-current span:last-child {
    transform: rotate(180deg);
    color: #D2B48C;
}

.lang-options {
    position: absolute;
    top: calc(100% + 4px);
    left: 0;
    right: 0;
    background: white;
    border: 2px solid rgba(210, 180, 140, 0.2);
    border-radius: 12px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.15);
    display: none;
    z-index: 9999;
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.lang-dropdown:hover .lang-options {
    display: block;
    animation: slideDown 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-8px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.lang-options a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    color: #333;
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-bottom: 1px solid rgba(210, 180, 140, 0.1);
}

.lang-options a:last-child {
    border-bottom: none;
}

.lang-options a:hover {
    background: rgba(210, 180, 140, 0.1);
    color: #D2B48C;
    padding-left: 20px;
}

.lang-options a img {
    width: 28px;
    height: 21px;
    border-radius: 4px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}

/* Fullscreen Button */
.fullscreen-btn {
    background: none;
    border: none;
    color: #333;
    font-size: 1.1rem;
    padding: 12px;
    cursor: pointer;
    transition: color 0.3s ease;
}

.fullscreen-btn:hover {
    color: #666;
}

/* Senior-Level Mobile Styles */
.mobile-toggle {
    display: none;
    background: none;
    border: none;
    cursor: pointer;
    flex-direction: column;
    gap: 2px; /* Reduced from 5px */
    padding: 12px;
    border-radius: 6px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.mobile-toggle:hover {
    background: rgba(255, 107, 107, 0.1); /* Light red background on hover */
}

.burger-line {
    width: 28px;
    height: 3px;
    background: linear-gradient(135deg, #FF6B6B, #FF8E8E, #FFAAAA);
    border-radius: 2px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.mobile-toggle.active .burger-line:nth-child(1) {
    transform: rotate(45deg) translate(7px, 7px);
}

.mobile-toggle.active .burger-line:nth-child(2) {
    opacity: 0;
    transform: scale(0);
}

.mobile-toggle.active .burger-line:nth-child(3) {
    transform: rotate(-45deg) translate(7px, -7px);
}

/* Professional Mobile Menu */
.mobile-menu {
    position: fixed;
    top: 0;
    left: -100%;
    width: 340px;
    height: 100vh;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    box-shadow: 4px 0 32px rgba(0,0,0,0.15);
    z-index: 9999;
    transition: left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow-y: auto;
    -webkit-overflow-scrolling: touch;
}

.mobile-menu.active {
    left: 0;
}

/* Mobile Menu Header */
.mobile-menu-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1.5rem 2rem;
    background: transparent;
    color: #333;
    border-bottom: 1px solid rgba(210, 180, 140, 0.2);
}

/* Remove the first decorative line in the hamburger (header separator) */
.mobile-menu-header { border-bottom: none !important; }

.mobile-menu-logo {
    height: 50px;
    width: auto;
    max-width: 150px;
}

/* Tiny logo fixed to top-left inside hamburger menu */
.mobile-menu-header { position: relative; }
.mobile-menu .mobile-menu-logo {
    position: absolute !important;
    top: 8px !important; /* moved a bit up */
    left: 16px !important;
    height: 56px !important; /* 2x bigger */
    width: auto !important;
    max-width: none !important;
    object-fit: contain !important;
}
/* Ensure close button is on the right inside the hamburger header */
.mobile-menu .mobile-close {
    position: absolute !important;
    top: 12px !important;
    right: 12px !important;
}

.mobile-close {
    background: none;
    border: none;
    color: #666;
    font-size: 1.5rem;
    padding: 0.5rem;
    cursor: pointer;
    border-radius: 50%;
    transition: all 0.3s ease;
}

.mobile-close:hover {
    background: rgba(210, 180, 140, 0.1);
    color: #D2B48C;
    transform: rotate(90deg);
}

/* Mobile Menu Content */
.mobile-menu-content {
    padding: 1.5rem 0;
}

.mobile-nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mobile-nav-item {
    margin-bottom: 0;
    border-bottom: 1px solid #eaeaea; /* separator line under each button */
}

.mobile-nav-item:last-child {
    border-bottom: none;
}

.mobile-nav-link {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 2rem;
    color: #333;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-left: 4px solid transparent;
    width: 100%; /* make border span full width */
    border-bottom: 1px solid #eaeaea; /* separator under each item */
}

.mobile-nav-link:hover {
    background: rgba(210, 180, 140, 0.1);
    color: #FF0000;
    border-left-color: #FF0000;
    padding-left: 2.5rem;
}

.mobile-nav-link i {
    font-size: 1.2rem;
    width: 24px;
    text-align: center;
    color: #666;
}

.mobile-nav-link:hover i {
    color: #FF0000;
}

/* Mobile Dropdown Styles */
.mobile-dropdown-item {
    position: relative;
}

.mobile-dropdown-trigger {
    width: 100%;
    background: none;
    border: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 2rem;
    color: #333;
    font-weight: 600;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-left: 4px solid transparent;
    text-align: left;
    border-bottom: 1px solid #eaeaea; /* separator under dropdown rows */
}

.mobile-dropdown-trigger:hover {
    background: rgba(210, 180, 140, 0.1);
    color: #FF0000;
    border-left-color: #FF0000;
    padding-left: 2.5rem;
}

.mobile-dropdown-label {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.mobile-dropdown-label i {
    font-size: 1.2rem;
    width: 24px;
    text-align: center;
    color: #666;
}

.mobile-dropdown-trigger:hover .mobile-dropdown-label i {
    color: #FF0000;
}

.mobile-dropdown-arrow {
    font-size: 0.9rem;
    color: #666;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.mobile-dropdown-trigger.active .mobile-dropdown-arrow {
    transform: rotate(180deg);
    color: #FF0000;
}

.mobile-dropdown-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    background: rgba(248, 249, 250, 0.8);
    border-radius: 0 12px 12px 0;
    margin-left: 2rem;
    margin-right: 1rem;
    overflow: hidden;
    max-height: 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.mobile-dropdown-menu.active {
    max-height: 400px;
    padding: 0.5rem 0;
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

.mobile-dropdown-link {
    display: block;
    padding: 0.75rem 1.5rem;
    color: #555;
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    transition: all 0.3s ease;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.mobile-dropdown-link:last-child {
    border-bottom: none;
}

.mobile-dropdown-link:hover {
    background: rgba(210, 180, 140, 0.15);
    color: #D2B48C;
    padding-left: 2rem;
    transform: translateX(4px);
}

/* Mobile Language Switcher - YouTube Red Theme */
.mobile-lang-switcher {
    padding: 0;
    margin: 0;
}

.mobile-lang-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 2rem;
    color: #333;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-left: 4px solid transparent;
    border-bottom: 1px solid #eaeaea; /* separator under language header */
}

.mobile-lang-header:hover {
    background: rgba(255, 0, 0, 0.1);
    color: #FF0000;
    border-left-color: #FF0000;
    padding-left: 2.5rem;
}

.mobile-lang-header i {
    font-size: 1.2rem;
    width: 24px;
    text-align: center;
    color: #666;
}

.mobile-lang-header:hover i {
    color: #FF0000;
}

.mobile-lang-header span {
    flex: 1;
}

.mobile-lang-arrow {
    font-size: 0.9rem;
    color: #666;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.mobile-lang-header:hover .mobile-lang-arrow {
    color: #FF0000;
}

.mobile-lang-options.active ~ .mobile-lang-header .mobile-lang-arrow,
.mobile-lang-header.active .mobile-lang-arrow {
    transform: rotate(180deg);
    color: #FF0000;
}

.mobile-lang-options {
    display: flex;
    flex-direction: column;
    background: rgba(248, 249, 250, 0.8);
    border-radius: 0 12px 12px 0;
    margin-left: 2rem;
    margin-right: 1rem;
    overflow: hidden;
    max-height: 0;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.mobile-lang-options.active {
    max-height: 300px;
    padding: 0.5rem 0;
    margin-top: 0.5rem;
    margin-bottom: 0.5rem;
}

.mobile-lang-option {
    display: block;
    text-decoration: none;
    transition: all 0.3s ease;
    border-bottom: 1px solid rgba(0,0,0,0.05);
}

.mobile-lang-option:last-child {
    border-bottom: none;
}

.mobile-lang-option:hover {
    background: rgba(255, 0, 0, 0.1);
    padding-left: 2rem;
    transform: translateX(4px);
}

.mobile-lang-option-content {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0.75rem 1.5rem;
    color: #555;
    font-weight: 500;
    font-size: 1rem;
}

.mobile-lang-flag {
    width: 24px;
    height: 18px;
    border-radius: 3px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
    object-fit: cover;
    border: 1px solid rgba(0,0,0,0.1);
    flex-shrink: 0;
}

.mobile-lang-name {
    flex: 1;
    color: #555;
}

.mobile-lang-option:hover .mobile-lang-name {
    color: #FF0000;
}

.mobile-lang-option.active .mobile-lang-name {
    color: #FF0000;
    font-weight: 600;
}

.mobile-lang-check {
    font-size: 1rem;
    color: #FF0000;
    background: rgba(255, 0, 0, 0.1);
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* RTL Support */
[dir="rtl"] .mobile-lang-option-content {
    flex-direction: row-reverse;
}

[dir="rtl"] .mobile-lang-header {
    flex-direction: row-reverse;
}

[dir="rtl"] .mobile-lang-options {
    margin-left: 1rem;
    margin-right: 2rem;
    border-radius: 12px 0 0 12px;
}

/* Mobile Auth Section */
.mobile-auth-section {
    border-top: 2px solid rgba(210, 180, 140, 0.2);
    margin-top: 1.5rem;
    padding-top: 1.5rem;
    margin-left: 2rem;
    margin-right: 2rem;
}

.mobile-auth-header h4 {
    color: #666;
    font-size: 0.9rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin: 0 0 1rem 0;
    text-align: center;
}

.mobile-auth-links {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.mobile-auth-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 1rem 1.5rem;
    color: #333;
    text-decoration: none;
    font-weight: 600;
    font-size: 1rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(0,0,0,0.05);
}

.mobile-auth-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 16px rgba(0,0,0,0.12);
    background: rgba(210, 180, 140, 0.05);
}

.mobile-auth-link i:first-child {
    font-size: 1.2rem;
    color: #666;
}

.mobile-auth-link:hover i:first-child {
    color: #D2B48C;
}

.mobile-auth-link i:last-child {
    font-size: 1rem;
    color: #999;
}

.mobile-dashboard-link {
    background: linear-gradient(135deg, #FF0000 0%, #FF0000 100%);
    color: white !important;
    border: none;
}

.mobile-dashboard-link:hover {
    background: linear-gradient(135deg, #CC0000 0%, #990000 100%);
    color: white !important;
}

.mobile-dashboard-link i {
    color: white !important;
}

.mobile-login-primary {
    background: linear-gradient(135deg, #FF0000 0%, #CC0000 100%);
    color: white !important;
    border: none;
}

.mobile-login-primary:hover {
    background: linear-gradient(135deg, #CC0000 0%, #990000 100%);
    color: white !important;
}

.mobile-login-primary i {
    color: white !important;
}


.mobile-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.5);
    z-index: 9998;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
}

.mobile-overlay.active {
    opacity: 1;
    visibility: visible;
}

/* Show desktop navigation on desktop screens */
@media (min-width: 1025px) {
    .nav-menu,
    .right-section,
    .logo-section {
        display: flex !important;
    }
    
    .mobile-nav-container {
        display: none !important;
    }
}

/* Responsive */
@media (max-width: 1024px) {
    /* Hide desktop navigation */
    .nav-menu,
    .right-section,
    .logo-section {
        display: none !important;
    }
    
    /* Mobile Navigation - Single Block Design */
    .mobile-nav-container {
        display: flex;
        align-items: center;
        justify-content: space-evenly;
        width: 100%;
        height: 5rem; /* 80px */
        padding: 0 0.75rem; /* 12px */
        background: #fff;
        border-bottom: 1px solid #f0f0f0;
        gap: 0.5rem; /* 8px */
    }
    
    /* Mobile Toggle Button - No Background */
    .mobile-toggle {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 3rem; /* 48px */
        height: 3rem; /* 48px */
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        border-radius: 0.75rem; /* 12px */
        transition: all 0.3s ease;
    }
    
    .mobile-toggle:hover {
        background: rgba(255, 0, 0, 0.1);
        transform: translateY(-1px);
    }
    
    .mobile-toggle.active {
        background: rgba(255, 0, 0, 0.1);
        transform: scale(0.95);
    }
    
    .mobile-toggle.active .burger-line {
        background: linear-gradient(135deg, #FF4444, #FF6666, #FF9999);
    }
    
    .burger-line {
        width: 1.25rem; /* 20px */
        height: 0.125rem; /* 2px */
        background: linear-gradient(135deg, #FF6B6B, #FF8E8E, #FFAAAA);
        margin: 0.0625rem 0; /* 1px - reduced from 2px */
        transition: all 0.3s ease;
        border-radius: 0.125rem; /* 2px */
    }
    
    .mobile-toggle:hover .burger-line {
        background: linear-gradient(135deg, #FF5252, #FF7979, #FFB3B3);
    }
    
            /* Mobile Navigation Buttons - No Box Styling */
            .mobile-nav-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 3rem; /* 48px */
                height: 3rem; /* 48px */
                background: transparent;
                border: none;
                color: #374151;
                text-decoration: none;
                transition: all 0.3s ease;
                flex-shrink: 0;
                padding: 0;
            }
            
            .mobile-nav-btn:hover {
                color: #FF0000;
                transform: translateY(-1px) scale(1.1);
            }
    
    .mobile-nav-btn svg {
        width: 1.25rem; /* 20px */
        height: 1.25rem; /* 20px */
        transition: all 0.3s ease;
    }
    
    .mobile-nav-btn:hover svg {
        transform: scale(1.1);
    }
    
    
    /* Update header nav for mobile */
    .header-nav {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        min-height: 5rem; /* 80px */
    }
}

@media (max-width: 768px) {
    .mobile-nav-container {
        padding: 0 0.5rem; /* 8px */
        gap: 0.375rem; /* 6px */
    }
    
    .mobile-toggle,
    .mobile-nav-btn {
        width: 2.75rem; /* 44px */
        height: 2.75rem; /* 44px */
    }
    
            .mobile-nav-btn svg {
                width: 1.125rem; /* 18px */
                height: 1.125rem; /* 18px */
            }
            
            .mobile-nav-btn:hover {
                transform: translateY(-1px) scale(1.05);
            }
}

@media (max-width: 480px) {
    .mobile-nav-container {
        padding: 0 0.375rem; /* 6px */
        gap: 0.25rem; /* 4px */
    }
    
    .mobile-toggle,
    .mobile-nav-btn {
        width: 2.5rem; /* 40px */
        height: 2.5rem; /* 40px */
    }
    
            .mobile-nav-btn svg {
                width: 1rem; /* 16px */
                height: 1rem; /* 16px */
            }
            
            .mobile-nav-btn:hover {
                transform: translateY(-1px) scale(1.05);
            }
    
    .burger-line {
        width: 1rem; /* 16px */
        margin: 0.03125rem 0; /* 0.5px - even tighter on small screens */
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Senior-Level Mobile Navigation
    class MobileNavigation {
        constructor() {
            this.toggle = document.querySelector('.mobile-toggle');
            this.menu = document.querySelector('.mobile-menu');
            this.overlay = document.querySelector('.mobile-overlay');
            this.closeBtn = document.querySelector('.mobile-close');
            this.init();
        }
        
        init() {
            this.ensureInBody();
            this.forceClosedState();
            this.bindEvents();
            this.setupDropdowns();
            this.setupAccessibility();
            // Reinitialize on pageshow (bfcache restores) to ensure handlers/state
            window.addEventListener('pageshow', (e) => {
                // Only reinitialize on BFCache restores; avoid toggling state on hard loads
                if (e.persisted) {
                    this.reinitialize();
                } else {
                    // Ensure closed state on normal load
                    this.forceClosedState();
                }
            });
            // Guard again after other scripts run
            setTimeout(() => this.forceClosedState(), 0);
        }
        
        bindEvents() {
            if (this.toggle && this.menu && this.overlay) {
                this.toggle.addEventListener('click', (e) => {
                    if (!e.isTrusted) return; // ignore programmatic clicks
                    this.toggleMenu();
                });
                // Overlay remains non-blocking; close on outside click via document listener
                if (this.closeBtn) {
                    this.closeBtn.addEventListener('click', (e) => {
                        if (!e.isTrusted) return;
                        this.closeMenu();
                    });
                }
                
                // Close on escape key
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && this.menu.classList.contains('active')) {
                        this.closeMenu();
                    }
                });
                
                // Close on window resize
                window.addEventListener('resize', () => {
                    if (window.innerWidth >= 992) {
                        this.closeMenu();
                    }
                });
                this._directBound = true;
            }

            // Delegated event listeners as a fallback for dynamic DOM or refresh edge cases
            if (!this._directBound && !this._delegatedBound) {
                this._delegatedHandler = (e) => {
                    if (!e.isTrusted) return; // only user interactions
                    if (e.target.closest && e.target.closest('.mobile-toggle')) {
                        // click should only open/close, don't propagate to avoid double triggers
                        e.preventDefault();
                        e.stopPropagation();
                        this.toggleMenu();
                        return;
                    }
                    if (e.target.closest && e.target.closest('.mobile-close')) {
                        e.preventDefault();
                        e.stopPropagation();
                        this.closeMenu();
                        return;
                    }
                    // Close when clicking outside the menu while it is open
                    if (this.menu && this.menu.classList.contains('active')) {
                        const clickedInsideMenu = e.target.closest && e.target.closest('.mobile-menu');
                        const clickedToggle = e.target.closest && e.target.closest('.mobile-toggle');
                        const clickedClose = e.target.closest && e.target.closest('.mobile-close');
                        if (!clickedInsideMenu && !clickedToggle && !clickedClose) {
                            this.closeMenu();
                            return;
                        }
                    }
                };
                document.addEventListener('click', this._delegatedHandler, true);
                this._delegatedBound = true;
            }
        }
        
        toggleMenu() {
            if (!this.menu || !this.toggle || !this.overlay) return;
            const isActive = this.menu.classList.contains('active');
            if (!isActive) {
                this.openMenu();
            } else {
                this.closeMenu();
            }
        }
        
        closeMenu() {
            this.toggle.classList.remove('active');
            this.menu.classList.remove('active');
            this.overlay.classList.remove('active');
            // Clear any inline overrides
            if (this.menu && this.menu.style) {
                this.menu.style.left = '';
            }
            
            this.toggle.setAttribute('aria-expanded', 'false');
            this.menu.setAttribute('aria-hidden', 'true');
            
            // Always unlock scroll on close
            this.unlockScroll();
            this.toggle.focus();
        }
        
        openMenu() {
            this.toggle.classList.add('active');
            this.menu.classList.add('active');
            this.overlay.classList.add('active');
            this.toggle.setAttribute('aria-expanded', 'true');
            this.menu.setAttribute('aria-hidden', 'false');
            // Fallback inline style to ensure visibility even if CSS is overridden
            this.menu.style.left = '0';
            // Lock scroll and set focus to first item
            this.lockScroll();
            setTimeout(() => {
                const firstLink = this.menu.querySelector('.mobile-nav-link, .mobile-dropdown-trigger');
                if (firstLink && firstLink.focus) firstLink.focus();
            }, 200);
        }
        
        setupDropdowns() {
            const dropdownTriggers = document.querySelectorAll('.mobile-dropdown-trigger');
            
            dropdownTriggers.forEach(trigger => {
                const menu = trigger.nextElementSibling;
                const arrow = trigger.querySelector('.mobile-dropdown-arrow');
                
                trigger.addEventListener('click', () => {
                    const isActive = trigger.classList.contains('active');
                    
                    // Close all other dropdowns
                    dropdownTriggers.forEach(otherTrigger => {
                        if (otherTrigger !== trigger) {
                            otherTrigger.classList.remove('active');
                            otherTrigger.nextElementSibling.classList.remove('active');
                            otherTrigger.setAttribute('aria-expanded', 'false');
                        }
                    });
                    
                    // Toggle current dropdown
                    trigger.classList.toggle('active');
                    menu.classList.toggle('active');
                    trigger.setAttribute('aria-expanded', !isActive);
                });
                
                // Close dropdown when clicking on links
                const links = menu.querySelectorAll('.mobile-dropdown-link');
                links.forEach(link => {
                    link.addEventListener('click', () => {
                        this.closeMenu();
                    });
                });
            });
            
            // Setup language switcher dropdown
            const langHeader = document.querySelector('.mobile-lang-header');
            const langOptions = document.querySelector('.mobile-lang-options');
            
            if (langHeader && langOptions) {
                langHeader.addEventListener('click', () => {
                    const isActive = langOptions.classList.contains('active');
                    
                    // Close all other dropdowns
                    dropdownTriggers.forEach(trigger => {
                        trigger.classList.remove('active');
                        trigger.nextElementSibling.classList.remove('active');
                        trigger.setAttribute('aria-expanded', 'false');
                    });
                    
                    // Toggle language dropdown
                    langOptions.classList.toggle('active');
                    langHeader.classList.toggle('active');
                });
                
                // Close language dropdown when clicking on links
                const langLinks = langOptions.querySelectorAll('.mobile-lang-option');
                langLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        langOptions.classList.remove('active');
                        langHeader.classList.remove('active');
                        this.closeMenu();
                    });
                });
            }
        }
        
        setupAccessibility() {
            // Trap focus within mobile menu
            const focusableElements = this.menu.querySelectorAll(
                'a, button, [tabindex]:not([tabindex="-1"])'
            );
            
            if (focusableElements.length > 0) {
                const firstElement = focusableElements[0];
                const lastElement = focusableElements[focusableElements.length - 1];
                
                this.menu.addEventListener('keydown', (e) => {
                    if (e.key === 'Tab') {
                        if (e.shiftKey) {
                            if (document.activeElement === firstElement) {
                                e.preventDefault();
                                lastElement.focus();
                            }
                        } else {
                            if (document.activeElement === lastElement) {
                                e.preventDefault();
                                firstElement.focus();
                            }
                        }
                    }
                });
            }
        }

        // Ensure menu and overlay are top-level (escape any ancestor stacking contexts)
        ensureInBody() {
            if (this.menu && this.menu.parentNode !== document.body) {
                document.body.appendChild(this.menu);
            }
            if (this.overlay && this.overlay.parentNode !== document.body) {
                document.body.appendChild(this.overlay);
            }
        }

        reinitialize() {
            // Requery elements in case DOM changed
            this.toggle = document.querySelector('.mobile-toggle');
            this.menu = document.querySelector('.mobile-menu');
            this.overlay = document.querySelector('.mobile-overlay');
            this.closeBtn = document.querySelector('.mobile-close');
            // Ensure correct DOM placement
            this.ensureInBody();
            // Close menu if somehow persisted as open
            this.forceClosedState();
        }

        forceClosedState() {
            if (this.menu) {
                this.menu.classList.remove('active');
                if (this.menu.style) this.menu.style.left = '';
                this.menu.setAttribute('aria-hidden', 'true');
            }
            if (this.overlay) {
                this.overlay.classList.remove('active');
            }
            if (this.toggle) {
                this.toggle.classList.remove('active');
                this.toggle.setAttribute('aria-expanded', 'false');
            }
            // Clear any scroll locks/styles
            document.documentElement.classList.remove('is-locked');
            document.body.classList.remove('is-locked');
            if (document.body.style.position === 'fixed') {
                document.body.style.position = '';
                document.body.style.top = '';
                document.body.style.left = '';
                document.body.style.right = '';
                document.body.style.width = '';
            }
        }

        // Robust scroll lock for mobile (supports iOS)
        lockScroll() {
            if (this._locked) return;
            this._locked = true;
            this._scrollY = window.scrollY || window.pageYOffset || 0;
            document.documentElement.classList.add('is-locked');
            document.body.classList.add('is-locked');
            // iOS-friendly: fix body to prevent background scroll
            document.body.style.position = 'fixed';
            document.body.style.top = `-${this._scrollY}px`;
            document.body.style.left = '0';
            document.body.style.right = '0';
            document.body.style.width = '100%';
            // Prevent scroll chaining to body/html when menu is open
            this._preventScroll = (e) => {
                if (!this.menu || !this.menu.classList.contains('active')) return;
                const insideMenu = e.target && e.target.closest && e.target.closest('.mobile-menu');
                if (!insideMenu) {
                    e.preventDefault();
                }
            };
            try {
                document.addEventListener('wheel', this._preventScroll, { passive: false });
                document.addEventListener('touchmove', this._preventScroll, { passive: false });
            } catch (_) {
                document.addEventListener('wheel', this._preventScroll);
                document.addEventListener('touchmove', this._preventScroll);
            }
            // iOS overscroll containment
            document.documentElement.style.overscrollBehaviorY = 'contain';
            document.body.style.overscrollBehaviorY = 'contain';
            // Ensure menu scrolls independently
            if (this.menu) {
                this.menu.style.webkitOverflowScrolling = 'touch';
                this.menu.style.overflowY = 'auto';
                this.menu.style.touchAction = 'pan-y';
                this._stopPropHandler = function(ev){ ev.stopPropagation(); };
                this.menu.addEventListener('touchmove', this._stopPropHandler, { passive: false });
            }
        }

        unlockScroll() {
            if (!this._locked) return;
            this._locked = false;
            document.documentElement.classList.remove('is-locked');
            document.body.classList.remove('is-locked');
            const top = parseInt(document.body.style.top || '0', 10) || 0;
            // Clear styles
            document.body.style.position = '';
            document.body.style.top = '';
            document.body.style.left = '';
            document.body.style.right = '';
            document.body.style.width = '';
            // Restore scroll position
            window.scrollTo(0, Math.abs(top));
            // Remove scroll prevention listeners
            if (this._preventScroll) {
                document.removeEventListener('wheel', this._preventScroll, { passive: false });
                document.removeEventListener('touchmove', this._preventScroll, { passive: false });
                document.removeEventListener('wheel', this._preventScroll);
                document.removeEventListener('touchmove', this._preventScroll);
                this._preventScroll = null;
            }
            // Reset overscroll behavior
            document.documentElement.style.overscrollBehaviorY = '';
            document.body.style.overscrollBehaviorY = '';
            if (this.menu && this._stopPropHandler) {
                this.menu.removeEventListener('touchmove', this._stopPropHandler, { passive: false });
                this._stopPropHandler = null;
            }
        }
    }
    
    // Initialize mobile navigation
    new MobileNavigation();
    
    
    // Language switcher
    const langDropdown = document.querySelector('.lang-dropdown');
    const langOptions = document.querySelector('.lang-options');
    
    if (langDropdown && langOptions) {
        langDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
            langOptions.style.display = langOptions.style.display === 'block' ? 'none' : 'block';
        });
        
        document.addEventListener('click', function(e) {
            if (!langDropdown.contains(e.target)) {
                langOptions.style.display = 'none';
            }
        });
    }
    
    // Fullscreen
    const fullscreenBtn = document.getElementById('fullscreenBtn');
    if (fullscreenBtn) {
        fullscreenBtn.addEventListener('click', function() {
            if (!document.fullscreenElement) {
                document.documentElement.requestFullscreen?.();
            } else {
                document.exitFullscreen?.();
            }
        });
    }
});
</script>