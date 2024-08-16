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
                $(this).html(`
                    <svg width="52" height="52" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="20" cy="20" r="20" fill="#221D17"/>
                        <path d="M23.4818 16.5187L16.5195 23.481" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M16.5201 16.5187L23.4824 23.481" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                `);
            } else {
                $('.header-section').css('background', '');
                $(this).html(`
                    <svg id="searchIcon" width="52" height="52" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="20" cy="20" r="19.25" stroke="#ECE9DB" stroke-width="1.5"></circle>
                        <path d="M14.2747 21.3369C14.8332 22.6512 15.8911 23.6898 17.2154 24.2242C18.5397 24.7586 20.0221 24.745 21.3364 24.1865C22.6507 23.6279 23.6894 22.5701 24.2238 21.2457C24.7581 19.9214 24.7445 18.439 24.1859 17.1247C23.6274 15.8104 22.5696 14.7718 21.2452 14.2374C19.9209 13.703 18.4385 13.7166 17.1242 14.2752C15.8099 14.8337 14.7713 15.8915 14.2369 17.2159C13.7025 18.5402 13.7161 20.0226 14.2747 21.3369Z" stroke="#645F4D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M23.0762 23.0771L26.1531 26.1541" stroke="#645F4D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                `);
            }
        });
   
        $(document).on('added_to_cart', function(event, fragments, cart_hash, $button) {
            var $product = $button.closest('.product, .swiper-slide.best_products_slide, .product-item');
            
            if ($product.length > 0) {
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

               
            }
        });
        $(document).on('added_to_cart', function(event, fragments, cart_hash, $button) {
            var $product = $button.closest('.product, .swiper-slide.best_products_slide, .product-item');
            
            if ($product.length > 0) {
                var image_url = $product.find('.product_image_item img').attr('src');
                var title = $product.find('.woocommerce-loop-product__title').text();
                var price = $product.find('.woocommerce-Price-amount').html();
                var words = title.split(' ');
                if (words.length > 2) {
                    title = words.slice(0, 2).join(' ') + '...';
                }
                $('#custom-popup-product-mob .popup-product-image').html('<img src="' + image_url + '" alt="' + title + '">');
                $('#custom-popup-product-mob .popup-product-title').text(title);
                $('#custom-popup-product-mob .popup-product-price').html(price);
                // $('.top-content-block-wrapp').css('overflow', 'visible');
                $('#custom-popup-product-mob').show();
                setTimeout(function() {
                    $('#custom-popup-product-mob').hide();
                    // $('.top-content-block-wrapp').css('overflow', 'hidden');
                    // location.reload();
                }, 3000);

               
            }
        });

//     function loadCartContent() {
//       $.ajax({
//           url: ajax_add_to_cart_params.ajax_url,
//           type: 'POST',
//           data: {
//               action: 'check_cart_status',
//               nonce: ajax_add_to_cart_params.nonce
//           },
//           success: function(response) {
//               if (response.success) {
//                   $('.woocommerce-cart-form').html(response.data.cart_content);
//               }
//           }
//       });
//   }

//   loadCartContent();
     

      var $popupBasket = $('.wrapp-popup-basket-bg');
      $('.btn_basket').on('click', function() {
            $popupBasket.addClass('active-popup-basket');
            //console.log(true);
      }); 

       $('.clouse-basket-popup').on('click', function() {
          $popupBasket.removeClass('active-popup-basket');
          //console.log(true);
      });
      var $button = $('.clouse-basket-popup');
      var $tableContainer = $('.table-container');
  
      $tableContainer.on('scroll', function() {
          var scrollTop = $tableContainer.scrollTop();
          console.log('scrollTop:', scrollTop);
  
          if (scrollTop === 0) {
              console.log('At the top, setting z-index to 5');
              $button.css('z-index', '5');
          } else {
              console.log('Scrolled, setting z-index to -1');
              $button.css('z-index', '-1');
          }
      });

      $('.btn_search_header').on('click', function() {
        const searchInput = $('.input_search_header').get(0);
        searchFetch(searchInput);
    });
    

  });
})(jQuery);


