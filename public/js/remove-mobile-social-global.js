/* =====================================
SOTUMA Global Mobile Social Removal
Remove mobile social toggle and menu from all pages
Version: 1.0
===================================== */

(function() {
    'use strict';
    
    // Function to aggressively remove mobile social elements
    function removeMobileSocialElements() {
        const selectors = [
            '.mobile-social-toggle',
            '.mobile-social-menu',
            '.mobile-social-overlay',
            'button[class*="mobile-social"]',
            'div[class*="mobile-social"]',
            '[aria-label*="Toggle social media menu"]',
            '[aria-label*="social media menu"]',
            'button i.fa-share-alt',
            'button .fas.fa-share-alt',
            'button[aria-label*="Toggle social media"]',
            'button[aria-label*="social media"]'
        ];
        
        selectors.forEach(selector => {
            document.querySelectorAll(selector).forEach(element => {
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
                    element.style.transform = 'scale(0)';
                    element.style.margin = '0';
                    element.style.padding = '0';
                    element.style.border = 'none';
                    element.style.background = 'transparent';
                    
                    // Remove from DOM
                    element.remove();
                }
            });
        });
        
        // Also remove any buttons with share-alt icons
        const shareButtons = document.querySelectorAll('button i.fa-share-alt, button .fas.fa-share-alt');
        shareButtons.forEach(icon => {
            const button = icon.closest('button');
            if (button && (
                button.className.includes('mobile-social') || 
                button.getAttribute('aria-label')?.includes('social') ||
                button.getAttribute('aria-label')?.includes('Toggle social')
            )) {
                button.remove();
            }
        });
    }
    
    // Function to inject CSS for additional force hiding
    function injectForceHideCSS() {
        const styleId = 'sotuma-mobile-social-removal';
        if (document.getElementById(styleId)) return;
        
        const style = document.createElement('style');
        style.id = styleId;
        style.textContent = `
            /* Force hide mobile social elements globally */
            .mobile-social-toggle,
            .mobile-social-menu,
            .mobile-social-overlay,
            button[class*="mobile-social"],
            div[class*="mobile-social"],
            [aria-label*="Toggle social media menu"],
            [aria-label*="social media menu"],
            button i.fa-share-alt,
            button .fas.fa-share-alt {
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
                transform: scale(0) !important;
                margin: 0 !important;
                padding: 0 !important;
                border: none !important;
                background: transparent !important;
            }
        `;
        document.head.appendChild(style);
    }
    
    // Initialize removal
    function init() {
        console.log('SOTUMA Global Mobile Social Removal initializing...');
        
        // Inject CSS immediately
        injectForceHideCSS();
        
        // Remove elements immediately
        removeMobileSocialElements();
        
        // Run on DOM ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', removeMobileSocialElements);
        }
        
        // Run on window load
        window.addEventListener('load', removeMobileSocialElements);
        
        // Run periodically to catch dynamically added elements
        let removalInterval = setInterval(removeMobileSocialElements, 500);
        
        // Stop after 10 seconds to avoid performance issues
        setTimeout(() => {
            clearInterval(removalInterval);
        }, 10000);
        
        // Use MutationObserver to catch dynamically added elements
        if ('MutationObserver' in window) {
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === 1) { // Element node
                            // Check if the added node is a mobile social element
                            if (node.classList && (
                                node.classList.contains('mobile-social-toggle') ||
                                node.classList.contains('mobile-social-menu') ||
                                node.classList.contains('mobile-social-overlay') ||
                                node.className.includes('mobile-social')
                            )) {
                                node.remove();
                                return;
                            }
                            
                            // Check if the added node contains mobile social elements
                            const socialElements = node.querySelectorAll && node.querySelectorAll('.mobile-social-toggle, .mobile-social-menu, .mobile-social-overlay, [class*="mobile-social"]');
                            if (socialElements && socialElements.length > 0) {
                                socialElements.forEach(element => element.remove());
                            }
                            
                            // Check for buttons with social aria-labels
                            const socialButtons = node.querySelectorAll && node.querySelectorAll('button[aria-label*="social"], button[aria-label*="Toggle social"]');
                            if (socialButtons && socialButtons.length > 0) {
                                socialButtons.forEach(button => {
                                    if (button.getAttribute('aria-label')?.includes('social')) {
                                        button.remove();
                                    }
                                });
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
    }
    
    // Run immediately
    init();
    
    // Export for external use
    window.SOTUMARemoveMobileSocial = {
        remove: removeMobileSocialElements,
        init: init
    };
    
})();
