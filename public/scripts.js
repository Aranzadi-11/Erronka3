document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".carousel").forEach(carousel => {
        let images = carousel.getAttribute("data-images").split(",");
        let imgElement = carousel.querySelector("img");
        let currentIndex = 0;

        carousel.querySelector(".prev").addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + images.length) % images.length;
            imgElement.src = images[currentIndex];
        });

        carousel.querySelector(".next").addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % images.length;
            imgElement.src = images[currentIndex];
        });
    });
});
