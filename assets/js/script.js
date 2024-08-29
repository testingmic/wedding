document.addEventListener('DOMContentLoaded', function() {
    let slideshows = document.querySelectorAll('.slideshow-container');
    slideshows.forEach(function(slideshow) {
        initializeSlideshow(slideshow);
    });
    console.log('slideshows:', slideshows);
});

function initializeSlideshow(slideshow) {
    let slideIndex = 0;
    showSlides();

    function showSlides() {
        let slides = slideshow.getElementsByClassName("slide");
        for (let i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}
        slides[slideIndex-1].style.display = "block";
        setTimeout(showSlides, 5000); // Change image every 5 seconds
    }
}

function changeSlide(n, slideshow) {
    let slides = slideshow.getElementsByClassName("slide");
    let slideIndex = parseInt(slideshow.getAttribute('data-slide-index') || 0);
    slideIndex += n;
    if (slideIndex > slides.length) {slideIndex = 1}
    if (slideIndex < 1) {slideIndex = slides.length}
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
    slideshow.setAttribute('data-slide-index', slideIndex);
}