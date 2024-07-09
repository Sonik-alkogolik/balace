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

    
    $('.filter-block').click(function() {
        var $list = $(this).find('.filter-list');
        $('.filter-list').not($list).removeClass('active-list');
        $('.filter-block').removeClass('filter-active-block');
        $list.addClass('active-list');
        $(this).addClass('filter-active-block');
    });
    
    
    
});


jQuery(function($) {
    $('#product_attributes input[type="checkbox"]').change(function() {
        var attributes = {};
        var checkedCheckbox = $(this); 

        if (checkedCheckbox.is(':checked')) { 
            var name = checkedCheckbox.attr('name').replace(/\[\]$/, '');
            var value = checkedCheckbox.val();
            console.log(name);
            console.log(value);
            attributes[name] = value;
        
            // AJAX запрос
            $.ajax({
                url: ajax_object.ajaxurl,
                type: 'POST',
                data: {
                    action: 'get_category_products',
                    nonce: ajax_object.ajax_nonce,
                    attributes: attributes,
                    name: name 
                },
                success: function(response) {
                    $('.products').html(response);
                },
                error: function(error) {
                    console.error('Error:', error);
                }
            });
        }
    });
});

