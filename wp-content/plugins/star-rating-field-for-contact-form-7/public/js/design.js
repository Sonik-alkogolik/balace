jQuery( document ).ready(function() {
    // console.log( "star ready!" );
    
    jQuery('.star_rating_class').each(function(index, value) {
        jQuery(jQuery(this)).raty({
            targetType:   'score',
            cancelButton:  true,
            cancelOff:   'cancel-off.png',
            cancelOn:    'cancel-on.png',
            starOff:     'star-off.png',
            starOn:     'star-on.png',
            path: student_ajax.ajax_urla+'/public/jquery.rating/images',
            target: '.'+jQuery(this).attr("target_pos"),
            number: 5,
            targetKeep:   true,
            score: jQuery(this).attr("score"),
        });
    });
});