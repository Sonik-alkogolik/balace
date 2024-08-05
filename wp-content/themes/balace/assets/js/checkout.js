jQuery(document).ready(function($) {
$('body').on('click', '.remove-product-chekout', function() {
    console.log(true);
    var $button = $(this);
    var cart_item_key = $button.data('cart-item-key');

    $.ajax({
        url: wc_add_to_cart_params.ajax_url,
        type: 'POST',
        data: {
            action: 'remove_cart_item',
            cart_item_key: cart_item_key,
        },
        success: function(response) {
            //console.log(response); 
            if (response.success) {
                location.reload();
            } else {
               // alert('Failed to remove item from cart.');
            }
        }
    });
});
});


document.addEventListener('DOMContentLoaded', function() {

    setTimeout(function() {
        var container = document.querySelector('.swiper-container-chekout');
        if (container) {
            //console.log("Swiper container found");

            var swiper = new Swiper('.swiper-container-chekout', {
                slidesPerView: 3,
                spaceBetween: 24,
                simulateTouch: true,
                touchRatio: 1,       
                touchAngle: 45,      
                grabCursor: true, 
                loop: false,
            });
        } else {
            //console.error("Swiper container not found");
        }
    }, 2000);
});