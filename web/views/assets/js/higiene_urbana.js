let currentSlide = 0;

    function showSlide(index) {
        const slides = document.querySelectorAll('.carousel-item');
        if (index >= slides.length) currentSlide = 0;
        if (index < 0) currentSlide = slides.length - 1;
        slides.forEach((slide, i) => {
            slide.style.display = i === currentSlide ? 'block' : 'none';
        });
    }

    function nextSlide() {
        showSlide(currentSlide + 1);
    }

    function prevSlide() {
        showSlide(currentSlide - 1);
    }

    // Initialize the carousel
    showSlide(currentSlide);

// Initialize the carousel
showSlide(currentIndex);


function scrollToClass(className) {
    // Encuentra el primer elemento con la clase dada
    const element = document.querySelector(`.${className}`);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
    }
    // Evita que el enlace realice el desplazamiento predeterminado del navegador
    return false;
}