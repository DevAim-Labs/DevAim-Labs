export function initThemeToggle() {
    const toggle = () => {
        const html = document.documentElement
        const next = html.getAttribute('data-theme') === 'light' ? 'dark' : 'light'
        html.setAttribute('data-theme', next)
        localStorage.setItem('theme', next)
    }

    document.querySelectorAll('[data-theme-toggle]').forEach((btn) => {
        btn.addEventListener('click', toggle)
    })
}
