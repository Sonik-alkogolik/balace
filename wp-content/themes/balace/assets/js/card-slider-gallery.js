document.addEventListener('DOMContentLoaded', function() {
    var gallerySwiper = new Swiper('.product-gallery-slider', {
        loop: true,
        slidesPerView: 1,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
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
//     var $productCard = $('.product-card-item-img');
// var $productCardWrapp = $('.product-card-wrapp');
// var stickyPoint = $productCard.offset().top;
// var cardHeight = $productCard.outerHeight();
// var wrapperHeight = $productCardWrapp.outerHeight();
// var wrapperTop = $productCardWrapp.offset().top;
// var wrapperBottom = wrapperTop + wrapperHeight;

// $(window).scroll(function() {
//     var scrollTop = $(window).scrollTop();
//     var cardBottom = scrollTop + cardHeight;

//     if (scrollTop >= stickyPoint && cardBottom <= wrapperBottom) {
//         $productCard.addClass('sticky');
//         $productCard.css({
//             position: 'fixed',
//             top: 0
//         });
//     } else if (cardBottom > wrapperBottom) {
//         $productCard.removeClass('sticky');
//         $productCard.css({
//             position: 'absolute',
//             top: wrapperHeight - cardHeight
//         });
//     } else {
//         $productCard.removeClass('sticky');
//         $productCard.css({
//             position: 'static'
//         });
//     }
// });
});
