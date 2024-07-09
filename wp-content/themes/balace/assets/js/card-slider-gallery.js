
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
    });
    