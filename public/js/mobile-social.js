/* =====================================
SOTUMA Mobile Social JavaScript
Mobile Social Menu Functionality
Version: 1.0
===================================== */

document.addEventListener('DOMContentLoaded', function() {
    
    // Only initialize on mobile devices
    function isMobile() {
        return window.innerWidth <= 768;
    }
    
    // Create mobile social elements
    function createMobileSocialElements() {
        // Don't create if already exists or not mobile
        if (document.querySelector('.mobile-social-toggle') || !isMobile()) {
            return;
        }
        
        // Create mobile social toggle button
        const toggleButton = document.createElement('button');
        toggleButton.className = 'mobile-social-toggle';
        toggleButton.innerHTML = '<i class="fas fa-share-alt"></i>';
        toggleButton.setAttribute('aria-label', 'Toggle social media menu');
        toggleButton.setAttribute('aria-expanded', 'false');
        
        // Create mobile social menu
        const socialMenu = document.createElement('div');
        socialMenu.className = 'mobile-social-menu';
        socialMenu.setAttribute('role', 'menu');
        socialMenu.setAttribute('aria-hidden', 'true');
        
        // Get social links from the existing sidebar
        const existingSocialSidebar = document.querySelector('.social-sidebar');
        if (existingSocialSidebar) {
            const socialIcons = existingSocialSidebar.querySelectorAll('.social-icon');
            
            socialIcons.forEach((icon, index) => {
                const link = icon.querySelector('a');
                if (link) {
                    const mobileIcon = document.createElement('div');
                    mobileIcon.className = 'social-icon';
                    
                    const mobileLink = document.createElement('a');
                    mobileLink.href = link.href;
                    mobileLink.target = link.target;
                    mobileLink.title = link.title;
                    mobileLink.innerHTML = link.innerHTML;
                    mobileLink.setAttribute('role', 'menuitem');
                    mobileLink.setAttribute('tabindex', '-1');
                    
                    mobileIcon.appendChild(mobileLink);
                    socialMenu.appendChild(mobileIcon);
                }
            });
        }
        
        // Create overlay
        const overlay = document.createElement('div');
        overlay.className = 'mobile-social-overlay';
        overlay.setAttribute('aria-hidden', 'true');
        
        // Add elements to DOM
        document.body.appendChild(toggleButton);
        document.body.appendChild(socialMenu);
        document.body.appendChild(overlay);
        
        return { toggleButton, socialMenu, overlay };
    }
    
    // Remove mobile social elements
    function removeMobileSocialElements() {
        const elements = [
            '.mobile-social-toggle',
            '.mobile-social-menu',
            '.mobile-social-overlay'
        ];
        
        elements.forEach(selector => {
            const element = document.querySelector(selector);
            if (element) {
                element.remove();
            }
        });
    }
    
    // Initialize mobile social functionality
    function initMobileSocial() {
        const elements = createMobileSocialElements();
        if (!elements) return;
        
        const { toggleButton, socialMenu, overlay } = elements;
        let isOpen = false;
        
        // Toggle menu function
        function toggleMenu() {
            isOpen = !isOpen;
            
            toggleButton.classList.toggle('active', isOpen);
            socialMenu.classList.toggle('active', isOpen);
            overlay.classList.toggle('active', isOpen);
            
            // Update ARIA attributes
            toggleButton.setAttribute('aria-expanded', isOpen.toString());
            socialMenu.setAttribute('aria-hidden', (!isOpen).toString());
            overlay.setAttribute('aria-hidden', (!isOpen).toString());
            
            // Prevent body scroll when menu is open
            document.body.style.overflow = isOpen ? 'hidden' : '';
            
            // Focus management
            if (isOpen) {
                const firstMenuItem = socialMenu.querySelector('a');
                if (firstMenuItem) {
                    setTimeout(() => firstMenuItem.focus(), 100);
                }
            } else {
                toggleButton.focus();
            }
        }
        
        // Close menu function
        function closeMenu() {
            if (isOpen) {
                toggleMenu();
            }
        }
        
        // Event listeners
        toggleButton.addEventListener('click', toggleMenu);
        overlay.addEventListener('click', closeMenu);
        
        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (!isOpen) return;
            
            if (e.key === 'Escape') {
                closeMenu();
                return;
            }
            
            // Tab navigation within menu
            if (e.key === 'Tab') {
                const menuItems = socialMenu.querySelectorAll('a');
                const firstItem = menuItems[0];
                const lastItem = menuItems[menuItems.length - 1];
                
                if (e.shiftKey) {
                    // Shift + Tab
                    if (document.activeElement === firstItem) {
                        e.preventDefault();
                        lastItem.focus();
                    }
                } else {
                    // Tab
                    if (document.activeElement === lastItem) {
                        e.preventDefault();
                        firstItem.focus();
                    }
                }
            }
        });
        
        // Close menu when clicking on a social link
        const socialLinks = socialMenu.querySelectorAll('a');
        socialLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Small delay to allow the link to be processed
                setTimeout(closeMenu, 100);
            });
            
            // Make links focusable when menu is open
            link.addEventListener('focus', function() {
                if (isOpen) {
                    this.setAttribute('tabindex', '0');
                }
            });
        });
        
        // Touch gestures
        let startY = 0;
        let currentY = 0;
        let isDragging = false;
        
        socialMenu.addEventListener('touchstart', function(e) {
            startY = e.touches[0].clientY;
            isDragging = true;
        }, { passive: true });
        
        socialMenu.addEventListener('touchmove', function(e) {
            if (!isDragging) return;
            currentY = e.touches[0].clientY;
        }, { passive: true });
        
        socialMenu.addEventListener('touchend', function(e) {
            if (!isDragging) return;
            isDragging = false;
            
            const diffY = currentY - startY;
            
            // Swipe down to close
            if (diffY > 50) {
                closeMenu();
            }
        }, { passive: true });
        
        // Auto-close after inactivity
        let inactivityTimer;
        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);
            if (isOpen) {
                inactivityTimer = setTimeout(closeMenu, 10000); // 10 seconds
            }
        }
        
        socialMenu.addEventListener('mouseenter', resetInactivityTimer);
        socialMenu.addEventListener('mouseleave', resetInactivityTimer);
        socialMenu.addEventListener('touchstart', resetInactivityTimer);
        toggleButton.addEventListener('click', resetInactivityTimer);
        
        // Intersection Observer to hide/show button based on scroll position
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    toggleButton.style.opacity = '1';
                    toggleButton.style.pointerEvents = 'auto';
                } else {
                    toggleButton.style.opacity = '0.7';
                }
            });
        }, observerOptions);
        
        // Observe the footer to hide button when footer is visible
        const footer = document.querySelector('footer, .footer');
        if (footer) {
            observer.observe(footer);
        }
        
        return { toggleButton, socialMenu, overlay, closeMenu };
    }
    
    // Handle window resize
    function handleResize() {
        if (isMobile()) {
            // Initialize mobile social if not already done
            if (!document.querySelector('.mobile-social-toggle')) {
                initMobileSocial();
            }
            // Ensure desktop sidebar is hidden on mobile
            const desktopSidebar = document.querySelector('.social-sidebar');
            if (desktopSidebar) {
                desktopSidebar.style.display = 'none';
            }
        } else {
            // Remove mobile social elements on desktop
            removeMobileSocialElements();
            // Ensure desktop sidebar is visible on desktop
            const desktopSidebar = document.querySelector('.social-sidebar');
            if (desktopSidebar) {
                desktopSidebar.style.display = 'block';
            }
        }
    }
    
    // Initialize on load
    handleResize();
    
    // Handle window resize with debounce
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(handleResize, 250);
    });
    
    // Performance optimization: Preload social icons
    function preloadSocialIcons() {
        const socialPlatforms = [
            'instagram', 'facebook', 'tiktok', 
            'linkedin', 'envelope', 'whatsapp'
        ];
        
        socialPlatforms.forEach(platform => {
            const link = document.createElement('link');
            link.rel = 'prefetch';
            link.href = `data:text/css,.fa-${platform}:before{content:""}`;
            document.head.appendChild(link);
        });
    }
    
    preloadSocialIcons();
    
    // Export for external use
    window.MobileSocial = {
        init: initMobileSocial,
        remove: removeMobileSocialElements,
        isMobile: isMobile
    };
    
    // Analytics tracking for social clicks (if analytics is available)
    function trackSocialClick(platform, isMobile) {
        if (typeof gtag !== 'undefined') {
            gtag('event', 'social_click', {
                'social_platform': platform,
                'device_type': isMobile ? 'mobile' : 'desktop',
                'custom_parameter': 'social_sidebar'
            });
        }
        
        if (typeof fbq !== 'undefined') {
            fbq('track', 'Contact', {
                content_category: 'social_media',
                content_name: platform
            });
        }
    }
    
    // Add analytics tracking to social links
    document.addEventListener('click', function(e) {
        const socialLink = e.target.closest('.social-icon a, .mobile-social-menu a');
        if (socialLink) {
            const href = socialLink.href;
            let platform = 'unknown';
            
            if (href.includes('instagram')) platform = 'instagram';
            else if (href.includes('facebook')) platform = 'facebook';
            else if (href.includes('tiktok')) platform = 'tiktok';
            else if (href.includes('linkedin')) platform = 'linkedin';
            else if (href.includes('mailto')) platform = 'email';
            else if (href.includes('whatsapp') || href.includes('wa.me')) platform = 'whatsapp';
            
            trackSocialClick(platform, isMobile());
        }
    });
});
