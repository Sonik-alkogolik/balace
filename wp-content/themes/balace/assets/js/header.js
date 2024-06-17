(function( $ ) {
  $(document).ready(function() {
    $('.btn_header_menu').click(function() {
      $('.header-catalog').fadeToggle(200);
      $('.btn_header_menu').toggleClass('menu_clouse');
    });

      $(".catalog-header").click(function() {
          $(".woocommerce_categories").toggleClass("hide show");
          $(".catalog-header").toggleClass("catalog-link-active");
      });

      $(".product_cat_sub_menu_active").click(function() {
        var submenu = $(this).next("ul.header_product_cat_sub_menu");
        $(".product_cat_sub_menu_active").toggleClass("active_link");
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