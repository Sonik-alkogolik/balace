jQuery(document).ready(function($) {
    var gallerySwiper = new Swiper('.product-gallery-slider', {
        loop: true, 
        navigation: {
            nextEl: '.btn_slider_right.card-slider-gallery',
            prevEl: '.btn_slider_left.card-slider-gallery',
        },
        slidesPerView: 1,
        spaceBetween: 10,
        centeredSlides: true, 
        speed: 800, 
        // autoplay: {
        //     delay: 5000, 
        //     disableOnInteraction: false 
        // },
        effect: 'fade', 
        fadeEffect: {
            crossFade: true 
        },
        allowTouchMove: false
    });
});
jQuery(document).ready(function($) {
    $('.deskription-product-item').click(function() {
        var $this = $(this);
        var $span = $this.children('p');
        if ($span.is(':visible')) {
            $span.slideUp();
            $this.removeClass('deskription-product-item-active'); 
        } else {
            $('.deskription-product-item p').slideUp();
            $span.slideDown();
            $('.deskription-product-item').removeClass('deskription-product-item-active'); 
            $this.addClass('deskription-product-item-active');
        }
    });

    
    // var $productCard = $('.product-card-item right');
    // var $productCardWrapp = $('.product-card-wrapp');
    
    // function updateDimensions() {
    //     stickyPoint = $productCardWrapp.offset().top;
    //     cardHeight = $productCard.outerHeight();
    //     cardWidth = $productCard.outerWidth();
    //     wrapperHeight = $productCardWrapp.outerHeight();
    //     wrapperTop = $productCardWrapp.offset().top;
    //     wrapperLeft = $productCardWrapp.offset().left;
    //     wrapperBottom = wrapperTop + wrapperHeight - 30;
    //     wrapperRight = wrapperLeft + $productCardWrapp.outerWidth() - cardWidth;
    // }

    // updateDimensions();

    // $(window).on('scroll resize', function() {
    //     updateDimensions();
    //     var scrollTop = $(window).scrollTop();
    //     var cardBottom = scrollTop + cardHeight;
    //     var currentLeft = $productCard.offset().left;

    //     if (scrollTop >= stickyPoint && cardBottom <= (wrapperTop + wrapperHeight)) {
    //         $productCard.addClass('sticky');
    //         $productCard.css({
    //             position: 'fixed',
    //             top: 0,
    //             left: 'auto',
    //             right: '24px',
    //         });
    //     } 
    //     else if (scrollTop < stickyPoint) {
    //         $productCard.removeClass('sticky');
    //         $productCard.css({
    //             position: 'relative',
    //             top: 0,
    //             left: 'auto',
    //             right: '24px',
    //         });
    //     } 
    //     else if (cardBottom > wrapperBottom) {
    //         $productCard.removeClass('sticky');
    //         $productCard.css({
    //             position: 'absolute',
    //             top: wrapperHeight - cardHeight - 30,
    //             left: 'auto',
    //         });
    //     }
    // });

   
    
    
});
