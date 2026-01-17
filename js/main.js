
/**
 * Main JavaScript
 */

document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const menuButton = document.querySelector('.menu-toggle');
    const mainNav = document.querySelector('.main-navigation');

    if (menuButton) {
        menuButton.addEventListener('click', function() {
            mainNav.classList.toggle('active');
            menuButton.classList.toggle('active');
        });

        // Close menu when clicking on a link
        const navLinks = mainNav.querySelectorAll('a');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                mainNav.classList.remove('active');
                menuButton.classList.remove('active');
            });
        });
    }

    // Smooth Scroll
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });

    // Add active class to current navigation item
    const currentUrl = window.location.href;
    const navLinks = document.querySelectorAll('.main-navigation a');
    navLinks.forEach(link => {
        if (link.href === currentUrl) {
            link.parentElement.classList.add('current-menu-item');
        }
    });

    // Lazy Loading
    if ('IntersectionObserver' in window) {
        const images = document.querySelectorAll('img');
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    observer.unobserve(entry.target);
                }
            });
        });

        images.forEach(img => {
            img.style.opacity = '0';
            img.style.transition = 'opacity 0.3s ease';
            imageObserver.observe(img);
        });
    }

    // Staff Slideshow
    let slideIndex = 1;
    showSlide(slideIndex);
});

// Slideshow Functions
let slideShowTimer;

function changeSlide(n) {
    clearTimeout(slideShowTimer);
    showSlide(slideIndex += n);
    autoSlide();
}

function currentSlide(n) {
    clearTimeout(slideShowTimer);
    showSlide(slideIndex = n);
    autoSlide();
}

function showSlide(n) {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.dot');

    if (slides.length === 0) return;

    if (n > slides.length) {
        slideIndex = 1;
    }
    if (n < 1) {
        slideIndex = slides.length;
    }

    slides.forEach(slide => {
        slide.classList.remove('fade');
    });
    dots.forEach(dot => {
        dot.classList.remove('active');
    });

    if (slides[slideIndex - 1]) {
        slides[slideIndex - 1].classList.add('fade');
    }
    if (dots[slideIndex - 1]) {
        dots[slideIndex - 1].classList.add('active');
    }
}

function autoSlide() {
    slideShowTimer = setTimeout(() => {
        slideIndex++;
        showSlide(slideIndex);
        autoSlide();
    }, 5000);
}

// Auto-start slideshow
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector('.slideshow-container')) {
        autoSlide();
    }
});

