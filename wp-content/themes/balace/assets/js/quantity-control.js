jQuery(document).ready(function($) {
    $(document).on('click', '.quantity-button-decrease', function() {
        var $button = $(this);
        var $row = $button.closest('tr');
        var $input = $row.find('.quantity-input');
        var cartItemKey = $button.data('cart-item-key');
        var currentQuantity = parseInt($input.val());

        if (currentQuantity > 1) {
            var newQuantity = currentQuantity - 1;
            $input.val(newQuantity);

            $.ajax({
                url: wc_add_to_cart_params.ajax_url,
                type: 'POST',
                data: {
                    action: 'woocommerce_update_cart_item',
                    cart_item_key: cartItemKey,
                    quantity: newQuantity,
                    _wpnonce: wc_add_to_cart_params.wc_nonce
                },
                success: function(response) {
                    if (response.success) {
                        $row.find('.product-quantity').html(response.data.quantity_html);
                        $('#order-total').html(response.data.order_total);
                        $('#subtotal').html(response.data.subtotal);
                    }
                },
                error: function(error) {
                    console.log('Error updating cart item:', error);
                }
            });
        }
    });

    $(document).on('click', '.quantity-button-increase', function() {
        var $button = $(this);
        var $row = $button.closest('tr');
        var $input = $row.find('.quantity-input');
        var cartItemKey = $button.data('cart-item-key');
        var currentQuantity = parseInt($input.val());
        var newQuantity = currentQuantity + 1;

        $input.val(newQuantity);

        $.ajax({
            url: wc_add_to_cart_params.ajax_url,
            type: 'POST',
            data: {
                action: 'woocommerce_update_cart_item',
                cart_item_key: cartItemKey,
                quantity: newQuantity,
                _wpnonce: wc_add_to_cart_params.wc_nonce
            },
            success: function(response) {
                if (response.success) {
                    $row.find('.product-quantity').html(response.data.quantity_html);
                    $('#order-total').html(response.data.order_total);
                    $('#subtotal').html(response.data.subtotal);
                }
            },
            error: function(error) {
                console.log('Error updating cart item:', error);
            }
        });
    });
});
