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


    $(document).on('click', '.remove', function(e) {
        e.preventDefault();

        var removeUrl = wc_remove_from_cart_params.ajax_url; // URL для AJAX запроса
        var cartKey = $(this).attr('href').match(/remove_item=([^&]*)/)[1]; // Извлекаем cart_key из href
        var nonce = wc_remove_from_cart_params.nonce; // Получаем nonce

        $.ajax({
            url: removeUrl,
            type: 'POST',
            data: {
                action: 'remove_from_cart',
                cart_key: cartKey,
                nonce: nonce 
            },
            success: function(response) {
                if (response.success) {
                    togglePopupBasket();
                    $('.wrapp-popup-basket-bg').html(response.data.cart_html);
                    $('.cart_totals-wrapp').html(response.data.cart_totals); 
                    togglePopupBasket();
                   
                } else {
                    //alert('Ошибка при удалении товара: ' + response.data);
                }
            },
            error: function() {
               // alert('Ошибка при удалении товара');
            }
        });
    });
});