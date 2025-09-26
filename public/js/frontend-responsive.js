/* =====================================
SOTUMA Frontend Responsive JavaScript
Mobile Frontend Functionality
Version: 1.0
===================================== */

document.addEventListener('DOMContentLoaded', function() {
    
    // Responsive Navigation Enhancement
    function enhanceNavigation() {
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu');
        const navOverlay = document.querySelector('.nav-overlay');
        const dropdownItems = document.querySelectorAll('.nav-item.dropdown');
        
        // Mobile dropdown toggle for touch devices
        if (window.innerWidth <= 991) {
            dropdownItems.forEach(item => {
                const link = item.querySelector('.nav-link');
                const menu = item.querySelector('.dropdown-menu');
                
                if (link && menu) {
                    // Remove hover events on mobile
                    item.removeEventListener('mouseenter', function() {});
                    item.removeEventListener('mouseleave', function() {});
                    
                    // Add click event for mobile
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        menu.classList.toggle('show');
                        
                        // Close other dropdowns
                        dropdownItems.forEach(otherItem => {
                            if (otherItem !== item) {
                                const otherMenu = otherItem.querySelector('.dropdown-menu');
                                if (otherMenu) {
                                    otherMenu.classList.remove('show');
                                }
                            }
                        });
                    });
                }
            });
        }
        
        // Keyboard navigation support
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Close mobile menu
                if (navMenu && navMenu.classList.contains('active')) {
                    navMenu.classList.remove('active');
                    navOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
                
                // Close dropdowns
                dropdownItems.forEach(item => {
                    const menu = item.querySelector('.dropdown-menu');
                    if (menu) {
                        menu.classList.remove('show');
                        menu.style.display = 'none';
                    }
                });
            }
        });
    }
    
    // Responsive Images with Lazy Loading
    function enhanceImages() {
        const images = document.querySelectorAll('img');
        
        // Add loading="lazy" to images that don't have it
        images.forEach(img => {
            if (!img.hasAttribute('loading')) {
                img.setAttribute('loading', 'lazy');
            }
            
            // Add error handling
            img.addEventListener('error', function() {
                this.src = '/images/no-image.png';
                this.alt = 'Image not available';
            });
        });
        
        // Intersection Observer for advanced lazy loading
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            observer.unobserve(img);
                        }
                    }
                });
            });
            
            const lazyImages = document.querySelectorAll('img.lazy');
            lazyImages.forEach(img => imageObserver.observe(img));
        }
    }
    
    // Responsive Product Cards
    function enhanceProductCards() {
        const productCards = document.querySelectorAll('.product-card, .single-product');
        
        productCards.forEach(card => {
            // Add touch support for mobile hover effects
            if ('ontouchstart' in window) {
                card.addEventListener('touchstart', function() {
                    this.classList.add('touch-hover');
                });
                
                card.addEventListener('touchend', function() {
                    setTimeout(() => {
                        this.classList.remove('touch-hover');
                    }, 300);
                });
            }
            
            // Improve accessibility
            if (!card.hasAttribute('tabindex')) {
                card.setAttribute('tabindex', '0');
            }
            
            // Keyboard navigation
            card.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    e.preventDefault();
                    const link = this.querySelector('a');
                    if (link) {
                        link.click();
                    }
                }
            });
        });
    }
    
    // Responsive Forms
    function enhanceForms() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            // Add responsive class
            if (!form.classList.contains('form-responsive')) {
                form.classList.add('form-responsive');
            }
            
            // Enhance form inputs for mobile
            const inputs = form.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                // Prevent zoom on iOS
                if (input.type === 'text' || input.type === 'email' || input.type === 'password') {
                    if (!input.style.fontSize) {
                        input.style.fontSize = '16px';
                    }
                }
                
                // Floating labels removed - using placeholders only
            });
            
            // Handle form submission with loading state
            form.addEventListener('submit', function() {
                const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
                if (submitBtn) {
                    submitBtn.disabled = true;
                    const originalText = submitBtn.textContent || submitBtn.value;
                    submitBtn.textContent = 'Loading...';
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                    
                    // Re-enable after 5 seconds (fallback)
                    setTimeout(() => {
                        submitBtn.disabled = false;
                        submitBtn.textContent = originalText;
                    }, 5000);
                }
            });
        });
    }
    
    // Responsive Tables
    function enhanceTables() {
        const tables = document.querySelectorAll('table');
        
        tables.forEach(table => {
            // Add responsive wrapper
            if (!table.parentElement.classList.contains('table-responsive')) {
                const wrapper = document.createElement('div');
                wrapper.classList.add('table-responsive');
                table.parentNode.insertBefore(wrapper, table);
                wrapper.appendChild(table);
            }
            
            // Add data labels for mobile view
            const headers = table.querySelectorAll('thead th');
            const rows = table.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                cells.forEach((cell, index) => {
                    if (headers[index] && !cell.hasAttribute('data-label')) {
                        cell.setAttribute('data-label', headers[index].textContent.trim());
                    }
                });
            });
        });
    }
    
    // Responsive Modals and Popups
    function enhanceModals() {
        const modals = document.querySelectorAll('.modal, .popup');
        
        modals.forEach(modal => {
            // Close modal on outside click
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                }
            });
            
            // Close modal on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && modal.style.display !== 'none') {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                }
            });
            
            // Trap focus within modal
            const focusableElements = modal.querySelectorAll(
                'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
            );
            
            if (focusableElements.length > 0) {
                const firstElement = focusableElements[0];
                const lastElement = focusableElements[focusableElements.length - 1];
                
                modal.addEventListener('keydown', function(e) {
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
        });
    }
    
    // Responsive Scroll Effects
    function enhanceScrollEffects() {
        let ticking = false;
        
        function updateScrollEffects() {
            const scrollY = window.scrollY;
            const header = document.querySelector('nav.navbar');
            
            // Sticky header
            if (header) {
                if (scrollY > 100) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
            
            // Back to top button
            let backToTop = document.querySelector('.back-to-top');
            if (!backToTop) {
                backToTop = document.createElement('button');
                backToTop.className = 'back-to-top';
                backToTop.innerHTML = '<i class="fas fa-arrow-up"></i>';
                backToTop.setAttribute('aria-label', 'Back to top');
                document.body.appendChild(backToTop);
                
                backToTop.addEventListener('click', function() {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }
            
            if (scrollY > 500) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
            
            ticking = false;
        }
        
        function requestScrollUpdate() {
            if (!ticking) {
                requestAnimationFrame(updateScrollEffects);
                ticking = true;
            }
        }
        
        window.addEventListener('scroll', requestScrollUpdate);
        updateScrollEffects(); // Initial call
    }
    
    // Responsive Touch Gestures
    function addTouchGestures() {
        let startX = 0;
        let startY = 0;
        let currentX = 0;
        let currentY = 0;
        let isDragging = false;
        
        document.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
            isDragging = true;
        }, { passive: true });
        
        document.addEventListener('touchmove', function(e) {
            if (!isDragging) return;
            currentX = e.touches[0].clientX;
            currentY = e.touches[0].clientY;
        }, { passive: true });
        
        document.addEventListener('touchend', function(e) {
            if (!isDragging) return;
            isDragging = false;
            
            const diffX = currentX - startX;
            const diffY = currentY - startY;
            const absDiffX = Math.abs(diffX);
            const absDiffY = Math.abs(diffY);
            
            // Only handle horizontal swipes
            if (absDiffX > absDiffY && absDiffX > 50) {
                const navMenu = document.querySelector('.nav-menu');
                const navOverlay = document.querySelector('.nav-overlay');
                
                // Swipe right to open menu (from left edge)
                if (diffX > 0 && startX < 50) {
                    if (navMenu && navOverlay && !navMenu.classList.contains('active')) {
                        navMenu.classList.add('active');
                        navOverlay.classList.add('active');
                        document.body.style.overflow = 'hidden';
                    }
                }
                
                // Swipe left to close menu
                if (diffX < 0 && navMenu && navMenu.classList.contains('active')) {
                    navMenu.classList.remove('active');
                    navOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
        }, { passive: true });
    }
    
    // Responsive Performance Optimizations
    function optimizePerformance() {
        // Debounce resize events
        let resizeTimer;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(function() {
                // Re-initialize responsive features on resize
                enhanceNavigation();
                enhanceTables();
            }, 250);
        });
        
        // Preload critical resources
        const criticalImages = document.querySelectorAll('img[data-critical]');
        criticalImages.forEach(img => {
            const link = document.createElement('link');
            link.rel = 'preload';
            link.as = 'image';
            link.href = img.src || img.dataset.src;
            document.head.appendChild(link);
        });
        
        // Lazy load non-critical CSS
        const nonCriticalCSS = document.querySelectorAll('link[data-lazy-css]');
        nonCriticalCSS.forEach(link => {
            link.media = 'print';
            link.onload = function() {
                this.media = 'all';
            };
        });
    }
    
    // Accessibility Enhancements
    function enhanceAccessibility() {
        // Add skip links
        if (!document.querySelector('.skip-link')) {
            const skipLink = document.createElement('a');
            skipLink.href = '#main-content';
            skipLink.className = 'skip-link';
            skipLink.textContent = 'Skip to main content';
            document.body.insertBefore(skipLink, document.body.firstChild);
        }
        
        // Enhance focus management
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-navigation');
            }
        });
        
        document.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-navigation');
        });
        
        // Add ARIA labels where missing
        const buttons = document.querySelectorAll('button:not([aria-label]):not([aria-labelledby])');
        buttons.forEach(button => {
            if (!button.textContent.trim()) {
                const icon = button.querySelector('i');
                if (icon) {
                    const iconClass = icon.className;
                    if (iconClass.includes('fa-bars')) {
                        button.setAttribute('aria-label', 'Toggle menu');
                    } else if (iconClass.includes('fa-search')) {
                        button.setAttribute('aria-label', 'Search');
                    } else if (iconClass.includes('fa-times')) {
                        button.setAttribute('aria-label', 'Close');
                    }
                }
            }
        });
    }
    
    // Initialize all responsive enhancements
    function initResponsiveFrontend() {
        enhanceNavigation();
        enhanceImages();
        enhanceProductCards();
        enhanceForms();
        enhanceTables();
        enhanceModals();
        enhanceScrollEffects();
        addTouchGestures();
        optimizePerformance();
        enhanceAccessibility();
    }
    
    // Run initialization
    initResponsiveFrontend();
    
    // Export for external use
    window.FrontendResponsive = {
        init: initResponsiveFrontend,
        navigation: enhanceNavigation,
        images: enhanceImages,
        cards: enhanceProductCards,
        forms: enhanceForms,
        tables: enhanceTables,
        modals: enhanceModals,
        scroll: enhanceScrollEffects,
        touch: addTouchGestures,
        accessibility: enhanceAccessibility
    };
});

