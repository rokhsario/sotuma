/* =====================================
SOTUMA Frontend Mobile Enhancements
Enhanced Mobile Interactions and Performance
Version: 1.0 - Production Ready
===================================== */

(function() {
    'use strict';

    // ===== MOBILE DETECTION =====
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;

    // ===== PERFORMANCE OPTIMIZATIONS =====
    if (isMobile) {
        // Reduce animations on mobile for better performance
        document.documentElement.style.setProperty('--animation-duration', '0.3s');
        
        // Optimize images for mobile
        const images = document.querySelectorAll('img');
        images.forEach(img => {
            if (!img.hasAttribute('loading')) {
                img.setAttribute('loading', 'lazy');
            }
        });
    }

    // ===== TOUCH INTERACTIONS =====
    if (isTouch) {
        // Add touch feedback to interactive elements
        const touchElements = document.querySelectorAll('.btn, .contact-card, .category-card, .product-card, .certificate-card, .tiktok-feed-item');
        
        touchElements.forEach(element => {
            element.addEventListener('touchstart', function() {
                this.style.transform = 'scale(0.98)';
                this.style.transition = 'transform 0.1s ease';
            });
            
            element.addEventListener('touchend', function() {
                this.style.transform = '';
            });
            
            element.addEventListener('touchcancel', function() {
                this.style.transform = '';
            });
        });
    }

    // ===== IMPROVED SCROLLING =====
    if (isMobile) {
        // Smooth scrolling for mobile
        document.documentElement.style.scrollBehavior = 'smooth';
        
        // Prevent overscroll bounce on iOS
        document.addEventListener('touchmove', function(e) {
            if (e.target.closest('.tiktok-feed-grid, .thumbnail-slider, .partners-scroll-content')) {
                return; // Allow scrolling in these containers
            }
            
            const target = e.target;
            const scrollableParent = target.closest('.scrollable');
            
            if (!scrollableParent) {
                e.preventDefault();
            }
        }, { passive: false });
    }

    // ===== MODAL ENHANCEMENTS =====
    function enhanceModals() {
        const modals = document.querySelectorAll('.certificate-modal, #feedModal, #imageModal');
        
        modals.forEach(modal => {
            // Close modal on swipe down (mobile)
            if (isTouch) {
                let startY = 0;
                let currentY = 0;
                let isDragging = false;
                
                modal.addEventListener('touchstart', function(e) {
                    startY = e.touches[0].clientY;
                    isDragging = true;
                });
                
                modal.addEventListener('touchmove', function(e) {
                    if (!isDragging) return;
                    
                    currentY = e.touches[0].clientY;
                    const diffY = currentY - startY;
                    
                    if (diffY > 50) { // Swipe down threshold
                        closeModal(modal);
                        isDragging = false;
                    }
                });
                
                modal.addEventListener('touchend', function() {
                    isDragging = false;
                });
            }
            
            // Prevent body scroll when modal is open
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                        const isVisible = modal.style.display !== 'none';
                        if (isVisible) {
                            document.body.style.overflow = 'hidden';
                        } else {
                            document.body.style.overflow = '';
                        }
                    }
                });
            });
            
            observer.observe(modal, { attributes: true });
        });
    }

    function closeModal(modal) {
        if (modal.id === 'feedModal') {
            if (typeof closeFeedModal === 'function') {
                closeFeedModal();
            }
        } else if (modal.id === 'imageModal') {
            if (typeof closeModal === 'function') {
                closeModal();
            }
        } else if (modal.classList.contains('certificate-modal')) {
            if (typeof closeCertificateModal === 'function') {
                closeCertificateModal();
            }
        }
    }

    // ===== FORM ENHANCEMENTS =====
    function enhanceForms() {
        const forms = document.querySelectorAll('form');
        
        forms.forEach(form => {
            const inputs = form.querySelectorAll('input, textarea, select');
            
            inputs.forEach(input => {
                // Prevent zoom on iOS when focusing inputs
                if (isMobile && (input.type === 'text' || input.type === 'email' || input.type === 'tel' || input.tagName === 'TEXTAREA')) {
                    input.style.fontSize = '16px';
                }
                
                // Add visual feedback for form validation
                input.addEventListener('blur', function() {
                    if (this.checkValidity && !this.checkValidity()) {
                        this.style.borderColor = '#dc3545';
                        this.style.backgroundColor = '#fff5f5';
                    } else {
                        this.style.borderColor = '#28a745';
                        this.style.backgroundColor = '#f8fff8';
                    }
                });
                
                input.addEventListener('input', function() {
                    if (this.checkValidity && this.checkValidity()) {
                        this.style.borderColor = '#28a745';
                        this.style.backgroundColor = '#f8fff8';
                    } else {
                        this.style.borderColor = '';
                        this.style.backgroundColor = '';
                    }
                });
            });
        });
    }

    // ===== LAZY LOADING ENHANCEMENT =====
    function enhanceLazyLoading() {
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.removeAttribute('data-src');
                        }
                        observer.unobserve(img);
                    }
                });
            }, {
                rootMargin: '50px 0px',
                threshold: 0.01
            });

            const lazyImages = document.querySelectorAll('img[data-src]');
            lazyImages.forEach(img => imageObserver.observe(img));
        }
    }

    // ===== GALLERY ENHANCEMENTS =====
    function enhanceGalleries() {
        // Thumbnail slider touch support
        const thumbnailSliders = document.querySelectorAll('.thumbnail-slider');
        
        thumbnailSliders.forEach(slider => {
            if (isTouch) {
                let startX = 0;
                let scrollLeft = 0;
                let isScrolling = false;
                
                slider.addEventListener('touchstart', function(e) {
                    startX = e.touches[0].pageX - slider.offsetLeft;
                    scrollLeft = slider.scrollLeft;
                    isScrolling = true;
                });
                
                slider.addEventListener('touchmove', function(e) {
                    if (!isScrolling) return;
                    e.preventDefault();
                    const x = e.touches[0].pageX - slider.offsetLeft;
                    const walk = (x - startX) * 2;
                    slider.scrollLeft = scrollLeft - walk;
                });
                
                slider.addEventListener('touchend', function() {
                    isScrolling = false;
                });
            }
        });
    }

    // ===== PERFORMANCE MONITORING =====
    function monitorPerformance() {
        if (isMobile && 'performance' in window) {
            window.addEventListener('load', function() {
                setTimeout(function() {
                    const perfData = performance.getEntriesByType('navigation')[0];
                    const loadTime = perfData.loadEventEnd - perfData.loadEventStart;
                    
                    if (loadTime > 3000) {
                        console.warn('Slow page load detected:', loadTime + 'ms');
                        // Could trigger additional optimizations here
                    }
                }, 0);
            });
        }
    }

    // ===== ACCESSIBILITY ENHANCEMENTS =====
    function enhanceAccessibility() {
        // Add ARIA labels to interactive elements
        const interactiveElements = document.querySelectorAll('.btn, .contact-card, .category-card, .product-card, .certificate-card');
        
        interactiveElements.forEach(element => {
            if (!element.getAttribute('aria-label') && !element.querySelector('aria-label')) {
                const text = element.textContent.trim() || element.title || 'Interactive element';
                element.setAttribute('aria-label', text);
            }
        });
        
        // Improve focus management for modals
        const modals = document.querySelectorAll('.certificate-modal, #feedModal, #imageModal');
        modals.forEach(modal => {
            modal.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeModal(modal);
                }
            });
        });
    }

    // ===== MOBILE RESPONSIVE GRIDS =====
    function forceMobileResponsive() {
        // Clean up index page elements first
        cleanupIndexPageElements();
        
        const isMobileWidth = window.innerWidth <= 768;
        const isSmallMobileWidth = window.innerWidth <= 480;
        
        // Get all grid elements with more specific selectors (excluding index page grids and their elements)
        const productsGrids = document.querySelectorAll('.products-grid:not(.projects-categories-grid):not(.offer-grid):not([class*="projects-categories"]):not([class*="offer-grid"]), .products-section .products-grid, .main-content .products-grid');
        const categoryGrids = document.querySelectorAll('.categories-grid:not(.projects-categories-grid):not(.offer-grid):not([class*="projects-categories"]):not([class*="offer-grid"]), .aluprof-category-grid:not(.projects-categories-grid):not(.offer-grid):not([class*="projects-categories"]):not([class*="offer-grid"]), .main-content .categories-grid');
        const projectGrids = document.querySelectorAll('.project-info-container:not(.projects-categories-grid):not(.offer-grid):not([class*="projects-categories"]):not([class*="offer-grid"]), .main-content .project-info-container');
        const mediaGrids = document.querySelectorAll('.tiktok-feed-grid');
        
        // Apply mobile responsive styles with maximum force
        if (isSmallMobileWidth) {
            // Single column for small mobile
            [...productsGrids, ...categoryGrids, ...projectGrids].forEach(grid => {
                if (grid) {
                    // Remove any existing inline grid styles
                    grid.style.removeProperty('grid-template-columns');
                    grid.style.removeProperty('grid-template-rows');
                    
                    // Force single column
                    grid.style.gridTemplateColumns = '1fr';
                    grid.style.gap = '15px';
                    grid.style.setProperty('grid-template-columns', '1fr', 'important');
                    grid.style.setProperty('gap', '15px', 'important');
                    
                    // Add data attribute to track override
                    grid.setAttribute('data-mobile-override', '1fr');
                }
            });
            
            // Handle media grids with flexbox for small mobile
            mediaGrids.forEach(grid => {
                if (grid) {
                    // Remove any existing inline styles
                    grid.style.removeProperty('grid-template-columns');
                    grid.style.removeProperty('display');
                    
                    // Force flexbox with centered single column
                    grid.style.display = 'flex';
                    grid.style.flexWrap = 'wrap';
                    grid.style.justifyContent = 'center';
                    grid.style.gap = '12px';
                    grid.style.setProperty('display', 'flex', 'important');
                    grid.style.setProperty('justify-content', 'center', 'important');
                    grid.style.setProperty('gap', '12px', 'important');
                    
                    // Set items to 80% width
                    const items = grid.querySelectorAll('.tiktok-feed-item');
                    items.forEach(item => {
                        item.style.width = '80%';
                        item.style.maxWidth = '80%';
                        item.style.flex = '0 0 80%';
                        item.style.setProperty('width', '80%', 'important');
                        item.style.setProperty('max-width', '80%', 'important');
                    });
                    
                    grid.setAttribute('data-mobile-override', 'flex-1col');
                }
            });
        } else if (isMobileWidth) {
            // One column for mobile
            [...productsGrids, ...categoryGrids, ...projectGrids].forEach(grid => {
                if (grid) {
                    // Remove any existing inline grid styles
                    grid.style.removeProperty('grid-template-columns');
                    grid.style.removeProperty('grid-template-rows');
                    
                    // Force single column
                    grid.style.gridTemplateColumns = '1fr';
                    grid.style.gap = '20px';
                    grid.style.setProperty('grid-template-columns', '1fr', 'important');
                    grid.style.setProperty('gap', '20px', 'important');
                    
                    // Add data attribute to track override
                    grid.setAttribute('data-mobile-override', '1fr');
                }
            });
            
            // Handle media grids with flexbox for mobile
            mediaGrids.forEach(grid => {
                if (grid) {
                    // Remove any existing inline styles
                    grid.style.removeProperty('grid-template-columns');
                    grid.style.removeProperty('display');
                    
                    // Force flexbox with centered two columns
                    grid.style.display = 'flex';
                    grid.style.flexWrap = 'wrap';
                    grid.style.justifyContent = 'center';
                    grid.style.gap = '15px';
                    grid.style.setProperty('display', 'flex', 'important');
                    grid.style.setProperty('justify-content', 'center', 'important');
                    grid.style.setProperty('gap', '15px', 'important');
                    
                    // Set items to 45% width for 2 columns
                    const items = grid.querySelectorAll('.tiktok-feed-item');
                    items.forEach(item => {
                        item.style.width = '45%';
                        item.style.maxWidth = '45%';
                        item.style.flex = '0 0 45%';
                        item.style.setProperty('width', '45%', 'important');
                        item.style.setProperty('max-width', '45%', 'important');
                    });
                    
                    grid.setAttribute('data-mobile-override', 'flex-2col');
                }
            });
        } else {
            // Desktop - remove mobile overrides
            [...productsGrids, ...categoryGrids, ...projectGrids].forEach(grid => {
                if (grid && grid.hasAttribute('data-mobile-override')) {
                    grid.removeAttribute('data-mobile-override');
                    grid.style.removeProperty('grid-template-columns');
                    grid.style.removeProperty('gap');
                }
            });
            
            // Reset media grids to original grid layout on desktop
            mediaGrids.forEach(grid => {
                if (grid && grid.hasAttribute('data-mobile-override')) {
                    grid.removeAttribute('data-mobile-override');
                    grid.style.removeProperty('display');
                    grid.style.removeProperty('justify-content');
                    grid.style.removeProperty('gap');
                    
                    // Reset items to original sizing
                    const items = grid.querySelectorAll('.tiktok-feed-item');
                    items.forEach(item => {
                        item.style.removeProperty('width');
                        item.style.removeProperty('max-width');
                        item.style.removeProperty('flex');
                    });
                }
            });
        }
    }

    // ===== CLEANUP INDEX PAGE ELEMENTS =====
    function cleanupIndexPageElements() {
        // Remove mobile-forced attributes and styles from index page elements
        const indexPageElements = document.querySelectorAll('[class*="projects-categories"], [class*="offer-grid"]');
        indexPageElements.forEach(element => {
            element.removeAttribute('data-mobile-forced');
            element.style.removeProperty('grid-template-columns');
            element.style.removeProperty('gap');
            element.style.removeProperty('display');
        });
    }

    // ===== ENHANCED INDEX PAGE SECTION HIDING =====
    function forceHideIndexPageSections() {
        // Only apply to index page
        const isIndexPage = window.location.pathname === '/' || window.location.pathname === '/home';
        if (!isIndexPage) return;
        
        const isMobileWidth = window.innerWidth <= 1024; // Include tablets
        
        if (isMobileWidth) {
            // Target specific sections mentioned in the request
            const targetSections = [
                '.projects-categories-grid-section',
                '.offer-grid-section'
            ];
            
            targetSections.forEach(selector => {
                const elements = document.querySelectorAll(selector);
                elements.forEach(element => {
                    if (element) {
                        // Maximum force hiding
                        element.style.setProperty('display', 'none', 'important');
                        element.style.setProperty('visibility', 'hidden', 'important');
                        element.style.setProperty('opacity', '0', 'important');
                        element.style.setProperty('height', '0', 'important');
                        element.style.setProperty('overflow', 'hidden', 'important');
                        element.style.setProperty('margin', '0', 'important');
                        element.style.setProperty('padding', '0', 'important');
                        element.setAttribute('data-sotuma-force-hidden', 'true');
                        
                        // Hide all child elements too
                        const children = element.querySelectorAll('*');
                        children.forEach(child => {
                            child.style.setProperty('display', 'none', 'important');
                            child.style.setProperty('visibility', 'hidden', 'important');
                        });
                    }
                });
            });
        } else {
            // Show sections on desktop
            const targetSections = [
                '.projects-categories-grid-section',
                '.offer-grid-section'
            ];
            
            targetSections.forEach(selector => {
                const elements = document.querySelectorAll(selector);
                elements.forEach(element => {
                    if (element && element.hasAttribute('data-sotuma-force-hidden')) {
                        element.style.removeProperty('display');
                        element.style.removeProperty('visibility');
                        element.style.removeProperty('opacity');
                        element.style.removeProperty('height');
                        element.style.removeProperty('overflow');
                        element.style.removeProperty('margin');
                        element.style.removeProperty('padding');
                        element.removeAttribute('data-sotuma-force-hidden');
                        
                        // Show all child elements
                        const children = element.querySelectorAll('*');
                        children.forEach(child => {
                            child.style.removeProperty('display');
                            child.style.removeProperty('visibility');
                        });
                    }
                });
            });
        }
    }

    // ===== IMMEDIATE MOBILE RESPONSIVE FORCE =====
    function immediateMobileForce() {
        // Clean up index page elements first
        cleanupIndexPageElements();
        
        const isMobileWidth = window.innerWidth <= 768;
        
        if (isMobileWidth) {
            // Force all grids to single column immediately (excluding index page grids and their elements)
            const allGrids = document.querySelectorAll('.products-grid:not(.projects-categories-grid):not(.offer-grid):not([class*="projects-categories"]):not([class*="offer-grid"]), .project-info-container:not(.projects-categories-grid):not(.offer-grid):not([class*="projects-categories"]):not([class*="offer-grid"]), .categories-grid:not(.projects-categories-grid):not(.offer-grid):not([class*="projects-categories"]):not([class*="offer-grid"]), .aluprof-category-grid:not(.projects-categories-grid):not(.offer-grid):not([class*="projects-categories"]):not([class*="offer-grid"])');
            
            allGrids.forEach(grid => {
                if (grid) {
                    grid.style.setProperty('grid-template-columns', '1fr', 'important');
                    grid.style.setProperty('gap', '20px', 'important');
                    grid.setAttribute('data-mobile-forced', 'true');
                }
            });
            
            // Handle media grids with single column layout for mobile/tablet
            const mediaGrids = document.querySelectorAll('.tiktok-feed-grid');
            mediaGrids.forEach(grid => {
                if (grid) {
                    // Force single column layout for mobile/tablet
                    grid.style.setProperty('display', 'block', 'important');
                    grid.style.setProperty('grid-template-columns', 'none', 'important');
                    grid.style.setProperty('gap', '0', 'important');
                    grid.style.setProperty('padding', '0', 'important');
                    grid.style.setProperty('margin', '0', 'important');
                    grid.style.setProperty('width', '100vw', 'important');
                    grid.style.setProperty('max-width', '100vw', 'important');
                    
                    // Set items to full width for single column
                    const items = grid.querySelectorAll('.tiktok-feed-item');
                    items.forEach(item => {
                        item.style.setProperty('width', '100vw', 'important');
                        item.style.setProperty('max-width', '100vw', 'important');
                        item.style.setProperty('margin', '0', 'important');
                        item.style.setProperty('border-radius', '0', 'important');
                        item.style.setProperty('display', 'block', 'important');
                    });
                    
                    grid.setAttribute('data-mobile-forced', 'true');
                }
            });
        }
    }

    // ===== INITIALIZATION =====
    function init() {
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
            return;
        }
        
        // Initialize all enhancements
        enhanceModals();
        enhanceForms();
        enhanceLazyLoading();
        enhanceGalleries();
        monitorPerformance();
        enhanceAccessibility();
        
        // Force mobile responsive grids immediately
        immediateMobileForce();
        forceMobileResponsive();
        
        // Force hide index page sections
        forceHideIndexPageSections();
        
        // Add mobile class to body for CSS targeting
        if (isMobile) {
            document.body.classList.add('mobile-device');
        }
        
        if (isTouch) {
            document.body.classList.add('touch-device');
        }
        
        // Handle window resize for responsive grids
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                forceMobileResponsive();
                forceHideIndexPageSections();
            }, 250);
        });
        
        // Run mobile force every 100ms for first 2 seconds to catch any late-loading content
        let forceInterval = setInterval(() => {
            immediateMobileForce();
            forceHideIndexPageSections();
        }, 100);
        setTimeout(() => clearInterval(forceInterval), 2000);
        
        console.log('SOTUMA Mobile Enhancements initialized');
    }

    // Start initialization
    init();

    // ===== UTILITY FUNCTIONS =====
    window.SOTUMAMobile = {
        isMobile: isMobile,
        isTouch: isTouch,
        closeModal: closeModal,
        forceMobileResponsive: forceMobileResponsive,
        immediateMobileForce: immediateMobileForce,
        forceHideIndexPageSections: forceHideIndexPageSections,
        
        // Utility function to debounce events
        debounce: function(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        },
        
        // Utility function to throttle events
        throttle: function(func, limit) {
            let inThrottle;
            return function() {
                const args = arguments;
                const context = this;
                if (!inThrottle) {
                    func.apply(context, args);
                    inThrottle = true;
                    setTimeout(() => inThrottle = false, limit);
                }
            };
        }
    };

})();
