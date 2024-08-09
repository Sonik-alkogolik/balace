// jQuery(document).ready(function($) {
//     function moveTinvwlButton() {
//         var $button = $('button[name="tinvwl-action-product_all"]');
//         var $headerContainer = $('.tinv-header');
//         if ($button.length && $headerContainer.length) {
//             $headerContainer.append($button);
//         }
//     }

//     moveTinvwlButton(); 

//     $(document).ajaxComplete(function(event, xhr, settings) {
//         if (settings.url.indexOf('wc-ajax=tinvwl') !== -1) {
//             moveTinvwlButton();
//         }
//     });

//     $(document).on('click', 'button[name="tinvwl-action-product_all"]', function(e) {
//         e.preventDefault(); 
//         //$('.tinv-wishlist.woocommerce.tinv-wishlist-clear form').submit(); 
//     });

// });