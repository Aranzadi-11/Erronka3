document.addEventListener('DOMContentLoaded', function() {
    const carousels = document.querySelectorAll('.carousel');

    carousels.forEach(carousel => {
        const prevButton = carousel.querySelector('.prev');
        const nextButton = carousel.querySelector('.next');
        const images = carousel.querySelectorAll('img');
        let currentIndex = 0;

        // Ocultar botones si hay solo una imagen
        if (images.length <= 1) {
            prevButton.style.display = 'none';
            nextButton.style.display = 'none';
        }

        prevButton.addEventListener('click', function() {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            updateCarousel();
        });

        nextButton.addEventListener('click', function() {
            currentIndex = (currentIndex + 1) % images.length;
            updateCarousel();
        });

        function updateCarousel() {
            images.forEach((img, index) => {
                img.style.display = index === currentIndex ? 'block' : 'none';
            });
        }

        updateCarousel(); // Inicializa el carrusel
    });
});
