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
        e.stopPropagation(); 
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
            // console.log(name);
            // console.log(value);
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

      
    $('#price-range').slider({
        range: true,
        min: 0,
        max: 5000,
        values: [0, 5000],
        slide: function(event, ui) {
            $('#min-price').val(ui.values[0]);
            $('#max-price').val(ui.values[1]);
            $('#min-price-display').text(ui.values[0]);
            $('#max-price-display').text(ui.values[1]);
        },
        change: function(event, ui) {
            $('#price-filter-form').submit();
        }
    });
    
    // Устанавливаем начальные значения для отображаемых цен
    $('#min-price-display').text($('#price-range').slider('values', 0));
    $('#max-price-display').text($('#price-range').slider('values', 1));

    $('#price-filter-form').on('submit', function(event) {
        event.preventDefault();
        var minPrice = $('#min-price').val();
        var maxPrice = $('#max-price').val();
        var selectedAttributes = [];
        $('input[name="pa_тип-товара[]"]:checked').each(function() {
            selectedAttributes.push($(this).val());
        });
        var data = {
            action: 'filter_products_by_price',  
            nonce: ajax_object.ajax_nonce,
            min_price: minPrice,
            max_price: maxPrice,
            attributes: selectedAttributes  
        };
        $.ajax({
            url: ajax_object.ajaxurl,
            type: 'POST',
            data: data,
            success: function(response) {
                $('.products').html(response); 
            },
            error: function(xhr, status, error) {
                console.log('AJAX Error: ' + status + ' - ' + error);
            }
        });
    });
    


    

    $('.select-options li').on('click', function() {
        var value = $(this).attr('data-value');
        $('.select-trigger span').text($(this).text());
        $('input[name="orderby"]').val(value);
        $('.select-options li').removeClass('selected');
        $(this).addClass('selected');
        $('.woocommerce-ordering').submit();
    });

    $('.custom-checkbox input[type="checkbox"]').on('change', function() {
        var $checkbox = $(this);
        var $parent = $checkbox.closest('.custom-checkbox');
        if ($checkbox.prop('checked')) {
            $parent.addClass('checked');
        } else {
            $parent.removeClass('checked');
        }
    });
});

