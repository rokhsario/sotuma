/* =====================================
SOTUMA Remove Mobile Social - Index Page Only
Immediate removal of mobile social elements on index page
Version: 1.0 - Production Ready
===================================== */

(function() {
    'use strict';
    
    // Check if we're on the index/home page
    function isIndexPage() {
        return window.location.pathname === '/' || 
               window.location.pathname === '/home' ||
               document.body.classList.contains('index-page') ||
               document.querySelector('.mobile-hero-section');
    }
    
    // Force remove mobile social elements
    function forceRemoveMobileSocial() {
        if (!isIndexPage()) return;
        
        const selectors = [
            '.mobile-social-toggle',
            '.mobile-social-menu', 
            '.mobile-social-overlay',
            'button[aria-label*="Toggle social media menu"]',
            'button[class*="mobile-social"]',
            'div[class*="mobile-social"]',
            '[aria-label*="social media menu"]'
        ];
        
        selectors.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            elements.forEach(element => {
                // Force hide immediately
                element.style.cssText = `
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
                `;
                
                // Remove from DOM
                element.remove();
            });
        });
        
        // Also target buttons with share-alt icons
        const shareButtons = document.querySelectorAll('button i.fa-share-alt, button .fas.fa-share-alt');
        shareButtons.forEach(icon => {
            const button = icon.closest('button');
            if (button && (
                button.className.includes('mobile-social') || 
                button.getAttribute('aria-label')?.includes('social') ||
                button.getAttribute('aria-label')?.includes('Toggle')
            )) {
                button.style.cssText = `
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
                `;
                button.remove();
            }
        });
    }
    
    // Run immediately
    forceRemoveMobileSocial();
    
    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', forceRemoveMobileSocial);
    }
    
    // Run on window load
    window.addEventListener('load', forceRemoveMobileSocial);
    
    // Run every 100ms for first 5 seconds
    let interval = setInterval(forceRemoveMobileSocial, 100);
    setTimeout(() => clearInterval(interval), 5000);
    
    // MutationObserver for dynamic elements
    if ('MutationObserver' in window) {
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1) {
                        // Check if added node is a mobile social element
                        if (node.classList && (
                            node.classList.contains('mobile-social-toggle') ||
                            node.classList.contains('mobile-social-menu') ||
                            node.classList.contains('mobile-social-overlay')
                        )) {
                            node.remove();
                            return;
                        }
                        
                        // Check if added node contains mobile social elements
                        if (node.querySelectorAll) {
                            const socialElements = node.querySelectorAll('.mobile-social-toggle, .mobile-social-menu, .mobile-social-overlay');
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
    
    // Inject CSS for maximum force hiding
    const style = document.createElement('style');
    style.id = 'remove-mobile-social-css';
    style.textContent = `
        .mobile-social-toggle,
        .mobile-social-menu,
        .mobile-social-overlay,
        button[class*="mobile-social"],
        div[class*="mobile-social"],
        [aria-label*="Toggle social media menu"],
        [aria-label*="social media menu"] {
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
    document.head.appendChild(style);
    
    console.log('SOTUMA Mobile Social Remover: Active on index page');
})();
