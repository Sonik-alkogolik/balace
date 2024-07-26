jQuery(document).ready(function($) {
    $('#clear_cart').on('click', function(e) {
        console.log(true);
        e.preventDefault();

        $.ajax({
            url: wc_clear_cart_params.ajax_url, 
            type: 'POST',
            data: {
                action: 'clear_cart',
                security: wc_clear_cart_params.nonce
            },
            success: function(response) {
                window.location.reload();
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', status, error);
            }
        });
    });
});
