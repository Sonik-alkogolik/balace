document.addEventListener('DOMContentLoaded', function() {
const swiper = new Swiper('.company-history .swiper-container', {
    slidesPerView: 3,
    spaceBetween: 30,
    navigation: {
      nextEl: '.company-history .swiper-button-next',
      prevEl: '.company-history .swiper-button-prev',
    },
    breakpoints: {
      1920:{
          slidesPerView: 3,
      },
      1024: {
          slidesPerView: 3,
          spaceBetween: 15, 
      },
      720: {
          slidesPerView: 2,
          spaceBetween: 15, 
      },
      420: {
        slidesPerView: 1.5,
        spaceBetween: 15, 
      },
      375: {
          slidesPerView: 1.3,
          spaceBetween: 15, 
      },
      320: {
          slidesPerView: 1,
          spaceBetween: 15, 
      }
      
  }
  });
});