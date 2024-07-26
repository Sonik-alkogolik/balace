(function( $ ) {
  $(document).ready(function() {
    $('.header-catalog-item.catalog-menu.mob nav ul li:first-child a').removeAttr('href');
    $('.btn_header_menu.desktop').click(function() {
      $('.header-catalog.desktop').fadeToggle(200);
      $('.btn_header_menu.desktop').toggleClass('menu_clouse');
    });
    $('.btn_header_menu.mob').click(function() {
      var $btn = $(this);
      var $headerSection = $('.header-section');
      
      $('.header-catalog.mob').fadeToggle(200);
      $btn.toggleClass('menu_clouse');
      
      if ($btn.hasClass('menu_clouse')) {
          $headerSection.css('background', 'rgba(245, 243, 232, 1)');
      } else {
          $headerSection.css('background', '');
      }
  });



      $(".catalog-header").click(function() {
        $(".woocommerce_categories").toggleClass("hide show");
        $(this).toggleClass("catalog-link-active");
        if ($(this).hasClass("catalog-link-active")) {
            $(".catalog-menu nav ul li a").not(this).addClass("catalog-link-opacity");
        } else {
            $("юcatalog-menu nav ul li a").removeClass("catalog-link-opacity");
        }
    });

      $(".product_cat_sub_menu_active").click(function() {
        var submenu = $(this).next("ul.header_product_cat_sub_menu");
        $(".product_cat_sub_menu_active").not(this).removeClass("active_link");
        $(this).toggleClass("active_link");
        $("ul.header_product_cat_sub_menu").not(submenu).addClass("hide").removeClass("show");
        submenu.toggleClass("hide show");
    });
    

        var $searchButton = $('.header-search.mob');
        $searchButton.on('click', function() {
            $(this).toggleClass('search_mob_active');
            $('.search-mob-wrapp').toggleClass("hide show");
            if ($(this).hasClass('search_mob_active')) {
              $('.header-section').css('background', 'rgba(245, 243, 232, 1)');
          } else {
              $('.header-section').css('background', '');
          }
        });
   
        $(document).on('added_to_cart', function(event, fragments, cart_hash, $button) {
          var $product = $button.closest('.product');
          var image_url = $product.find('.product_image_item img').attr('src');
          var title = $product.find('.woocommerce-loop-product__title').text();
          var price = $product.find('.woocommerce-Price-amount').html();
          var words = title.split(' ');
          if (words.length > 2) {
              title = words.slice(0, 2).join(' ') + '...';
          }
          $('#custom-popup-product .popup-product-image').html('<img src="' + image_url + '" alt="' + title + '">');
          $('#custom-popup-product .popup-product-title').text(title);
          $('#custom-popup-product .popup-product-price').html(price);
          $('#custom-popup-product').show();
          setTimeout(function() {
            $('#custom-popup-product').hide();
            // location.reload();
        }, 3000);
      });


          // Функция для загрузки содержимого корзины через AJAX
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

  // Загрузка содержимого корзины при загрузке страницы
  loadCartContent();
     

      var $popupBasket = $('.wrapp-popup-basket-bg');
      $('.btn_basket').on('click', function() {
            $popupBasket.addClass('active-popup-basket');
            console.log(true);
      }); 

       $('.clouse-basket-popup').on('click', function() {
          $popupBasket.removeClass('active-popup-basket');
          console.log(true);
      });

  });
})(jQuery);


