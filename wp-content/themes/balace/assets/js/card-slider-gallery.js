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
    
});




document.addEventListener('DOMContentLoaded', function() {
    var button = document.querySelector('.card-play-video');
    var video = document.getElementById('video-frame');
    var soundToggleButton = document.querySelector('.card-sound-toggle');
    var btnLeft = document.querySelector('.btn_slider_left.card-slider-gallery');
    var btnRight = document.querySelector('.btn_slider_right.card-slider-gallery');

    button.addEventListener('click', function() {
        video.style.display = 'block';
        video.play(); 
        button.style.display = 'none';
        video.style.zIndex = '95'; 
        soundToggleButton.style.display = 'block';
    });

    soundToggleButton.addEventListener('click', function() {
        if (video.muted) {
            video.muted = false;
            soundToggleButton.textContent = '🔊'; 
        } else {
            video.muted = true;
            soundToggleButton.textContent = '🔈'; 
        }
    });

    btnLeft.addEventListener('click', function() {
        video.pause(); 
        video.style.zIndex = '-1'; 
        video.style.display = 'none'; 
        soundToggleButton.style.display = 'none';
        button.style.display = 'block';
    });

    btnRight.addEventListener('click', function() {
        video.pause(); 
        video.style.zIndex = '-1'; 
        video.style.display = 'none'; 
        soundToggleButton.style.display = 'none';
        button.style.display = 'block';
    });
});