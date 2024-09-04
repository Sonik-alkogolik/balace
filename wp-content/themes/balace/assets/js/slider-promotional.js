

document.addEventListener('DOMContentLoaded', function() {
    const swiper = new Swiper('.swiper-container.promotional-swiper', {
        navigation: {
            nextEl: '.btn_slider_right',
            prevEl: '.btn_slider_left',
        },
        slidesPerView: 3,
        spaceBetween: 20,
        loop: true,
        speed: 600, 
        touchRatio: 1,
    simulateTouch: true,
    touchAngle: 45,
    shortSwipes: true,
    longSwipes: true,
    longSwipesRatio: 0.5,
    longSwipesMs: 300,
    followFinger: true,
        breakpoints: {
            1920: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1350: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            1024: {
                slidesPerView: 2.5,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 1.5,
                spaceBetween: 15,
            },
          
        }
    });

});
