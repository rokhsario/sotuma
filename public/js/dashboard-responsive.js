/* =====================================
SOTUMA Dashboard Responsive JavaScript
Mobile Dashboard Functionality
Version: 1.0
===================================== */

document.addEventListener('DOMContentLoaded', function() {
    // Create mobile sidebar toggle if it doesn't exist
    function createSidebarToggle() {
        const topbar = document.querySelector('.topbar');
        if (topbar && !document.querySelector('.sidebar-toggler')) {
            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'sidebar-toggler';
            toggleBtn.innerHTML = '<i class="fas fa-bars"></i>';
            toggleBtn.setAttribute('aria-label', 'Toggle sidebar');
            
            // Insert at the beginning of topbar
            topbar.insertBefore(toggleBtn, topbar.firstChild);
            
            return toggleBtn;
        }
        return document.querySelector('.sidebar-toggler');
    }
    
    // Create sidebar overlay if it doesn't exist
    function createSidebarOverlay() {
        if (!document.querySelector('.sidebar-overlay')) {
            const overlay = document.createElement('div');
            overlay.className = 'sidebar-overlay';
            document.body.appendChild(overlay);
            return overlay;
        }
        return document.querySelector('.sidebar-overlay');
    }
    
    // Initialize sidebar toggle functionality
    function initSidebarToggle() {
        const sidebar = document.querySelector('.sidebar');
        const toggleBtn = createSidebarToggle();
        const overlay = createSidebarOverlay();
        
        if (!sidebar || !toggleBtn || !overlay) return;
        
        // Toggle sidebar
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
        });
        
        // Close sidebar when clicking overlay
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        });
        
        // Close sidebar when clicking on sidebar links (mobile)
        const sidebarLinks = sidebar.querySelectorAll('.nav-link');
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });
        
        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
    
    // Make tables responsive
    function makeTablesResponsive() {
        const tables = document.querySelectorAll('.table');
        tables.forEach(table => {
            // Add responsive wrapper if not exists
            if (!table.parentElement.classList.contains('table-responsive')) {
                const wrapper = document.createElement('div');
                wrapper.className = 'table-responsive';
                table.parentNode.insertBefore(wrapper, table);
                wrapper.appendChild(table);
            }
            
            // Add data labels for mobile view
            const headers = table.querySelectorAll('thead th');
            const rows = table.querySelectorAll('tbody tr');
            
            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                cells.forEach((cell, index) => {
                    if (headers[index]) {
                        cell.setAttribute('data-label', headers[index].textContent.trim());
                    }
                });
            });
        });
    }
    
    // Handle form responsiveness
    function makeFormsResponsive() {
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            // Add responsive class if not exists
            if (!form.classList.contains('form-responsive')) {
                form.classList.add('form-responsive');
            }
            
            // Handle button groups on mobile
            const btnGroups = form.querySelectorAll('.btn-group');
            btnGroups.forEach(group => {
                if (window.innerWidth <= 768) {
                    group.style.flexDirection = 'column';
                    group.style.width = '100%';
                    
                    const buttons = group.querySelectorAll('.btn');
                    buttons.forEach(btn => {
                        btn.style.width = '100%';
                        btn.style.marginBottom = '0.5rem';
                    });
                }
            });
        });
    }
    
    // Handle modal responsiveness
    function makeModalsResponsive() {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('show.bs.modal', function() {
                const modalDialog = modal.querySelector('.modal-dialog');
                if (modalDialog && window.innerWidth <= 768) {
                    modalDialog.style.margin = '1rem';
                    modalDialog.style.maxWidth = 'calc(100% - 2rem)';
                }
            });
        });
    }
    
    // Handle card responsiveness
    function makeCardsResponsive() {
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            // Add responsive class if not exists
            if (!card.classList.contains('card-responsive')) {
                card.classList.add('card-responsive');
            }
        });
    }
    
    // Handle statistics cards
    function makeStatsCardsResponsive() {
        const statsCards = document.querySelectorAll('.border-left-primary, .border-left-success, .border-left-info, .border-left-warning, .border-left-danger');
        statsCards.forEach(card => {
            if (!card.classList.contains('stats-card')) {
                card.classList.add('stats-card');
            }
            
            // Find icon and add stats-icon class
            const icon = card.querySelector('.fa-2x');
            if (icon && !icon.classList.contains('stats-icon')) {
                icon.classList.add('stats-icon');
            }
            
            // Find value and add stats-value class
            const value = card.querySelector('.h5');
            if (value && !value.classList.contains('stats-value')) {
                value.classList.add('stats-value');
            }
            
            // Find label and add stats-label class
            const label = card.querySelector('.text-xs');
            if (label && !label.classList.contains('stats-label')) {
                label.classList.add('stats-label');
            }
        });
    }
    
    // Handle responsive grid layout
    function makeGridResponsive() {
        const rows = document.querySelectorAll('.row');
        rows.forEach(row => {
            // Add dashboard-grid class for better mobile handling
            if (row.children.length > 1) {
                row.classList.add('dashboard-grid');
                
                // Determine grid columns based on children
                const childCount = row.children.length;
                if (childCount === 2) {
                    row.classList.add('cols-sm-2');
                } else if (childCount === 3) {
                    row.classList.add('cols-md-3');
                } else if (childCount === 4) {
                    row.classList.add('cols-md-4', 'cols-lg-4');
                } else if (childCount >= 5) {
                    row.classList.add('cols-md-4', 'cols-lg-5');
                }
            }
        });
    }
    
    // Handle responsive navigation highlighting
    function handleActiveNavigation() {
        const currentPath = window.location.pathname;
        const navLinks = document.querySelectorAll('.sidebar .nav-link');
        
        navLinks.forEach(link => {
            const href = link.getAttribute('href');
            if (href && currentPath.includes(href)) {
                link.classList.add('active');
            }
        });
    }
    
    // Handle responsive charts (if Chart.js is loaded)
    function makeChartsResponsive() {
        if (typeof Chart !== 'undefined') {
            Chart.defaults.responsive = true;
            Chart.defaults.maintainAspectRatio = false;
            
            // Update existing charts
            Object.values(Chart.instances).forEach(chart => {
                chart.options.responsive = true;
                chart.options.maintainAspectRatio = false;
                chart.update();
            });
        }
    }
    
    // Handle responsive datatables (if DataTables is loaded)
    function makeDataTablesResponsive() {
        if (typeof $.fn.DataTable !== 'undefined') {
            $('.dataTable').each(function() {
                if ($.fn.DataTable.isDataTable(this)) {
                    $(this).DataTable().responsive.recalc();
                } else {
                    $(this).DataTable({
                        responsive: true,
                        scrollX: true,
                        autoWidth: false
                    });
                }
            });
        }
    }
    
    // Touch gesture support for mobile
    function addTouchSupport() {
        let startX = 0;
        let currentX = 0;
        let isDragging = false;
        
        document.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            isDragging = true;
        });
        
        document.addEventListener('touchmove', function(e) {
            if (!isDragging) return;
            currentX = e.touches[0].clientX;
        });
        
        document.addEventListener('touchend', function(e) {
            if (!isDragging) return;
            isDragging = false;
            
            const diffX = currentX - startX;
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.sidebar-overlay');
            
            // Swipe right to open sidebar (only if starting from left edge)
            if (diffX > 50 && startX < 50 && window.innerWidth <= 768) {
                if (sidebar && overlay) {
                    sidebar.classList.add('active');
                    overlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }
            
            // Swipe left to close sidebar
            if (diffX < -50 && sidebar && sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
    
    // Initialize all responsive features
    function initResponsiveDashboard() {
        initSidebarToggle();
        makeTablesResponsive();
        makeFormsResponsive();
        makeModalsResponsive();
        makeCardsResponsive();
        makeStatsCardsResponsive();
        makeGridResponsive();
        handleActiveNavigation();
        makeChartsResponsive();
        addTouchSupport();
        
        // Initialize DataTables after a short delay to ensure DOM is ready
        setTimeout(makeDataTablesResponsive, 100);
    }
    
    // Run initialization
    initResponsiveDashboard();
    
    // Re-run certain functions on window resize
    window.addEventListener('resize', function() {
        makeTablesResponsive();
        makeFormsResponsive();
        makeChartsResponsive();
    });
    
    // Re-run DataTables responsive on window resize with debounce
    let resizeTimer;
    window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
            makeDataTablesResponsive();
        }, 250);
    });
    
    // Export functions for external use
    window.DashboardResponsive = {
        init: initResponsiveDashboard,
        sidebar: {
            toggle: function() {
                const sidebar = document.querySelector('.sidebar');
                const overlay = document.querySelector('.sidebar-overlay');
                if (sidebar && overlay) {
                    sidebar.classList.toggle('active');
                    overlay.classList.toggle('active');
                    document.body.style.overflow = sidebar.classList.contains('active') ? 'hidden' : '';
                }
            },
            close: function() {
                const sidebar = document.querySelector('.sidebar');
                const overlay = document.querySelector('.sidebar-overlay');
                if (sidebar && overlay) {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }
        },
        tables: {
            makeResponsive: makeTablesResponsive
        },
        forms: {
            makeResponsive: makeFormsResponsive
        },
        charts: {
            makeResponsive: makeChartsResponsive
        }
    };
});

// CSS-in-JS for dynamic responsive styles
(function() {
    const style = document.createElement('style');
    style.textContent = `
        /* Dynamic responsive styles */
        @media (max-width: 768px) {
            .container-fluid {
                padding-left: 1rem !important;
                padding-right: 1rem !important;
            }
            
            .btn-group .btn {
                margin-bottom: 0.5rem;
            }
            
            .card-header {
                padding: 0.75rem 1rem !important;
            }
            
            .card-body {
                padding: 1rem !important;
            }
        }
    `;
    document.head.appendChild(style);
})();
