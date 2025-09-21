/* =====================================
SOTUMA Dashboard Simple JavaScript
Minimal Dashboard Mobile Functionality
Version: 1.0
===================================== */

document.addEventListener('DOMContentLoaded', function() {
    
    // Simple sidebar toggle for mobile
    function initSimpleSidebarToggle() {
        const topbar = document.querySelector('.topbar');
        if (!topbar) return;
        
        // Create toggle button if it doesn't exist
        let toggleBtn = document.querySelector('.sidebar-toggler');
        if (!toggleBtn) {
            toggleBtn = document.createElement('button');
            toggleBtn.className = 'sidebar-toggler';
            toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
            toggleBtn.setAttribute('aria-label', 'Toggle sidebar');
            topbar.insertBefore(toggleBtn, topbar.firstChild);
        }
        
        const sidebar = document.querySelector('.sidebar');
        if (!sidebar) return;
        
        // Toggle sidebar on mobile
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.toggle('toggled');
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('toggled');
            }
        });
    }
    
    // Make tables more mobile-friendly
    function enhanceMobileTables() {
        const tables = document.querySelectorAll('.table');
        tables.forEach(table => {
            if (!table.parentElement.classList.contains('table-responsive')) {
                const wrapper = document.createElement('div');
                wrapper.className = 'table-responsive';
                table.parentNode.insertBefore(wrapper, table);
                wrapper.appendChild(table);
            }
        });
    }
    
    // Initialize everything
    initSimpleSidebarToggle();
    enhanceMobileTables();
});
