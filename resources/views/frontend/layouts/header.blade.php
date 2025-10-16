<!-- Navigation -->
<nav class="navbar" style="width:100%;position:relative;z-index:1050;">
    <div class="nav-container" style="display:flex;align-items:center;justify-content:space-between;width:100%;padding:0 18px;flex-wrap:nowrap;">
        <!-- Mobile/Tablet Menu Toggle -->
        <div class="mobile-menu-toggle" style="display:flex;flex-direction:column;cursor:pointer;padding:15px;width:80px;height:80px;justify-content:center;align-items:center;z-index:1001;" onclick="toggleMobileSidebar()">
            <span class="hamburger-line" style="width:40px;height:5px;background:#FF0000;margin:2px 0;transition:0.3s;"></span>
            <span class="hamburger-line" style="width:40px;height:5px;background:#FF0000;margin:2px 0;transition:0.3s;"></span>
            <span class="hamburger-line" style="width:40px;height:5px;background:#FF0000;margin:2px 0;transition:0.3s;"></span>
        </div>
        
        <div class="logo" style="margin-right:40px;flex-shrink:0;">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo2.png') }}" alt="SOTUMA" style="height: 180px; max-width: 700px;">
            </a>
        </div>
        <ul class="nav-menu" style="display:flex;align-items:center;gap:32px;margin:0;padding:0;flex:1;justify-content:center;">
            <li><a href="{{ route('home') }}">{{ __('frontend.home') }}</a></li>
            <li><a href="{{ route('about-us') }}">{{ __('frontend.about') }}</a></li>
            <li><a href="{{ route('media') }}">{{ __('frontend.media') }}</a></li>
            <li class="nav-item dropdown" style="position:relative;">
                <a href="{{ route('project-categories.index') }}" class="nav-link" id="projectsDropdown" role="button" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">{{ __('frontend.projects') }} <span style="font-size:0.8em;">▼</span></a>
                <div class="dropdown-menu" aria-labelledby="projectsDropdown" style="position:absolute;top:100%;left:0;min-width:500px !important;width:500px !important;z-index:99999;display:none;background:#fff;border-radius:0 0 8px 8px;box-shadow:0 4px 16px rgba(0,0,0,0.08);padding:25px 0;">
                    <a class="dropdown-item" href="{{ route('project-categories.index') }}" style="padding:20px 40px; text-transform: capitalize !important; display: block; margin-bottom: 12px;">{{ __('frontend.all') }}</a>
                    @foreach(\App\Models\ProjectCategory::orderBy('name','ASC')->get() as $cat)
                        <a class="dropdown-item" href="{{ route('project-categories.show', $cat->slug) }}" style="padding:20px 40px; text-transform: lowercase !important; display: block; margin-bottom: 12px;" data-original-text="{{ $cat->name }}">{{ ucwords(strtolower($cat->name)) }}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown" style="position:relative;">
                <a href="{{ route('categories.index') }}" class="nav-link" id="productsDropdown" role="button" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">{{ __('frontend.products') }} <span style="font-size:0.8em;">▼</span></a>
                <div class="dropdown-menu" aria-labelledby="productsDropdown" style="position:absolute;top:100%;left:0;min-width:500px !important;width:500px !important;z-index:99999;display:none;background:#fff;border-radius:0 0 8px 8px;box-shadow:0 4px 16px rgba(0,0,0,0.08);padding:25px 0;">
                    <a class="dropdown-item" href="{{ route('categories.index') }}" style="padding:20px 40px; text-transform: capitalize !important; display: block; margin-bottom: 12px;">{{ __('frontend.all') }}</a>
                    @foreach(\App\Models\Category::whereNull('parent_id')->orderBy('sort_order','ASC')->orderBy('title','ASC')->get() as $cat)
                        <a class="dropdown-item" href="{{ route('categories.show', $cat->slug ?? Str::slug($cat->title)) }}" style="padding:20px 40px; text-transform: capitalize !important; display: block; margin-bottom: 12px;">{{ $cat->title }}</a>
                    @endforeach
                </div>
            </li>
            <li><a href="{{ route('certificates') }}">{{ __('frontend.certificates') }}</a></li>
            <li><a href="{{ route('contact') }}">{{ __('frontend.contact') }}</a></li>
        </ul>
        
        <!-- Mobile/Tablet Sidebar Overlay -->
        <div class="mobile-sidebar-overlay" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9998;"></div>
        
        <!-- Mobile/Tablet Sidebar -->
        <div class="mobile-sidebar" id="mobileSidebar" style="position:fixed;top:0;left:-500px;width:500px;height:100vh;background:#fff;z-index:9999;transition:all 0.3s ease;overflow-y:auto;box-shadow:2px 0 10px rgba(0,0,0,0.1);">
            <div class="sidebar-header" style="padding:20px;border-bottom:1px solid #eee;display:flex;justify-content:space-between;align-items:center;">
                <img src="{{ asset('images/logo2.png') }}" alt="SOTUMA" style="height: 60px; max-width: 200px;">
                <button class="sidebar-close" onclick="closeMobileSidebar()" style="background:none;border:none;font-size:24px;cursor:pointer;">&times;</button>
            </div>
            <ul class="sidebar-menu" style="list-style:none;padding:0;margin:0;">
                <li style="border-bottom:1px solid #eee;"><a href="{{ route('home') }}" style="display:block;padding:25px 35px;text-decoration:none;color:#333;font-weight:600;font-size:22px;min-height:70px;align-items:center;">{{ __('frontend.home') }}</a></li>
                <li style="border-bottom:1px solid #eee;"><a href="{{ route('about-us') }}" style="display:block;padding:25px 35px;text-decoration:none;color:#333;font-weight:600;font-size:22px;min-height:70px;align-items:center;">{{ __('frontend.about') }}</a></li>
                <li style="border-bottom:1px solid #eee;"><a href="{{ route('media') }}" style="display:block;padding:25px 35px;text-decoration:none;color:#333;font-weight:600;font-size:22px;min-height:70px;align-items:center;">{{ __('frontend.media') }}</a></li>
                <li style="border-bottom:1px solid #eee;">
                    <a href="{{ route('project-categories.index') }}" style="display:block;padding:25px 35px;text-decoration:none;color:#333;font-weight:600;font-size:22px;min-height:70px;align-items:center;">{{ __('frontend.projects') }}</a>
                    <ul style="list-style:none;padding:0;margin:0;background:#f8f9fa;">
                        <li><a href="{{ route('project-categories.index') }}" style="display:block;padding:20px 55px;text-decoration:none;color:#666;font-size:20px;min-height:60px;align-items:center;text-transform: capitalize !important;">{{ __('frontend.all') }}</a></li>
                        @foreach(\App\Models\ProjectCategory::orderBy('name','ASC')->get() as $cat)
                            <li><a href="{{ route('project-categories.show', $cat->slug) }}" style="display:block;padding:20px 55px;text-decoration:none;color:#666;font-size:20px;min-height:60px;align-items:center;text-transform: lowercase !important;">{{ ucwords(strtolower($cat->name)) }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li style="border-bottom:1px solid #eee;">
                    <a href="{{ route('categories.index') }}" style="display:block;padding:25px 35px;text-decoration:none;color:#333;font-weight:600;font-size:22px;min-height:70px;align-items:center;">{{ __('frontend.products') }}</a>
                    <ul style="list-style:none;padding:0;margin:0;background:#f8f9fa;">
                        <li><a href="{{ route('categories.index') }}" style="display:block;padding:20px 55px;text-decoration:none;color:#666;font-size:20px;min-height:60px;align-items:center;text-transform: capitalize !important;">{{ __('frontend.all') }}</a></li>
                        @foreach(\App\Models\Category::whereNull('parent_id')->orderBy('sort_order','ASC')->orderBy('title','ASC')->get() as $cat)
                            <li><a href="{{ route('categories.show', $cat->slug ?? Str::slug($cat->title)) }}" style="display:block;padding:20px 55px;text-decoration:none;color:#666;font-size:20px;min-height:60px;align-items:center;text-transform: capitalize !important;">{{ $cat->title }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li style="border-bottom:1px solid #eee;"><a href="{{ route('certificates') }}" style="display:block;padding:25px 35px;text-decoration:none;color:#333;font-weight:600;font-size:22px;min-height:70px;align-items:center;">{{ __('frontend.certificates') }}</a></li>
                <li style="border-bottom:1px solid #eee;"><a href="{{ route('contact') }}" style="display:block;padding:25px 35px;text-decoration:none;color:#333;font-weight:600;font-size:22px;min-height:70px;align-items:center;">{{ __('frontend.contact') }}</a></li>
            </ul>
            <div class="sidebar-auth" style="padding:20px;border-top:1px solid #eee;margin-top:auto;">
                @if(auth()->check())
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin')
                        <a href="{{ route('register.form') }}" style="display:block;padding:20px 25px;text-decoration:none;color:#333;text-align:center;border:1px solid #ddd;border-radius:5px;margin-bottom:15px;font-size:20px;font-weight:600;min-height:70px;align-items:center;justify-content:center;">{{ __('frontend.register') }}</a>
                        <a href="{{ route('admin') }}" style="display:block;padding:20px 25px;text-decoration:none;color:#333;text-align:center;border:1px solid #ddd;border-radius:5px;font-size:20px;font-weight:600;min-height:70px;align-items:center;justify-content:center;">{{ __('frontend.dashboard') }}</a>
                    @else
                        <a href="{{ route('register.form') }}" style="display:block;padding:20px 25px;text-decoration:none;color:#333;text-align:center;border:1px solid #ddd;border-radius:5px;margin-bottom:15px;font-size:20px;font-weight:600;min-height:70px;align-items:center;justify-content:center;">{{ __('frontend.register') }}</a>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display:block;padding:20px 25px;text-decoration:none;color:#333;text-align:center;border:1px solid #ddd;border-radius:5px;font-size:20px;font-weight:600;min-height:70px;align-items:center;justify-content:center;">{{ __('frontend.logout') }}</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" style="display:block;padding:20px 25px;text-decoration:none;color:#333;text-align:center;border:1px solid #ddd;border-radius:5px;margin-bottom:15px;font-size:20px;font-weight:600;min-height:70px;align-items:center;justify-content:center;">{{ __('frontend.login') }}</a>
                    <a href="{{ route('register.form') }}" style="display:block;padding:20px 25px;text-decoration:none;color:#333;text-align:center;border:1px solid #ddd;border-radius:5px;font-size:20px;font-weight:600;min-height:70px;align-items:center;justify-content:center;">{{ __('frontend.register') }}</a>
                @endif
            </div>
        </div>
        
        <!-- Mobile Sidebar JavaScript -->
        <script>
        // IMMEDIATE FORCE WIDTH - SENIOR LEVEL
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('mobileSidebar');
            if (sidebar) {
                sidebar.style.width = '500px';
                sidebar.style.maxWidth = '500px';
                sidebar.style.minWidth = '500px';
                sidebar.style.left = '-500px';
            }
        });
        
        // ALSO RUN IMMEDIATELY
        (function() {
            const sidebar = document.getElementById('mobileSidebar');
            if (sidebar) {
                sidebar.style.width = '500px';
                sidebar.style.maxWidth = '500px';
                sidebar.style.minWidth = '500px';
                sidebar.style.left = '-500px';
            }
        })();
        function toggleMobileSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.querySelector('.mobile-sidebar-overlay');
            
            // Force width to 500px
            sidebar.style.width = '500px';
            sidebar.style.maxWidth = '500px';
            sidebar.style.minWidth = '500px';
            
            if (sidebar.style.left === '-500px' || sidebar.style.left === '' || sidebar.style.left === '-100%') {
                sidebar.style.left = '0px';
                sidebar.classList.add('active');
                overlay.style.display = 'block';
                document.body.style.overflow = 'hidden';
            } else {
                closeMobileSidebar();
            }
        }
        
        function closeMobileSidebar() {
            const sidebar = document.getElementById('mobileSidebar');
            const overlay = document.querySelector('.mobile-sidebar-overlay');
            
            // Force width to 500px
            sidebar.style.width = '500px';
            sidebar.style.maxWidth = '500px';
            sidebar.style.minWidth = '500px';
            
            sidebar.style.left = '-500px';
            sidebar.classList.remove('active');
            overlay.style.display = 'none';
            document.body.style.overflow = '';
        }
        
        // Close sidebar when clicking overlay
        document.addEventListener('DOMContentLoaded', function() {
            const overlay = document.querySelector('.mobile-sidebar-overlay');
            if (overlay) {
                overlay.addEventListener('click', closeMobileSidebar);
            }
            
            // Show/hide mobile menu toggle based on screen size
            function checkScreenSize() {
                const toggle = document.querySelector('.mobile-menu-toggle');
                if (window.innerWidth <= 1200) {
                    toggle.style.display = 'flex';
                } else {
                    toggle.style.display = 'none';
                    closeMobileSidebar();
                }
            }
            
            window.addEventListener('resize', checkScreenSize);
            checkScreenSize();
        });
        </script>
        
        <div class="nav-auth" style="display: flex; align-items: center; gap: 15px; margin-right: 40px; flex-shrink:0;">
            @if(auth()->check())
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin')
                    <!-- For admin/co-admin: Replace login with dashboard -->
                    <a href="{{ route('register.form') }}" class="auth-link">{{ __('frontend.register') }}</a>
                    <span style="border-left:1px solid #000;height:22px;display:inline-block;margin:0 8px;vertical-align:middle;"></span>
                    <a href="{{ route('admin') }}" class="auth-link dashboard-auth-link">{{ __('frontend.dashboard') }}</a>
                @else
                    <!-- For regular users: Show logout -->
                    <a href="{{ route('register.form') }}" class="auth-link">{{ __('frontend.register') }}</a>
                    <span style="border-left:1px solid #000;height:22px;display:inline-block;margin:0 8px;vertical-align:middle;"></span>
                    <a href="{{ route('logout') }}" class="auth-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('frontend.logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @endif
            @else
                <!-- For guests: Show login -->
                <a href="{{ route('register.form') }}" class="auth-link">{{ __('frontend.register') }}</a>
                <span style="border-left:1px solid #000;height:22px;display:inline-block;margin:0 8px;vertical-align:middle;"></span>
                <a href="{{ route('login.form') }}" class="auth-link">{{ __('frontend.login') }}</a>
            @endif
        </div>
        <div class="lang-switcher" style="margin-left: 25px; margin-right: 25px; flex-shrink:0;">
            <div class="custom-lang-dropdown" tabindex="0">
                <div class="selected-lang">
                    @php
                        $currentLang = app()->getLocale();
                        $langs = [
                            'fr' => ['name' => 'Français', 'flag' => asset('flags/fr.svg')],
                            'en' => ['name' => 'English', 'flag' => asset('flags/uk.svg')],
                            'ar' => ['name' => 'العربية', 'flag' => asset('flags/sa.svg')],
                        ];
                    @endphp
                    <img src="{{ $langs[$currentLang]['flag'] }}" alt="{{ $langs[$currentLang]['name'] }}" class="lang-flag">
                    <span>{{ $langs[$currentLang]['name'] }}</span>
                    <span class="lang-caret">▼</span>
                </div>
                <div class="lang-options">
                    @foreach($langs as $code => $lang)
                        <a href="{{ request()->fullUrlWithQuery(['lang' => $code]) }}" class="lang-option-item">
                            <img src="{{ $lang['flag'] }}" alt="{{ $lang['name'] }}" class="lang-flag">
                            <span>{{ $lang['name'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
        <button id="fullscreenBtn" class="fullscreen-btn" title="Toggle Fullscreen" style="margin-left: 25px; margin-right: 40px; flex-shrink:0;">
            <i class="fas fa-expand"></i>
        </button>
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div class="mobile-nav-menu">
        <ul>
            <li><a href="{{ route('home') }}">{{ __('frontend.home') }}</a></li>
            <li><a href="{{ route('about-us') }}">{{ __('frontend.about') }}</a></li>
            <li><a href="{{ route('media') }}">{{ __('frontend.media') }}</a></li>
            <li><a href="{{ route('project-categories.index') }}">{{ __('frontend.projects') }}</a></li>
            <li><a href="{{ route('categories.index') }}">{{ __('frontend.products') }}</a></li>
            <li><a href="{{ route('certificates') }}">{{ __('frontend.certificates') }}</a></li>
            <li><a href="{{ route('contact') }}">{{ __('frontend.contact') }}</a></li>
            @if(auth()->check())
                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin')
                    <li><a href="{{ route('admin') }}" style="background: linear-gradient(135deg, #FF0000 0%, #FF0000 100%); color: white; font-weight: 600; text-transform: uppercase; border-radius: 8px; padding: 1rem; margin: 0.5rem 0;">{{ __('frontend.dashboard') }}</a></li>
                @endif
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form-mobile').submit();">{{ __('frontend.logout') }}</a></li>
                <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
            @else
                <li><a href="{{ route('register.form') }}">{{ __('frontend.register') }}</a></li>
                <li><a href="{{ route('login.form') }}">{{ __('frontend.login') }}</a></li>
            @endif
        </ul>
    </div>
    
    <div class="mobile-nav-overlay"></div>
</nav>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle all dropdown menus
    var dropdownItems = document.querySelectorAll('.nav-item.dropdown');
    dropdownItems.forEach(function(navItem) {
        var menu = navItem.querySelector('.dropdown-menu');
        var link = navItem.querySelector('.nav-link');
        
        navItem.addEventListener('mouseenter', function() { 
            menu.style.display = 'block'; 
        });
        navItem.addEventListener('mouseleave', function() { 
            menu.style.display = 'none'; 
        });
        
        // Ensure the main link works properly
        if (link) {
            link.addEventListener('click', function(e) {
                // Allow the default navigation to happen
                console.log('Navigating to:', this.href);
            });
        }
    });
    
    // Handle language switcher
    var langDropdown = document.querySelector('.custom-lang-dropdown');
    var langOptions = document.querySelector('.lang-options');
    
    if (langDropdown && langOptions) {
        langDropdown.addEventListener('click', function(e) {
            e.stopPropagation();
            langOptions.style.display = langOptions.style.display === 'block' ? 'none' : 'block';
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!langDropdown.contains(e.target)) {
                langOptions.style.display = 'none';
            }
        });
        
        // Handle language option clicks
        var langOptionItems = document.querySelectorAll('.lang-option-item');
        langOptionItems.forEach(function(item) {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                var href = this.getAttribute('href');
                if (href) {
                    window.location.href = href;
                }
            });
        });
    }
    
    // Mobile Navigation Toggle
    const navToggle = document.querySelector('.nav-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const navOverlay = document.querySelector('.nav-overlay');
    
    if (navToggle && navMenu && navOverlay) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            navOverlay.classList.toggle('active');
            document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : '';
        });
        
        navOverlay.addEventListener('click', function() {
            navMenu.classList.remove('active');
            navOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        // Close mobile menu when clicking on a link
        const navLinks = navMenu.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navMenu.classList.remove('active');
                navOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    }
    
    // Mobile Navigation Toggle
    const hamburger = document.querySelector('.hamburger');
    const mobileMenu = document.querySelector('.mobile-nav-menu');
    const mobileOverlay = document.querySelector('.mobile-nav-overlay');
    
    if (hamburger && mobileMenu && mobileOverlay) {
        hamburger.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            mobileOverlay.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
        });
        
        mobileOverlay.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            mobileOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        // Close mobile menu when clicking on links
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
                mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 991) {
                mobileMenu.classList.remove('active');
                mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
        
        // Mobile dropdown functionality
        const mobileDropdowns = mobileMenu.querySelectorAll('.mobile-dropdown');
        mobileDropdowns.forEach(dropdown => {
            const toggle = dropdown.querySelector('.mobile-dropdown-toggle');
            const menu = dropdown.querySelector('.mobile-dropdown-menu');
            const arrow = dropdown.querySelector('.mobile-dropdown-arrow');
            
            if (toggle && menu && arrow) {
                toggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Toggle this dropdown
                    menu.classList.toggle('active');
                    arrow.style.transform = menu.classList.contains('active') ? 'rotate(180deg)' : 'rotate(0deg)';
                    
                    // Close other dropdowns
                    mobileDropdowns.forEach(otherDropdown => {
                        if (otherDropdown !== dropdown) {
                            const otherMenu = otherDropdown.querySelector('.mobile-dropdown-menu');
                            const otherArrow = otherDropdown.querySelector('.mobile-dropdown-arrow');
                            if (otherMenu && otherArrow) {
                                otherMenu.classList.remove('active');
                                otherArrow.style.transform = 'rotate(0deg)';
                            }
                        }
                    });
                });
            }
        });
    }
    
    // Mobile menu toggle
    const hamburger = document.querySelector('.hamburger');
    const mobileMenu = document.querySelector('.mobile-nav-menu');
    const mobileOverlay = document.querySelector('.mobile-nav-overlay');
    
    if (hamburger && mobileMenu && mobileOverlay) {
        hamburger.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
            mobileOverlay.classList.toggle('active');
            document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
        });
        
        mobileOverlay.addEventListener('click', function() {
            mobileMenu.classList.remove('active');
            mobileOverlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        // Close mobile menu when clicking links
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
                mobileOverlay.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
    }
    
    // Handle fullscreen functionality
    var fullscreenBtn = document.getElementById('fullscreenBtn');
    var fullscreenIcon = fullscreenBtn.querySelector('i');
    
    if (fullscreenBtn) {
        fullscreenBtn.addEventListener('click', function() {
            if (!document.fullscreenElement) {
                // Enter fullscreen
                if (document.documentElement.requestFullscreen) {
                    document.documentElement.requestFullscreen();
                } else if (document.documentElement.webkitRequestFullscreen) {
                    document.documentElement.webkitRequestFullscreen();
                } else if (document.documentElement.msRequestFullscreen) {
                    document.documentElement.msRequestFullscreen();
                }
            } else {
                // Exit fullscreen
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            }
        });
        
        // Update icon based on fullscreen state
        function updateFullscreenIcon() {
            if (document.fullscreenElement) {
                fullscreenIcon.className = 'fas fa-compress';
                fullscreenBtn.title = 'Exit Fullscreen';
            } else {
                fullscreenIcon.className = 'fas fa-expand';
                fullscreenBtn.title = 'Toggle Fullscreen';
            }
        }
        
        // Listen for fullscreen changes
        document.addEventListener('fullscreenchange', updateFullscreenIcon);
        document.addEventListener('webkitfullscreenchange', updateFullscreenIcon);
        document.addEventListener('mozfullscreenchange', updateFullscreenIcon);
        document.addEventListener('MSFullscreenChange', updateFullscreenIcon);
    }
});

