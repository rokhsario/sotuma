@extends('frontend.layouts.master')

@section('title', __('frontend.certificates'))

@section('main-content')
<style>
/* MODERN CERTIFICATES PAGE - EYE COMFORTABLE & SYMMETRICAL */
:root {
    --primary-bg: #fafafa;
    --secondary-bg: #ffffff;
    --accent-color: #6366f1;
    --accent-light: #818cf8;
    --text-primary: #1f2937;
    --text-secondary: #6b7280;
    --text-muted: #9ca3af;
    --border-light: #e5e7eb;
    --border-lighter: #f3f4f6;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --gradient-accent: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

/* Strong lock for mobile/tablet inspect modal - mirror media page behavior */
@media (max-width: 1024px) {
    html.inspect-open, body.inspect-open {
        overflow: hidden !important;
        position: fixed !important;
        inset: 0 !important;
        width: 100% !important;
        height: 100% !important;
    }
    body.inspect-open > * {
        display: none !important;
    }
    body.inspect-open > #certificateModal {
        display: flex !important;
        visibility: visible !important;
        opacity: 1 !important;
        pointer-events: auto !important;
    }
}

body {
    background-color: var(--primary-bg);
    color: var(--text-primary);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    line-height: 1.6;
}

.certificates-container {
    min-height: 100vh;
    background: var(--primary-bg);
    position: relative;
}

.certificates-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}




/* Section Header */
.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--text-primary);
    margin-bottom: 1rem;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -0.5rem;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: var(--gradient-primary);
    border-radius: 2px;
}

.section-subtitle {
    font-size: 1.125rem;
    color: var(--text-secondary);
    max-width: 500px;
    margin: 0 auto;
    line-height: 1.6;
}

/* Certificates Grid - Symmetrical Design */
.certificates-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.certificate-card {
    background: var(--secondary-bg);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid var(--border-light);
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
    min-height: 500px;
}

.certificate-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
    border-color: var(--accent-light);
}

.certificate-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--gradient-primary);
    z-index: 1;
}

.certificate-image-container {
    position: relative;
    height: 280px;
    overflow: hidden;
    background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.certificate-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    transition: transform 0.3s ease;
    cursor: pointer;
    padding: 1rem;
}

.certificate-card:hover .certificate-image {
    transform: scale(1.02);
}

.certificate-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(99, 102, 241, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    backdrop-filter: blur(4px);
}

.certificate-card:hover .certificate-overlay {
    opacity: 1;
}

.zoom-icon {
    background: rgba(255, 255, 255, 0.9);
    color: var(--accent-color);
    border-radius: 50%;
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
}

.zoom-icon:hover {
    background: var(--accent-color);
    color: white;
    transform: scale(1.1);
}

.certificate-content {
    padding: 2rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 220px;
}

.certificate-title {
    font-size: 1.375rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: auto;
    line-height: 1.4;
    min-height: 3.5rem;
    display: flex;
    align-items: center;
}

.certificate-description {
    font-size: 1rem;
    line-height: 1.6;
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
    flex: 1;
    min-height: 4.5rem;
    display: flex;
    align-items: flex-start;
}

.certificate-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 1.5rem;
    border-top: 1px solid var(--border-lighter);
    margin-top: auto;
}

.certificate-badge {
    background: var(--gradient-primary);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    box-shadow: var(--shadow-sm);
}



/* Empty State */
.empty-state {
    background: var(--secondary-bg);
    border-radius: 20px;
    padding: 4rem 2rem;
    text-align: center;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.empty-icon {
    font-size: 4rem;
    color: var(--text-muted);
    margin-bottom: 1.5rem;
    opacity: 0.5;
}

.empty-title {
    font-size: 1.5rem;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.empty-description {
    color: var(--text-secondary);
    font-size: 1rem;
    max-width: 400px;
    margin: 0 auto;
}

/* Modal */
.certificate-modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    padding: 2rem;
    backdrop-filter: blur(8px);
}

.certificate-modal.active {
    opacity: 1;
    visibility: visible;
}

.modal-content {
    position: relative;
    max-width: 90vw;
    max-height: 90vh;
    background: var(--secondary-bg);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-xl);
    transform: scale(0.9);
    transition: transform 0.3s ease;
    border: 1px solid var(--border-light);
}

.certificate-modal.active .modal-content {
    transform: scale(1);
}

.modal-image {
    width: 100%;
    height: auto;
    max-height: 80vh;
    object-fit: contain;
    padding: 1rem;
}

.modal-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    border: none;
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 1.125rem;
    cursor: pointer;
    transition: all 0.3s ease;
    backdrop-filter: blur(8px);
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-close:hover {
    background: var(--accent-color);
    transform: scale(1.1);
}



/* Responsive Design */
@media (max-width: 1024px) {
    .certificates-content {
        padding: 1.5rem;
    }
    
    
    .certificates-grid {
        grid-template-columns: 1fr !important;
        gap: 0 !important;
        margin: 0 auto !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        justify-items: center !important;
    }
    
    .certificate-card {
        width: 100% !important;
        max-width: 640px !important;
        margin: 0 auto !important;
        border-radius: 0 !important;
    }
}

