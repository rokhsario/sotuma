/**
 * SOTUMA Hamburger Menu Test
 * Script de test pour vérifier que le menu hamburger fonctionne correctement
 */

(function() {
    'use strict';

    // Attendre que le DOM soit prêt
    document.addEventListener('DOMContentLoaded', function() {
    // Ne pas auto-exécuter sauf si activé explicitement
    if (window.__SOTUMA_TEST__ === true) {
        // Test du menu hamburger après 2 secondes
        setTimeout(function() {
            testHamburgerMenu();
        }, 2000);
    }
    });

    function testHamburgerMenu() {
        console.log('=== TEST DU MENU HAMBURGER SOTUMA ===');
        
        // Vérifier si on est sur mobile
        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        
        if (!isMobile) {
            console.log('Test ignoré - pas sur mobile');
            return;
        }

        console.log('Appareil mobile détecté:', navigator.userAgent);

        // Test 1: Vérifier que les éléments du menu existent
        const mobileToggle = document.querySelector('.mobile-toggle');
        const mobileMenu = document.querySelector('.mobile-menu');
        const mobileOverlay = document.querySelector('.mobile-overlay');
        const mobileClose = document.querySelector('.mobile-close');

        console.log('Éléments du menu hamburger:', {
            toggle: !!mobileToggle,
            menu: !!mobileMenu,
            overlay: !!mobileOverlay,
            close: !!mobileClose
        });

        if (!mobileToggle || !mobileMenu || !mobileOverlay) {
            console.error('❌ PROBLÈME - Éléments du menu hamburger manquants');
            return;
        }

        // Test 2: Vérifier les styles CSS
        const toggleStyles = window.getComputedStyle(mobileToggle);
        const menuStyles = window.getComputedStyle(mobileMenu);
        const overlayStyles = window.getComputedStyle(mobileOverlay);

        console.log('Styles du bouton toggle:', {
            display: toggleStyles.display,
            visibility: toggleStyles.visibility,
            opacity: toggleStyles.opacity,
            position: toggleStyles.position,
            zIndex: toggleStyles.zIndex
        });

        console.log('Styles du menu:', {
            display: menuStyles.display,
            visibility: menuStyles.visibility,
            opacity: menuStyles.opacity,
            position: menuStyles.position,
            left: menuStyles.left,
            zIndex: menuStyles.zIndex
        });

        console.log('Styles de l\'overlay:', {
            display: overlayStyles.display,
            visibility: overlayStyles.visibility,
            opacity: overlayStyles.opacity,
            position: overlayStyles.position,
            zIndex: overlayStyles.zIndex
        });

        // Test 3: Vérifier les événements
        let clickEventFired = false;
        let toggleEventFired = false;

        // Ajouter des listeners temporaires pour tester
        const testClickListener = function() {
            clickEventFired = true;
            console.log('✅ ÉVÉNEMENT CLICK DÉTECTÉ sur le toggle');
        };

        const testToggleListener = function() {
            toggleEventFired = true;
            console.log('✅ ÉVÉNEMENT TOGGLE DÉTECTÉ');
        };

        mobileToggle.addEventListener('click', testClickListener);
        
        // Observer les changements de classe pour détecter le toggle
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                    if (mobileMenu.classList.contains('active')) {
                        toggleEventFired = true;
                        console.log('✅ TOGGLE DÉTECTÉ - Menu ouvert');
                    } else {
                        console.log('✅ TOGGLE DÉTECTÉ - Menu fermé');
                    }
                }
            });
        });

        observer.observe(mobileMenu, { attributes: true, attributeFilter: ['class'] });

        // Test 4: Simuler un clic sur le bouton
        console.log('Simulation d\'un clic sur le bouton hamburger...');
        mobileToggle.click();

        // Vérifier après un délai
        setTimeout(() => {
            if (clickEventFired) {
                console.log('✅ CLIC FONCTIONNE - Le bouton répond aux clics');
            } else {
                console.log('❌ PROBLÈME - Le bouton ne répond pas aux clics');
            }

            if (mobileMenu.classList.contains('active')) {
                console.log('✅ MENU S\'OUVRE - Le menu s\'ouvre correctement');
            } else {
                console.log('❌ PROBLÈME - Le menu ne s\'ouvre pas');
            }

            // Test 5: Vérifier le scroll du body
            const bodyOverflow = document.body.style.overflow;
            const bodyPosition = document.body.style.position;
            
            console.log('État du body après ouverture:', {
                overflow: bodyOverflow,
                position: bodyPosition,
                top: document.body.style.top
            });

            if (bodyPosition === 'fixed' || bodyOverflow === 'hidden') {
                console.log('✅ SCROLL BLOQUÉ - Le scroll du body est correctement géré');
            } else {
                console.log('⚠️ ATTENTION - Le scroll du body pourrait ne pas être géré correctement');
            }

            // Test 6: Fermer le menu
            console.log('Fermeture du menu...');
            mobileToggle.click();

            setTimeout(() => {
                if (!mobileMenu.classList.contains('active')) {
                    console.log('✅ MENU SE FERME - Le menu se ferme correctement');
                } else {
                    console.log('❌ PROBLÈME - Le menu ne se ferme pas');
                }

                // Vérifier la restauration du scroll
                const bodyOverflowAfter = document.body.style.overflow;
                const bodyPositionAfter = document.body.style.position;
                
                console.log('État du body après fermeture:', {
                    overflow: bodyOverflowAfter,
                    position: bodyPositionAfter,
                    top: document.body.style.top
                });

                if (bodyPositionAfter === '' && bodyOverflowAfter === '') {
                    console.log('✅ SCROLL RESTAURÉ - Le scroll du body est correctement restauré');
                } else {
                    console.log('⚠️ ATTENTION - Le scroll du body pourrait ne pas être restauré correctement');
                }

                // Nettoyer les listeners de test
                mobileToggle.removeEventListener('click', testClickListener);
                observer.disconnect();

                console.log('=== FIN DU TEST DU MENU HAMBURGER ===');
            }, 500);

        }, 500);
    }

    // Fonction pour forcer un test du menu hamburger
    window.testSOTUMAHamburgerMenu = function() {
        testHamburgerMenu();
    };

    // Afficher un message dans la console
    console.log('SOTUMA Hamburger Menu Test chargé. Utilisez testSOTUMAHamburgerMenu() pour tester manuellement.');

})();
