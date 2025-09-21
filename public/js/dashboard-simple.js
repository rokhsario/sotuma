/* =====================================
SOTUMA Dashboard - Senior Level Mobile JavaScript
Professional Mobile Solution
Author: Senior Developer  
Version: 8.0 - Production Ready
===================================== */

$(document).ready(function() {
    console.log('🚀 Senior Level Mobile Dashboard Loading...');
    
    // Senior Level Dashboard Manager
    class SeniorMobileDashboard {
        constructor() {
            this.isInitialized = false;
            this.debugMode = true; // Set to false in production
            this.init();
        }
        
        init() {
            this.validateEnvironment();
            this.forceSidebarVisibility();
            this.setupResponsiveTables();
            this.setupResponsiveForms();
            this.setupResponsiveCharts();
            this.setupTouchOptimizations();
            this.handleWindowResize();
            this.addDebugInfo();
            
            this.isInitialized = true;
            this.logStatus();
        }
        
        validateEnvironment() {
            const checks = {
                jquery: typeof $ !== 'undefined',
                sidebar: $('.sidebar').length > 0,
                contentWrapper: $('#content-wrapper').length > 0,
                wrapper: $('#wrapper').length > 0,
                bootstrap: typeof $.fn.modal !== 'undefined'
            };
            
            let allPassed = true;
            Object.entries(checks).forEach(([key, passed]) => {
                if (!passed) {
                    console.error(`❌ ${key} validation failed`);
                    allPassed = false;
                } else {
                    console.log(`✅ ${key} validation passed`);
                }
            });
            
            if (!allPassed) {
                console.error('🚨 Environment validation failed - some features may not work');
            }
            
            return allPassed;
        }
        
        forceSidebarVisibility() {
            console.log('🔧 Forcing sidebar visibility...');
            
            const $sidebar = $('.sidebar');
            const $wrapper = $('#wrapper');
            const $contentWrapper = $('#content-wrapper');
            
            if ($sidebar.length === 0) {
                console.error('❌ Sidebar element not found!');
                return;
            }
            
            // Nuclear option: Force sidebar visibility with inline styles
            $sidebar.attr('style', `
                display: block !important;
                visibility: visible !important;
                opacity: 1 !important;
                position: relative !important;
                width: 14rem !important;
                min-height: 100vh !important;
                flex: 0 0 14rem !important;
            `);
            
            // Force wrapper to use flexbox
            $wrapper.attr('style', `
                display: flex !important;
                flex-direction: row !important;
            `);
            
            // Force content wrapper
            $contentWrapper.attr('style', `
                flex: 1 1 auto !important;
                margin-left: 0 !important;
                width: auto !important;
            `);
            
            // Remove any conflicting classes
            $sidebar.removeClass('d-none d-md-none d-lg-none toggled');
            
            console.log('✅ Sidebar visibility forced');
            
            // Verify after DOM manipulation
            setTimeout(() => {
                const isVisible = $sidebar.is(':visible');
                const computedDisplay = $sidebar.css('display');
                console.log('🔍 Sidebar visibility check:', {
                    isVisible,
                    computedDisplay,
                    width: $sidebar.width(),
                    height: $sidebar.height()
                });
            }, 100);
        }
        
        setupResponsiveTables() {
            console.log('📊 Setting up responsive tables...');
            
            $('.table').each(function() {
                const $table = $(this);
                
                // Wrap in responsive container
                if (!$table.parent().hasClass('table-responsive')) {
                    $table.wrap('<div class="table-responsive"></div>');
                }
                
                // Add mobile-friendly classes
                $table.addClass('table-hover table-sm');
                
                // Optimize action buttons
                $table.find('.btn').each(function() {
                    $(this).addClass('btn-sm');
                });
            });
            
            console.log('✅ Tables configured for mobile');
        }
        
        setupResponsiveForms() {
            console.log('📝 Setting up responsive forms...');
            
            // Prevent iOS zoom
            $('.form-control').each(function() {
                const $input = $(this);
                if ($input.attr('type') !== 'file') {
                    $input.css('font-size', '16px');
                }
            });
            
            // Touch-friendly buttons
            $('.btn').each(function() {
                $(this).css('min-height', '38px');
            });
            
            // Enhanced modal behavior
            $('.modal').off('shown.bs.modal.senior').on('shown.bs.modal.senior', function() {
                const $firstInput = $(this).find('input, textarea, select').first();
                if ($firstInput.length) {
                    setTimeout(() => $firstInput.focus(), 300);
                }
            });
            
            console.log('✅ Forms optimized for mobile');
        }
        
        setupResponsiveCharts() {
            console.log('📈 Setting up responsive charts...');
            
            // Chart.js configuration
            if (typeof Chart !== 'undefined') {
                Chart.defaults.global.responsive = true;
                Chart.defaults.global.maintainAspectRatio = false;
                Chart.defaults.global.defaultFontSize = this.getOptimalFontSize();
                console.log('✅ Chart.js configured');
            } else {
                console.warn('⚠️ Chart.js not found');
            }
            
            // Google Charts configuration
            if (typeof google !== 'undefined' && google.charts) {
                this.enhanceGoogleCharts();
                console.log('✅ Google Charts enhanced');
            } else {
                console.warn('⚠️ Google Charts not found');
            }
        }
        
        getOptimalFontSize() {
            const width = $(window).width();
            if (width <= 480) return 10;
            if (width <= 768) return 11;
            return 12;
        }
        
        enhanceGoogleCharts() {
            // Override drawChart function if it exists
            if (typeof window.drawChart === 'function') {
                const originalDrawChart = window.drawChart;
                window.drawChart = () => {
                    originalDrawChart();
                    this.optimizeGoogleChartSizes();
                };
            }
        }
        
        optimizeGoogleChartSizes() {
            const $pieChart = $('#pie_chart');
            if ($pieChart.length) {
                const width = $(window).width();
                let height = '300px';
                
                if (width <= 480) height = '250px';
                else if (width <= 768) height = '280px';
                
                $pieChart.css('height', height);
            }
        }
        
        setupTouchOptimizations() {
            console.log('👆 Setting up touch optimizations...');
            
            // Touch feedback for interactive elements
            $('.card, .btn, .nav-link').off('touchstart.senior touchend.senior')
                .on('touchstart.senior', function() {
                    $(this).addClass('touch-active');
                })
                .on('touchend.senior touchcancel.senior', function() {
                    const $element = $(this);
                    setTimeout(() => $element.removeClass('touch-active'), 150);
                });
            
            // Optimize dropdowns for touch
            $('.dropdown-toggle').off('click.senior').on('click.senior', function(e) {
                if ($(window).width() <= 768) {
                    e.preventDefault();
                    const $menu = $(this).next('.dropdown-menu');
                    $('.dropdown-menu').not($menu).hide();
                    $menu.toggle();
                }
            });
            
            // Close dropdowns when clicking outside
            $(document).off('click.senior').on('click.senior', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').hide();
                }
            });
            
            console.log('✅ Touch optimizations applied');
        }
        
        handleWindowResize() {
            console.log('📐 Setting up resize handler...');
            
            let resizeTimer;
            $(window).off('resize.senior').on('resize.senior', () => {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(() => {
                    this.onWindowResize();
                }, 250);
            });
        }
        
        onWindowResize() {
            const width = $(window).width();
            console.log(`📏 Window resized to: ${width}px`);
            
            // Re-force sidebar visibility if needed
            if (width <= 768) {
                this.forceSidebarVisibility();
            }
            
            // Update chart font sizes
            if (typeof Chart !== 'undefined') {
                Chart.defaults.global.defaultFontSize = this.getOptimalFontSize();
                this.resizeCharts();
            }
            
            // Update Google Charts
            if (typeof drawChart === 'function') {
                setTimeout(() => drawChart(), 100);
            }
        }
        
        resizeCharts() {
            Object.values(Chart.instances || {}).forEach(chart => {
                if (chart && typeof chart.resize === 'function') {
                    chart.resize();
                }
            });
        }
        
        addDebugInfo() {
            if (!this.debugMode) return;
            
            // Add debug panel
            const debugInfo = this.getDebugInfo();
            const $debugPanel = $(`
                <div id="senior-debug-panel" style="
                    position: fixed;
                    bottom: 10px;
                    right: 10px;
                    background: rgba(0,0,0,0.8);
                    color: white;
                    padding: 10px;
                    border-radius: 5px;
                    font-size: 11px;
                    z-index: 9999;
                    max-width: 300px;
                    display: none;
                ">
                    <div><strong>📱 Mobile Dashboard Debug</strong></div>
                    <div>Screen: ${debugInfo.screenWidth}×${debugInfo.screenHeight}</div>
                    <div>Sidebar: ${debugInfo.sidebarVisible ? '✅ Visible' : '❌ Hidden'}</div>
                    <div>Sidebar Size: ${debugInfo.sidebarWidth}×${debugInfo.sidebarHeight}</div>
                    <div>Breakpoint: ${debugInfo.breakpoint}</div>
                    <div>Touch: ${debugInfo.touchSupport ? '✅' : '❌'}</div>
                </div>
            `);
            
            $('body').append($debugPanel);
            
            // Toggle debug panel with Ctrl+Shift+D
            $(document).on('keydown', function(e) {
                if (e.ctrlKey && e.shiftKey && e.key === 'D') {
                    $debugPanel.toggle();
                }
            });
        }
        
        getDebugInfo() {
            const $sidebar = $('.sidebar');
            return {
                screenWidth: $(window).width(),
                screenHeight: $(window).height(),
                sidebarVisible: $sidebar.is(':visible'),
                sidebarWidth: $sidebar.width(),
                sidebarHeight: $sidebar.height(),
                breakpoint: this.getCurrentBreakpoint(),
                touchSupport: 'ontouchstart' in window
            };
        }
        
        getCurrentBreakpoint() {
            const width = $(window).width();
            if (width <= 480) return 'xs';
            if (width <= 768) return 'sm';
            if (width <= 992) return 'md';
            if (width <= 1200) return 'lg';
            return 'xl';
        }
        
        logStatus() {
            const status = {
                initialized: this.isInitialized,
                screenWidth: $(window).width(),
                sidebarVisible: $('.sidebar').is(':visible'),
                sidebarWidth: $('.sidebar').width(),
                jQuery: $.fn.jquery,
                chartJs: typeof Chart !== 'undefined',
                googleCharts: typeof google !== 'undefined' && !!google.charts,
                bootstrap: typeof $.fn.modal !== 'undefined'
            };
            
            console.log('🎯 Senior Mobile Dashboard Status:', status);
            
            if (status.sidebarVisible) {
                console.log('✅ SUCCESS: Sidebar is visible on mobile!');
            } else {
                console.error('❌ FAILED: Sidebar is still not visible on mobile!');
            }
        }
    }
    
    // Initialize senior mobile dashboard
    const seniorDashboard = new SeniorMobileDashboard();
    
    // Add touch feedback CSS
    if (!$('#senior-touch-styles').length) {
        $('head').append(`
            <style id="senior-touch-styles">
                .touch-active {
                    opacity: 0.8 !important;
                    transform: scale(0.98) !important;
                    transition: all 0.1s ease !important;
                }
                
                @media (max-width: 768px) {
                    .sidebar {
                        border-right: 2px solid #e3e6f0 !important;
                        box-shadow: 2px 0 5px rgba(0,0,0,0.1) !important;
                    }
                    
                    .sidebar::after {
                        content: "📱";
                        position: absolute;
                        top: 10px;
                        right: 10px;
                        font-size: 12px;
                        opacity: 0.5;
                    }
                }
            </style>
        `);
    }
    
    console.log('🎉 Senior Level Mobile Dashboard Fully Loaded!');
    console.log('💡 Press Ctrl+Shift+D to toggle debug panel');
});