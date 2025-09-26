@extends('frontend.layouts.master')

@section('title','SOTUMA || ' . __('Reset Password'))

@section('main-content')
    <!-- Elegant Password Reset Section -->
    <section class="elegant-reset-section">
        <div class="reset-container">
            <div class="reset-card">
                <!-- Left Side - Branding -->
                <div class="reset-branding">
                    <div class="branding-content">
                        <div class="brand-logo">
                            <div class="logo-container">
                                <div class="logo-icon">
                                    <i class="fas fa-key"></i>
                                </div>
                                <div class="logo-glow"></div>
                            </div>
                            <h1 class="brand-title">SOTUMA</h1>
                            <div class="brand-subtitle">Security & Recovery</div>
                        </div>
                        
                        <div class="brand-description">
                            <h2>{{ __('Reset Your Password') }}</h2>
                            <p>{{ __('Create a new secure password to regain access to your account') }}</p>
                        </div>
                        
                        <div class="brand-features">
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="feature-content">
                                    <span class="feature-title">{{ __('Secure Reset') }}</span>
                                    <span class="feature-desc">Bank-level security</span>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="feature-content">
                                    <span class="feature-title">{{ __('Quick Process') }}</span>
                                    <span class="feature-desc">Get back in minutes</span>
                                </div>
                            </div>
                            <div class="feature-item">
                                <div class="feature-icon">
                                    <i class="fas fa-user-check"></i>
                                </div>
                                <div class="feature-content">
                                    <span class="feature-title">{{ __('Account Recovery') }}</span>
                                    <span class="feature-desc">Safe and reliable</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Reset Form -->
                <div class="reset-form-container">
                    <div class="form-header">
                        <div class="form-icon">
                            <i class="fas fa-lock"></i>
                        </div>
                        <h2>{{ __('Reset Password') }}</h2>
                        <p>{{ __('Enter your new password below') }}</p>
                    </div>

                    <form class="elegant-reset-form" method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        
                        <div class="form-group">
                            <div class="input-wrapper">
                                <div class="input-icon">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <input type="email" name="email" id="email" placeholder="{{ __('E-Mail Address') }}" required value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>
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
                                <input type="password" name="password" id="password" placeholder="{{ __('New Password') }}" required autocomplete="new-password">
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

                        <div class="form-group">
                            <div class="input-wrapper">
                                <div class="input-icon">
                                    <i class="fas fa-lock"></i>
                                </div>
                                <input type="password" name="password_confirmation" id="password-confirm" placeholder="{{ __('Confirm New Password') }}" required autocomplete="new-password">
                                <button type="button" class="password-toggle" onclick="togglePassword('password-confirm')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <div class="input-border"></div>
                            </div>
                        </div>

                        <div class="password-strength" id="passwordStrength">
                            <div class="strength-header">
                                <span class="strength-label">{{ __('Password Strength') }}</span>
                                <span class="strength-text" id="strengthText">Weak</span>
                            </div>
                            <div class="strength-bar">
                                <div class="strength-fill" id="strengthFill"></div>
                            </div>
                            <div class="strength-requirements">
                                <div class="requirement" id="req-length">
                                    <i class="fas fa-check"></i>
                                    <span>At least 8 characters</span>
                                </div>
                                <div class="requirement" id="req-uppercase">
                                    <i class="fas fa-check"></i>
                                    <span>One uppercase letter</span>
                                </div>
                                <div class="requirement" id="req-lowercase">
                                    <i class="fas fa-check"></i>
                                    <span>One lowercase letter</span>
                                </div>
                                <div class="requirement" id="req-number">
                                    <i class="fas fa-check"></i>
                                    <span>One number</span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="reset-btn">
                            <span class="btn-content">
                                <span class="btn-text">{{ __('Reset Password') }}</span>
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
                        <span class="divider-text">{{ __('or') }}</span>
                    </div>

                    <div class="login-link">
                        <p>{{ __('Remember your password?') }} 
                            <a href="{{route('login.form')}}" class="link-highlight">
                                <span>{{ __('Back to Login') }}</span>
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
/* Elegant Password Reset Styles */
.elegant-reset-section {
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

.reset-container {
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.reset-card {
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
.reset-branding {
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
    gap: 20px;
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
.reset-form-container {
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

.elegant-reset-form {
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

/* Password Strength Indicator */
.password-strength {
    margin-bottom: 30px;
    padding: 20px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 16px;
    border: 2px solid rgba(102, 126, 234, 0.1);
    backdrop-filter: blur(10px);
}

.strength-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.strength-label {
    font-size: 14px;
    font-weight: 600;
    color: #333;
}

.strength-text {
    font-size: 12px;
    font-weight: 600;
    padding: 4px 8px;
    border-radius: 6px;
    transition: all 0.3s ease;
}

.strength-text.weak {
    color: #e74c3c;
    background: rgba(231, 76, 60, 0.1);
}

.strength-text.fair {
    color: #f39c12;
    background: rgba(243, 156, 18, 0.1);
}

.strength-text.good {
    color: #3498db;
    background: rgba(52, 152, 219, 0.1);
}

.strength-text.strong {
    color: #27ae60;
    background: rgba(39, 174, 96, 0.1);
}

.strength-bar {
    width: 100%;
    height: 6px;
    background: rgba(102, 126, 234, 0.1);
    border-radius: 3px;
    overflow: hidden;
    margin-bottom: 16px;
}

.strength-fill {
    height: 100%;
    width: 0%;
    transition: all 0.3s ease;
    border-radius: 3px;
}

.strength-fill.weak { width: 25%; background: #e74c3c; }
.strength-fill.fair { width: 50%; background: #f39c12; }
.strength-fill.good { width: 75%; background: #3498db; }
.strength-fill.strong { width: 100%; background: #27ae60; }

.strength-requirements {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 8px;
}

.requirement {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: #666;
    transition: all 0.3s ease;
}

.requirement i {
    font-size: 10px;
    transition: all 0.3s ease;
}

.requirement.valid {
    color: #27ae60;
}

.requirement.valid i {
    color: #27ae60;
}

.requirement.invalid {
    color: #e74c3c;
}

.requirement.invalid i {
    color: #e74c3c;
}

.reset-btn {
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

.reset-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
}

.reset-btn:active {
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

.reset-btn:hover .btn-icon {
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

.reset-btn.loading .btn-content {
    opacity: 0;
}

.reset-btn.loading .btn-loading {
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

.reset-btn:active .btn-ripple {
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

.login-link {
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
    .reset-card {
        flex-direction: column;
        min-height: auto;
        border-radius: 24px;
    }
    
    .reset-branding {
        padding: 60px 40px;
    }
    
    .brand-title {
        font-size: 2.5rem;
    }
    
    .brand-description h2 {
        font-size: 1.8rem;
    }
    
    .reset-form-container {
        padding: 60px 40px;
    }
    
    .strength-requirements {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .elegant-reset-section {
        padding: 10px;
    }
    
    .reset-branding {
        padding: 40px 20px;
    }
    
    .reset-form-container {
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

// Enhanced password strength checker
function checkPasswordStrength(password) {
    const requirements = {
        length: password.length >= 8,
        uppercase: /[A-Z]/.test(password),
        lowercase: /[a-z]/.test(password),
        number: /[0-9]/.test(password),
        special: /[^a-zA-Z0-9]/.test(password)
    };
    
    const strengthFill = document.getElementById('strengthFill');
    const strengthText = document.getElementById('strengthText');
    
    // Update requirement indicators
    Object.keys(requirements).forEach(req => {
        const element = document.getElementById(`req-${req}`);
        if (element) {
            if (requirements[req]) {
                element.classList.add('valid');
                element.classList.remove('invalid');
            } else {
                element.classList.add('invalid');
                element.classList.remove('valid');
            }
        }
    });
    
    // Calculate strength
    const validRequirements = Object.values(requirements).filter(Boolean).length;
    let strength = 'weak';
    let strengthClass = 'weak';
    
    if (validRequirements >= 5) {
        strength = 'strong';
        strengthClass = 'strong';
    } else if (validRequirements >= 4) {
        strength = 'good';
        strengthClass = 'good';
    } else if (validRequirements >= 3) {
        strength = 'fair';
        strengthClass = 'fair';
    }
    
    // Update strength indicator
    strengthFill.className = `strength-fill ${strengthClass}`;
    strengthText.textContent = strength.charAt(0).toUpperCase() + strength.slice(1);
    strengthText.className = `strength-text ${strengthClass}`;
}

// Password strength monitoring
document.getElementById('password').addEventListener('input', function() {
    checkPasswordStrength(this.value);
});

// Form submission with loading state
document.querySelector('.elegant-reset-form').addEventListener('submit', function(e) {
    const btn = this.querySelector('.reset-btn');
    btn.classList.add('loading');
    
    // Remove loading state after 3 seconds (in case of error)
    setTimeout(() => {
        btn.classList.remove('loading');
    }, 3000);
});

// Password confirmation validation
document.getElementById('password-confirm').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;
    
    if (confirmPassword && password !== confirmPassword) {
        this.style.borderColor = '#e74c3c';
        this.parentElement.style.borderColor = '#e74c3c';
    } else {
        this.style.borderColor = '';
        this.parentElement.style.borderColor = '';
    }
});

// Button ripple effect
document.querySelector('.reset-btn').addEventListener('click', function(e) {
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