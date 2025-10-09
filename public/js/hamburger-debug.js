/**
 * SOTUMA Hamburger Debug Script
 * Script de diagnostic pour identifier pourquoi le menu hamburger ne s'ouvre pas
 */

(function() {
    'use strict';

    console.log('🔍 SOTUMA Hamburger Debug - Initialisation...');

    // Attendre que le DOM soit prêt
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            debugHamburgerMenu();
        }, 1000);
    });

    function debugHamburgerMenu() {
        console.log('=== DIAGNOSTIC DU MENU HAMBURGER ===');
        
        // 1. Vérifier tous les sélecteurs possibles
        const selectors = [
            '.mobile-toggle',
            '.mobile-menu-toggle', 
            '.hamburger',
            '.mobile-nav-toggle',
            '[aria-label="Toggle mobile menu"]',
            'button[class*="toggle"]',
            'button[class*="hamburger"]',
            'button[class*="mobile"]'
        ];

        console.log('🔍 Recherche des boutons hamburger avec différents sélecteurs...');
        
        selectors.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            if (elements.length > 0) {
                console.log(`✅ Trouvé avec "${selector}":`, elements);
                elements.forEach((el, index) => {
                    console.log(`  - Élément ${index + 1}:`, {
                        tagName: el.tagName,
                        className: el.className,
                        id: el.id,
                        innerHTML: el.innerHTML.substring(0, 100),
                        visible: isElementVisible(el),
                        clickable: isElementClickable(el)
                    });
                });
            } else {
                console.log(`❌ Aucun élément trouvé avec "${selector}"`);
            }
        });

        // 2. Vérifier les éléments du menu
        const menuSelectors = [
            '.mobile-menu',
            '.mobile-nav-menu',
            '.mobile-sidebar',
            '[class*="mobile-menu"]'
        ];

        console.log('🔍 Recherche des éléments de menu...');
        
        menuSelectors.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            if (elements.length > 0) {
                console.log(`✅ Menu trouvé avec "${selector}":`, elements);
                elements.forEach((el, index) => {
                    console.log(`  - Menu ${index + 1}:`, {
                        tagName: el.tagName,
                        className: el.className,
                        id: el.id,
                        visible: isElementVisible(el),
                        hasActiveClass: el.classList.contains('active')
                    });
                });
            } else {
                console.log(`❌ Aucun menu trouvé avec "${selector}"`);
            }
        });

        // 3. Vérifier les overlays
        const overlaySelectors = [
            '.mobile-overlay',
            '.mobile-nav-overlay',
            '.overlay',
            '[class*="overlay"]'
        ];

        console.log('🔍 Recherche des overlays...');
        
        overlaySelectors.forEach(selector => {
            const elements = document.querySelectorAll(selector);
            if (elements.length > 0) {
                console.log(`✅ Overlay trouvé avec "${selector}":`, elements);
            } else {
                console.log(`❌ Aucun overlay trouvé avec "${selector}"`);
            }
        });

        // 4. Vérifier les event listeners existants
        console.log('🔍 Vérification des event listeners...');
        
        const allButtons = document.querySelectorAll('button');
        allButtons.forEach((button, index) => {
            if (button.className.includes('mobile') || button.className.includes('toggle') || button.className.includes('hamburger')) {
                console.log(`🔘 Bouton suspect ${index + 1}:`, {
                    className: button.className,
                    id: button.id,
                    innerHTML: button.innerHTML.substring(0, 50)
                });
                
                // Tester le clic
                button.addEventListener('click', function(e) {
                    console.log('🎯 CLIC DÉTECTÉ sur:', button);
                    console.log('Event:', e);
                }, true);
            }
        });

        // 5. Créer un bouton de test
        createTestButton();

        console.log('=== FIN DU DIAGNOSTIC ===');
    }

    function isElementVisible(element) {
        const style = window.getComputedStyle(element);
        return style.display !== 'none' && 
               style.visibility !== 'hidden' && 
               style.opacity !== '0' &&
               element.offsetWidth > 0 &&
               element.offsetHeight > 0;
    }

    function isElementClickable(element) {
        const style = window.getComputedStyle(element);
        return style.pointerEvents !== 'none' && 
               element.disabled !== true;
    }

    function createTestButton() {
        // Créer un bouton de test pour forcer l'ouverture du menu
        const testButton = document.createElement('button');
        testButton.innerHTML = '🧪 TEST MENU';
        testButton.style.cssText = `
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 99999;
            background: #FF0000;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        `;
        
        testButton.addEventListener('click', function() {
            console.log('🧪 Test manuel du menu...');
            forceOpenMenu();
        });
        
        document.body.appendChild(testButton);
        console.log('🧪 Bouton de test créé (coin supérieur droit)');
    }

    function forceOpenMenu() {
        // Essayer de forcer l'ouverture du menu avec différents sélecteurs
        const menuSelectors = ['.mobile-menu', '.mobile-nav-menu', '.mobile-sidebar'];
        const overlaySelectors = ['.mobile-overlay', '.mobile-nav-overlay'];
        
        let menuFound = false;
        let overlayFound = false;
        
        menuSelectors.forEach(selector => {
            const menu = document.querySelector(selector);
            if (menu) {
                console.log(`🎯 Forçage de l'ouverture du menu: ${selector}`);
                menu.classList.add('active');
                menu.style.display = 'block';
                menu.style.left = '0';
                menu.style.transform = 'translateX(0)';
                menuFound = true;
            }
        });
        
        overlaySelectors.forEach(selector => {
            const overlay = document.querySelector(selector);
            if (overlay) {
                console.log(`🎯 Forçage de l'ouverture de l'overlay: ${selector}`);
                overlay.classList.add('active');
                overlay.style.display = 'block';
                overlay.style.opacity = '1';
                overlay.style.visibility = 'visible';
                overlayFound = true;
            }
        });
        
        if (menuFound || overlayFound) {
            console.log('✅ Menu forcé à s\'ouvrir');
            
            // Fermer après 3 secondes
            setTimeout(() => {
                forceCloseMenu();
            }, 3000);
        } else {
            console.log('❌ Impossible de forcer l\'ouverture du menu');
        }
    }

    function forceCloseMenu() {
        console.log('🎯 Fermeture forcée du menu...');
        
        const menuSelectors = ['.mobile-menu', '.mobile-nav-menu', '.mobile-sidebar'];
        const overlaySelectors = ['.mobile-overlay', '.mobile-nav-overlay'];
        
        menuSelectors.forEach(selector => {
            const menu = document.querySelector(selector);
            if (menu) {
                menu.classList.remove('active');
                menu.style.display = 'none';
                menu.style.left = '-100%';
                menu.style.transform = 'translateX(-100%)';
            }
        });
        
        overlaySelectors.forEach(selector => {
            const overlay = document.querySelector(selector);
            if (overlay) {
                overlay.classList.remove('active');
                overlay.style.display = 'none';
                overlay.style.opacity = '0';
                overlay.style.visibility = 'hidden';
            }
        });
    }

    // Fonction globale pour tester manuellement
    window.debugSOTUMAHamburger = debugHamburgerMenu;
    window.forceOpenSOTUMAMenu = forceOpenMenu;
    window.forceCloseSOTUMAMenu = forceCloseMenu;

    console.log('🔍 SOTUMA Hamburger Debug chargé. Utilisez debugSOTUMAHamburger() pour diagnostiquer.');

})();
