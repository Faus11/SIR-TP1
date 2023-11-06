// slideshow.js

function startSlideshow() {
    var images = document.querySelectorAll(".slideshow img");
    var currentIndex = 0;

    setInterval(function () {
        images[currentIndex].style.display = "none";
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].style.display = "block";
    }, 3000);
}

window.onload = startSlideshow;
