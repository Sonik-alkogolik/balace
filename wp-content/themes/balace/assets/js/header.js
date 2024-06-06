(function( $ ) {
  $(document).ready(function() {
    $('.btn_header_menu').click(function() {
      $('.header-catalog').fadeToggle(200);
      $('.btn_header_menu').toggleClass('menu_clouse');
    });
  });
})(jQuery);