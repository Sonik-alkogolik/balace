
jQuery(document).ready(function($) {
    var button = $(this);
    var productId = button.data('product-id');
    function ever_check_onload() {
        $.ajax({
            url: ajax_compare_params.ajax_url, 
            method: 'POST',
            data: {
                action: 'check_compare_status', 
                product_id: productId,
                nonce: ajax_compare_params.nonce
            },
            success: function(response) {
                if (response.success) {
                    console.log("response true");
                    $('.btn_ever_compare').show();
                } else {
                    $('.btn_ever_compare').hide(); 
                }
            },
            error: function() {
                alert('Произошла ошибка при проверке товара в сравнении.');
            }
        });
    }
    ever_check_onload();


    $('.ever_compare_button').on('click', function(e) {
        //console.log(true);
        e.preventDefault();
        ever_check_onload();
    });
});
