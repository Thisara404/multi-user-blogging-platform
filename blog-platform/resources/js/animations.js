export class AnimationManager {
    constructor() {
        this.statsAnimated = false;
        this.init();
    }

    init() {
        this.setupScrollReveal();
        this.setupFeatureCardEffects();
        this.setupStatsAnimation();
    }

    setupScrollReveal() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                }
            });
        }, observerOptions);

        // Observe all scroll-reveal elements
        document.querySelectorAll('.scroll-reveal').forEach(el => {
            observer.observe(el);
        });
    }

    setupFeatureCardEffects() {
        document.querySelectorAll('.feature-card').forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.background = 'linear-gradient(145deg, #ffffff 0%, #f0f9ff 100%)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.background = 'linear-gradient(145deg, #ffffff 0%, #f8fafc 100%)';
            });
        });
    }

    animateStats() {
        const statsElements = document.querySelectorAll('.text-4xl.font-bold');
        statsElements.forEach(stat => {
            const rect = stat.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
                const finalValue = stat.textContent;
                const numericValue = parseInt(finalValue.replace(/\D/g, ''));
                const suffix = finalValue.replace(/[\d,]/g, '');

                let currentValue = 0;
                const increment = numericValue / 30;
                const counter = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= numericValue) {
                        stat.textContent = finalValue;
                        clearInterval(counter);
                    } else {
                        stat.textContent = Math.floor(currentValue) + suffix;
                    }
                }, 50);
            }
        });
    }

    setupStatsAnimation() {
        window.addEventListener('scroll', () => {
            if (!this.statsAnimated) {
                const statsSection = document.querySelector('.mt-16.grid.grid-cols-3');
                if (statsSection) {
                    const rect = statsSection.getBoundingClientRect();
                    if (rect.top < window.innerHeight) {
                        this.animateStats();
                        this.statsAnimated = true;
                    }
                }
            }
        });
    }
}
