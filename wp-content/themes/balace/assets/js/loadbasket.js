
jQuery(document).ready(function($) {
    function loadCartContent() {
        $.ajax({
            url: ajax_add_to_cart_params.ajax_url,
            type: 'POST',
            data: {
                action: 'check_cart_status',
                nonce: ajax_add_to_cart_params.nonce
            },
            success: function(response) {
                if (response.success) {
                    $('.woocommerce-cart-form').html(response.data.cart_content);
                }
            }
        });
    }

    loadCartContent();
});