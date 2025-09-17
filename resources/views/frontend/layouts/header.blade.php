<!-- Navigation -->
<nav class="navbar" style="width:100%;">
    <div class="nav-container" style="display:flex;align-items:center;justify-content:flex-start;width:100%;padding:0 18px;flex-wrap:nowrap;">
        <div class="logo" style="margin-right:40px;flex-shrink:0;">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo2.png') }}" alt="SOTUMA" style="height: 180px; max-width: 700px;">
            </a>
        </div>
        <ul class="nav-menu" style="display:flex;align-items:center;gap:32px;margin:0 40px 0 0;padding:0;flex-shrink:0;">
            <li><a href="{{ route('home') }}">{{ __('frontend.home') }}</a></li>
            <li><a href="{{ route('about-us') }}">{{ __('frontend.about') }}</a></li>
            <li><a href="{{ route('media') }}">{{ __('frontend.media') }}</a></li>
            <li class="nav-item dropdown" style="position:relative;">
                <a href="{{ route('project-categories.index') }}" class="nav-link" id="projectsDropdown" role="button" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">{{ __('frontend.projects') }} <span style="font-size:0.8em;">▼</span></a>
                <div class="dropdown-menu" aria-labelledby="projectsDropdown" style="position:absolute;top:100%;left:0;min-width:200px;z-index:1000;display:none;background:#fff;border-radius:0 0 8px 8px;box-shadow:0 4px 16px rgba(0,0,0,0.08);padding:8px 0;">
                    <a class="dropdown-item" href="{{ route('project-categories.index') }}" style="padding:8px 18px;">{{ __('frontend.all') }}</a>
                    @foreach(\App\Models\ProjectCategory::orderBy('name','ASC')->get() as $cat)
                        <a class="dropdown-item" href="{{ route('project-categories.show', $cat->slug) }}" style="padding:8px 18px;">{{ $cat->name }}</a>
                    @endforeach
                </div>
            </li>
            <li class="nav-item dropdown" style="position:relative;">
                <a href="{{ route('categories.index') }}" class="nav-link" id="productsDropdown" role="button" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;">{{ __('frontend.products') }} <span style="font-size:0.8em;">▼</span></a>
                <div class="dropdown-menu" aria-labelledby="productsDropdown" style="position:absolute;top:100%;left:0;min-width:200px;z-index:1000;display:none;background:#fff;border-radius:0 0 8px 8px;box-shadow:0 4px 16px rgba(0,0,0,0.08);padding:8px 0;">
                    <a class="dropdown-item" href="{{ route('categories.index') }}" style="padding:8px 18px;">{{ __('frontend.all') }}</a>
                    @foreach(\App\Models\Category::whereNull('parent_id')->orderBy('sort_order','ASC')->orderBy('title','ASC')->get() as $cat)
                        <a class="dropdown-item" href="{{ route('categories.show', $cat->slug ?? Str::slug($cat->title)) }}" style="padding:8px 18px;">{{ $cat->title }}</a>
                    @endforeach
                </div>
            </li>
            <li><a href="{{ route('certificates') }}">{{ __('frontend.certificates') }}</a></li>
            <li><a href="{{ route('contact') }}">{{ __('frontend.contact') }}</a></li>
        </ul>
        <div style="flex:1 1 0;"></div>
        <div class="nav-auth" style="display: flex; align-items: center; gap: 12px; margin-right: 0; flex-shrink:0;">
            <a href="{{ route('register.form') }}" class="auth-link">{{ __('frontend.register') }}</a>
            <span style="border-left:1px solid #000;height:22px;display:inline-block;margin:0 8px;vertical-align:middle;"></span>
            <a href="{{ route('login.form') }}" class="auth-link">{{ __('frontend.login') }}</a>
        </div>
        <div class="lang-switcher" style="margin-left: 20px; margin-right: 0; flex-shrink:0;">
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
        <button id="fullscreenBtn" class="fullscreen-btn" title="Toggle Fullscreen" style="margin-left: 20px; margin-right: 4px; flex-shrink:0;">
            <i class="fas fa-expand"></i>
        </button>
        @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'co-admin'))
            <a href="{{ route('admin') }}" class="btn btn-warning font-weight-bold admin-dashboard-btn" style="border-radius: 20px;min-width:140px;margin-left: 20px;margin-right:4px;flex-shrink:0;text-transform: uppercase;letter-spacing: 1px;">{{ __('frontend.dashboard') }}</a>
        @endif
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
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
</script>
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
    text-transform: uppercase;
    font-size: 1rem;
    font-weight: 500;
    letter-spacing: 0.5px;
    color: #333;
    text-decoration: none;
    transition: background-color 0.3s ease;
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