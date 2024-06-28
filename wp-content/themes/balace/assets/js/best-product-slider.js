document.addEventListener('DOMContentLoaded', function() {
    var mySwiper = new Swiper('.best_products', {
        // Опции Swiper
        slidesPerView: 4,  // Количество слайдов, видимых одновременно
        spaceBetween: 20,  // Расстояние между слайдами
        loop: true,        // Бесконечный цикл слайдера

        // Навигация по слайдам
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
  });