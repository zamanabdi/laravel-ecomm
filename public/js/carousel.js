const carousel = document.getElementById('carousel');

function slideLeft() {
    carousel.scrollBy({ left: -400, behavior: 'smooth' });
}

function slideRight() {
    carousel.scrollBy({ left: 400, behavior: 'smooth' });
}