// FORCE DROPDOWN TEXT CAPITALIZATION
document.addEventListener('DOMContentLoaded', function() {
    // Force capitalize all dropdown items
    function capitalizeDropdownText() {
        // Target all possible dropdown selectors
        const selectors = [
            '.dropdown-item',
            '.dropdown-menu a',
            '.nav-item.dropdown .dropdown-menu a',
            '.dropdown-menu .dropdown-item',
            '.navbar .dropdown-item',
            '.navbar .dropdown-menu a',
            'a.dropdown-item',
            '.dropdown-menu a.dropdown-item'
        ];
        
        selectors.forEach(function(selector) {
            const dropdownItems = document.querySelectorAll(selector);
            dropdownItems.forEach(function(item) {
                if (item.textContent) {
                    // Capitalize first letter of each word
                    const text = item.textContent.trim();
                    const capitalized = text.replace(/\b\w/g, function(l) {
                        return l.toUpperCase();
                    });
                    item.textContent = capitalized;
                    item.style.textTransform = 'capitalize';
                    item.style.setProperty('text-transform', 'capitalize', 'important');
                }
            });
        });
    }
    
    // Run immediately
    capitalizeDropdownText();
    
    // Run again after delays to catch dynamically loaded content
    setTimeout(capitalizeDropdownText, 100);
    setTimeout(capitalizeDropdownText, 500);
    setTimeout(capitalizeDropdownText, 1000);
    setTimeout(capitalizeDropdownText, 2000);
    
    // Also run when dropdowns are opened
    document.addEventListener('click', function(e) {
        if (e.target.closest('.dropdown')) {
            setTimeout(capitalizeDropdownText, 50);
        }
    });
});
</script>

