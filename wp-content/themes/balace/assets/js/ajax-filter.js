jQuery(document).ready(function($) {
   
    $('#brand input[type="checkbox"]').on('change', function() {
        var url = $('#brand input[type="checkbox"]:checked').data('url');
        if (url) {
            window.location.href = url;
        }
    });
    $('#category input[type="checkbox"]').on('change', function() {
      var url =  $('#category input[type="checkbox"]:checked').data('url');
        if (url) {
            window.location.href = url;
        }
    });
    
});

jQuery(document).ready(function($) {
    $('#your-button-id').click(function() {
        $.ajax({
            url: ajax_params.ajax_url,
            type: 'POST',
            data: {
                action: 'get_category_products', 
                nonce: ajax_params.nonce,
                category_id: ajax_params.current_category_id 
            },
            success: function(response) {
                $('.products').html(response);
            },
            error: function(errorThrown) {
                console.log(errorThrown);
            }
        });
    });
});