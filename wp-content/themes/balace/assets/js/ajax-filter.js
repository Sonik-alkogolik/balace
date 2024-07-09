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

    
    $('.filter-block').click(function(e) {
        var $list = $(this).find('.filter-list');
        $('.filter-list').not($list).removeClass('active-list');
        $('.filter-block').removeClass('filter-active-block');
        $list.addClass('active-list');
        $(this).addClass('filter-active-block');
        e.stopPropagation(); // Останавливаем всплытие события клика
    });

    document.addEventListener("click", function(e) {
        var contentPopups = document.querySelectorAll('.filter-list');
        var targetElement = e.target;
        var clickedOutside = true;

        contentPopups.forEach(function(contentPopup) {
            if (contentPopup.contains(targetElement)) {
                clickedOutside = false;
            }
        });

        if (clickedOutside) {
            $('.filter-list').removeClass('active-list');
            $('.filter-block').removeClass('filter-active-block');
        }
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

    $('#filter-form').on('submit', function(event) {
        event.preventDefault();

        var formData = $(this).serialize();
        $.ajax({
            url: ajax_object.ajaxurl,
            type: 'POST',
            data: {
                action: 'filter_products_by_price',
                nonce: ajax_object.ajax_nonce,
                formData: formData
            },
            success: function(response) {
                $('#products-list').html(response);
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error: ' + status + ' - ' + error);
            }
        });
    });
});

