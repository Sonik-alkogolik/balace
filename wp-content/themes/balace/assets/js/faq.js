jQuery(document).ready(function($) {
    $('.faq-item-content').click(function() {
        var $this = $(this);
        var $span = $this.children('span');
        if ($span.is(':visible')) {
            $span.slideUp();
            $this.removeClass('faq-item-active'); 
        } else {
            $('.faq-item-content span').slideUp();
            $span.slideDown();
            $('.faq-item-content').removeClass('faq-item-active'); 
            $this.addClass('faq-item-active');
        }
    });
});
