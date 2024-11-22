import './bootstrap';
import { Observer } from 'tailwindcss-intersect';

// REF: https://livewire.laravel.com/docs/navigate#dont-rely-on-domcontentloaded
document.addEventListener('livewire:navigated', () => {
    Observer.start();

    console.log('LOG: Libs initialized');
});

window.darkModeSwitcher = function() {
    return {
        switchOn: JSON.parse(localStorage.getItem('cosIsDarkMode')) || false,
        switchTheme() {
            if (this.switchOn) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }

            localStorage.setItem('cosIsDarkMode', this.switchOn);

            console.log('Dark mode:', this.switchOn);
        },
        init() {
            this.switchTheme();
        }
    }
}
