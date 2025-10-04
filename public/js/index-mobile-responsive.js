/* =====================================
SOTUMA Index Page Mobile Responsive Handler
Robust JavaScript to Hide Sections on Mobile and Tablets
Version: 1.0 - Production Ready
===================================== */

(function() {
    'use strict';

    // ===== DEVICE DETECTION =====
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    const isTablet = /iPad|Android(?!.*Mobile)/i.test(navigator.userAgent);
    const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    
    // ===== BREAKPOINT DETECTION =====
    function isMobileWidth() {
        return window.innerWidth <= 768;
    }
    
    function isTabletWidth() {
        return window.innerWidth > 768 && window.innerWidth <= 1024;
    }
    
    function isDesktopWidth() {
        return window.innerWidth > 1024;
    }

    // ===== SECTION SELECTORS =====
    const DESKTOP_SECTIONS = [
        '.projects-categories-grid-section',
        '.offer-grid-section',
        '.hero-video-section',
        '.partners-slider-section',
        '.presentation-section',
        '.premium-presentation-section',
        '.premium-process-section',
        '.premium-partners-section',
        '.premium-certificates-section',
        '.premium-cta-section',
        '.floating-guarantee',
        '.presentation-floating-element',
        '.premium-floating-element',
        '.premium-image-container'
    ];

    const MOBILE_SECTIONS = [
        '.mobile-hero-section',
        '.mobile-proj-cats',
        '.mobile-process',
        '.mobile-prod-cats'
    ];

    // ===== ROBUST SECTION HIDING/SHOWING =====
    function hideSections(sections, force = true) {
        sections.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => {
                if (element) {
                    if (force) {
                        // Maximum force hiding
                        element.style.setProperty('display', 'none', 'important');
                        element.style.setProperty('visibility', 'hidden', 'important');
                        element.style.setProperty('opacity', '0', 'important');
                        element.style.setProperty('height', '0', 'important');
                        element.style.setProperty('overflow', 'hidden', 'important');
                        element.style.setProperty('margin', '0', 'important');
                        element.style.setProperty('padding', '0', 'important');
                        element.setAttribute('data-mobile-hidden', 'true');
                    } else {
                        element.style.display = 'none';
                        element.style.visibility = 'hidden';
                        element.style.opacity = '0';
                        element.setAttribute('data-mobile-hidden', 'true');
                    }
                }
            });
        });
    }

    function showSections(sections, force = true) {
        sections.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => {
                if (element) {
                    if (force) {
                        // Maximum force showing
                        element.style.removeProperty('display');
                        element.style.removeProperty('visibility');
                        element.style.removeProperty('opacity');
                        element.style.removeProperty('height');
                        element.style.removeProperty('overflow');
                        element.style.removeProperty('margin');
                        element.style.removeProperty('padding');
                        element.style.setProperty('display', 'block', 'important');
                        element.style.setProperty('visibility', 'visible', 'important');
                        element.style.setProperty('opacity', '1', 'important');
                        element.removeAttribute('data-mobile-hidden');
                    } else {
                        element.style.display = 'block';
                        element.style.visibility = 'visible';
                        element.style.opacity = '1';
                        element.removeAttribute('data-mobile-hidden');
                    }
                }
            });
        });
    }

    // ===== MAIN RESPONSIVE HANDLER =====
    function handleResponsive() {
        const currentWidth = window.innerWidth;
        const isMobileDevice = isMobile || isMobileWidth();
        const isTabletDevice = isTablet || isTabletWidth();
        const isDesktopDevice = isDesktopWidth();

        console.log('Responsive Handler:', {
            width: currentWidth,
            isMobileDevice,
            isTabletDevice,
            isDesktopDevice,
            userAgent: navigator.userAgent
        });

        if (isDesktopDevice) {
            // Desktop: Show desktop sections, hide mobile sections
            showSections(DESKTOP_SECTIONS, true);
            hideSections(MOBILE_SECTIONS, true);
            
            // Additional desktop-specific handling
            document.body.classList.add('desktop-view');
            document.body.classList.remove('mobile-view', 'tablet-view');
            
        } else if (isMobileDevice || isTabletDevice) {
            // Mobile/Tablet: Hide desktop sections, show mobile sections
            hideSections(DESKTOP_SECTIONS, true);
            showSections(MOBILE_SECTIONS, true);
            
            // Additional mobile/tablet-specific handling
            if (isMobileDevice) {
                document.body.classList.add('mobile-view');
                document.body.classList.remove('desktop-view', 'tablet-view');
            } else {
                document.body.classList.add('tablet-view');
                document.body.classList.remove('desktop-view', 'mobile-view');
            }
        }
    }

    // ===== ENHANCED SECTION DETECTION =====
    function enhanceSectionDetection() {
        // Add data attributes for better tracking
        DESKTOP_SECTIONS.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => {
                element.setAttribute('data-section-type', 'desktop');
                element.setAttribute('data-responsive-managed', 'true');
            });
        });

        MOBILE_SECTIONS.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => {
                element.setAttribute('data-section-type', 'mobile');
                element.setAttribute('data-responsive-managed', 'true');
            });
        });
    }

    // ===== FORCE MOBILE HIDING FOR SPECIFIC SECTIONS =====
    function forceHideIndexSections() {
        // Specifically target the sections mentioned in the request
        const targetSelectors = [
            '.projects-categories-grid-section',
            '.offer-grid-section'
        ];

        targetSelectors.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => {
                if (element && (isMobile || isTablet || isMobileWidth() || isTabletWidth())) {
                    // Maximum force hiding
                    element.style.setProperty('display', 'none', 'important');
                    element.style.setProperty('visibility', 'hidden', 'important');
                    element.style.setProperty('opacity', '0', 'important');
                    element.style.setProperty('height', '0', 'important');
                    element.style.setProperty('overflow', 'hidden', 'important');
                    element.style.setProperty('margin', '0', 'important');
                    element.style.setProperty('padding', '0', 'important');
                    element.setAttribute('data-force-hidden-mobile', 'true');
                    
                    // Also hide all child elements
                    const children = element.querySelectorAll('*');
                    children.forEach(child => {
                        child.style.setProperty('display', 'none', 'important');
                        child.style.setProperty('visibility', 'hidden', 'important');
                    });
                }
            });
        });
    }

    // ===== CSS INJECTION FOR ADDITIONAL FORCE =====
    function injectMobileCSS() {
        const style = document.createElement('style');
        style.id = 'sotuma-mobile-responsive';
        style.textContent = `
            /* Force hide sections on mobile/tablet */
            @media (max-width: 1024px) {
                .projects-categories-grid-section,
                .offer-grid-section {
                    display: none !important;
                    visibility: hidden !important;
                    opacity: 0 !important;
                    height: 0 !important;
                    overflow: hidden !important;
                    margin: 0 !important;
                    padding: 0 !important;
                }
                
                .projects-categories-grid-section *,
                .offer-grid-section * {
                    display: none !important;
                    visibility: hidden !important;
                }
            }
            
            /* Ensure mobile sections are visible */
            @media (max-width: 1024px) {
                .mobile-hero-section,
                .mobile-proj-cats,
                .mobile-process,
                .mobile-prod-cats {
                    display: block !important;
                    visibility: visible !important;
                    opacity: 1 !important;
                }
            }
            
            /* Desktop sections visibility */
            @media (min-width: 1025px) {
                .projects-categories-grid-section,
                .offer-grid-section {
                    display: block !important;
                    visibility: visible !important;
                    opacity: 1 !important;
                }
                
                .mobile-hero-section,
                .mobile-proj-cats,
                .mobile-process,
                .mobile-prod-cats {
                    display: none !important;
                    visibility: hidden !important;
                    opacity: 0 !important;
                }
            }
            
            /* Force hide mobile social elements on index page */
            .mobile-social-toggle,
            .mobile-social-menu,
            .mobile-social-overlay,
            button[class*="mobile-social"],
            div[class*="mobile-social"],
            [aria-label*="Toggle social media menu"],
            [aria-label*="social media menu"],
            button i.fa-share-alt {
                display: none !important;
                visibility: hidden !important;
                opacity: 0 !important;
                position: absolute !important;
                left: -9999px !important;
                top: -9999px !important;
                width: 0 !important;
                height: 0 !important;
                overflow: hidden !important;
                pointer-events: none !important;
                z-index: -1 !important;
            }
        `;
        
        // Remove existing style if present
        const existingStyle = document.getElementById('sotuma-mobile-responsive');
        if (existingStyle) {
            existingStyle.remove();
        }
        
        document.head.appendChild(style);
    }

    // ===== PERFORMANCE OPTIMIZED OBSERVER =====
    function setupPerformanceObserver() {
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    const element = entry.target;
                    const isVisible = entry.isIntersecting;
                    
                    // Only process elements managed by our responsive system
                    if (element.hasAttribute('data-responsive-managed')) {
                        const isDesktop = isDesktopWidth();
                        const isMobileDevice = isMobile || isMobileWidth();
                        const isTabletDevice = isTablet || isTabletWidth();
                        
                        if (element.hasAttribute('data-section-type')) {
                            const sectionType = element.getAttribute('data-section-type');
                            
                            if (isDesktop && sectionType === 'desktop') {
                                element.style.display = 'block';
                            } else if ((isMobileDevice || isTabletDevice) && sectionType === 'mobile') {
                                element.style.display = 'block';
                            } else {
                                element.style.display = 'none';
                            }
                        }
                    }
                });
            }, {
                rootMargin: '50px',
                threshold: 0.1
            });

            // Observe all managed sections
            const managedElements = document.querySelectorAll('[data-responsive-managed="true"]');
            managedElements.forEach(element => observer.observe(element));
        }
    }

    // ===== REMOVE MOBILE SOCIAL MENU =====
    function removeMobileSocialMenu() {
        // Remove mobile social elements if they exist
        const mobileSocialElements = [
            '.mobile-social-toggle',
            '.mobile-social-menu', 
            '.mobile-social-overlay',
            'button[aria-label*="Toggle social media menu"]',
            'button[class*="mobile-social"]',
            'div[class*="mobile-social"]',
            '[aria-label*="social media menu"]'
        ];
        
        mobileSocialElements.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => {
                if (element) {
                    // Force hide before removing
                    element.style.display = 'none';
                    element.style.visibility = 'hidden';
                    element.style.opacity = '0';
                    element.style.position = 'absolute';
                    element.style.left = '-9999px';
                    element.style.top = '-9999px';
                    element.style.width = '0';
                    element.style.height = '0';
                    element.style.overflow = 'hidden';
                    element.style.pointerEvents = 'none';
                    element.style.zIndex = '-1';
                    
                    // Then remove from DOM
                    element.remove();
                }
            });
        });
        
        // Also remove any buttons with share-alt icons
        const shareButtons = document.querySelectorAll('button i.fa-share-alt, button .fas.fa-share-alt');
        shareButtons.forEach(icon => {
            const button = icon.closest('button');
            if (button && (button.className.includes('mobile-social') || button.getAttribute('aria-label')?.includes('social'))) {
                button.remove();
            }
        });
    }

    // ===== INITIALIZATION =====
    function init() {
        console.log('SOTUMA Index Mobile Responsive Handler initializing...');
        
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
            return;
        }
        
        // Remove mobile social menu from index page
        removeMobileSocialMenu();

        // Inject CSS for additional force
        injectMobileCSS();
        
        // Enhance section detection
        enhanceSectionDetection();
        
        // Initial responsive handling
        handleResponsive();
        
        // Force hide specific sections
        forceHideIndexSections();
        
        // Setup performance observer
        setupPerformanceObserver();
        
        // Handle window resize with debouncing
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                handleResponsive();
                forceHideIndexSections();
            }, 250);
        });

        // Run force hiding every 100ms for first 3 seconds to catch late-loading content
        let forceInterval = setInterval(() => {
            forceHideIndexSections();
            handleResponsive();
            removeMobileSocialMenu();
        }, 100);
        
        setTimeout(() => clearInterval(forceInterval), 3000);
        
        // Run mobile social removal every 500ms for first 10 seconds to catch any late-loading elements
        let socialRemovalInterval = setInterval(removeMobileSocialMenu, 500);
        setTimeout(() => clearInterval(socialRemovalInterval), 10000);
        
        // MutationObserver to catch any dynamically added mobile social elements
        if ('MutationObserver' in window) {
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === 1) { // Element node
                            // Check if the added node is a mobile social element
                            if (node.classList && (
                                node.classList.contains('mobile-social-toggle') ||
                                node.classList.contains('mobile-social-menu') ||
                                node.classList.contains('mobile-social-overlay')
                            )) {
                                node.remove();
                            }
                            
                            // Check if the added node contains mobile social elements
                            const socialElements = node.querySelectorAll && node.querySelectorAll('.mobile-social-toggle, .mobile-social-menu, .mobile-social-overlay');
                            if (socialElements && socialElements.length > 0) {
                                socialElements.forEach(element => element.remove());
                            }
                        }
                    });
                });
            });
            
            observer.observe(document.body, {
                childList: true,
                subtree: true
            });
        }

        // Run on page load complete
        window.addEventListener('load', function() {
            setTimeout(() => {
                handleResponsive();
                forceHideIndexSections();
            }, 500);
        });

        console.log('SOTUMA Index Mobile Responsive Handler initialized successfully');
    }

    // ===== UTILITY FUNCTIONS =====
    window.SOTUMAIndexResponsive = {
        isMobile: isMobile,
        isTablet: isTablet,
        isTouch: isTouch,
        isMobileWidth: isMobileWidth,
        isTabletWidth: isTabletWidth,
        isDesktopWidth: isDesktopWidth,
        handleResponsive: handleResponsive,
        forceHideIndexSections: forceHideIndexSections,
        removeMobileSocialMenu: removeMobileSocialMenu,
        
        // Manual control functions
        forceShowDesktop: function() {
            showSections(DESKTOP_SECTIONS, true);
            hideSections(MOBILE_SECTIONS, true);
        },
        
        forceShowMobile: function() {
            hideSections(DESKTOP_SECTIONS, true);
            showSections(MOBILE_SECTIONS, true);
        },
        
        // Debug function
        debug: function() {
            console.log('SOTUMA Index Responsive Debug:', {
                isMobile: isMobile,
                isTablet: isTablet,
                isTouch: isTouch,
                width: window.innerWidth,
                desktopSections: document.querySelectorAll(DESKTOP_SECTIONS.join(', ')).length,
                mobileSections: document.querySelectorAll(MOBILE_SECTIONS.join(', ')).length,
                hiddenSections: document.querySelectorAll('[data-mobile-hidden="true"]').length,
                forceHiddenSections: document.querySelectorAll('[data-force-hidden-mobile="true"]').length
            });
        }
    };

    // Start initialization
    init();

})();
