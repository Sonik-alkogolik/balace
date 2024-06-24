document.addEventListener('DOMContentLoaded', function() {
    function initializeSwiper() {
        new Swiper('.advantages-swiper-container', {
            slidesPerView: 'auto',
            breakpoints: {
                768: {
                    slidesPerView: 'auto',
                    spaceBetween: 20
                }
            }
        });
    }
    initializeSwiper();
    window.addEventListener('resize', initializeSwiper);
  });