document.addEventListener('DOMContentLoaded', function () {
    const carousels = document.querySelectorAll('.carousel');
    carousels.forEach(carousel => {
        const images = carousel.getAttribute('data-images').split(',');
        let currentImageIndex = 0;
        const imgElement = carousel.querySelector('.carousel-image');
        const prevButton = carousel.querySelector('.prev');
        const nextButton = carousel.querySelector('.next');

        function updateImage() {
            imgElement.src = images[currentImageIndex];
        }

        if (prevButton) {
            prevButton.addEventListener('click', () => {
                currentImageIndex = (currentImageIndex > 0) ? currentImageIndex - 1 : images.length - 1;
                updateImage();
            });
        }

        if (nextButton) {
            nextButton.addEventListener('click', () => {
                currentImageIndex = (currentImageIndex < images.length - 1) ? currentImageIndex + 1 : 0;
                updateImage();
            });
        }
    });
});