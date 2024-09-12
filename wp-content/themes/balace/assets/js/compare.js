jQuery(document).ready(function($) {
   function updateCompareTable() {
    $('.htcompare-row.compare-data-add_to_cart').each(function() {
        var $row = $(this);
        $row.find('.htcompare-col.htcolumn-value').each(function(index) {
            var $column = $(this);
            var $primaryContentArea = $row.closest('.htcompare-table').find('.htcompare-row.compare-data-primary .htcompare-col.htcolumn-value').eq(index).find('.htcompare-primary-content-area');
            if ($primaryContentArea.length > 0) {
                var $addToCartLink = $column.find('a.add_to_cart_button').clone();
                $primaryContentArea.append($addToCartLink);
            }
        });
        $row.remove();
    });

    $('.htcompare-primary-content-area').each(function() {
        var $column = $(this);
        var product_id = $column.closest('.htcompare-row.compare-data-add_to_cart')
                               .find('.htcompare-col.htcolumn-value a.add_to_cart_button')
                               .data('product_id');
        var $wishlistButton = $('<a>', {
            role: 'button',
            tabindex: '0',
            name: '',
            'aria-label': '',
            class: 'tinvwl_add_to_wishlist_button tinvwl-icon-heart no-txt tinvwl-position-after tinvwl-loop',
            'data-tinv-wl-list': '[]',
            'data-tinv-wl-product': product_id,
            'data-tinv-wl-productvariation': '0',
            'data-tinv-wl-productvariations': '[]',
            'data-tinv-wl-producttype': 'simple',
            'data-tinv-wl-action': 'addto'
        });
        $column.append($wishlistButton);
    });
}



function checkAndUpdateCompareTable() {
    if ($('.htcompare-table').hasClass('loading')) {
        setTimeout(checkAndUpdateCompareTable, 100); 
    } else {
        updateCompareTable();
    }
}
    updateCompareTable();
    $(document).on('updated_checkout', function() {
        checkAndUpdateCompareTable();
    });
    $(document).on('click', '.htcompare-remove', function() {
        checkAndUpdateCompareTable();
    });

});


jQuery(document).ready(function($) {
    var $btnAllRemove = $('<button class="clear-compare-table-btn button">Очистить список</button>');
    var $btnShop = $('<a href="/shop/" class="button compare_product_add">Добавить Товар</a>');
    
    $('.htcompare-row.compare-data-primary > div.htcompare-col.htcolumn-field-name').append($btnShop.clone());
    $('.htcompare-row.compare-data-primary > div.htcompare-col.htcolumn-field-name').append($btnAllRemove.clone());
    
    $('.wrapp-btn-compare-mob').append($btnShop);
    $('.wrapp-btn-compare-mob').append($btnAllRemove);
    
    var productIds = [];
    var data_id =  $('a.htcompare-remove[data-product_id]');
    data_id.each(function() {
        var id = $(this).data('product_id');
        productIds.push(id);
       // console.log(productIds);
    });
 
    function removeProductsSequentially(productIds, callback) {
        $('a.htcompare-remove [data-product_id]').each(function() {
            var id = $(this).data('product_id');
            productIds.push(id);
        });
        if (productIds.length === 0) {
            if (typeof callback === 'function') callback();
            return;
        }
        var id = productIds.shift();
    
        $.ajax({
            url: evercompare.ajaxurl,
            data: {
                action: 'ever_compare_remove_from_compare',
                nonce: evercompare.nonce,
                id: id
            },
            dataType: 'json',
            method: 'GET',
            success: function(response) {
                if (response) {
                   // console.log('Удаление товара:', id);
                } else {
                   // console.log('Ошибка при удалении товара:', id);
                }
            },
            error: function() {
               // console.log('Ошибка запроса для товара:', id);
            },
            complete: function() {
                setTimeout(function() {
                    removeProductsSequentially(productIds, callback);
                }, 200); 
            }
        });
    }

    $('.clear-compare-table-btn').on('click', function() {
        removeProductsSequentially(productIds, function() {
            location.reload(); 
        });
    });

});