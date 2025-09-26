@extends('frontend.layouts.master')

@section('title','SOTUMA || ' . __('frontend.login'))

@section('main-content')
    <!-- Elegant Login Section -->
    <section class="elegant-login-section">

        <div class="login-container">
            <div class="login-card">
                <!-- Left Side - Branding -->
                <div class="login-branding">
                    <div class="branding-content">
                        <div class="brand-logo">
                            <div class="logo-container">
                                <div class="logo-icon">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div class="logo-glow"></div>
                            </div>
                            <h1 class="brand-title">SOTUMA</h1>
                            <div class="brand-subtitle">Excellence & Innovation</div>
                        </div>
                        
                        <div class="brand-description">
                            <h2>{{ __('frontend.welcome_personal_space') }}</h2>
                            <p>{{ __('frontend.login_description') }}</p>
                        </div>
                        
                        <div class="brand-features">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="feature-content">
                                    <span class="feature-title">{{ __('frontend.security_guaranteed') }}</span>
                                    <span class="feature-desc">Bank-level security</span>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="feature-content">
                                    <span class="feature-title">{{ __('frontend.access_24_7') }}</span>
                                    <span class="feature-desc">Always available</span>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-headset"></i>
                                </div>
                                <div class="feature-content">
                                    <span class="feature-title">{{ __('frontend.premium_support') }}</span>
                                    <span class="feature-desc">Expert assistance</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- Right Side - Login Form -->
                <div class="login-form-container">
                    <div class="form-header">
                        <div class="form-icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <h2>{{ __('frontend.login') }}</h2>
                        <p>{{ __('frontend.access_sotuma_account') }}</p>
                    </div>

                    <form class="elegant-login-form" method="post" action="{{route('login.submit')}}">
                        @csrf
                        
                        <div class="form-group">
                            <div class="input-wrapper">
                                <div class="input-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <input type="email" name="email" id="email" placeholder="{{ __('frontend.email_address') }}" required value="{{old('email')}}" autocomplete="email">
                                <div class="input-border"></div>
                            </div>
                            @error('email')
                                <span class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <div class="input-wrapper">
                                <div class="input-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <input type="password" name="password" id="password" placeholder="{{ __('frontend.password') }}" required autocomplete="current-password">
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <div class="input-border"></div>
                            </div>
                            @error('password')
                                <span class="error-message">
                                    <i class="fas fa-exclamation-circle"></i>
                                    {{$message}}
                                </span>
                            @enderror
                        </div>

                        <div class="form-options">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <span class="checkmark">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="checkbox-label">{{ __('frontend.remember_me') }}</span>
                            </label>
                            
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="forgot-password">
                                    {{ __('frontend.forgot_password') }}
                                </a>
                            @endif
                        </div>

                        <button type="submit" class="login-btn">
                            <span class="btn-content">
                                <span class="btn-text">{{ __('frontend.login') }}</span>
                                <span class="btn-icon">
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </span>
                            <div class="btn-loading">
                                <div class="spinner"></div>
                            </div>
                            <div class="btn-ripple"></div>
                        </button>
                    </form>

                    <div class="divider">
                        <span class="divider-text">{{ __('frontend.or') }}</span>
                    </div>

                    <div class="register-link">
                        <p>{{ __('frontend.no_account_yet') }} 
                            <a href="{{route('register.form')}}" class="link-highlight">
                                <span>{{ __('frontend.create_account') }}</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
/* Elegant Login Styles */
.elegant-login-section {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    position: relative;
    overflow: hidden;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}


.login-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.login-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(30px);
    border-radius: 32px;
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15),
                0 0 0 1px rgba(255, 255, 255, 0.2);
    overflow: hidden;
    display: flex;
    min-height: 700px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}

/* Left Side - Branding */
.login-branding {
    flex: 1;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 80px 60px;
    color: white;
    overflow: hidden;
}

.branding-content {
    text-align: center;
    z-index: 3;
    position: relative;
    max-width: 400px;
}

.brand-logo {
    margin-bottom: 50px;
}

.logo-container {
    position: relative;
    display: inline-block;
    margin-bottom: 20px;
}