// Add CSS for responsive enhancements
(function() {
    const style = document.createElement('style');
    style.textContent = `
        /* Responsive Enhancement Styles */
        .back-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background: var(--primary, #D2B48C);
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            font-size: 18px;
        }
        
        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }
        
        .back-to-top:hover {
            background: var(--primary-dark, #b8a177);
            transform: translateY(-2px);
        }
        
        .skip-link {
            position: absolute;
            top: -40px;
            left: 6px;
            background: #000;
            color: #fff;
            padding: 8px;
            text-decoration: none;
            z-index: 10000;
            border-radius: 4px;
            transition: top 0.3s ease;
        }
        
        .skip-link:focus {
            top: 6px;
        }
        
        /* Floating labels removed */
        
        .form-group {
            position: relative;
            margin-bottom: 1rem;
        }
        
        .touch-hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(0,0,0,0.1);
        }
        
        .keyboard-navigation *:focus {
            outline: 2px solid var(--primary, #D2B48C);
            outline-offset: 2px;
        }
        
        @media (max-width: 767px) {
            .back-to-top {
                width: 45px;
                height: 45px;
                bottom: 15px;
                right: 15px;
                font-size: 16px;
            }
        }
        
        /* Mobile dropdown styles */
        @media (max-width: 991px) {
            .dropdown-menu.show {
                display: block !important;
            }
        }
    `;
    document.head.appendChild(style);
})();
