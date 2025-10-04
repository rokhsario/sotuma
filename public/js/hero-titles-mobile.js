/* =====================================
SOTUMA Hero Titles Mobile Enhancement
JavaScript to ensure all hero titles display on single line for mobile/tablet (except index page)
===================================== */

(function() {
    'use strict';
    
    const isMobile = window.innerWidth <= 1024;
    
    // Check if current page is index
    const isIndexPage = window.location.pathname === '/' || window.location.pathname === '/home';
    
    // Only apply to non-index pages
    if (isIndexPage || !isMobile) return;
    
    // ===== FORCE HERO TITLES TO SINGLE LINE =====
    function forceHeroTitlesSingleLine() {
        // Hero title selectors for different pages
        const heroTitleSelectors = [
            '.about-hero h1',
            '.project-categories-page .hero-title',
            '.project-categories-show-page .hero-title',
            '.hero-section .hero-title',
            '.categories-page .hero-title',
            '.tiktok-hero-title',
            '.blog-hero .hero-content h1',
            '.blog-hero .hero-title',
            '.hero-section h1',
            '.hero-content h1',
            '.hero-title'
        ];
        
        heroTitleSelectors.forEach(selector => {
            document.querySelectorAll(selector).forEach(title => {
                if (title) {
                    // Apply single line styling
                    title.style.setProperty('white-space', 'nowrap', 'important');
                    title.style.setProperty('overflow', 'hidden', 'important');
                    title.style.setProperty('text-overflow', 'ellipsis', 'important');
                    title.style.setProperty('line-height', '1.2', 'important');
                    title.style.setProperty('max-width', '100%', 'important');
                    title.style.setProperty('text-align', 'center', 'important');
                    title.style.setProperty('margin', '0 auto', 'important');
                    title.style.setProperty('display', 'block', 'important');
                    title.style.setProperty('box-sizing', 'border-box', 'important');
                    
                    // Apply responsive font sizing
                    const screenWidth = window.innerWidth;
                    let fontSize;
                    
                    if (screenWidth <= 360) {
                        fontSize = 'clamp(1.2rem, 12vw, 1.8rem)';
                    } else if (screenWidth <= 480) {
                        fontSize = 'clamp(1.4rem, 10vw, 2rem)';
                    } else if (screenWidth <= 768) {
                        fontSize = 'clamp(1.6rem, 8vw, 2.4rem)';
                    } else {
                        fontSize = 'clamp(1.8rem, 6vw, 2.8rem)';
                    }
                    
                    title.style.setProperty('font-size', fontSize, 'important');
                }
            });
        });
        
        // Ensure hero content containers are properly styled
        const heroContentSelectors = [
            '.hero-content',
            '.hero-container',
            '.about-hero .container',
            '.tiktok-hero',
            '.blog-hero'
        ];
        
        heroContentSelectors.forEach(selector => {
            document.querySelectorAll(selector).forEach(container => {
                if (container) {
                    container.style.setProperty('max-width', '100%', 'important');
                    container.style.setProperty('padding', '0 15px', 'important');
                    container.style.setProperty('text-align', 'center', 'important');
                    container.style.setProperty('box-sizing', 'border-box', 'important');
                }
            });
        });
        
        // Adjust hero section padding for mobile
        const heroSectionSelectors = [
            '.hero-section',
            '.about-hero',
            '.tiktok-hero',
            '.blog-hero'
        ];
        
        heroSectionSelectors.forEach(selector => {
            document.querySelectorAll(selector).forEach(section => {
                if (section) {
                    const screenWidth = window.innerWidth;
                    let padding;
                    
                    if (screenWidth <= 360) {
                        padding = '60px 0 30px';
                    } else if (screenWidth <= 480) {
                        padding = '80px 0 40px';
                    } else if (screenWidth <= 768) {
                        padding = '100px 0 60px';
                    } else {
                        padding = '120px 0 80px';
                    }
                    
                    section.style.setProperty('padding', padding, 'important');
                    section.style.setProperty('min-height', 'auto', 'important');
                }
            });
        });
    }
    
    // ===== MAIN INITIALIZATION =====
    function init() {
        forceHeroTitlesSingleLine();
    }
    
    // Run immediately
    init();
    
    // Run on DOMContentLoaded
    document.addEventListener('DOMContentLoaded', init);
    
    // Run on window load
    window.addEventListener('load', init);
    
    // Run on resize
    window.addEventListener('resize', function() {
        const newIsMobile = window.innerWidth <= 1024;
        if (newIsMobile !== isMobile) {
            location.reload(); // Reload if switching between mobile/desktop
        } else {
            init();
        }
    });
    
    // Set up a MutationObserver to catch dynamically added hero titles
    if ('MutationObserver' in window) {
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1) { // Element node
                        // Check if the added node is a hero title or contains hero titles
                        if (node.matches && (
                            node.matches('h1') || 
                            node.classList.contains('hero-title') ||
                            node.classList.contains('hero-content') ||
                            node.classList.contains('hero-container')
                        )) {
                            init();
                        } else if (node.querySelector && node.querySelector('h1, .hero-title, .hero-content, .hero-container')) {
                            init();
                        }
                    }
                });
            });
        });
        // Observe the entire document body for additions
        observer.observe(document.body, { childList: true, subtree: true });
    }
    
    // Run periodically for good measure, but stop after some time
    let intervalCount = 0;
    const maxIntervals = 15; // Run for 7.5 seconds (15 * 500ms)
    const intervalId = setInterval(() => {
        init();
        intervalCount++;
        if (intervalCount >= maxIntervals) {
            clearInterval(intervalId);
        }
    }, 500);
    
    // Export for external use
    window.SOTUMAHeroTitles = {
        forceHeroTitlesSingleLine,
        init
    };
})();