@media (max-width: 768px) {
    
    .section-title {
        font-size: 2rem;
    }
    
    .certificates-grid {
        grid-template-columns: 1fr !important;
        gap: 0 !important;
        margin: 0 auto !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        justify-items: center !important;
    }
    
    .certificate-card {
        width: 100% !important;
        max-width: 640px !important;
        margin: 0 auto !important;
        border-radius: 0 !important;
    }
    
    .certificate-image-container {
        height: 240px;
    }
    
    .certificate-content {
        padding: 1.5rem;
    }
}

@media (max-width: 480px) {
    .certificates-content {
        padding: 1rem;
    }
    
    
    .certificate-image-container {
        height: 200px;
    }
    /* Keep card centered and avoid viewport width overflow */
    .certificates-grid {
        margin: 0 auto !important;
        width: 100% !important;
        max-width: 100% !important;
        justify-items: center !important;
    }
    .certificate-card {
        max-width: 540px !important;
        margin: 0 auto !important;
    }
}

/* Loading Animation */
.certificate-card.loading {
    animation: shimmer 1.5s infinite linear;
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
}

@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

/* Smooth Animations */
.certificate-card {
    animation: fadeInUp 0.6s ease-out;
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
</style>

<div class="certificates-container">
    <div class="certificates-content">

        <!-- Certificates Section -->
        <section class="certificates-section">
            <div class="section-header">
                <h2 class="section-title">Certifications Officielles</h2>
                <p class="section-subtitle">
                    Chaque certificat représente notre engagement envers l'excellence et notre conformité 
                    aux standards internationaux les plus élevés.
                </p>
            </div>

            @if($certificates->count() > 0)
                <div class="certificates-grid">
                    @foreach($certificates as $certificate)
                        <div class="certificate-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="certificate-image-container" onclick="openCertificateModal('{{ asset($certificate->image) }}', '{{ $certificate->title }}')">
                                <img src="{{ asset($certificate->image) }}" 
                                     alt="{{ $certificate->title }}" 
                                     class="certificate-image"
                                     loading="lazy">
                                <div class="certificate-overlay">
                                    <div class="zoom-icon">
                                        <i class="fas fa-search-plus"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="certificate-content">
                                <h3 class="certificate-title">{{ $certificate->title }}</h3>
                                <p class="certificate-description">{{ $certificate->description }}</p>
                                <div class="certificate-meta">
                                    <span class="certificate-badge">Certifié</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3 class="empty-title">Aucun certificat disponible</h3>
                    <p class="empty-description">
                        {{ __('frontend.certificates_updating') }}
                    </p>
                </div>
            @endif
        </section>
    </div>
</div>

<!-- Certificate Modal -->
<div class="certificate-modal" id="certificateModal" onclick="closeCertificateModal()">
    <button class="modal-close" onclick="closeCertificateModal()">
        <i class="fas fa-times"></i>
    </button>
    <div class="modal-content" onclick="event.stopPropagation()">
        <img src="" alt="Certificat" class="modal-image" id="modalImage">
    </div>
</div>

<script>
// Certificate Modal Functions
function openCertificateModal(imageSrc, title) {
    const modal = document.getElementById('certificateModal');
    const modalImage = document.getElementById('modalImage');
    
    modalImage.src = imageSrc;
    modalImage.alt = title;
    
    // Ensure modal is a direct child of body for strong lock layout (mobile/tablet)
    try {
        if (modal && modal.parentNode !== document.body) {
            document.body.appendChild(modal);
        }
    } catch (e) {}
    
    const isMobileOrTablet = window.innerWidth <= 1024 || /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    if (isMobileOrTablet) {
        // Strong full-screen inspect mode (match media page)
        document.body.classList.add('inspect-open');
    }
    
    modal.classList.add('active');
    
    // Prevent body scroll (desktop fallback)
    document.body.style.overflow = 'hidden';
}

function closeCertificateModal() {
    const modal = document.getElementById('certificateModal');
    modal.classList.remove('active');
    
    // Restore body scroll
    document.body.style.overflow = '';
    document.body.classList.remove('inspect-open');
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeCertificateModal();
    }
});

// Close modal on background click
document.getElementById('certificateModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCertificateModal();
    }
});

// Intersection Observer for animations
if ('IntersectionObserver' in window) {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe certificate cards
    document.querySelectorAll('.certificate-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
    });
}

// Loading state management
document.addEventListener('DOMContentLoaded', function() {
    // Remove loading states after images load
    const images = document.querySelectorAll('.certificate-image');
    images.forEach(img => {
        if (img.complete) {
            img.parentElement.classList.remove('loading');
        } else {
            img.addEventListener('load', function() {
                this.parentElement.classList.remove('loading');
            });
            img.addEventListener('error', function() {
                this.parentElement.classList.remove('loading');
                this.style.display = 'none';
            });
        }
    });
});
</script>
@endsection 