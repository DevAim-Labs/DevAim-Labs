export function initThemeToggle() {
    const toggle = () => {
        const html = document.documentElement
        const next = html.getAttribute('data-theme') === 'light' ? 'dark' : 'light'

        // Add transition class for smooth color change
        html.classList.add('theme-transition')

        // Change theme
        html.setAttribute('data-theme', next)
        localStorage.setItem('theme', next)

        // Remove transition class after animation completes
        setTimeout(() => {
            html.classList.remove('theme-transition')
        }, 300)
    }

    document.querySelectorAll('[data-theme-toggle]').forEach((btn) => {
        btn.addEventListener('click', toggle)
    })
}
