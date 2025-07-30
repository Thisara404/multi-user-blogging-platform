export class NavbarManager {
    constructor() {
        this.lastScrollY = 0;
        this.navbar = document.getElementById("navbar");
        this.ticking = false;

        // Check if navbar exists before initializing
        if (this.navbar) {
            this.init();
        }
    }

    init() {
        this.setupScrollListener();
        this.setupSmoothScrolling();
    }

    updateNavbar() {
        // Add null check
        if (!this.navbar) return;

        const currentScrollY = window.scrollY;

        if (currentScrollY > 50) {
            this.navbar.classList.add(
                "bg-white/95",
                "backdrop-blur-md",
                "shadow-xl"
            );
            this.navbar.classList.remove("bg-transparent");

            // Apply gradient text for nav links and logo
            this.navbar.querySelectorAll(".nav-link, h1").forEach((el) => {
                if (el && el.classList) { // Add safety check
                    el.classList.add(
                        "bg-gradient-to-r",
                        "from-orange-500",
                        "via-pink-500",
                        "to-pink-400",
                        "bg-clip-text",
                        "text-transparent"
                    );
                    el.classList.remove(
                        "text-white",
                        "text-white/80",
                        "!text-gray-900",
                        "hover:text-white",
                        "hover:!text-white",
                        "hover:text-yellow-400",
                        "hover:text-pink-500"
                    );
                }
            });
        } else {
            this.navbar.classList.remove(
                "bg-white/95",
                "backdrop-blur-md",
                "shadow-xl"
            );
            this.navbar.classList.add("bg-transparent");

            // Restore gradient text for nav links and logo
            this.navbar.querySelectorAll(".nav-link, h1").forEach((el) => {
                if (el && el.classList) { // Add safety check
                    el.classList.add(
                        "bg-gradient-to-r",
                        "from-pink-400",
                        "via-orange-400",
                        "to-pink-300",
                        "bg-clip-text",
                        "text-transparent"
                    );
                }
            });
        }

        this.lastScrollY = currentScrollY;
    }

    setupScrollListener() {
        window.addEventListener("scroll", () => {
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
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener("click", function (e) {
                e.preventDefault();
                const target = document.querySelector(
                    this.getAttribute("href")
                );
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition =
                        elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: "smooth",
                    });
                }
            });
        });
    }
}
