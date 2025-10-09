/**
 * SOTUMA Mobile Scroll Test
 * Script de test pour vérifier que le scroll fonctionne sur mobile
 */

(function() {
    'use strict';

    // Attendre que le DOM soit prêt
    document.addEventListener('DOMContentLoaded', function() {
        // Test du scroll après 2 secondes
        setTimeout(function() {
            testMobileScroll();
        }, 2000);
    });

    function testMobileScroll() {
        console.log('=== TEST DU SCROLL MOBILE SOTUMA ===');
        
        // Vérifier si on est sur mobile
        const isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
        
        if (!isMobile) {
            console.log('Test ignoré - pas sur mobile');
            return;
        }

        console.log('Appareil mobile détecté:', navigator.userAgent);

        // Test 1: Vérifier les styles du body
        const bodyStyles = window.getComputedStyle(document.body);
        console.log('Body overflow-y:', bodyStyles.overflowY);
        console.log('Body overflow-x:', bodyStyles.overflowX);
        console.log('Body position:', bodyStyles.position);
        console.log('Body height:', bodyStyles.height);

        // Test 2: Vérifier les styles du html
        const htmlStyles = window.getComputedStyle(document.documentElement);
        console.log('HTML overflow-y:', htmlStyles.overflowY);
        console.log('HTML overflow-x:', htmlStyles.overflowX);

        // Test 3: Vérifier la hauteur de la page
        const pageHeight = document.documentElement.scrollHeight;
        const windowHeight = window.innerHeight;
        console.log('Hauteur de la page:', pageHeight);
        console.log('Hauteur de la fenêtre:', windowHeight);
        console.log('Peut scroller:', pageHeight > windowHeight);

        // Test 4: Tester le scroll programmatique
        const initialScrollY = window.scrollY;
        console.log('Position de scroll initiale:', initialScrollY);

        // Essayer de scroller vers le bas
        window.scrollTo(0, 100);
        
        setTimeout(() => {
            const newScrollY = window.scrollY;
            console.log('Position de scroll après scrollTo(0, 100):', newScrollY);
            
            if (newScrollY > initialScrollY) {
                console.log('✅ SCROLL FONCTIONNE - Le scroll programmatique fonctionne');
            } else {
                console.log('❌ PROBLÈME DE SCROLL - Le scroll programmatique ne fonctionne pas');
            }

            // Revenir à la position initiale
            window.scrollTo(0, initialScrollY);
            
            // Test 5: Vérifier les éléments qui peuvent bloquer le scroll
            checkBlockingElements();
            
        }, 500);

        // Test 6: Vérifier les événements de scroll
        let scrollEventFired = false;
        const scrollListener = function() {
            scrollEventFired = true;
            console.log('✅ ÉVÉNEMENT DE SCROLL DÉTECTÉ');
            window.removeEventListener('scroll', scrollListener);
        };
        
        window.addEventListener('scroll', scrollListener);
        
        // Déclencher un scroll après 1 seconde
        setTimeout(() => {
            if (!scrollEventFired) {
                console.log('❌ PROBLÈME - Les événements de scroll ne se déclenchent pas');
            }
            window.removeEventListener('scroll', scrollListener);
        }, 3000);
    }

    function checkBlockingElements() {
        console.log('=== VÉRIFICATION DES ÉLÉMENTS BLOQUANTS ===');
        
        // Vérifier les modales ouvertes
        const modals = document.querySelectorAll('.modal, .popup');
        modals.forEach((modal, index) => {
            const styles = window.getComputedStyle(modal);
            if (styles.display !== 'none' && styles.visibility !== 'hidden') {
                console.log(`❌ MODALE ${index + 1} OUVERTE - Peut bloquer le scroll`);
            }
        });

        // Vérifier les overlays
        const overlays = document.querySelectorAll('.mobile-sidebar-overlay, .nav-overlay');
        overlays.forEach((overlay, index) => {
            const styles = window.getComputedStyle(overlay);
            if (styles.display !== 'none' && styles.visibility !== 'hidden') {
                console.log(`❌ OVERLAY ${index + 1} ACTIF - Peut bloquer le scroll`);
            }
        });

        // Vérifier les éléments avec position fixed
        const fixedElements = document.querySelectorAll('*');
        let blockingElements = 0;
        
        fixedElements.forEach(element => {
            const styles = window.getComputedStyle(element);
            if (styles.position === 'fixed' && 
                styles.top === '0px' && 
                styles.left === '0px' && 
                styles.width === '100%' && 
                styles.height === '100%' &&
                !element.classList.contains('modal') &&
                !element.classList.contains('popup') &&
                !element.classList.contains('mobile-sidebar-overlay')) {
                
                blockingElements++;
                console.log(`❌ ÉLÉMENT FIXE BLOQUANT:`, element);
            }
        });

        if (blockingElements === 0) {
            console.log('✅ AUCUN ÉLÉMENT BLOQUANT DÉTECTÉ');
        } else {
            console.log(`❌ ${blockingElements} ÉLÉMENT(S) BLOQUANT(S) DÉTECTÉ(S)`);
        }

        // Vérifier les styles inline du body
        const bodyOverflow = document.body.style.overflow;
        const bodyPosition = document.body.style.position;
        
        if (bodyOverflow === 'hidden') {
            console.log('❌ BODY OVERFLOW = HIDDEN - Bloque le scroll');
        } else {
            console.log('✅ BODY OVERFLOW OK:', bodyOverflow || 'auto');
        }

        if (bodyPosition === 'fixed') {
            console.log('❌ BODY POSITION = FIXED - Peut bloquer le scroll');
        } else {
            console.log('✅ BODY POSITION OK:', bodyPosition || 'static');
        }
    }

    // Fonction pour forcer un test de scroll
    window.testSOTUMAScroll = function() {
        testMobileScroll();
    };

    // Afficher un message dans la console
    console.log('SOTUMA Mobile Scroll Test chargé. Utilisez testSOTUMAScroll() pour tester manuellement.');

})();
