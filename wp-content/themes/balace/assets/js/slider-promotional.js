

document.addEventListener('DOMContentLoaded', function() {
const swiper = new Swiper('.swiper-container.promotional-swiper', {
    navigation: {
        nextEl: '.btn_slider_left',
        prevEl: '.btn_slider_right',
    },
    slidesPerView: 3,
    spaceBetween: 20,
    loop: true,
});

});
