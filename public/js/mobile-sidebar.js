/**
 * Mobile Sidebar Functionality
 * Handles mobile menu toggle and sidebar interactions
 */

document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileSidebar = document.querySelector('.mobile-sidebar');
    const mobileSidebarOverlay = document.querySelector('.mobile-sidebar-overlay');
    const sidebarClose = document.querySelector('.sidebar-close');
    
    // Show mobile menu toggle on mobile screens
    function showMobileToggle() {
        if (window.innerWidth <= 1200) {
            if (mobileMenuToggle) {
                mobileMenuToggle.style.display = 'flex';
            }
        } else {
            if (mobileMenuToggle) {
                mobileMenuToggle.style.display = 'none';
            }
        }
    }
    
    // Toggle sidebar open/close
    function toggleSidebar() {
        if (mobileSidebar && mobileSidebarOverlay) {
            const isOpen = mobileSidebar.style.left === '0px' || mobileSidebar.classList.contains('active');
            
            if (isOpen) {
                closeSidebar();
            } else {
                openSidebar();
            }
        }
    }
    
    // Open sidebar
    function openSidebar() {
        if (mobileSidebar && mobileSidebarOverlay) {
            mobileSidebar.style.left = '0px';
            mobileSidebar.classList.add('active');
            mobileSidebarOverlay.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    }
    
    // Close sidebar
    function closeSidebar() {
        if (mobileSidebar && mobileSidebarOverlay) {
            mobileSidebar.style.left = '-100%';
            mobileSidebar.classList.remove('active');
            mobileSidebarOverlay.style.display = 'none';
            document.body.style.overflow = '';
        }
    }
    
    // Event listeners
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', toggleSidebar);
    }
    
    if (sidebarClose) {
        sidebarClose.addEventListener('click', closeSidebar);
    }
    
    if (mobileSidebarOverlay) {
        mobileSidebarOverlay.addEventListener('click', closeSidebar);
    }
    
    // Close sidebar when clicking on menu items
    const sidebarMenuItems = document.querySelectorAll('.sidebar-menu a');
    sidebarMenuItems.forEach(item => {
        item.addEventListener('click', closeSidebar);
    });
    
    // Close sidebar on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeSidebar();
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', function() {
        showMobileToggle();
        
        // Close sidebar if screen becomes large
        if (window.innerWidth > 1200) {
            closeSidebar();
        }
    });
    
    // Initial setup
    showMobileToggle();
    
    // Add hamburger animation
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
        });
    }
});
