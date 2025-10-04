/* =====================================
SOTUMA Mobile Responsive Integration
Integration script to ensure mobile responsive handling works properly
Version: 1.0 - Production Ready
===================================== */

(function() {
    'use strict';

    // ===== SCRIPT LOADING VERIFICATION =====
    function verifyScriptsLoaded() {
        const scripts = [
            'index-mobile-responsive.js',
            'frontend-mobile-enhancements.js'
        ];
        
        let allLoaded = true;
        scripts.forEach(scriptName => {
            const scriptElement = document.querySelector(`script[src*="${scriptName}"]`);
            if (!scriptElement) {
                console.warn(`SOTUMA Mobile: Script ${scriptName} not found in DOM`);
                allLoaded = false;
            }
        });
        
        return allLoaded;
    }

    // ===== FALLBACK RESPONSIVE HANDLING =====
    function fallbackResponsiveHandling() {
        console.log('SOTUMA Mobile: Applying fallback responsive handling');
        
        const isMobileWidth = window.innerWidth <= 1024;
        
        if (isMobileWidth) {
            // Hide desktop sections
            const desktopSections = document.querySelectorAll('.projects-categories-grid-section, .offer-grid-section');
            desktopSections.forEach(section => {
                if (section) {
                    section.style.setProperty('display', 'none', 'important');
                    section.style.setProperty('visibility', 'hidden', 'important');
                    section.style.setProperty('opacity', '0', 'important');
                    section.setAttribute('data-fallback-hidden', 'true');
                }
            });
            
            // Show mobile sections
            const mobileSections = document.querySelectorAll('.mobile-hero-section, .mobile-proj-cats, .mobile-process, .mobile-prod-cats');
            mobileSections.forEach(section => {
                if (section) {
                    section.style.setProperty('display', 'block', 'important');
                    section.style.setProperty('visibility', 'visible', 'important');
                    section.style.setProperty('opacity', '1', 'important');
                }
            });
        } else {
            // Show desktop sections
            const desktopSections = document.querySelectorAll('.projects-categories-grid-section, .offer-grid-section');
            desktopSections.forEach(section => {
                if (section && section.hasAttribute('data-fallback-hidden')) {
                    section.style.removeProperty('display');
                    section.style.removeProperty('visibility');
                    section.style.removeProperty('opacity');
                    section.removeAttribute('data-fallback-hidden');
                }
            });
            
            // Hide mobile sections
            const mobileSections = document.querySelectorAll('.mobile-hero-section, .mobile-proj-cats, .mobile-process, .mobile-prod-cats');
            mobileSections.forEach(section => {
                if (section) {
                    section.style.setProperty('display', 'none', 'important');
                    section.style.setProperty('visibility', 'hidden', 'important');
                    section.style.setProperty('opacity', '0', 'important');
                }
            });
        }
    }

    // ===== CSS INJECTION FOR MAXIMUM COMPATIBILITY =====
    function injectCompatibilityCSS() {
        const style = document.createElement('style');
        style.id = 'sotuma-mobile-compatibility';
        style.textContent = `
            /* Maximum force hiding for mobile/tablet */
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
                    position: absolute !important;
                    left: -9999px !important;
                    top: -9999px !important;
                }
                
                .projects-categories-grid-section *,
                .offer-grid-section * {
                    display: none !important;
                    visibility: hidden !important;
                    opacity: 0 !important;
                }
                
                .mobile-hero-section,
                .mobile-proj-cats,
                .mobile-process,
                .mobile-prod-cats {
                    display: block !important;
                    visibility: visible !important;
                    opacity: 1 !important;
                }
            }
            
            /* Desktop visibility */
            @media (min-width: 1025px) {
                .projects-categories-grid-section,
                .offer-grid-section {
                    display: block !important;
                    visibility: visible !important;
                    opacity: 1 !important;
                    height: auto !important;
                    overflow: visible !important;
                    position: static !important;
                    left: auto !important;
                    top: auto !important;
                }
                
                .projects-categories-grid-section *,
                .offer-grid-section * {
                    display: revert !important;
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
        `;
        
        // Remove existing style if present
        const existingStyle = document.getElementById('sotuma-mobile-compatibility');
        if (existingStyle) {
            existingStyle.remove();
        }
        
        document.head.appendChild(style);
    }

    // ===== INITIALIZATION =====
    function init() {
        console.log('SOTUMA Mobile Integration initializing...');
        
        // Wait for DOM to be ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
            return;
        }

        // Inject compatibility CSS immediately
        injectCompatibilityCSS();
        
        // Apply fallback handling immediately
        fallbackResponsiveHandling();
        
        // Check if main scripts are loaded
        setTimeout(() => {
            const scriptsLoaded = verifyScriptsLoaded();
            if (!scriptsLoaded) {
                console.warn('SOTUMA Mobile: Main scripts not detected, relying on fallback handling');
            } else {
                console.log('SOTUMA Mobile: Main scripts detected and loaded');
            }
        }, 1000);
        
        // Handle window resize
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(fallbackResponsiveHandling, 250);
        });

        // Run fallback handling every 500ms for first 5 seconds
        let fallbackInterval = setInterval(fallbackResponsiveHandling, 500);
        setTimeout(() => clearInterval(fallbackInterval), 5000);

        console.log('SOTUMA Mobile Integration initialized successfully');
    }

    // Start initialization
    init();

    // ===== GLOBAL UTILITY =====
    window.SOTUMAMobileIntegration = {
        fallbackResponsiveHandling: fallbackResponsiveHandling,
        verifyScriptsLoaded: verifyScriptsLoaded,
        injectCompatibilityCSS: injectCompatibilityCSS
    };

})();
