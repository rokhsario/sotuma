// script.js - Custom scripts for MAS Enterprise landing page

document.addEventListener('DOMContentLoaded', function() {
    // Hamburger menu toggle
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    let navOverlay = document.querySelector('.nav-overlay');
    if (!navOverlay) {
        navOverlay = document.createElement('div');
        navOverlay.className = 'nav-overlay hide';
        document.body.appendChild(navOverlay);
    }
    function openMenu() {
        navMenu.classList.add('active');
        navOverlay.classList.remove('hide');
        document.body.classList.add('menu-open');
    }
    function closeMenu() {
        navMenu.classList.remove('active');
        navOverlay.classList.add('hide');
        document.body.classList.remove('menu-open');
    }
    if (hamburger && navMenu) {
        hamburger.addEventListener('click', function() {
            if (navMenu.classList.contains('active')) {
                closeMenu();
            } else {
                openMenu();
            }
        });
        navOverlay.addEventListener('click', closeMenu);
        // Close menu on nav link click (mobile)
        navMenu.querySelectorAll('a').forEach(function(link) {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 900) closeMenu();
            });
        });
        // Close menu on language select
        const langSelect = document.querySelector('.lang-select');
        if (langSelect) {
            langSelect.addEventListener('change', function() {
                if (window.innerWidth <= 900) closeMenu();
            });
        }
    }
    // Custom language dropdown with flags
    (function() {
        const dropdown = document.querySelector('.custom-lang-dropdown');
        if (!dropdown) return;
        const selected = dropdown.querySelector('.selected-lang');
        const options = dropdown.querySelector('.lang-options');
        const input = document.getElementById('lang-input');
        const form = dropdown.closest('form');
        let open = false;

        function openDropdown() {
            dropdown.classList.add('open');
            open = true;
        }
        function closeDropdown() {
            dropdown.classList.remove('open');
            open = false;
        }
        selected.addEventListener('click', function(e) {
            e.stopPropagation();
            open ? closeDropdown() : openDropdown();
        });
        dropdown.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') closeDropdown();
        });
        document.addEventListener('click', function(e) {
            if (!dropdown.contains(e.target)) closeDropdown();
        });
        options.querySelectorAll('.lang-option-item').forEach(function(opt) {
            opt.addEventListener('click', function() {
                const lang = this.getAttribute('data-lang');
                input.value = lang;
                form.submit();
            });
            if (input.value === opt.getAttribute('data-lang')) {
                opt.classList.add('selected');
            } else {
                opt.classList.remove('selected');
            }
        });
    })();
    // Add more custom JS as needed
}); 