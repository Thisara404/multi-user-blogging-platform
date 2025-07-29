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
            this.navbar.classList.add('bg-gradient-to-r', 'from-orange-900', 'via-yellow-700', 'to-orange-500', 'backdrop-blur-md', 'shadow-xl');
            this.navbar.classList.remove('bg-transparent');

            // Update text colors for better contrast using gradient-like classes
            this.navbar.querySelectorAll('.nav-link, h1').forEach(el => {
                el.classList.add('text-transparent', 'bg-clip-text', 'bg-gradient-to-r', 'from-yellow-300', 'to-orange-700');
                el.classList.remove('text-white', 'text-white/80', '!text-gray-900');
            });
        } else {
            this.navbar.classList.remove('bg-gradient-to-r', 'from-orange-900', 'via-yellow-700', 'to-orange-500', 'backdrop-blur-md', 'shadow-xl');
            this.navbar.classList.add('bg-transparent');

            // Restore original gradient text colors
            this.navbar.querySelectorAll('.nav-link, h1').forEach(el => {
                el.classList.remove('text-transparent', 'bg-clip-text', 'bg-gradient-to-r', 'from-yellow-300', 'to-orange-700', '!text-gray-900');
                el.classList.add('text-transparent', 'bg-clip-text', 'bg-gradient-to-r', 'from-orange-400', 'to-yellow-500');
            });
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
