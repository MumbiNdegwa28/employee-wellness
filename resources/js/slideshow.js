// slideshow.js
document.addEventListener("DOMContentLoaded", function () {
    let slideIndex = 0;
    const slides = document.querySelectorAll(".slideshow-image");
    const totalSlides = slides.length;

    function showSlides() {
        for (let i = 0; i < totalSlides; i++) {
            slides[i].classList.remove("active");
        }

        slideIndex++;
        if (slideIndex > totalSlides) { slideIndex = 1; }
        slides[slideIndex - 1].classList.add("active");

        setTimeout(showSlides, 8000); // Change image every 3 seconds
    }

    showSlides();
});
