/**
 * SOTUMA Hamburger Menu Fix
 * Correction spécifique pour le menu hamburger après les corrections du scroll mobile
 * Version: 1.0 - Production Ready
 */

(function() {
    'use strict';

    // Attendre que le DOM soit prêt
    document.addEventListener('DOMContentLoaded', function() {
        console.log('SOTUMA Hamburger Menu Fix - Initialisation...');
        
        // Initialiser la correction du menu hamburger
        initHamburgerMenuFix();
    });

    function initHamburgerMenuFix() {
        // Sélectionner les éléments du menu hamburger
        const mobileToggle = document.querySelector('.mobile-toggle');
        const mobileMenu = document.querySelector('.mobile-menu');
        const mobileOverlay = document.querySelector('.mobile-overlay');
        const mobileClose = document.querySelector('.mobile-close');

        // Vérifier que les éléments existent
        if (!mobileToggle || !mobileMenu || !mobileOverlay) {
            console.warn('Éléments du menu hamburger non trouvés');
            return;
        }

        console.log('Éléments du menu hamburger trouvés:', {
            toggle: !!mobileToggle,
            menu: !!mobileMenu,
            overlay: !!mobileOverlay,
            close: !!mobileClose
        });

        // Fonction pour ouvrir le menu
        function openMenu() {
            console.log('Ouverture du menu hamburger');
            
            // Ajouter les classes actives
            mobileToggle.classList.add('active');
            mobileMenu.classList.add('active');
            mobileOverlay.classList.add('active');
            
            // Mettre à jour les attributs ARIA
            mobileToggle.setAttribute('aria-expanded', 'true');
            mobileMenu.setAttribute('aria-hidden', 'false');
            
            // Gestion du scroll du body - méthode compatible avec les corrections du scroll
            const currentScrollY = window.scrollY;
            document.body.style.position = 'fixed';
            document.body.style.top = `-${currentScrollY}px`;
            document.body.style.width = '100%';
            document.body.style.overflow = 'hidden';
            document.body.setAttribute('data-scroll-y', currentScrollY);
            
            // Focus sur le premier élément du menu
            setTimeout(() => {
                const firstFocusable = mobileMenu.querySelector('a, button, [tabindex]:not([tabindex="-1"])');
                if (firstFocusable) {
                    firstFocusable.focus();
                }
            }, 300);
        }

        // Fonction pour fermer le menu
        function closeMenu() {
            console.log('Fermeture du menu hamburger');
            
            // Retirer les classes actives
            mobileToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
            mobileOverlay.classList.remove('active');
            
            // Mettre à jour les attributs ARIA
            mobileToggle.setAttribute('aria-expanded', 'false');
            mobileMenu.setAttribute('aria-hidden', 'true');
            
            // Restaurer le scroll du body
            const scrollY = document.body.getAttribute('data-scroll-y');
            document.body.style.position = '';
            document.body.style.top = '';
            document.body.style.width = '';
            document.body.style.overflow = '';
            document.body.removeAttribute('data-scroll-y');
            
            // Restaurer la position de scroll
            if (scrollY) {
                window.scrollTo(0, parseInt(scrollY));
            }
            
            // Focus sur le bouton toggle
            mobileToggle.focus();
        }

        // Fonction pour basculer le menu
        function toggleMenu() {
            const isActive = mobileMenu.classList.contains('active');
            
            if (isActive) {
                closeMenu();
            } else {
                openMenu();
            }
        }

        // Event listeners
        mobileToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            toggleMenu();
        });

        if (mobileClose) {
            mobileClose.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                closeMenu();
            });
        }

        mobileOverlay.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            closeMenu();
        });

        // Fermer le menu avec la touche Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                closeMenu();
            }
        });

        // Fermer le menu lors du redimensionnement de la fenêtre
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1025) {
                closeMenu();
            }
        });

        // Gestion des dropdowns dans le menu mobile
        setupMobileDropdowns();

        // Gestion de l'accessibilité
        setupAccessibility();

        console.log('SOTUMA Hamburger Menu Fix - Initialisé avec succès');
    }

    function setupMobileDropdowns() {
        const dropdownTriggers = document.querySelectorAll('.mobile-dropdown-trigger');
        
        dropdownTriggers.forEach(trigger => {
            const menu = trigger.nextElementSibling;
            const arrow = trigger.querySelector('.mobile-dropdown-arrow');
            
            if (!menu) return;
            
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const isActive = trigger.classList.contains('active');
                
                // Fermer tous les autres dropdowns
                dropdownTriggers.forEach(otherTrigger => {
                    if (otherTrigger !== trigger) {
                        otherTrigger.classList.remove('active');
                        const otherMenu = otherTrigger.nextElementSibling;
                        if (otherMenu) {
                            otherMenu.classList.remove('active');
                        }
                        otherTrigger.setAttribute('aria-expanded', 'false');
                    }
                });
                
                // Basculer le dropdown actuel
                trigger.classList.toggle('active');
                menu.classList.toggle('active');
                trigger.setAttribute('aria-expanded', !isActive);
                
                // Animation de la flèche
                if (arrow) {
                    arrow.style.transform = !isActive ? 'rotate(180deg)' : 'rotate(0deg)';
                }
            });
            
            // Fermer le dropdown quand on clique sur un lien
            const links = menu.querySelectorAll('.mobile-dropdown-link');
            links.forEach(link => {
                link.addEventListener('click', function() {
                    // Fermer le menu principal après un court délai
                    setTimeout(() => {
                        const mobileMenu = document.querySelector('.mobile-menu');
                        if (mobileMenu && mobileMenu.classList.contains('active')) {
                            closeMenu();
                        }
                    }, 100);
                });
            });
        });

        // Gestion du sélecteur de langue mobile
        const langHeader = document.querySelector('.mobile-lang-header');
        const langOptions = document.querySelector('.mobile-lang-options');
        
        if (langHeader && langOptions) {
            langHeader.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const isActive = langOptions.classList.contains('active');
                
                // Fermer tous les dropdowns
                dropdownTriggers.forEach(trigger => {
                    trigger.classList.remove('active');
                    const menu = trigger.nextElementSibling;
                    if (menu) {
                        menu.classList.remove('active');
                    }
                    trigger.setAttribute('aria-expanded', 'false');
                });
                
                // Basculer le sélecteur de langue
                langOptions.classList.toggle('active');
                langHeader.classList.toggle('active');
                
                // Animation de la flèche
                const langArrow = langHeader.querySelector('.mobile-lang-arrow');
                if (langArrow) {
                    langArrow.style.transform = !isActive ? 'rotate(180deg)' : 'rotate(0deg)';
                }
            });
            
            // Fermer le sélecteur de langue quand on clique sur une option
            const langLinks = langOptions.querySelectorAll('.mobile-lang-option');
            langLinks.forEach(link => {
                link.addEventListener('click', function() {
                    langOptions.classList.remove('active');
                    langHeader.classList.remove('active');
                    
                    // Fermer le menu principal après un court délai
                    setTimeout(() => {
                        const mobileMenu = document.querySelector('.mobile-menu');
                        if (mobileMenu && mobileMenu.classList.contains('active')) {
                            closeMenu();
                        }
                    }, 100);
                });
            });
        }
    }

    function setupAccessibility() {
        const mobileMenu = document.querySelector('.mobile-menu');
        if (!mobileMenu) return;

        // Piéger le focus dans le menu mobile
        const focusableElements = mobileMenu.querySelectorAll(
            'a, button, [tabindex]:not([tabindex="-1"])'
        );
        
        if (focusableElements.length > 0) {
            const firstElement = focusableElements[0];
            const lastElement = focusableElements[focusableElements.length - 1];
            
            mobileMenu.addEventListener('keydown', function(e) {
                if (e.key === 'Tab') {
                    if (e.shiftKey) {
                        // Shift + Tab
                        if (document.activeElement === firstElement) {
                            e.preventDefault();
                            lastElement.focus();
                        }
                    } else {
                        // Tab
                        if (document.activeElement === lastElement) {
                            e.preventDefault();
                            firstElement.focus();
                        }
                    }
                }
            });
        }
    }

    // Fonction utilitaire pour fermer le menu (accessible globalement)
    window.closeHamburgerMenu = function() {
        const mobileMenu = document.querySelector('.mobile-menu');
        if (mobileMenu && mobileMenu.classList.contains('active')) {
            const mobileToggle = document.querySelector('.mobile-toggle');
            const mobileOverlay = document.querySelector('.mobile-overlay');
            
            if (mobileToggle) mobileToggle.classList.remove('active');
            mobileMenu.classList.remove('active');
            if (mobileOverlay) mobileOverlay.classList.remove('active');
            
            // Restaurer le scroll
            const scrollY = document.body.getAttribute('data-scroll-y');
            document.body.style.position = '';
            document.body.style.top = '';
            document.body.style.width = '';
            document.body.style.overflow = '';
            document.body.removeAttribute('data-scroll-y');
            
            if (scrollY) {
                window.scrollTo(0, parseInt(scrollY));
            }
        }
    };

    // Fonction utilitaire pour ouvrir le menu (accessible globalement)
    window.openHamburgerMenu = function() {
        const mobileMenu = document.querySelector('.mobile-menu');
        if (mobileMenu && !mobileMenu.classList.contains('active')) {
            const mobileToggle = document.querySelector('.mobile-toggle');
            const mobileOverlay = document.querySelector('.mobile-overlay');
            
            if (mobileToggle) mobileToggle.classList.add('active');
            mobileMenu.classList.add('active');
            if (mobileOverlay) mobileOverlay.classList.add('active');
            
            // Gestion du scroll
            const currentScrollY = window.scrollY;
            document.body.style.position = 'fixed';
            document.body.style.top = `-${currentScrollY}px`;
            document.body.style.width = '100%';
            document.body.style.overflow = 'hidden';
            document.body.setAttribute('data-scroll-y', currentScrollY);
        }
    };

    // Fonction utilitaire pour basculer le menu (accessible globalement)
    window.toggleHamburgerMenu = function() {
        const mobileMenu = document.querySelector('.mobile-menu');
        if (mobileMenu) {
            if (mobileMenu.classList.contains('active')) {
                window.closeHamburgerMenu();
            } else {
                window.openHamburgerMenu();
            }
        }
    };

    // Export pour utilisation externe
    window.SOTUMAHamburgerMenu = {
        init: initHamburgerMenuFix,
        open: window.openHamburgerMenu,
        close: window.closeHamburgerMenu,
        toggle: window.toggleHamburgerMenu
    };

})();
