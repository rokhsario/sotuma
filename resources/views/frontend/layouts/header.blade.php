<!-- Navigation -->
<nav class="navbar" style="width:100%;">
    <div class="nav-container" style="display:flex;align-items:center;justify-content:flex-start;width:100%;padding:0 18px;flex-wrap:nowrap;">
        <div class="logo" style="margin-right:32px;flex-shrink:0;">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="SOTUMA">
            </a>
        </div>
        <ul class="nav-menu" style="display:flex;align-items:center;gap:22px;margin:0 60px 0 0;padding:0;flex-shrink:0;">
            <li><a href="{{ route('home') }}">Acceuil</a></li>
            <li><a href="{{ route('about-us') }}">A propos</a></li>
            <li><a href="#">Media</a></li>
            <li><a href="#">Nos Projets</a></li>
            <li><a href="{{ route('product-grids') }}">Nos Produits</a></li>
            <li><a href="{{ route('certificates') }}">Nos Certificats</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
        </ul>
        <div style="flex:1 1 0;"></div>
        <div class="nav-auth" style="display: flex; align-items: center; gap: 8px; margin-right: 0; flex-shrink:0;">
            <a href="{{ route('register.form') }}">S'inscrire</a>
            <span style="border-left:1px solid #000;height:22px;display:inline-block;margin:0 6px;vertical-align:middle;"></span>
            <a href="{{ route('login.form') }}">Se connecter</a>
        </div>
        <div class="lang-switcher" style="margin-right: 0; flex-shrink:0;">
            <form method="GET" action="" style="margin:0;">
                <div class="custom-lang-dropdown" tabindex="0">
                    <input type="hidden" name="lang" id="lang-input" value="{{ request('lang', app()->getLocale()) }}">
                    <div class="selected-lang">
                        @php
                            $currentLang = request('lang', app()->getLocale());
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
                            <div class="lang-option-item" data-lang="{{ $code }}">
                                <img src="{{ $lang['flag'] }}" alt="{{ $lang['name'] }}" class="lang-flag">
                                <span>{{ $lang['name'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('admin') }}" class="btn btn-warning font-weight-bold admin-dashboard-btn" style="border-radius: 20px;min-width:140px;margin-right:4px;flex-shrink:0;">Tableau de bord</a>
        @endif
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</nav>
<style>
.admin-dashboard-btn {
    transition: background 0.2s, color 0.2s;
    cursor: pointer;
}
.admin-dashboard-btn:hover {
    background:rgba(155, 155, 154, 0.55) !important;
    color: #222 !important;
}
</style>