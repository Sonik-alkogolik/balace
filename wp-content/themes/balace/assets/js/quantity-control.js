

jQuery(document).ready(function($) {
    $(document).on('click', '.quantity-button-decrease, .quantity-button-increase', function() {
        var $button = $(this);
        var $controls = $button.closest('.product-quantity-controls');
        var $input = $controls.find('.quantity-input'); 
        var cartItemKey = $button.data('cart-item-key');
        var currentQuantity = parseInt($input.val());
        var newQuantity = $button.hasClass('quantity-button-decrease') ? currentQuantity - 1 : currentQuantity + 1;

        if (newQuantity < 1) return;

        //console.log('Cart item key:', cartItemKey);
       // console.log('New quantity:', newQuantity);

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
                console.log('Response:', response);
                if (response.success) {
                    $input.val(newQuantity);
      
                    $('#subtotal').html(`
                    <p>Сумма посылки</p>
                    <span class="woocommerce-Price-amount amount">
                        <bdi>${response.data.subtotal}&nbsp;<span class="woocommerce-Price-currencySymbol"></span></bdi>
                    </span>
                `);
                $('#order-total').html(`
                    <p>Итог: </p>
                    <p><strong>
                        <span class="woocommerce-Price-amount amount">
                            <bdi>${response.data.order_total}&nbsp;<span class="woocommerce-Price-currencySymbol"></span></bdi>
                        </span>
                    </strong></p>
                `);
                } else {
                    //console.log('Error:', response.data);
                }
            },
            error: function(xhr, status, error) {
                //console.log('AJAX Error:', xhr.responseText);
            }
        });
    });


    $('.form-group.agree-personal-data').on('click', function() {
        var $checkbox = $(this).find('input[type="checkbox"]');
        var $customCheckbox = $(this).find('.checkbox-custom');
        $checkbox.prop('checked', !$checkbox.prop('checked'));
        if ($checkbox.prop('checked')) {
        $customCheckbox.addClass('checked');
        } else {
        $customCheckbox.removeClass('checked');
        }
    });
    $(document).ready(function() {

        $('#custom_delivery_method').on('click', function(e) {
            e.stopPropagation(); 
            $('.custom-select-delivery-method').toggle();
        });
    

        $('.custom-select-delivery-method li').on('click', function() {
            var value = $(this).data('value');
            $('#custom_delivery_method').val(value);
            $('.custom-select-delivery-method').hide();
        });
    
  
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#custom_delivery_method').length && !$(e.target).closest('.custom-select-delivery-method').length) {
                $('.custom-select-delivery-method').hide();
            }
        });
    });
});