<style>
/* Simple dropdown fix */
.nav-item.dropdown:hover .dropdown-menu {
    display: block !important;
}

/* Hide mobile menu on desktop */
@media (min-width: 992px) {
    .mobile-nav-menu {
        display: none !important;
    }
    
    .mobile-nav-overlay {
        display: none !important;
    }
}

/* Push register/login and everything after to right */
@media (min-width: 992px) {
    .nav-auth {
        margin-left: 0 !important;
        margin-right: 40px !important;
        gap: 15px !important;
    }
    
    .lang-switcher {
        margin-left: 25px !important;
        margin-right: 25px !important;
    }
    
    .fullscreen-btn {
        margin-left: 25px !important;
        margin-right: 40px !important;
    }
    
    /* Override inline styles */
    div[style*="flex:1"] {
        flex: 1 1 0 !important;
    }
}

/* Show mobile menu only on mobile */
@media (max-width: 991px) {
    .nav-menu {
        display: none !important;
    }
    
    .nav-auth {
        display: none !important;
    }
    
    .lang-switcher {
        display: none !important;
    }
    
    .fullscreen-btn {
        display: none !important;
    }
    
    .hamburger {
        display: block !important;
        cursor: pointer !important;
    }
}
</style>
<style>
.admin-dashboard-btn {
    transition: background 0.2s, color 0.2s;
    cursor: pointer;
}
.admin-dashboard-btn:hover {
    background:rgba(155, 155, 154, 0.55) !important;
    color: #222 !important;
}

