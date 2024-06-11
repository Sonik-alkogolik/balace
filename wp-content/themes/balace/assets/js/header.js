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

  });
})(jQuery);