.logo-icon {
    width: 100px;
    height: 100px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(20px);
    border: 3px solid rgba(255, 255, 255, 0.3);
    position: relative;
    z-index: 2;
    transition: all 0.3s ease;
}

.logo-icon:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
}

.logo-icon i {
    font-size: 3rem;
    color: white;
}

.logo-glow {
    position: absolute;
    top: -20px;
    left: -20px;
    right: -20px;
    bottom: -20px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
    border-radius: 50%;
    animation: pulse 3s ease-in-out infinite;
    z-index: 1;
}

@keyframes pulse {
    0%, 100% { opacity: 0.5; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(1.1); }
}

.brand-title {
    font-size: 3rem;
    font-weight: 800;
    margin: 0 0 10px 0;
    letter-spacing: 3px;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.brand-subtitle {
    font-size: 1rem;
    font-weight: 500;
    opacity: 0.9;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 40px;
}

.brand-description h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 20px;
    line-height: 1.2;
}

.brand-description p {
    font-size: 1.1rem;
    line-height: 1.6;
    opacity: 0.9;
    margin-bottom: 50px;
    color: white;
}

.brand-features {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.feature-item {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.feature-item:hover {
    transform: translateX(10px);
    background: rgba(255, 255, 255, 0.15);
}

.feature-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.feature-icon i {
    font-size: 1.5rem;
    color: white;
}

.feature-content {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.feature-title {
    font-size: 1rem;
    font-weight: 600;
    color: white;
}

.feature-desc {
    font-size: 0.85rem;
    opacity: 0.8;
    color: white;
}



/* Right Side - Form */
.login-form-container {
    flex: 1;
    padding: 80px 60px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    background: rgba(255, 255, 255, 0.95);
    color: #333;
}

.form-header {
    text-align: center;
    margin-bottom: 50px;
}

.form-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.form-icon i {
    font-size: 1.5rem;
    color: white;
}

.form-header h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 12px;
    letter-spacing: -0.5px;
}

.form-header p {
    color: #666;
    font-size: 1.1rem;
    font-weight: 400;
}

.elegant-login-form {
    width: 100%;
}

.form-group {
    margin-bottom: 30px;
}

.input-wrapper {
    position: relative;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 16px;
    border: 2px solid rgba(102, 126, 234, 0.1);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    backdrop-filter: blur(10px);
}

.input-wrapper:focus-within {
    border-color: #667eea;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1),
                0 10px 30px rgba(102, 126, 234, 0.15);
    transform: translateY(-2px);
}

.input-icon {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: #667eea;
    font-size: 18px;
    transition: all 0.3s ease;
    z-index: 2;
}

.input-wrapper:focus-within .input-icon {
    color: #764ba2;
    transform: translateY(-50%) scale(1.1);
}

.input-wrapper input {
    width: 100%;
    padding: 20px 20px 20px 60px;
    border: none;
    background: transparent;
    font-size: 16px;
    color: #333;
    outline: none;
    font-weight: 500;
}

.input-wrapper input::placeholder {
    color: #999;
    transition: opacity 0.3s ease;
    font-weight: 400;
}

.input-wrapper:focus-within input::placeholder {
    opacity: 0.7;
}


.input-border {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.input-wrapper:focus-within .input-border {
    transform: scaleX(1);
}

.password-toggle {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #999;
    cursor: pointer;
    padding: 8px;
    transition: all 0.3s ease;
    border-radius: 8px;
}

.password-toggle:hover {
    color: #667eea;
    background: rgba(102, 126, 234, 0.1);
}

.error-message {
    color: #e74c3c;
    font-size: 14px;
    margin-top: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 500;
}

.error-message i {
    font-size: 12px;
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
}

.checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 12px;
    cursor: pointer;
    font-size: 14px;
    color: #666;
    font-weight: 500;
}

.checkbox-wrapper input[type="checkbox"] {
    display: none;
}

.checkmark {
    width: 20px;
    height: 20px;
    border: 2px solid #ddd;
    border-radius: 6px;
    position: relative;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.checkbox-wrapper input[type="checkbox"]:checked + .checkmark {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-color: #667eea;
}

.checkbox-wrapper input[type="checkbox"]:checked + .checkmark i {
    color: white;
    font-size: 12px;
    opacity: 1;
    transform: scale(1);
}

.checkmark i {
    opacity: 0;
    transform: scale(0);
    transition: all 0.3s ease;
}

.forgot-password {
    color: #667eea;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
    padding: 8px 12px;
    border-radius: 8px;
}

.forgot-password:hover {
    color: #764ba2;
    background: rgba(102, 126, 234, 0.1);
}

.login-btn {
    width: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 16px;
    padding: 20px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
}

.login-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
}

.login-btn:active {
    transform: translateY(-1px);
}

.btn-content {
    display: flex;
    align-items: center;
    gap: 12px;
    position: relative;
    z-index: 2;
}

.btn-text {
    font-size: 16px;
    font-weight: 600;
}

.btn-icon {
    transition: transform 0.3s ease;
}

.login-btn:hover .btn-icon {
    transform: translateX(4px);
}

.btn-loading {
    display: none;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 3;
}

.login-btn.loading .btn-content {
    opacity: 0;
}

.login-btn.loading .btn-loading {
    display: block;
}

.spinner {
    width: 24px;
    height: 24px;
    border: 3px solid rgba(255, 255, 255, 0.3);
    border-top: 3px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.btn-ripple {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.6s ease;
    pointer-events: none;
}

.login-btn:active .btn-ripple {
    width: 300px;
    height: 300px;
}

.divider {
    text-align: center;
    margin: 40px 0;
    position: relative;
}

.divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, #ddd 50%, transparent 100%);
}

.divider-text {
    background: rgba(255, 255, 255, 0.95);
    padding: 0 20px;
    color: #999;
    font-size: 14px;
    font-weight: 500;
}

.register-link {
    text-align: center;
    color: #666;
    font-size: 14px;
    font-weight: 500;
}

.link-highlight {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    border-radius: 8px;
}

.link-highlight:hover {
    color: #764ba2;
    background: rgba(102, 126, 234, 0.1);
    transform: translateX(4px);
}

.link-highlight i {
    transition: transform 0.3s ease;
}

.link-highlight:hover i {
    transform: translateX(4px);
}

/* Responsive Design */
@media (max-width: 768px) {
    .login-card {
        flex-direction: column;
        min-height: auto;
        border-radius: 24px;
    }
    
    .login-branding {
        padding: 60px 40px;
    }
    
    .brand-title {
        font-size: 2.5rem;
    }
    
    .brand-description h2 {
        font-size: 1.8rem;
    }
    
    .login-form-container {
        padding: 60px 40px;
    }
    
    .form-options {
        flex-direction: column;
        gap: 20px;
        align-items: flex-start;
    }
}

@media (max-width: 480px) {
    .elegant-login-section {
        padding: 10px;
    }
    
    .login-branding {
        padding: 40px 20px;
    }
    
    .login-form-container {
        padding: 40px 20px;
    }
    
    .brand-title {
        font-size: 2rem;
    }
    
    .form-header h2 {
        font-size: 2rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const toggle = input.parentElement.querySelector('.password-toggle i');
    
    if (input.type === 'password') {
        input.type = 'text';
        toggle.className = 'fas fa-eye-slash';
    } else {
        input.type = 'password';
        toggle.className = 'fas fa-eye';
    }
}

// Form submission with loading state
document.querySelector('.elegant-login-form').addEventListener('submit', function(e) {
    const btn = this.querySelector('.login-btn');
    btn.classList.add('loading');
    
    // Remove loading state after 3 seconds (in case of error)
    setTimeout(() => {
        btn.classList.remove('loading');
    }, 3000);
});

// Input focus effects removed - no floating labels

// Button ripple effect
document.querySelector('.login-btn').addEventListener('click', function(e) {
    const ripple = this.querySelector('.btn-ripple');
    const rect = this.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top - size / 2;
    
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = x + 'px';
    ripple.style.top = y + 'px';
    
    setTimeout(() => {
        ripple.style.width = ripple.style.height = '0px';
    }, 600);
});
</script>
@endpush