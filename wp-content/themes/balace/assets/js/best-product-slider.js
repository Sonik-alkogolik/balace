document.addEventListener('DOMContentLoaded', function() {
    var mySwiper = new Swiper('.best_products', {
        slidesPerView: 4,  
        spaceBetween: 20, 
        loop: true,        
        navigation: {
            nextEl: '.swiper-button-next.best-slider-btn',
            prevEl: '.swiper-button-prev.best-slider-btn',
        },
        breakpoints: {
            1920:{
                slidesPerView: 4,
            },
            1024: {
                slidesPerView: 4,
            },
            720: {
                slidesPerView: 3,
            },
            375: {
                slidesPerView: 1.8,
                spaceBetween: 15, 
            },
            320: {
                slidesPerView: 1.5,
                spaceBetween: 15, 
            }
            
        }
    });
    
  });