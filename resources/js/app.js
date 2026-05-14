import './bootstrap';
import { init, toggle, getCurrentTheme } from './theme-manager.js';

// Initialize theme immediately (module-level)
init();

/**
 * Update sun/moon icon visibility based on current theme.
 */
function updateIcons() {
    const theme = getCurrentTheme();
    const sunIcons = document.querySelectorAll('.theme-icon-sun');
    const moonIcons = document.querySelectorAll('.theme-icon-moon');

    sunIcons.forEach(icon => {
        icon.classList.toggle('hidden', theme !== 'dark');
    });
    moonIcons.forEach(icon => {
        icon.classList.toggle('hidden', theme !== 'light');
    });
}

document.addEventListener('DOMContentLoaded', () => {
    // --- Theme toggle wiring ---
    const toggleButtons = document.querySelectorAll('#theme-toggle-desktop, #theme-toggle-mobile');

    toggleButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            // Add transition class for smooth color switch
            document.documentElement.classList.add('theme-transition');

            toggle();
            updateIcons();

            // Remove transition class after animation completes
            setTimeout(() => {
                document.documentElement.classList.remove('theme-transition');
            }, 250);
        });
    });

    // Set initial icon state
    updateIcons();

    // --- Mobile hamburger menu toggle ---
    const menuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const iconOpen = document.getElementById('menu-icon-open');
    const iconClose = document.getElementById('menu-icon-close');

    if (menuBtn && mobileMenu) {
        menuBtn.addEventListener('click', () => {
            const isExpanded = menuBtn.getAttribute('aria-expanded') === 'true';
            menuBtn.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    }

    // --- Scroll-triggered animations (IntersectionObserver) ---
    const scrollElements = document.querySelectorAll('.animate-on-scroll');
    if (scrollElements.length > 0) {
        // Check if IntersectionObserver is supported
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.01 });

            scrollElements.forEach(el => observer.observe(el));
        } else {
            // Fallback: make all visible immediately
            scrollElements.forEach(el => el.classList.add('visible'));
        }
    }
});
