;(function($){
"use strict";
    
    var $body = $('body'),
        $popup = $('.htcompare-popup');
        
    $body.append(`<div id="htcompare-error-modal" class="htcompare-error-modal" style="display:none">
        <div class="htcompare-error-modal-content">
            <button class="htcompare-error-modal-close">&times;</button>
            <div class="htcompare-error-modal-body"></div>
        </div>
    </div>`);
    const $htcompareErrorModal = $("#htcompare-error-modal");
    $('.htcompare-error-modal-close').on('click', function() {
        $htcompareErrorModal.css('display', 'none');
    })
    $(window).on('click', function(e) {
        if(e.target == $htcompareErrorModal[0]) {
            $htcompareErrorModal.css('display', 'none');
        }
    })
    $('a.htcompare-btn').each(function() {
        const $this = $(this);
        if($this.hasClass('added')) {
            $this.html('<span class="htcompare-btn-text">'+$this.data('added-text')+'</span>');
        }
    });

    // Notification Markup
    const notificationMarkup = `<div class="htcompare-notification">
        <div class="htcompare-notification-text">${evercompare.option_data.success_added_notification_text}</div>
        <span class="htcompare-notification-close">close</span>
    </div>`
    // Insert Notification Markup in body & notification close method if notification is enabled
    if(evercompare.option_data.enable_success_notification === 'on') {
        $body.append(notificationMarkup);
        $body.on('click', '.htcompare-notification-close', function() {
            $body.find('.htcompare-notification').removeClass('open');
        });
    }
    // Notification Show Function
    const ShowNotification = (message) => {
        if(evercompare.option_data.enable_success_notification === 'on') {
            $body.find('.htcompare-notification-text').html(message);
            $body.find('.htcompare-notification').addClass('open');
            if(+evercompare.option_data.removed_notification_after > -1) {
                setTimeout(function() {
                    $body.find('.htcompare-notification').removeClass('open');
                }, +evercompare.option_data.removed_notification_after * 1000)
            }
        }
    }

    // Add product in compare table
    $body.on('click', 'a.htcompare-btn', function (e) {
        var $this = $(this),
            id = $this.data('product_id'),
            addedText = $this.data('added-text'),
            success_message = evercompare.option_data.success_added_notification_text.replace('{product_name}', $this.data('product_title'));

        if( evercompare.popup === 'yes' &&  evercompare.option_data.remove_on_click === 'off' ){
            e.preventDefault();
            if ($this.hasClass('added') ) {
                $body.find('.htcompare-popup').addClass('open');
                return true;
            }
        }else{
            if ( $this.hasClass('added') ) return true;
        }

        e.preventDefault();

        $this.addClass('loading');

        $.ajax({
            url: evercompare.ajaxurl,
            data: {
                action: 'ever_compare_add_to_compare',
                nonce: evercompare.nonce,
                id: id,
            },
            dataType: 'json',
            method: 'GET',
            success: function ( response ) {
                const $products = typeof response.products === 'array' ? response.products : Object.values(response.products);
                if ( response.table && $products.indexOf(id.toString()) >= 0 ) {
                    updateCompareData( response );
                    $popup.addClass('open');
                } else {
                    $('.htcompare-error-modal-body').html(response.limitReached)
                    $htcompareErrorModal.css('display', 'flex');
                    console.log( 'Something wrong loading compare data' );
                }
                $body.find('.htcompare-counter').html( response.count );
            },
            error: function ( data ) {
                console.log('Something wrong with AJAX response.');
            },
            complete: function (res) {
                $this.removeClass('loading');
                const $products = typeof res.responseJSON.products === 'array' ? res.responseJSON.products : Object.values(res.responseJSON.products);
                if($products.indexOf(id.toString()) >= 0) {
                    $this.addClass('added');
                    $this.html('<span class="htcompare-btn-text">'+addedText+'</span>');
                }
                ShowNotification(success_message);
            },
        });

    });

    if(evercompare.option_data.remove_on_click && evercompare.option_data.remove_on_click === 'on') {
        $body.on('click', 'a.htcompare-btn.added', function (e) {
            e.preventDefault();
            var $this = $(this),
                id = $this.data('product_id'),
                success_message = evercompare.option_data.success_removed_notification_text.replace('{product_name}', $this.data('product_title'));
            $this.addClass('loading');
            jQuery.ajax({
                url: evercompare.ajaxurl,
                data: {
                    action: 'ever_compare_remove_from_compare',
                    nonce: evercompare.nonce,
                    id: id,
                },
                dataType: 'json',
                method: 'GET',
                success: function (response) {
                    if (response) {
                        $body.find('.htcompare-counter').html( response.count );
                    } else {
                        console.log( 'Something wrong loading compare data' );
                    }
                },
                error: function (data) {
                    console.log('Something wrong with AJAX response.');
                },
                complete: function () {
                    $this.removeClass('loading added').html('<span class="htcompare-btn-text">'+$this.data('text')+'</span>');
                    ShowNotification(success_message);
                },
            });
        });
    }

    // Remove data from compare table
    $body.on('click', 'a.htcompare-remove', function (e) {
        var $table = $('.htcompare-table');

        e.preventDefault();
        var $this = $(this),
            id = $this.data('product_id'),
            success_message = evercompare.option_data.success_removed_notification_text.replace('{product_name}', $this.data('product_title'));

        $table.addClass('loading');
        $this.addClass('loading');

        jQuery.ajax({
            url: evercompare.ajaxurl,
            data: {
                action: 'ever_compare_remove_from_compare',
                nonce: evercompare.nonce,
                id: id,
            },
            dataType: 'json',
            method: 'GET',
            success: function (response) {
                if (response.table) {
                    updateCompareData(response);
                } else {
                    console.log( 'Something wrong loading compare data' );
                }
                $('a.htcompare-btn').each(function() {
                    if($(this).data('product_id') === id) {
                        $(this).removeClass('added');
                        $(this).html('<span class="htcompare-btn-text">'+$(this).data('text')+'</span>');
                    }
                })
                $body.find('.htcompare-counter').html( response.count );
            },
            error: function (data) {
                console.log('Something wrong with AJAX response.');
            },
            complete: function () {
                $table.removeClass('loading');
                $this.addClass('loading');
                ShowNotification(success_message);
            },
        });

    });

    // Update table HTML
    function updateCompareData( data ) {
        if ( $('.htcompare-table').length > 0 ) {
            $('.htcompare-table').replaceWith( data.table );
            $('.evercompare-copy-link').on('click',function(e){
                evercompareCopyToClipboard( $(this).closest('.ever-compare-shareable-link').find('.evercompare-share-link') , this );
            });
        }
    }

    // Close popup
    $body.on('click','.htcompare-popup-close', function(e){
        $(this).parent('.htcompare-popup.open').removeClass('open');
        $popup.removeClass('open');
    });

    // Copy Shareable link
    $('.evercompare-copy-link').on('click',function(e){
        evercompareCopyToClipboard( $(this).closest('.ever-compare-shareable-link').find('.evercompare-share-link') , this );
    });
    function evercompareCopyToClipboard( element, button ) {
        var $tempdata = $("<input>");
        $("body").append($tempdata);
        $tempdata.val($(element).text()).select();
        document.execCommand("copy");
        $tempdata.remove();
        $(button).text( $(button).data('copytext') );
        setTimeout(function() { 
            $( button ).text( $(button).data('btntext') );
        }, 1000);
    }

})(jQuery);