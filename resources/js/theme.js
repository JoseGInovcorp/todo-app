// Theme management for dark/light mode
class ThemeManager {
    constructor() {
        this.initTheme();
        this.bindEvents();
    }

    initTheme() {
        // Check for saved theme preference or default to 'light'
        const savedTheme = localStorage.getItem("theme");
        const prefersDark = window.matchMedia(
            "(prefers-color-scheme: dark)"
        ).matches;

        const theme = savedTheme || (prefersDark ? "dark" : "light");
        this.setTheme(theme);
    }

    setTheme(theme) {
        const html = document.documentElement;

        if (theme === "dark") {
            html.classList.add("dark");
            localStorage.setItem("theme", "dark");
        } else {
            html.classList.remove("dark");
            localStorage.setItem("theme", "light");
        }

        // Update toggle button icon if it exists
        this.updateToggleIcon(theme);
    }

    toggleTheme() {
        const currentTheme = document.documentElement.classList.contains("dark")
            ? "dark"
            : "light";
        const newTheme = currentTheme === "dark" ? "light" : "dark";
        this.setTheme(newTheme);
    }

    updateToggleIcon(theme) {
        // Use requestAnimationFrame to ensure smooth update without flash
        requestAnimationFrame(() => {
            const sunIcon = document.querySelector(".theme-toggle .sun-icon");
            const moonIcon = document.querySelector(".theme-toggle .moon-icon");
            const darkModeText = document.querySelector(".dark-mode-text");
            const lightModeText = document.querySelector(".light-mode-text");

            if (sunIcon && moonIcon) {
                // Disable transitions temporarily on toggle elements
                const toggleElements = [
                    sunIcon,
                    moonIcon,
                    darkModeText,
                    lightModeText,
                ].filter(Boolean);
                toggleElements.forEach((el) => {
                    el.style.transition = "none";
                });

                if (theme === "dark") {
                    sunIcon.classList.remove("hidden");
                    moonIcon.classList.add("hidden");
                    if (darkModeText) darkModeText.classList.add("hidden");
                    if (lightModeText) lightModeText.classList.remove("hidden");
                } else {
                    sunIcon.classList.add("hidden");
                    moonIcon.classList.remove("hidden");
                    if (darkModeText) darkModeText.classList.remove("hidden");
                    if (lightModeText) lightModeText.classList.add("hidden");
                }

                // Re-enable transitions after a frame
                setTimeout(() => {
                    toggleElements.forEach((el) => {
                        el.style.transition = "";
                    });
                }, 16);
            }
        });
    }

    bindEvents() {
        // Listen for toggle button clicks
        document.addEventListener("click", (e) => {
            if (e.target.closest(".theme-toggle")) {
                e.preventDefault();
                this.toggleTheme();
            }
        });

        // Listen for system theme changes
        window
            .matchMedia("(prefers-color-scheme: dark)")
            .addEventListener("change", (e) => {
                if (!localStorage.getItem("theme")) {
                    this.setTheme(e.matches ? "dark" : "light");
                }
            });
    }

    // Force apply current theme - useful for page changes
    forceApplyTheme() {
        const savedTheme = localStorage.getItem("theme");
        const prefersDark = window.matchMedia(
            "(prefers-color-scheme: dark)"
        ).matches;
        const theme = savedTheme || (prefersDark ? "dark" : "light");
        this.setTheme(theme);
    }
}

// Global function to ensure theme is applied correctly
window.applyStoredTheme = function () {
    const savedTheme = localStorage.getItem("theme");
    const prefersDark = window.matchMedia(
        "(prefers-color-scheme: dark)"
    ).matches;
    const theme = savedTheme || (prefersDark ? "dark" : "light");

    if (theme === "dark") {
        document.documentElement.classList.add("dark");
    } else {
        document.documentElement.classList.remove("dark");
    }
};

// Initialize theme manager when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
    window.themeManager = new ThemeManager();
});

// Also initialize on window load as backup
window.addEventListener("load", () => {
    if (!window.themeManager) {
        window.themeManager = new ThemeManager();
    } else {
        // Force reapply theme to ensure consistency
        window.themeManager.forceApplyTheme();
    }
});

// Reinitialize for Livewire navigation (if present)
document.addEventListener("livewire:navigated", () => {
    if (!window.themeManager) {
        window.themeManager = new ThemeManager();
    } else {
        // Update icons for new page elements
        const savedTheme = localStorage.getItem("theme");
        const prefersDark = window.matchMedia(
            "(prefers-color-scheme: dark)"
        ).matches;
        const theme = savedTheme || (prefersDark ? "dark" : "light");
        window.themeManager.updateToggleIcon(theme);
    }
});

// Also handle general page changes and navigation
window.addEventListener("popstate", () => {
    setTimeout(() => {
        if (window.themeManager) {
            window.themeManager.forceApplyTheme();
        }
    }, 100);
});

// Handle page visibility change (when returning from another tab)
document.addEventListener("visibilitychange", () => {
    if (!document.hidden && window.themeManager) {
        window.themeManager.forceApplyTheme();
    }
});

// Export for use in other scripts
window.ThemeManager = ThemeManager;
