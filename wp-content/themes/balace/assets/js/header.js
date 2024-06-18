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
          $(".catalog-header").toggleClass("catalog-link-active");
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
   

  });
})(jQuery);