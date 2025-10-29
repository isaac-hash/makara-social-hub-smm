// Intersection Observer setup for animations
document.addEventListener('DOMContentLoaded', () => {
    // Set up the Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1, // Trigger when at least 10% of the element is visible
        rootMargin: '50px' // Start animation slightly before the element comes into view
    });

    // Observe all elements with animation classes
    document.querySelectorAll('.fade-up, .fade-in-left, .fade-in-right, .scale-up').forEach(el => {
        observer.observe(el);
    });

    // Optional: Add animation to elements that are already visible on page load
    setTimeout(() => {
        document.querySelectorAll('.fade-up, .fade-in-left, .fade-in-right, .scale-up').forEach(el => {
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight) {
                el.classList.add('visible');
            }
        });
    }, 100);
});