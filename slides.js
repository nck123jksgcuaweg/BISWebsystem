let currentSlide = 0;
const slides = document.querySelectorAll('.slideshow-image');

function showSlide(index) {
    slides.forEach((slide, i) => {
        slide.classList.toggle('active', i === index);
    });
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}

setInterval(nextSlide, 4000); // Change image every 1 second

// Initial display
showSlide(currentSlide);





    
