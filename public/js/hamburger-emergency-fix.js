/**
 * SOTUMA Hamburger Emergency Fix
 * Correction d'urgence pour forcer le fonctionnement du menu hamburger
 */

(function() {
    'use strict';

    console.log('🚨 SOTUMA Hamburger Emergency Fix - Initialisation...');

    // Attendre que le DOM soit prêt
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            emergencyFixHamburger();
        }, 2000);
    });

    function emergencyFixHamburger() {
        console.log('🚨 Application de la correction d\'urgence du menu hamburger...');

        // 1. Trouver le bouton hamburger avec tous les sélecteurs possibles
        let hamburgerButton = null;
        const hamburgerSelectors = [
            '.mobile-toggle',
            '.mobile-menu-toggle',
            '.hamburger',
            '.mobile-nav-toggle',
            'button[aria-label*="Toggle"]',
            'button[aria-label*="menu"]',
            'button[class*="toggle"]',
            'button[class*="hamburger"]',
            'button[class*="mobile"]'
        ];

        for (let selector of hamburgerSelectors) {
            hamburgerButton = document.querySelector(selector);
            if (hamburgerButton) {
                console.log(`✅ Bouton hamburger trouvé avec: ${selector}`);
                break;
            }
        }

        if (!hamburgerButton) {
            console.log('❌ Aucun bouton hamburger trouvé, création d\'un bouton d\'urgence...');
            hamburgerButton = createEmergencyHamburgerButton();
        }

        // 2. Trouver le menu avec tous les sélecteurs possibles
        let mobileMenu = null;
        const menuSelectors = [
            '.mobile-menu',
            '.mobile-nav-menu',
            '.mobile-sidebar',
            '[class*="mobile-menu"]',
            '[class*="mobile-nav"]'
        ];

        for (let selector of menuSelectors) {
            mobileMenu = document.querySelector(selector);
            if (mobileMenu) {
                console.log(`✅ Menu mobile trouvé avec: ${selector}`);
                break;
            }
        }

        if (!mobileMenu) {
            console.log('❌ Aucun menu mobile trouvé, création d\'un menu d\'urgence...');
            mobileMenu = createEmergencyMenu();
        }

        // 3. Trouver l'overlay avec tous les sélecteurs possibles
        let mobileOverlay = null;
        const overlaySelectors = [
            '.mobile-overlay',
            '.mobile-nav-overlay',
            '.overlay',
            '[class*="overlay"]'
        ];

        for (let selector of overlaySelectors) {
            mobileOverlay = document.querySelector(selector);
            if (mobileOverlay) {
                console.log(`✅ Overlay mobile trouvé avec: ${selector}`);
                break;
            }
        }

        if (!mobileOverlay) {
            console.log('❌ Aucun overlay mobile trouvé, création d\'un overlay d\'urgence...');
            mobileOverlay = createEmergencyOverlay();
        }

        // 4. Appliquer la correction d'urgence
        if (hamburgerButton && mobileMenu && mobileOverlay) {
            console.log('🔧 Application de la correction d\'urgence...');
            applyEmergencyFix(hamburgerButton, mobileMenu, mobileOverlay);
        } else {
            console.log('❌ Impossible d\'appliquer la correction d\'urgence');
        }
    }

    function createEmergencyHamburgerButton() {
        console.log('🔧 Création d\'un bouton hamburger d\'urgence...');
        
        const button = document.createElement('button');
        button.className = 'emergency-hamburger';
        button.innerHTML = `
            <span class="burger-line"></span>
            <span class="burger-line"></span>
            <span class="burger-line"></span>
        `;
        
        button.style.cssText = `
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 10001;
            width: 48px;
            height: 48px;
            background: #FF0000;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 4px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        `;
        
        button.querySelectorAll('.burger-line').forEach(line => {
            line.style.cssText = `
                width: 20px;
                height: 2px;
                background: white;
                border-radius: 1px;
                transition: all 0.3s ease;
            `;
        });
        
        document.body.appendChild(button);
        return button;
    }

    function createEmergencyMenu() {
        console.log('🔧 Création d\'un menu mobile d\'urgence...');
        
        const menu = document.createElement('div');
        menu.className = 'emergency-mobile-menu';
        menu.innerHTML = `
            <div class="emergency-menu-header">
                <img src="${window.location.origin}/images/logo2.png" alt="SOTUMA" style="height: 40px;">
                <button class="emergency-menu-close">✕</button>
            </div>
            <div class="emergency-menu-content">
                <a href="/" class="emergency-menu-link">🏠 Accueil</a>
                <a href="/about-us" class="emergency-menu-link">ℹ️ À Propos</a>
                <a href="/media" class="emergency-menu-link">📸 Médias</a>
                <a href="/project-categories" class="emergency-menu-link">🏗️ Projets</a>
                <a href="/categories" class="emergency-menu-link">📦 Produits</a>
                <a href="/certificates" class="emergency-menu-link">📜 Certificats</a>
                <a href="/contact" class="emergency-menu-link">📧 Contact</a>
            </div>
        `;
        
        menu.style.cssText = `
            position: fixed;
            top: 0;
            left: -100%;
            width: 300px;
            max-width: 85vw;
            height: 100vh;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            box-shadow: 4px 0 32px rgba(0,0,0,0.15);
            z-index: 10000;
            transition: left 0.4s ease;
            overflow-y: auto;
        `;
        
        // Styles pour le header
        const header = menu.querySelector('.emergency-menu-header');
        header.style.cssText = `
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            border-bottom: 1px solid #eee;
            background: white;
        `;
        
        // Styles pour le bouton fermer
        const closeBtn = menu.querySelector('.emergency-menu-close');
        closeBtn.style.cssText = `
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #666;
            padding: 0.5rem;
            border-radius: 50%;
            transition: all 0.3s ease;
        `;
        
        // Styles pour le contenu
        const content = menu.querySelector('.emergency-menu-content');
        content.style.cssText = `
            padding: 1rem 0;
        `;
        
        // Styles pour les liens
        menu.querySelectorAll('.emergency-menu-link').forEach(link => {
            link.style.cssText = `
                display: block;
                padding: 1rem 1.5rem;
                color: #333;
                text-decoration: none;
                font-weight: 600;
                border-bottom: 1px solid #f0f0f0;
                transition: all 0.3s ease;
            `;
            
            link.addEventListener('mouseenter', function() {
                this.style.background = 'rgba(255, 0, 0, 0.1)';
                this.style.color = '#FF0000';
            });
            
            link.addEventListener('mouseleave', function() {
                this.style.background = '';
                this.style.color = '#333';
            });
        });
        
        document.body.appendChild(menu);
        return menu;
    }

    function createEmergencyOverlay() {
        console.log('🔧 Création d\'un overlay d\'urgence...');
        
        const overlay = document.createElement('div');
        overlay.className = 'emergency-mobile-overlay';
        overlay.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0,0,0,0.5);
            z-index: 9999;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        `;
        
        document.body.appendChild(overlay);
        return overlay;
    }

    function applyEmergencyFix(hamburgerButton, mobileMenu, mobileOverlay) {
        console.log('🔧 Application de la correction d\'urgence...');

        // Supprimer tous les event listeners existants
        const newHamburgerButton = hamburgerButton.cloneNode(true);
        hamburgerButton.parentNode.replaceChild(newHamburgerButton, hamburgerButton);
        
        // Fonction pour ouvrir le menu
        function openMenu() {
            console.log('🚀 Ouverture du menu d\'urgence...');
            
            // Ajouter les classes actives
            newHamburgerButton.classList.add('active');
            mobileMenu.classList.add('active');
            mobileOverlay.classList.add('active');
            
            // Appliquer les styles directement
            mobileMenu.style.left = '0';
            mobileMenu.style.transform = 'translateX(0)';
            mobileOverlay.style.opacity = '1';
            mobileOverlay.style.visibility = 'visible';
            
            // Gérer le scroll du body
            const currentScrollY = window.scrollY;
            document.body.style.position = 'fixed';
            document.body.style.top = `-${currentScrollY}px`;
            document.body.style.width = '100%';
            document.body.style.overflow = 'hidden';
            document.body.setAttribute('data-scroll-y', currentScrollY);
            
            // Transformer le bouton en X
            const lines = newHamburgerButton.querySelectorAll('.burger-line');
            if (lines.length >= 3) {
                lines[0].style.transform = 'rotate(45deg) translate(5px, 5px)';
                lines[1].style.opacity = '0';
                lines[2].style.transform = 'rotate(-45deg) translate(7px, -6px)';
            }
        }

        // Fonction pour fermer le menu
        function closeMenu() {
            console.log('🚀 Fermeture du menu d\'urgence...');
            
            // Retirer les classes actives
            newHamburgerButton.classList.remove('active');
            mobileMenu.classList.remove('active');
            mobileOverlay.classList.remove('active');
            
            // Appliquer les styles directement
            mobileMenu.style.left = '-100%';
            mobileMenu.style.transform = 'translateX(-100%)';
            mobileOverlay.style.opacity = '0';
            mobileOverlay.style.visibility = 'hidden';
            
            // Restaurer le scroll du body
            const scrollY = document.body.getAttribute('data-scroll-y');
            document.body.style.position = '';
            document.body.style.top = '';
            document.body.style.width = '';
            document.body.style.overflow = '';
            document.body.removeAttribute('data-scroll-y');
            
            if (scrollY) {
                window.scrollTo(0, parseInt(scrollY));
            }
            
            // Restaurer le bouton hamburger
            const lines = newHamburgerButton.querySelectorAll('.burger-line');
            if (lines.length >= 3) {
                lines[0].style.transform = '';
                lines[1].style.opacity = '';
                lines[2].style.transform = '';
            }
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

        // Ajouter les event listeners
        newHamburgerButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('🎯 Clic détecté sur le bouton hamburger d\'urgence');
            toggleMenu();
        });

        mobileOverlay.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('🎯 Clic détecté sur l\'overlay d\'urgence');
            closeMenu();
        });

        // Fermer avec Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                console.log('🎯 Touche Escape détectée');
                closeMenu();
            }
        });

        // Fermer les liens du menu
        const menuLinks = mobileMenu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function() {
                console.log('🎯 Clic sur un lien du menu');
                setTimeout(() => {
                    closeMenu();
                }, 100);
            });
        });

        // Fermer le bouton de fermeture s'il existe
        const closeButton = mobileMenu.querySelector('.mobile-close, .emergency-menu-close');
        if (closeButton) {
            closeButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('🎯 Clic sur le bouton fermer');
                closeMenu();
            });
        }

        console.log('✅ Correction d\'urgence appliquée avec succès !');
        console.log('🎯 Le menu hamburger devrait maintenant fonctionner');
    }

    // Fonction globale pour forcer la correction
    window.emergencyFixSOTUMAHamburger = emergencyFixHamburger;

    console.log('🚨 SOTUMA Hamburger Emergency Fix chargé. Utilisez emergencyFixSOTUMAHamburger() pour forcer la correction.');

})();
