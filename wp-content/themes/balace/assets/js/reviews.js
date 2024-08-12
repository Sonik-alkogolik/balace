
document.addEventListener('DOMContentLoaded', function() {
    var starRatings = document.querySelectorAll('.star-rating');
    starRatings.forEach(function(container) {
        let rating = parseFloat(container.getAttribute('data-rating'));
        //console.log('Rating:', rating);
        let stars = container.querySelectorAll('img');
        stars.forEach(function(star) {
            let starValue = parseFloat(star.getAttribute('data-value'));
            if (starValue <= rating) {
                star.src = '/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-on.png';
            } else {
                star.src = '/wp-content/plugins/star-rating-field-for-contact-form-7/public/jquery.rating/images/star-off.png';
            }
        });
    });

});


jQuery(document).ready(function($) {
const toggleSwitch = $('.switch-btn');
const lastNameField = $('span[data-name="text-805"]');
const firstNameField = $('span[data-name="text-807"]');
function checkFields() {
    console.log('Toggle Switch Class:', toggleSwitch.attr('class'));

    if (!toggleSwitch.hasClass('switch-on')) {
        lastNameField.show();
        firstNameField.show();
    } else {
        lastNameField.hide();
        firstNameField.hide();
    }
}

toggleSwitch.click(function() {
    $(this).toggleClass('switch-on');
    checkFields();
});
});