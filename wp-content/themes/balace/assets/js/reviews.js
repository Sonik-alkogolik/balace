
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
                star.style.display = 'none';
            }
        });
    });


});


jQuery(document).ready(function($) {


$('.star_rating_class img').hover(function() {
    var altValue = $(this).attr('alt');
    $('.focus-data-value').text(altValue);
});


// const toggleSwitch = $('.switch-btn');
// const lastNameField = $('span[data-name="text-805"]');
// const firstNameField = $('span[data-name="text-807"]');
// const lastNameFieldInput = $('span[data-name="text-805"] input');
// const firstNameFieldInput = $('span[data-name="text-807"] input');
// const agreePersonal = $('.agree-personal-data');
// const submitButton = $('.wpcf7-submit');
// function checkFields() {
//     //console.log('Toggle Switch Class:', toggleSwitch.attr('class'));

//     if (!toggleSwitch.hasClass('switch-on')) {
//         lastNameField.attr('required', 'required');
//         firstNameField.attr('required', 'required');
//         lastNameField.show();
//         firstNameField.show();
//         agreePersonal.show();
//     } else {
//         lastNameField.removeAttr('required');
//         firstNameField.removeAttr('required');
//         lastNameField.hide();
//         firstNameField.hide();
//         agreePersonal.hide();
//         submitButton.prop('disabled', false);
//     }
// }


// // $('.star_rating_class img').mousemove(function(e) {
// //     // var imgWidth = $(this).width();
// //     // var offsetX = e.offsetX; 
// //     // var altValue = parseFloat($(this).attr('alt')); 
// //     // var score;

// //     // if (offsetX < imgWidth / 2) {
// //     //     score = altValue - 0.5; 
// //     // } else {
// //     //     score = altValue; 
// //     // }
// //     // $('.focus-data-value').text(score.toFixed(1)); 
// //     $('.star_rating_class img').mousemove(function(e) {
// //         $('.star_rating_class img').mousemove(function(e) {
// //             var imgWidth = $(this).width();
// //             var offsetX = e.offsetX;
// //             var altValue = parseFloat($(this).attr('alt'));
// //             var score = altValue - 1 + (offsetX / imgWidth); 
    
// //             $('.focus-data-value').text(score.toFixed(1)); 
// //         });
// //     });
// // });
// submitButton.click(function() {
//     if (lastNameFieldInput.val() === '' || firstNameFieldInput.val() === '') {
//         submitButton.prop('disabled', true);
//         lastNameFieldInput.addClass('placeholder-red');
//         firstNameFieldInput.addClass('placeholder-red');
//     } else {
//         submitButton.prop('disabled', false);
//         lastNameFieldInput.removeClass('placeholder-red');
//         firstNameFieldInput.removeClass('placeholder-red');
//     }
  
//     setTimeout(function() {
//         const status = $('.wpcf7-form.failed').attr('data-status'); 
//         if (status === 'send') {
//           closePopup('.popup-wrapp-container');
//             sendPopup.addClass('active');
//             setTimeout(function() {
//              location.reload();
//           }, 2000); 
//         }
//     }, 5000); 
// });

// $('.star_rating_class img').hover(function() {
//     var altValue = $(this).attr('alt');
//     $('.focus-data-value').text(altValue);
// });


// toggleSwitch.click(function() {
//     $(this).toggleClass('switch-on');
//     checkFields();
// });



const toggleSwitch = $('.switch-btn');
 const lastNameField = $('span[data-name="text-805"]');
const firstNameField = $('span[data-name="text-807"]');
 const lastNameFieldInput = $('span[data-name="text-805"] input');
 const firstNameFieldInput = $('span[data-name="text-807"] input');
const emailField = $('input[name="email-335"]');
const submitButton = $('.wpcf7-submit');
const sendPopup = $('.send-popup');
const agreePersonal = $('.agree-personal-data');

console.log(sendPopup);

function checkFields() {
    //console.log('Toggle Switch Class:', toggleSwitch.attr('class'));

    if (!toggleSwitch.hasClass('switch-on')) {
        submitButton.prop('disabled', false);
        lastNameField.attr('required', 'required');
        firstNameField.attr('required', 'required');
        lastNameField.show();
        firstNameField.show();
        agreePersonal.show();
    } else {
        lastNameField.removeAttr('required');
        firstNameField.removeAttr('required');
        lastNameField.hide();
        firstNameField.hide();
        agreePersonal.hide();
        submitButton.prop('disabled', true);
    }
}

toggleSwitch.click(function() {
    $(this).toggleClass('switch-on');
    checkFields();
});

function validateEmail() {
    const emailValue = emailField.val();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailValue)) {
        emailField.addClass('invalid');
        submitButton.prop('disabled', true);
    } else {
        emailField.removeClass('invalid');
        submitButton.prop('disabled', false);
    }
}

emailField.on('input', validateEmail);
validateEmail();

submitButton.click(function() {
    if (lastNameFieldInput.val() === '' || firstNameFieldInput.val() === '') {
        submitButton.prop('disabled', true);
        lastNameFieldInput.addClass('placeholder-red');
        firstNameFieldInput.addClass('placeholder-red');
    } else {
        submitButton.prop('disabled', false);
        lastNameFieldInput.removeClass('placeholder-red');
        firstNameFieldInput.removeClass('placeholder-red');
    }
  
    setTimeout(checkFormStatus, 5000);
});

function checkFormStatus() {
    const status = $('.wpcf7-form').attr('data-status');
    console.log('Статус:', status);
    if (status === 'sent') {
        console.log('Processing status:', status);
        sendPopup.addClass('active');
        setTimeout(function() {
            location.reload();
        }, 2000);
    } else if (status === 'resetting') {
        console.log('resetting');
        setTimeout(checkFormStatus, 1000);
    } else {
        setTimeout(checkFormStatus, 1000); 
    }
}


sendPopup.click(function() {
  sendPopup.removeClass('active');
});

lastNameField.add(firstNameField).on('input', checkFields);
checkFields();

});