/**
 * SOTUMA Mobile Scroll Fix
 * Correction JavaScript complète du problème de scroll sur mobile
 * Version: 1.0 - Production Ready
 */

(function() {
    'use strict';

    // ===== DÉTECTION MOBILE =====
    const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
    const isTouch = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
    const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent);
    const isAndroid = /Android/.test(navigator.userAgent);

    // ===== CORRECTION DU VIEWPORT =====
    function fixViewport() {
        if (isMobile) {
            // Correction du viewport pour éviter les problèmes de zoom
            let viewport = document.querySelector('meta[name="viewport"]');
            if (viewport) {
                viewport.setAttribute('content', 
                    'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover'
                );
            } else {
                viewport = document.createElement('meta');
                viewport.name = 'viewport';
                viewport.content = 'width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover';
                document.head.appendChild(viewport);
            }
        }
    }

    // ===== CORRECTION DU BODY ET HTML =====
    function fixBodyAndHtml() {
        if (isMobile) {
            // Correction du html
            document.documentElement.style.overflowX = 'hidden';
            document.documentElement.style.overflowY = 'auto';
            document.documentElement.style.webkitOverflowScrolling = 'touch';
            document.documentElement.style.height = '100%';
            document.documentElement.style.position = 'relative';

            // Correction du body
            document.body.style.overflowX = 'hidden';
            document.body.style.overflowY = 'auto';
            document.body.style.webkitOverflowScrolling = 'touch';
            document.body.style.touchAction = 'pan-y';
            document.body.style.position = 'relative';
            document.body.style.height = 'auto';
            document.body.style.minHeight = '100vh';

            // Correction spécifique pour iOS
            if (isIOS) {
                document.body.style.webkitTransform = 'translateZ(0)';
                document.body.style.transform = 'translateZ(0)';
                document.body.style.webkitBackfaceVisibility = 'hidden';
                document.body.style.backfaceVisibility = 'hidden';
            }
        }
    }

    // ===== CORRECTION DE LA HAUTEUR DYNAMIQUE =====
    function fixDynamicHeight() {
        if (isMobile) {
            function setVH() {
                const vh = window.innerHeight * 0.01;
                document.documentElement.style.setProperty('--vh', `${vh}px`);
            }

            // Définir la hauteur au chargement
            setVH();

            // Mettre à jour la hauteur lors du redimensionnement
            window.addEventListener('resize', setVH);
            window.addEventListener('orientationchange', function() {
                setTimeout(setVH, 100);
            });
        }
    }

    // ===== CORRECTION DU SCROLL TOUCH =====
    function fixTouchScroll() {
        if (isTouch) {
            // Permettre le scroll naturel
            document.addEventListener('touchstart', function(e) {
                // Ne pas empêcher le scroll par défaut
            }, { passive: true });

            document.addEventListener('touchmove', function(e) {
                // Permettre le scroll vertical
                const target = e.target;
                const scrollableParent = target.closest('.scrollable, .modal, .popup, .mobile-sidebar');
                
                if (!scrollableParent) {
                    // Permettre le scroll du body
                    return;
                }
            }, { passive: true });

            // Correction pour les éléments avec overflow
            const scrollableElements = document.querySelectorAll('.modal, .popup, .mobile-sidebar, .tiktok-feed-grid, .thumbnail-slider');
            scrollableElements.forEach(element => {
                element.style.webkitOverflowScrolling = 'touch';
                element.style.overflowScrolling = 'touch';
            });
        }
    }

    // ===== CORRECTION DES MODALES =====
    function fixModals() {
        if (isMobile) {
            const modals = document.querySelectorAll('.modal, .popup, .certificate-modal, #feedModal, #imageModal');
            
            modals.forEach(modal => {
                // S'assurer que les modales permettent le scroll
                modal.style.webkitOverflowScrolling = 'touch';
                modal.style.overflowY = 'auto';
                modal.style.position = 'fixed';
                modal.style.top = '0';
                modal.style.left = '0';
                modal.style.width = '100vw';
                modal.style.height = '100vh';
                modal.style.zIndex = '999999';

                // Observer les changements de visibilité
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'style') {
                            const isVisible = modal.style.display !== 'none' && 
                                            modal.style.visibility !== 'hidden' && 
                                            modal.style.opacity !== '0';
                            
                            if (isVisible) {
                                // Ne pas bloquer le scroll du body, juste empêcher le scroll en arrière-plan
                                document.body.style.overflow = 'hidden';
                                document.body.style.position = 'fixed';
                                document.body.style.width = '100%';
                                document.body.style.top = `-${window.scrollY}px`;
                            } else {
                                // Restaurer le scroll du body
                                const scrollY = document.body.style.top;
                                document.body.style.overflow = '';
                                document.body.style.position = '';
                                document.body.style.width = '';
                                document.body.style.top = '';
                                if (scrollY) {
                                    window.scrollTo(0, parseInt(scrollY || '0') * -1);
                                }
                            }
                        }
                    });
                });

                observer.observe(modal, { attributes: true, attributeFilter: ['style'] });
            });
        }
    }

    // ===== CORRECTION DU MOBILE SIDEBAR =====
    function fixMobileSidebar() {
        if (isMobile) {
            const sidebar = document.querySelector('.mobile-sidebar');
            const overlay = document.querySelector('.mobile-sidebar-overlay');
            
            if (sidebar) {
                sidebar.style.webkitOverflowScrolling = 'touch';
                sidebar.style.overflowY = 'auto';
                sidebar.style.position = 'fixed';
                sidebar.style.top = '0';
                sidebar.style.left = '-100%';
                sidebar.style.width = '450px';
                sidebar.style.maxWidth = '90vw';
                sidebar.style.height = '100vh';
                sidebar.style.zIndex = '1000000';
                sidebar.style.transition = 'left 0.3s ease';

                // Fonction pour ouvrir le sidebar
                function openSidebar() {
                    sidebar.style.left = '0';
                    sidebar.classList.add('active');
                    if (overlay) {
                        overlay.style.display = 'block';
                    }
                    // Ne pas bloquer complètement le scroll du body
                    document.body.style.overflow = 'hidden';
                }

                // Fonction pour fermer le sidebar
                function closeSidebar() {
                    sidebar.style.left = '-100%';
                    sidebar.classList.remove('active');
                    if (overlay) {
                        overlay.style.display = 'none';
                    }
                    document.body.style.overflow = '';
                }

                // Event listeners
                const toggle = document.querySelector('.mobile-menu-toggle');
                if (toggle) {
                    toggle.addEventListener('click', function() {
                        const isOpen = sidebar.style.left === '0px' || sidebar.classList.contains('active');
                        if (isOpen) {
                            closeSidebar();
                        } else {
                            openSidebar();
                        }
                    });
                }

                if (overlay) {
                    overlay.addEventListener('click', closeSidebar);
                }

                const closeBtn = sidebar.querySelector('.sidebar-close');
                if (closeBtn) {
                    closeBtn.addEventListener('click', closeSidebar);
                }

                // Fermer avec la touche Escape
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'Escape' && sidebar.classList.contains('active')) {
                        closeSidebar();
                    }
                });
            }
        }
    }

    // ===== CORRECTION DES ÉLÉMENTS STICKY =====
    function fixStickyElements() {
        if (isMobile) {
            const stickyElements = document.querySelectorAll('.social-sidebar, .navbar, .header, .sticky-header');
            
            stickyElements.forEach(element => {
                element.style.position = 'relative';
                element.style.zIndex = '100';
                element.style.webkitTransform = 'translateZ(0)';
                element.style.transform = 'translateZ(0)';
            });

            // Correction spéciale pour la sidebar sociale
            const socialSidebar = document.querySelector('.social-sidebar');
            if (socialSidebar) {
                socialSidebar.style.position = 'fixed';
                socialSidebar.style.right = '0';
                socialSidebar.style.top = '50%';
                socialSidebar.style.transform = 'translateY(-50%)';
                socialSidebar.style.zIndex = '1000';
            }
        }
    }

    // ===== CORRECTION DES GRILLES ET LAYOUTS =====
    function fixGridsAndLayouts() {
        if (isMobile) {
            const grids = document.querySelectorAll('.products-grid, .categories-grid, .project-info-container, .tiktok-feed-grid');
            
            grids.forEach(grid => {
                // S'assurer que les grilles ne bloquent pas le scroll
                grid.style.position = 'relative';
                grid.style.overflow = 'visible';
                grid.style.display = 'block';
                
                // Correction des éléments enfants
                const children = grid.querySelectorAll('*');
                children.forEach(child => {
                    child.style.position = 'relative';
                    child.style.overflow = 'visible';
                });
            });
        }
    }

    // ===== CORRECTION DU PRELOADER =====
    function fixPreloader() {
        if (isMobile) {
            const preloader = document.querySelector('.preloader');
            
            if (preloader) {
                // S'assurer que le preloader ne bloque pas le scroll
                preloader.style.pointerEvents = 'none';
                preloader.style.overflow = 'hidden';
                
                // Fonction pour masquer le preloader
                function hidePreloader() {
                    preloader.style.opacity = '0';
                    preloader.style.visibility = 'hidden';
                    preloader.style.transition = 'opacity 0.3s ease, visibility 0.3s ease';
                    
                    setTimeout(() => {
                        if (preloader.parentNode) {
                            preloader.parentNode.removeChild(preloader);
                        }
                    }, 300);
                }

                // Masquer le preloader après le chargement
                if (document.readyState === 'complete') {
                    setTimeout(hidePreloader, 1000);
                } else {
                    window.addEventListener('load', function() {
                        setTimeout(hidePreloader, 1000);
                    });
                }
            }
        }
    }

    // ===== CORRECTION DES PERFORMANCES =====
    function optimizePerformance() {
        if (isMobile) {
            // Réduire les animations sur mobile
            document.documentElement.style.setProperty('--animation-duration', '0.3s');
            
            // Optimiser les images
            const images = document.querySelectorAll('img');
            images.forEach(img => {
                if (!img.hasAttribute('loading')) {
                    img.setAttribute('loading', 'lazy');
                }
            });

            // Debounce des événements de scroll
            let scrollTimeout;
            function debounceScroll() {
                clearTimeout(scrollTimeout);
                scrollTimeout = setTimeout(() => {
                    // Code de scroll optimisé ici si nécessaire
                }, 16); // ~60fps
            }

            window.addEventListener('scroll', debounceScroll, { passive: true });
        }
    }

    // ===== CORRECTION DES FORMULAIRES =====
    function fixForms() {
        if (isMobile) {
            const inputs = document.querySelectorAll('input, textarea, select');
            
            inputs.forEach(input => {
                // Prévenir le zoom sur iOS
                if (input.type === 'text' || input.type === 'email' || input.type === 'tel' || input.tagName === 'TEXTAREA') {
                    input.style.fontSize = '16px';
                }

                // Correction du scroll lors du focus
                input.addEventListener('focus', function() {
                    setTimeout(() => {
                        this.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }, 300);
                });
            });
        }
    }

    // ===== CORRECTION FINALE DU SCROLL =====
    function forceScrollFix() {
        if (isMobile) {
            // Force le scroll sur tous les éléments parents
            const elements = [document.documentElement, document.body];
            const selectors = ['.main-content', '.content', 'main', '.container', '.container-fluid'];
            
            selectors.forEach(selector => {
                const element = document.querySelector(selector);
                if (element) {
                    elements.push(element);
                }
            });

            elements.forEach(element => {
                if (element) {
                    element.style.overflow = 'visible';
                    element.style.overflowX = 'hidden';
                    element.style.overflowY = 'auto';
                    element.style.webkitOverflowScrolling = 'touch';
                    element.style.position = 'relative';
                    element.style.height = 'auto';
                    element.style.minHeight = '100vh';
                    element.style.touchAction = 'pan-y';
                }
            });

            // S'assurer qu'aucun élément ne bloque le scroll
            const allElements = document.querySelectorAll('*');
            allElements.forEach(element => {
                const computedStyle = window.getComputedStyle(element);
                
                // Si l'élément a une position fixed et bloque le scroll
                if (computedStyle.position === 'fixed' && 
                    computedStyle.top === '0px' && 
                    computedStyle.left === '0px' && 
                    computedStyle.width === '100%' && 
                    computedStyle.height === '100%' &&
                    !element.classList.contains('modal') &&
                    !element.classList.contains('popup') &&
                    !element.classList.contains('mobile-sidebar-overlay')) {
                    
                    element.style.pointerEvents = 'none';
                    element.style.overflow = 'hidden';
                }
            });
        }
    }

    // ===== INITIALISATION =====
    function init() {
        // Attendre que le DOM soit prêt
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', init);
            return;
        }

        console.log('SOTUMA Mobile Scroll Fix - Initialisation...');

        // Appliquer toutes les corrections
        fixViewport();
        fixBodyAndHtml();
        fixDynamicHeight();
        fixTouchScroll();
        fixModals();
        fixMobileSidebar();
        fixStickyElements();
        fixGridsAndLayouts();
        fixPreloader();
        optimizePerformance();
        fixForms();
        forceScrollFix();

        // Appliquer les corrections après un délai pour les éléments chargés dynamiquement
        setTimeout(() => {
            forceScrollFix();
            fixGridsAndLayouts();
            fixModals();
        }, 1000);

        // Appliquer les corrections lors du redimensionnement
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                fixDynamicHeight();
                fixBodyAndHtml();
                forceScrollFix();
            }, 250);
        });

        // Appliquer les corrections lors du changement d'orientation
        window.addEventListener('orientationchange', function() {
            setTimeout(() => {
                fixDynamicHeight();
                fixBodyAndHtml();
                forceScrollFix();
            }, 500);
        });

        console.log('SOTUMA Mobile Scroll Fix - Initialisé avec succès');
    }

    // ===== EXPORT POUR UTILISATION EXTERNE =====
    window.SOTUMAMobileScrollFix = {
        isMobile: isMobile,
        isTouch: isTouch,
        isIOS: isIOS,
        isAndroid: isAndroid,
        init: init,
        forceScrollFix: forceScrollFix,
        fixBodyAndHtml: fixBodyAndHtml,
        fixDynamicHeight: fixDynamicHeight,
        fixTouchScroll: fixTouchScroll,
        fixModals: fixModals,
        fixMobileSidebar: fixMobileSidebar,
        fixStickyElements: fixStickyElements,
        fixGridsAndLayouts: fixGridsAndLayouts,
        fixPreloader: fixPreloader,
        optimizePerformance: optimizePerformance,
        fixForms: fixForms
    };

    // Démarrer l'initialisation
    init();

})();
