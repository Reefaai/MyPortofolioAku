/**
 * Theme Manager — handles dark/light mode switching
 * Uses localStorage for persistence and system preference as fallback.
 */

const STORAGE_KEY = 'theme-preference';

/**
 * Read stored theme preference from localStorage.
 * @returns {'dark'|'light'|null}
 */
export function getStoredTheme() {
    try {
        return localStorage.getItem(STORAGE_KEY);
    } catch {
        return null;
    }
}

/**
 * Detect system color scheme preference.
 * @returns {'dark'|'light'}
 */
export function getSystemTheme() {
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        return 'dark';
    }
    return 'light';
}

/**
 * Apply theme by adding/removing `dark` class on <html>.
 * @param {'dark'|'light'} theme
 */
export function applyTheme(theme) {
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
}

/**
 * Persist theme to localStorage and apply it.
 * @param {'dark'|'light'} theme
 */
export function setTheme(theme) {
    try {
        localStorage.setItem(STORAGE_KEY, theme);
    } catch {
        // localStorage unavailable — still apply visually
    }
    applyTheme(theme);
}

/**
 * Toggle between dark and light, persisting the new value.
 */
export function toggle() {
    const current = getCurrentTheme();
    const next = current === 'dark' ? 'light' : 'dark';
    setTheme(next);
}

/**
 * Read current theme from the DOM class state.
 * @returns {'dark'|'light'}
 */
export function getCurrentTheme() {
    return document.documentElement.classList.contains('dark') ? 'dark' : 'light';
}

/**
 * Initialize theme on page load — applies stored preference or system default.
 */
export function init() {
    const stored = getStoredTheme();
    const theme = stored || getSystemTheme();
    applyTheme(theme);
}
