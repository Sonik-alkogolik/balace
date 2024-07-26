// jQuery(document).ready(function($) {
//     $('.btn_basket').on('click', function() {
//         // отображения корзины
//     });

//     $('body').on('click', '.add_to_cart_button', function(e) {
//         e.preventDefault();

//         var $this = $(this),
//             product_id = $this.data('product_id'),
//             quantity = $this.data('quantity') || 1;

//         $.ajax({
//             url: ajax_add_to_cart_params.ajax_url,
//             type: 'POST',
//             data: {
//                 action: 'add_to_cart',
//                 product_id: product_id,
//                 quantity: quantity,
//                 nonce: ajax_add_to_cart_params.nonce
//             },
//             success: function(response) {
//                 if (response.success) {
//                     // Удаляем старый HTML и добавляем новый
//                     // $('.basket-item-wrapp').html(response.data.cart_html);
//                     // $('.basket-title').html('Корзина / <span>' + response.data.cart_count + ' штук</span>');
//                     // $('.cart-collaterals').html(response.data.cart_collaterals);
//                 } else {
//                     // alert('Failed to add product to cart.');
//                 }
//             },
//             error: function() {
//                 //alert('Error adding product to cart.');
//             }
//         });
//     });
// });




jQuery(document).ready(function($) {

    function togglePopupBasket() {
        var $popupBasket = $('.wrapp-popup-basket-bg');
    
        // Открытие попапа корзины
        $('.btn_basket').on('click', function() {
            $popupBasket.addClass('active-popup-basket');
            console.log('Popup basket opened');
        });
    
        // Закрытие попапа корзины
        $('.clouse-basket-popup').on('click', function() {
            $popupBasket.removeClass('active-popup-basket');
            console.log('Popup basket closed');
        });
    }


    $('body').on('click', '.add_to_cart_button', function(e) {
        e.preventDefault();

        var $this = $(this),
            product_id = $this.data('product_id'),
            quantity = $this.data('quantity') || 1;

        $.ajax({
            url: ajax_add_to_cart_params.ajax_url,
            type: 'POST',
            data: {
                action: 'add_to_cart',
                product_id: product_id,
                quantity: quantity,
                nonce: ajax_add_to_cart_params.nonce
            },
            success: function(response) {
                if (response.success) {
                    $('.wrapp-popup-basket-bg').html(response.data.cart_html);
                    togglePopupBasket();
                } else {
                    //alert('Failed to add product to cart.');
                }
            },
            error: function() {
                //alert('Error adding product to cart.');
            }
        });
    });
});