
       document.querySelectorAll('.carousel').forEach(carousel => {
    const images = carousel.querySelector('.carousel-images');
    const totalImages = images.children.length;
    let index = 0;

    function updateCarousel() {
        images.style.transform = `translateX(-${index * 600}px)`;
    }

    carousel.querySelector('.next').addEventListener('click', function (e) {
        e.preventDefault();
        index = (index + 1) % totalImages;
        updateCarousel();
    });

    carousel.querySelector('.prev').addEventListener('click', function (e) {
        e.preventDefault();
        index = (index - 1 + totalImages) % totalImages;
        updateCarousel();
    });

    // <<--- FULLSCREEN IMAGE FEATURE FOR CAROUSEl --->
    Array.from(images.children).forEach(img => {
        img.addEventListener('click', function () {
            const modal = document.getElementById('carousel-fullscreen');
            const modalImg = document.getElementById('carousel-fullscreen-img');
            modalImg.src = this.src;
            modal.style.display = 'flex';
        });
    });

    updateCarousel();
});

// Modal close (outside carousel loop)
document.getElementById('carousel-close').addEventListener('click', function () {
    document.getElementById('carousel-fullscreen').style.display = 'none';
});
document.getElementById('carousel-fullscreen').addEventListener('click', function (e) {
    if (e.target === this) {
        this.style.display = 'none';
    }
});
