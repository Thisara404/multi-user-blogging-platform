import './bootstrap';
import Alpine from 'alpinejs';
import { NavbarManager } from './navbar';
import { AnimationManager } from './animations';

window.Alpine = Alpine;
Alpine.start();

// Initialize custom components when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize navbar functionality
    new NavbarManager();

    // Initialize animations
    new AnimationManager();
});
