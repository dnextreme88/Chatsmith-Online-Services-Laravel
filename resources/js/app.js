import './bootstrap';
import { Observer } from 'tailwindcss-intersect';

Observer.start();

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
