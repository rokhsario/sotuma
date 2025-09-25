/**
 * Mobile Touch Scrolling Fix - No Desktop Mode Needed
 * Enables proper touch scrolling on mobile devices
 */

(function() {
    'use strict';
    
    // Check if mobile device
    function isMobile() {
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ||
               (navigator.maxTouchPoints && navigator.maxTouchPoints > 1);
    }
    
    // Enable touch scrolling
    function enableTouchScrolling() {
        if (!isMobile()) return;
        
        // Force touch scrolling styles
        document.documentElement.style.setProperty('-webkit-overflow-scrolling', 'touch', 'important');
        document.body.style.setProperty('-webkit-overflow-scrolling', 'touch', 'important');
        document.body.style.setProperty('touch-action', 'pan-y', 'important');
        document.body.style.setProperty('overscroll-behavior', 'none', 'important');
        
        // Enable scrolling on all scrollable elements
        const scrollableElements = document.querySelectorAll('*');
        scrollableElements.forEach(el => {
            el.style.setProperty('-webkit-overflow-scrolling', 'touch', 'important');
            el.style.setProperty('touch-action', 'manipulation', 'important');
        });
        
        console.log('Touch scrolling enabled for mobile');
    }
    
    // Run immediately
    enableTouchScrolling();
    
    // Re-enable on orientation change
    window.addEventListener('orientationchange', function() {
        setTimeout(enableTouchScrolling, 100);
    });
    
    // Re-enable on resize
    window.addEventListener('resize', function() {
        setTimeout(enableTouchScrolling, 100);
    });
    
})();
