export class NavbarManager {
    constructor() {
        this.lastScrollY = 0;
        this.navbar = document.getElementById('navbar');
        this.ticking = false;
        this.init();
    }

    init() {
        this.setupScrollListener();
        this.setupSmoothScrolling();
    }

    updateNavbar() {
        const currentScrollY = window.scrollY;

        if (currentScrollY > 50) {
            this.navbar.classList.add('bg-white/95', 'backdrop-blur-md', 'shadow-xl');
            this.navbar.classList.remove('bg-transparent');

            // Update text colors for better contrast
            this.navbar.querySelectorAll('.nav-link, h1').forEach(el => {
                el.classList.add('!text-gray-900');
                el.classList.remove('text-white', 'text-white/80');
            });
        } else {
            this.navbar.classList.remove('bg-white/95', 'backdrop-blur-md', 'shadow-xl');
            this.navbar.classList.add('bg-transparent');

            // Restore original colors
            this.navbar.querySelectorAll('.nav-link').forEach(el => {
                el.classList.remove('!text-gray-900');
                el.classList.add('text-white/80');
            });
            this.navbar.querySelector('h1').classList.remove('!text-gray-900');
            this.navbar.querySelector('h1').classList.add('text-white');
        }

        this.lastScrollY = currentScrollY;
    }

    setupScrollListener() {
        window.addEventListener('scroll', () => {
            if (!this.ticking) {
                requestAnimationFrame(() => {
                    this.updateNavbar();
                    this.ticking = false;
                });
                this.ticking = true;
            }
        });
    }

    setupSmoothScrolling() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });
    }
}
