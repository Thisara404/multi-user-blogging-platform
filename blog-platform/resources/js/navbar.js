export class NavbarManager {
    constructor() {
        this.lastScrollY = 0;
        this.navbar = document.getElementById("navbar");
        this.ticking = false;

        // Check if navbar exists before initializing
        if (this.navbar) {
            this.init();
            // Set initial state immediately
            this.setInitialState();
        }
    }

    init() {
        this.setupScrollListener();
        this.setupSmoothScrolling();
    }

    setInitialState() {
        // Ensure initial transparent state is properly set
        this.navbar.classList.add("bg-transparent");
        this.navbar.classList.remove("bg-white/95", "backdrop-blur-md", "shadow-xl");

        // Set initial white text for all nav elements
        this.navbar.querySelectorAll(".nav-link").forEach((el) => {
            if (el && el.classList) {
                el.classList.add("text-white/90");
                el.classList.remove(
                    "bg-gradient-to-r",
                    "from-blue-600",
                    "via-purple-600",
                    "to-pink-600",
                    "bg-clip-text",
                    "text-transparent",
                    "text-gray-700",
                    "text-gray-900"
                );
            }
        });

        // Set initial white text for logo
        const navbarLogo = this.navbar.querySelector("h1");
        if (navbarLogo) {
            navbarLogo.classList.add("text-white");
            navbarLogo.classList.remove(
                "bg-gradient-to-r",
                "from-blue-600",
                "via-purple-600",
                "to-pink-600",
                "bg-clip-text",
                "text-transparent"
            );
        }
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

            // Apply dark gradient text for nav links when scrolled
            this.navbar.querySelectorAll(".nav-link").forEach((el) => {
                if (el && el.classList) {
                    // Remove all previous color classes
                    el.classList.remove(
                        "text-white",
                        "text-white/80",
                        "text-white/90",
                        "text-transparent"
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
                navbarLogo.classList.remove("text-white", "text-white/80");
                navbarLogo.classList.add(
                    "bg-gradient-to-r",
                    "from-blue-600",
                    "via-purple-600",
                    "to-pink-600",
                    "bg-clip-text",
                    "text-transparent"
                );
            }

            // Handle auth buttons for scrolled state
            this.navbar.querySelectorAll("a[href*='login'], a[href*='register']").forEach((el) => {
                if (el.textContent.includes('Sign In') || el.href.includes('login')) {
                    // Login button - make it visible with dark text
                    el.classList.remove("text-white/90", "text-white", "hover:text-white");
                    el.classList.add("text-gray-700", "hover:text-gray-900");
                }
                // Register button already has white background, so it's always visible
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
                        "text-transparent",
                        "text-gray-700",
                        "text-gray-900"
                    );

                    // Add white text for transparent state
                    el.classList.add("text-white/90", "hover:text-white");
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
                    el.classList.remove("text-gray-700", "text-gray-900", "hover:text-gray-900");
                    el.classList.add("text-white/90", "hover:text-white");
                }
                // Register button keeps white background for visibility
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
