document.addEventListener('DOMContentLoaded', function() {
    var swiper = new Swiper('.swiper-container-article', {
        slidesPerView: 3,
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            768: {
                slidesPerView: 1,
                spaceBetween: 20
            },
            992: {
                slidesPerView: 2,
                spaceBetween: 30
            }
        }
    });
});