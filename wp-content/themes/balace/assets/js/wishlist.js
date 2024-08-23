jQuery(document).ready(function($) {
//     function moveTinvwlButton() {
//         var $button = $('button[name="tinvwl-action-product_all"]');
//         var $headerContainer = $('.tinv-header');
//         if ($button.length && $headerContainer.length) {
//             $headerContainer.append($button);
//         }
//     }

//     moveTinvwlButton(); 

//     $(document).ajaxComplete(function(event, xhr, settings) {
//         if (settings.url.indexOf('wc-ajax=tinvwl') !== -1) {
//             moveTinvwlButton();
//         }
//     });

//     $(document).on('click', 'button[name="tinvwl-action-product_all"]', function(e) {
//         e.preventDefault(); 
//         //$('.tinv-wishlist.woocommerce.tinv-wishlist-clear form').submit(); 
//     });

function togglePopupBasket() {
    var $popupBasket = $('.wrapp-popup-basket-bg');

    // Открытие попапа корзины
    $('.btn_basket').on('click', function() {
        $popupBasket.addClass('active-popup-basket');
        //console.log('Popup basket opened');
    });

    // Закрытие попапа корзины
    $('.clouse-basket-popup').on('click', function() {
        $popupBasket.removeClass('active-popup-basket');
        //console.log('Popup basket closed');
    });
}


$('body').on('click', '.wishlist_add_to_card ', function(e) {
    e.preventDefault();
    //  console.log(true);
    var $this = $(this),
        product_id = $this.data('product_id');
        quantity =  1;
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
                showAddedToCartPopup($this);
                showAddedToCartPopup_mob($this);
            } else {
                //alert('Failed to add product to cart.');
            }
        },
        error: function() {
            //alert('Error adding product to cart.');
        }
    });
});

function showAddedToCartPopup($button) {
    // Найти родительский элемент товара
    var $product = $button.closest('.wishlist_item');
    
    if ($product.length > 0) {
        // Извлечь данные о товаре
        var image_url = $product.find('.product-thumbnail a img').attr('src');
        var title = $product.find('.product-name a').text();
        var price = $product.find('.product-price .woocommerce-Price-amount').html();
        
        // Обрезать название товара, если оно слишком длинное
        var words = title.split(' ');
        if (words.length > 2) {
            title = words.slice(0, 2).join(' ') + '...';
        }

        // Обновить содержимое всплывающего окна
        $('#custom-popup-product .popup-product-image').html('<img src="' + image_url + '" alt="' + title + '">');
        $('#custom-popup-product .popup-product-title').text(title);
        $('#custom-popup-product .popup-product-price').html(price);
        $('#custom-popup-product').show();
        
        // Скрыть всплывающее окно через 3 секунды
        setTimeout(function() {
            $('#custom-popup-product').hide();
        }, 3000);
    }
}

function showAddedToCartPopup_mob($button) {
    var $product = $button.closest('.wishlist_item');
    if ($product.length > 0) {
        var image_url = $product.find('.product-thumbnail > a > img').attr('src');
        console.log(image_url);
        var title = $product.find('.product-name a').text();
        var price = $product.find('.product-price .woocommerce-Price-amount').html();
        var words = title.split(' ');
        if (words.length > 2) {
            title = words.slice(0, 2).join(' ') + '...';
        }
        $('#custom-popup-product-mob .popup-product-image').html('<img src="' + image_url + '" alt="' + title + '">');
        $('#custom-popup-product-mob .popup-product-title').text(title);
        $('#custom-popup-product-mob .popup-product-price').html(price);
        // $('.top-content-block-wrapp').css('overflow', 'visible');
        $('#custom-popup-product-mob').show();
        setTimeout(function() {
            $('#custom-popup-product-mob').hide();
            // $('.top-content-block-wrapp').css('overflow', 'hidden');
            // location.reload();
        }, 3000);

       
    }
}


});