/* Navigation Menu Styles */
.nav-menu li a {
    text-transform: uppercase;
    font-size: 1.1rem;
    font-weight: 600;
    letter-spacing: 1px;
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.nav-menu li a:hover {
    color: #666;
}

.nav-link {
    text-transform: uppercase;
    font-size: 1.1rem;
    font-weight: 600;
    letter-spacing: 1px;
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.nav-link:hover {
    color: #666;
}

.dropdown-item {
    text-transform: capitalize !important;
    font-size: 1rem;
    font-weight: 500;
    letter-spacing: 0.5px;
    color: #333;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

/* More specific rules to override any conflicting styles */
.dropdown-menu .dropdown-item,
.nav-item.dropdown .dropdown-menu .dropdown-item,
.dropdown-menu a.dropdown-item {
    text-transform: capitalize !important;
}

/* ULTRA AGGRESSIVE OVERRIDE - MUST BE LAST */
.dropdown-item,
.dropdown-menu a,
.dropdown-menu .dropdown-item,
.nav-item.dropdown .dropdown-menu a,
.nav-item.dropdown .dropdown-menu .dropdown-item,
.dropdown-menu a.dropdown-item,
.dropdown-menu .dropdown-item a,
.dropdown-item.text-uppercase,
.dropdown-menu a.text-uppercase,
.dropdown-menu .dropdown-item.text-uppercase {
    text-transform: capitalize !important;
    font-variant: normal !important;
    text-rendering: optimizeLegibility !important;
}

/* OVERRIDE ANY GLOBAL CSS */
.navbar .dropdown-item,
.navbar .dropdown-menu a,
.navbar .dropdown-menu .dropdown-item {
    text-transform: capitalize !important;
}

.dropdown-item:hover {
    background-color: #f8f9fa;
    color: #666;
}

/* Authentication Links */
.auth-link {
    text-transform: uppercase;
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 1px;
    color: #333;
    text-decoration: none;
    transition: color 0.3s ease;
}

.auth-link:hover {
    color: #666;
}

/* Language Switcher Styles */
.custom-lang-dropdown {
    position: relative;
    cursor: pointer;
    user-select: none;
}

.selected-lang {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 6px;
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    transition: all 0.2s ease;
}

.selected-lang:hover {
    background: #e9ecef;
}

.lang-flag {
    width: 20px;
    height: 15px;
    object-fit: cover;
    border-radius: 2px;
}

.lang-caret {
    font-size: 0.8em;
    transition: transform 0.2s ease;
}

.custom-lang-dropdown.active .lang-caret {
    transform: rotate(180deg);
}

.lang-options {
    position: absolute;
    top: 100%;
    right: 0;
    min-width: 150px;
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 6px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    z-index: 1000;
    display: none;
    margin-top: 4px;
}

.lang-option-item {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 12px;
    text-decoration: none;
    color: #333;
    transition: background 0.2s ease;
}

.lang-option-item:hover {
    background: #f8f9fa;
    text-decoration: none;
    color: #333;
}

.lang-option-item:first-child {
    border-radius: 6px 6px 0 0;
}

.lang-option-item:last-child {
    border-radius: 0 0 6px 6px;
}

/* RTL Support for Language Switcher */
[dir="rtl"] .lang-options {
    right: auto;
    left: 0;
}

/* Desktop: widen language switcher trigger and dropdown */
@media (min-width: 992px) {
    .custom-lang-dropdown .selected-lang {
        min-width: clamp(150px, 12vw, 260px);
    }
    .custom-lang-dropdown .lang-options {
        min-width: clamp(150px, 12vw, 260px);
    }
}

/* Fullscreen Button Styles */
.fullscreen-btn {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
    border-radius: 6px;
    padding: 8px 12px;
    cursor: pointer;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
}

.fullscreen-btn:hover {
    background: #e9ecef;
    border-color: #dee2e6;
}

.fullscreen-btn i {
    font-size: 16px;
    color: #333;
    transition: color 0.2s ease;
}

.fullscreen-btn:hover i {
    color: #666;
}

.fullscreen-btn:active {
    transform: scale(0.95);
}
</style>