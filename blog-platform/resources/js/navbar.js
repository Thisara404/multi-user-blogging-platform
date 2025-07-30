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
            // Scrolled state - white background with dark text
            this.navbar.classList.add(
                "bg-white/95",
                "backdrop-blur-md",
                "shadow-xl"
            );
            this.navbar.classList.remove("bg-transparent");

            // Apply dark gradient text for nav links and logo when scrolled
            this.navbar.querySelectorAll(".nav-link").forEach((el) => {
                if (el && el.classList) {
                    // Remove all previous color classes
                    el.classList.remove(
                        "text-white",
                        "text-white/80",
                        "text-transparent",
                        "bg-gradient-to-r",
                        "from-pink-400",
                        "via-orange-400",
                        "to-pink-300",
                        "bg-clip-text"
                    );

                    // Add dark gradient for scrolled state
                    el.classList.add(
                        "bg-gradient-to-r",
                        "from-blue-600",
                        "via-purple-600",
                        "to-pink-600",
                        "bg-clip-text",
                        "text-transparent"
                    );
                }
            });

            // Handle navbar logo
            const navbarLogo = this.navbar.querySelector("h1");
            if (navbarLogo) {
                navbarLogo.classList.remove(
                    "text-white",
                    "text-white/80",
                    "text-transparent",
                    "bg-gradient-to-r",
                    "from-pink-400",
                    "via-orange-400",
                    "to-pink-300",
                    "bg-clip-text"
                );

                navbarLogo.classList.add(
                    "bg-gradient-to-r",
                    "from-blue-600",
                    "via-purple-600",
                    "to-pink-600",
                    "bg-clip-text",
                    "text-transparent"
                );
            }

            // Handle auth buttons
            this.navbar.querySelectorAll("a[href*='login'], a[href*='register']").forEach((el) => {
                if (el.textContent.includes('Sign In') || el.href.includes('login')) {
                    // Login button - make it visible with dark text
                    el.classList.remove("text-white/80", "text-white");
                    el.classList.add("text-gray-700", "hover:text-gray-900");
                } else if (el.textContent.includes('Get Started') || el.href.includes('register')) {
                    // Register button - keep the styling but ensure visibility
                    el.classList.add("bg-blue-600", "text-white", "hover:bg-blue-700");
                }
            });

        } else {
            // Transparent state - transparent background with white text
            this.navbar.classList.remove(
                "bg-white/95",
                "backdrop-blur-md",
                "shadow-xl"
            );
            this.navbar.classList.add("bg-transparent");

            // Restore white/light text for transparent state
            this.navbar.querySelectorAll(".nav-link").forEach((el) => {
                if (el && el.classList) {
                    // Remove scrolled state classes
                    el.classList.remove(
                        "bg-gradient-to-r",
                        "from-blue-600",
                        "via-purple-600",
                        "to-pink-600",
                        "bg-clip-text",
                        "text-transparent"
                    );

                    // Add white text for transparent state
                    el.classList.add("text-white/80");
                }
            });

            // Handle navbar logo for transparent state
            const navbarLogo = this.navbar.querySelector("h1");
            if (navbarLogo) {
                navbarLogo.classList.remove(
                    "bg-gradient-to-r",
                    "from-blue-600",
                    "via-purple-600",
                    "to-pink-600",
                    "bg-clip-text",
                    "text-transparent"
                );

                navbarLogo.classList.add("text-white");
            }

            // Handle auth buttons for transparent state
            this.navbar.querySelectorAll("a[href*='login'], a[href*='register']").forEach((el) => {
                if (el.textContent.includes('Sign In') || el.href.includes('login')) {
                    // Login button - white text on transparent
                    el.classList.remove("text-gray-700", "text-gray-900");
                    el.classList.add("text-white/80", "hover:text-white");
                } else if (el.textContent.includes('Get Started') || el.href.includes('register')) {
                    // Register button - keep white background for visibility
                    el.classList.add("bg-white", "text-blue-600", "hover:bg-gray-100");
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
