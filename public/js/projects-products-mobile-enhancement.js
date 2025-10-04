/* =====================================
SOTUMA Projects & Products Mobile Enhancement JavaScript
Removes breadcrumbs and simplifies cards for mobile/tablet
Ensures edge-to-edge images with centered titles
===================================== */

(function() {
    'use strict';

    // ===== MOBILE DETECTION =====
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    const isMobileWidth = window.innerWidth <= 1024;

    // ===== FORCE REMOVE BREADCRUMBS =====
    function forceRemoveBreadcrumbs() {
        if (!isMobileWidth) return;

        // Target all possible breadcrumb selectors
        const breadcrumbSelectors = [
            '.project-categories-page .breadcrumb-section',
            '.project-categories-show-page .breadcrumb-section',
            '.breadcrumb-section',
            '.breadcrumb-custom',
            '.products-page .breadcrumb-section',
            '.product-detail-page .breadcrumb-section'
        ];

        breadcrumbSelectors.forEach(selector => {
            const breadcrumbs = document.querySelectorAll(selector);
            breadcrumbs.forEach(breadcrumb => {
                if (breadcrumb) {
                    breadcrumb.style.setProperty('display', 'none', 'important');
                    breadcrumb.style.setProperty('visibility', 'hidden', 'important');
                    breadcrumb.style.setProperty('opacity', '0', 'important');
                    breadcrumb.style.setProperty('height', '0', 'important');
                    breadcrumb.style.setProperty('overflow', 'hidden', 'important');
                    breadcrumb.style.setProperty('margin', '0', 'important');
                    breadcrumb.style.setProperty('padding', '0', 'important');
                    breadcrumb.style.setProperty('position', 'absolute', 'important');
                    breadcrumb.style.setProperty('left', '-9999px', 'important');
                    breadcrumb.style.setProperty('top', '-9999px', 'important');
                    breadcrumb.style.setProperty('width', '0', 'important');
                    breadcrumb.style.setProperty('max-width', '0', 'important');
                    breadcrumb.setAttribute('data-mobile-hidden', 'true');
                }
            });
        });
    }

    // ===== FORCE GRID CONTAINERS FOR MOBILE =====
    function forceGridContainersForMobile() {
        if (!isMobileWidth) return;

        // Force all grid containers to display block
        const gridSelectors = [
            '.project-categories-page .categories-grid',
            '.project-categories-show-page .projects-grid',
            '.categories-grid',
            '.products-grid',
            '.aluprof-category-grid'
        ];

        gridSelectors.forEach(selector => {
            const grids = document.querySelectorAll(selector);
            grids.forEach(grid => {
                if (grid) {
                    grid.style.setProperty('display', 'block', 'important');
                    grid.style.setProperty('width', '100%', 'important');
                    grid.style.setProperty('max-width', '100%', 'important');
                    grid.style.setProperty('margin', '0', 'important');
                    grid.style.setProperty('padding', '0', 'important');
                    grid.style.setProperty('overflow', 'visible', 'important');
                    grid.style.removeProperty('grid-template-columns');
                    grid.style.removeProperty('grid-template-rows');
                    grid.style.removeProperty('grid-auto-columns');
                    grid.style.removeProperty('grid-auto-rows');
                }
            });
        });

        // Force all containers
        const containerSelectors = [
            '.project-categories-page .categories-container',
            '.project-categories-show-page .projects-container',
            '.categories-container',
            '.products-container'
        ];

        containerSelectors.forEach(selector => {
            const containers = document.querySelectorAll(selector);
            containers.forEach(container => {
                if (container) {
                    container.style.setProperty('width', '100%', 'important');
                    container.style.setProperty('max-width', '100%', 'important');
                    container.style.setProperty('margin', '0', 'important');
                    container.style.setProperty('padding', '0', 'important');
                    container.style.setProperty('overflow', 'visible', 'important');
                }
            });
        });
    }

    // ===== SIMPLIFY CARDS FOR MOBILE =====
    function simplifyCardsForMobile() {
        if (!isMobileWidth) return;

        // Target all possible card selectors (excluding mobile index cards)
        const cardSelectors = [
            '.project-categories-page .category-card',
            '.project-categories-show-page .project-card',
            '.category-card',
            '.product-card',
            '.aluprof-category-block',
            '.row.g-4 .card'
        ];

        cardSelectors.forEach(selector => {
            const cards = document.querySelectorAll(selector);
            cards.forEach(card => {
                if (card && !card.closest('.mobile-proj-cats, .mobile-prod-cats')) {
                    // Remove all shadows, borders, and backgrounds - FIXED FOR MOBILE
                    card.style.setProperty('background', '#fff', 'important');
                    card.style.setProperty('border', 'none', 'important');
                    card.style.setProperty('border-radius', '0', 'important');
                    card.style.setProperty('box-shadow', 'none', 'important');
                    card.style.setProperty('padding', '0', 'important');
                    card.style.setProperty('margin', '0 0 20px 0', 'important');
                    card.style.setProperty('width', '100%', 'important');
                    card.style.setProperty('max-width', '100%', 'important');
                    card.style.setProperty('overflow', 'hidden', 'important');
                    card.style.setProperty('display', 'block', 'important');
                    card.style.setProperty('box-sizing', 'border-box', 'important');

                    // Find image container
                    const imageContainer = card.querySelector('.category-image-container, .project-image-container, .product-image-container, .card-img-top');
                    if (imageContainer) {
                        imageContainer.style.setProperty('width', '100%', 'important');
                        imageContainer.style.setProperty('height', '350px', 'important');
                        imageContainer.style.setProperty('overflow', 'hidden', 'important');
                        imageContainer.style.setProperty('position', 'relative', 'important');
                        imageContainer.style.setProperty('display', 'block', 'important');
                        imageContainer.style.setProperty('max-width', '100%', 'important');
                        imageContainer.style.setProperty('margin', '0', 'important');
                        imageContainer.style.setProperty('padding', '0', 'important');
                    }

                    // Find image
                    const image = card.querySelector('.category-image, .project-image, .product-image, .card-img-top img');
                    if (image) {
                        image.style.setProperty('width', '100%', 'important');
                        image.style.setProperty('height', '100%', 'important');
                        image.style.setProperty('object-fit', 'cover', 'important');
                        image.style.setProperty('object-position', 'center', 'important');
                        image.style.setProperty('display', 'block', 'important');
                        image.style.setProperty('max-width', '100%', 'important');
                        image.style.setProperty('max-height', '100%', 'important');
                        image.style.setProperty('position', 'absolute', 'important');
                        image.style.setProperty('top', '0', 'important');
                        image.style.setProperty('left', '0', 'important');
                        image.style.setProperty('right', '0', 'important');
                        image.style.setProperty('bottom', '0', 'important');
                        image.style.setProperty('margin', '0', 'important');
                        image.style.setProperty('padding', '0', 'important');
                        
                        // Zoom out product images by 20% (scale to 0.8)
                        if (image.classList.contains('product-image') || card.classList.contains('product-card')) {
                            image.style.setProperty('transform', 'scale(0.8)', 'important');
                            image.style.setProperty('transform-origin', 'center center', 'important');
                        }
                    }

                    // Find content container - POSITION UNDER IMAGE
                    const contentContainer = card.querySelector('.category-content, .project-content, .product-content, .card-body');
                    if (contentContainer) {
                        contentContainer.style.setProperty('position', 'relative', 'important');
                        contentContainer.style.setProperty('bottom', 'auto', 'important');
                        contentContainer.style.setProperty('left', 'auto', 'important');
                        contentContainer.style.setProperty('right', 'auto', 'important');
                        contentContainer.style.setProperty('background', '#fff', 'important');
                        contentContainer.style.setProperty('padding', '20px', 'important');
                        contentContainer.style.setProperty('z-index', '1', 'important');
                        contentContainer.style.setProperty('text-align', 'center', 'important');
                        contentContainer.style.setProperty('display', 'block', 'important');
                    }

                    // Find title - DARK TEXT UNDER IMAGE - SINGLE LINE SMALL
                    const title = card.querySelector('.category-title, .project-title, .product-title, .card-title');
                    if (title) {
                        title.style.setProperty('color', '#333', 'important');
                        title.style.setProperty('font-size', '0.85rem', 'important');
                        title.style.setProperty('font-weight', 'bold', 'important');
                        title.style.setProperty('text-align', 'center', 'important');
                        title.style.setProperty('margin', '0', 'important');
                        title.style.setProperty('text-shadow', 'none', 'important');
                        title.style.setProperty('text-transform', 'uppercase', 'important');
                        title.style.setProperty('letter-spacing', '0.5px', 'important');
                        title.style.setProperty('position', 'relative', 'important');
                        title.style.setProperty('display', 'block', 'important');
                        title.style.setProperty('white-space', 'nowrap', 'important');
                        title.style.setProperty('overflow', 'hidden', 'important');
                        title.style.setProperty('text-overflow', 'ellipsis', 'important');
                        title.style.setProperty('line-height', '1.2', 'important');
                    }

                    // Hide drag handles for non-admin users on mobile
                    const sortHandles = card.querySelectorAll('.sort-handle');
                    sortHandles.forEach(handle => {
                        if (handle) {
                            handle.style.setProperty('display', 'none', 'important');
                            handle.style.setProperty('visibility', 'hidden', 'important');
                            handle.style.setProperty('opacity', '0', 'important');
                            handle.style.setProperty('position', 'absolute', 'important');
                            handle.style.setProperty('left', '-9999px', 'important');
                            handle.style.setProperty('top', '-9999px', 'important');
                            handle.style.setProperty('width', '0', 'important');
                            handle.style.setProperty('height', '0', 'important');
                            handle.style.setProperty('overflow', 'hidden', 'important');
                        }
                    });

                    // Remove all hover effects and overlays
                    const overlays = card.querySelectorAll('::before, ::after, .category-overlay, .project-overlay, .product-overlay');
                    overlays.forEach(overlay => {
                        if (overlay.style) {
                            overlay.style.setProperty('display', 'none', 'important');
                        }
                    });

                    // Remove all hover effects completely
                    card.style.setProperty('transform', 'none', 'important');
                    card.style.setProperty('transition', 'none', 'important');
                    
                    // Remove any hover effects from child elements
                    const childElements = card.querySelectorAll('*');
                    childElements.forEach(child => {
                        child.style.setProperty('transform', 'none', 'important');
                        child.style.setProperty('transition', 'none', 'important');
                        child.style.setProperty('box-shadow', 'none', 'important');
                    });

                    card.setAttribute('data-mobile-simplified', 'true');
                }
            });
        });

        // Hide all overlay elements
        const overlaySelectors = [
            '.category-card::before',
            '.category-card::after',
            '.project-card::before',
            '.project-card::after',
            '.product-card::before',
            '.product-card::after',
            '.category-overlay',
            '.project-overlay',
            '.product-overlay'
        ];

        // Create style element to hide pseudo-elements
        if (!document.getElementById('mobile-cards-override')) {
            const style = document.createElement('style');
            style.id = 'mobile-cards-override';
            style.textContent = `
                @media (max-width: 1024px) {
                    .category-card::before,
                    .category-card::after,
                    .project-card::before,
                    .project-card::after,
                    .product-card::before,
                    .product-card::after,
                    .category-overlay,
                    .project-overlay,
                    .product-overlay {
                        display: none !important;
                    }
                    
                    .category-card:hover,
                    .project-card:hover,
                    .product-card:hover {
                        transform: none !important;
                    }
                    
                    .category-card:hover .category-image,
                    .project-card:hover .project-image,
                    .product-card:hover .product-image {
                        transform: none !important;
                    }
                }
            `;
            document.head.appendChild(style);
        }
    }

    // ===== ENHANCE MOBILE CARD INTERACTIONS =====
    function enhanceMobileCardInteractions() {
        if (!isMobile) return;

        // Only add touch feedback to cards that don't have onclick handlers
        const cards = document.querySelectorAll('.category-card, .project-card, .aluprof-category-block');
        
        cards.forEach(card => {
            // Skip product cards that have data-product-url (they use click handlers)
            if (card.classList.contains('product-card') && card.hasAttribute('data-product-url')) {
                return;
            }
            
            // Remove all touch feedback to prevent any hover-like effects
            // No touch feedback for mobile cards
        });
    }

    // ===== ENSURE CLICK FUNCTIONALITY =====
    function ensureClickFunctionality() {
        // Always ensure click functionality works on all devices
        console.log('Ensuring click functionality for product cards...', 'isMobile:', isMobile, 'isMobileWidth:', isMobileWidth);
        
        // Find all product cards with data-product-url
        const productCards = document.querySelectorAll('.product-card[data-product-url]');
        console.log('Found product cards:', productCards.length);
        
        productCards.forEach((card, index) => {
            const url = card.getAttribute('data-product-url');
            console.log(`Card ${index}: URL = ${url}`);
            
            // Remove any existing click listeners to avoid duplicates
            card.removeEventListener('click', handleProductCardClick);
            
            // Add click handler
            card.addEventListener('click', handleProductCardClick);
            console.log(`Click handler added to card ${index}`);
        });
    }
    
    // ===== HANDLE PRODUCT CARD CLICK =====
    function handleProductCardClick(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const productUrl = this.getAttribute('data-product-url');
        console.log('Product card clicked, URL:', productUrl);
        
        if (productUrl) {
            console.log('Navigating to:', productUrl);
            window.location.href = productUrl;
        } else {
            console.log('No URL found for product card');
        }
    }

    // ===== INITIALIZATION =====
    function init() {
        // Run immediately
        forceRemoveBreadcrumbs();
        forceGridContainersForMobile();
        simplifyCardsForMobile();
        enhanceMobileCardInteractions();
        ensureClickFunctionality();

        // Run on DOM content loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                forceRemoveBreadcrumbs();
                forceGridContainersForMobile();
                simplifyCardsForMobile();
                enhanceMobileCardInteractions();
                ensureClickFunctionality();
            });
        }

        // Run on window load
        window.addEventListener('load', function() {
            forceRemoveBreadcrumbs();
            forceGridContainersForMobile();
            simplifyCardsForMobile();
            enhanceMobileCardInteractions();
            ensureClickFunctionality();
        });

        // Run on resize
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                forceRemoveBreadcrumbs();
                forceGridContainersForMobile();
                simplifyCardsForMobile();
                ensureClickFunctionality();
            }, 250);
        });

        // Run periodically to catch dynamically loaded content
        let intervalCount = 0;
        const maxIntervals = 20; // Run for 10 seconds (20 * 500ms)
        const intervalId = setInterval(() => {
            forceRemoveBreadcrumbs();
            forceGridContainersForMobile();
            simplifyCardsForMobile();
            ensureClickFunctionality();
            intervalCount++;
            if (intervalCount >= maxIntervals) {
                clearInterval(intervalId);
            }
        }, 500);

        // Set up MutationObserver to catch dynamically added elements
        if ('MutationObserver' in window) {
            const observer = new MutationObserver(function(mutations) {
                mutations.forEach(function(mutation) {
                    mutation.addedNodes.forEach(function(node) {
                        if (node.nodeType === 1) { // Element node
                            // Check if the added node is a breadcrumb or card
                            if (node.matches && (
                                node.matches('.breadcrumb-section') ||
                                node.matches('.breadcrumb-custom') ||
                                node.matches('.category-card') ||
                                node.matches('.product-card') ||
                                node.matches('.project-card') ||
                                node.matches('.aluprof-category-block')
                            )) {
                                setTimeout(() => {
                                    forceRemoveBreadcrumbs();
                                    simplifyCardsForMobile();
                                }, 100);
                            }
                            
                            // Check if the added node contains breadcrumbs or cards
                            const elements = node.querySelectorAll && node.querySelectorAll(
                                '.breadcrumb-section, .breadcrumb-custom, ' +
                                '.category-card, .product-card, .project-card, .aluprof-category-block'
                            );
                            if (elements && elements.length > 0) {
                                setTimeout(() => {
                                    forceRemoveBreadcrumbs();
                                    simplifyCardsForMobile();
                                }, 100);
                            }
                        }
                    });
                });
            });
            
            // Observe the entire document body for additions
            observer.observe(document.body, { childList: true, subtree: true });
        }

        console.log('SOTUMA Projects & Products Mobile Enhancement initialized');
    }

    // Start initialization
    init();

    // ===== EXPOSE UTILITY FUNCTIONS =====
    window.SOTUMAProjectsProductsMobile = {
        forceRemoveBreadcrumbs: forceRemoveBreadcrumbs,
        simplifyCardsForMobile: simplifyCardsForMobile,
        enhanceMobileCardInteractions: enhanceMobileCardInteractions,
        isMobile: isMobile,
        isMobileWidth: isMobileWidth
    };

})();
