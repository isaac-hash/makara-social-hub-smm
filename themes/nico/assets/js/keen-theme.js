// Keen Theme Components
document.addEventListener('alpine:init', () => {
    // Dark mode toggle
    Alpine.store('theme', {
        isDark: false,
        toggle() {
            this.isDark = !this.isDark;
            document.body.classList.toggle('dark-theme', this.isDark);
        }
    });

    // Counter animation
    Alpine.data('counter', (target) => ({
        current: 0,
        target: parseInt(target),
        init() {
            const duration = 2000;
            const steps = 50;
            const increment = this.target / steps;
            const stepDuration = duration / steps;
            
            const interval = setInterval(() => {
                this.current = Math.min(this.current + increment, this.target);
                if (this.current >= this.target) {
                    clearInterval(interval);
                }
            }, stepDuration);
        }
    }));

    // Testimonial carousel
    Alpine.data('testimonials', () => ({
        current: 0,
        items: [],
        init() {
            this.items = this.$root.querySelectorAll('.keen-testimonial');
        },
        next() {
            this.current = (this.current + 1) % this.items.length;
        },
        prev() {
            this.current = (this.current - 1 + this.items.length) % this.items.length;
        }
    }));
});