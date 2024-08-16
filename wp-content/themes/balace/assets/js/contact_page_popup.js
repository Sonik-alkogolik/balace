jQuery(document).ready(function($) {

  function openPopup(popupContainer) {
      $(popupContainer).addClass('active');
  }

  function closePopup(popupContainer) {
      $(popupContainer).removeClass('active');
      //console.log(true);
  }
  function initializePopup(popupBtnSelector, popupContainerSelector, closeBtnSelector) {
      const popupBtn = $(popupBtnSelector);
      const popupContainer = $(popupContainerSelector);
      const closeBtn = popupContainer.find(closeBtnSelector);

      popupBtn.on('click', function() {
          openPopup(popupContainer);
      });

      closeBtn.on('click', function() {
          closePopup(popupContainer);
      });

      popupContainer.on('click', function(e) {
          if ($(e.target).is(popupContainer)) {
              closePopup(popupContainer);
          }
      });
  }


  initializePopup('.btn-form-popup', '.popup-wrapp-container', '.close-popup-btn');


  const toggleSwitch = $('.switch-btn');
  const lastNameField = $('span[data-name="text-801"]');
  const firstNameField = $('span[data-name="text-802"]');
  const lastNameFieldInput = $('span[data-name="text-801"] input');
  const firstNameFieldInput = $('span[data-name="text-802"] input');
  const emailField = $('input[name="email-333"]');
  const emailFieldSpan =  $('span[data-name="email-333"]');
  const submitButton = $('.btn_form_submit');
  const sendPopup = $('.send-popup');
  const agreePersonal = $('.agree-personal-data');
  const textComment = $('textarea[name="textarea-462"]');
  const textCommentSpan = $('span[data-name="textarea-462"]');

//   function checkFields() {
//       console.log('Toggle Switch Class:', toggleSwitch.attr('class'));

//       if (!toggleSwitch.hasClass('switch-on')) {
//           lastNameField.attr('required', 'required');
//           firstNameField.attr('required', 'required');
//           lastNameField.show();
//           firstNameField.show();
//           agreePersonal.show();
//       } else {
//           lastNameField.removeAttr('required');
//           firstNameField.removeAttr('required');
//           lastNameField.hide();
//           firstNameField.hide();
//           agreePersonal.hide();
//           submitButton.prop('disabled', false);
//       }
//   }

//   toggleSwitch.click(function() {
//       $(this).toggleClass('switch-on');
//       checkFields();
//   });

//   function validateEmail() {
//       const emailValue = emailField.val();
//       const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//       if (!emailRegex.test(emailValue)) {
//           emailField.addClass('invalid');
//           submitButton.prop('disabled', true);
//       } else {
//           emailField.removeClass('invalid');
//           submitButton.prop('disabled', false);
//       }
//   }

//   emailField.on('input', validateEmail);
//   validateEmail();

//   submitButton.click(function() {
//       if (lastNameFieldInput.val() === '' || firstNameFieldInput.val() === '') {
//           submitButton.prop('disabled', true);
//           lastNameFieldInput.addClass('placeholder-red');
//           firstNameFieldInput.addClass('placeholder-red');
//       } else {
//           submitButton.prop('disabled', false);
//           lastNameFieldInput.removeClass('placeholder-red');
//           firstNameFieldInput.removeClass('placeholder-red');
//       }
    
//       setTimeout(function() {
//           const status = $('.wpcf7-form.failed').attr('data-status'); 
//           if (status === 'sent') {
//               sendPopup.addClass('active');
//               setTimeout(function() {
//                location.reload();
//             }, 2000); 
//           }
//       }, 5000); 
//   });

//   sendPopup.click(function() {
//     sendPopup.removeClass('active');
//   });

//   lastNameField.add(firstNameField).on('input', checkFields);
//   checkFields();


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
    submitButton.prop('disabled', false);
    submitButton.css('background','rgba(0, 0, 0, 1)');
  
});

function validateEmail() {
    const emailValue = emailField.val();
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailValue)|| textComment.val().trim() === '') {
        emailField.addClass('invalid');
        submitButton.prop('disabled', true);
        emailFieldSpan.addClass('placeholder-red');
        textCommentSpan.addClass('placeholder-red');
    } else {
        emailField.removeClass('invalid');
        submitButton.prop('disabled', false);
        submitButton.css('background','rgba(0, 0, 0, 1)');
        emailFieldSpan.removeClass('placeholder-red');
        textCommentSpan.removeClass('placeholder-red');
    }
}

emailField.on('input', validateEmail);
// validateEmail();

submitButton.click(function() {
   if (toggleSwitch.hasClass('switch-on') ) {
        validateEmail();
    } else {

    if (lastNameFieldInput.val() === '' || firstNameFieldInput.val() === ''  || textComment.val().trim() === '') {
        submitButton.prop('disabled', true);
        submitButton.css('background','#645F4D');
        lastNameFieldInput.addClass('placeholder-red');
        firstNameFieldInput.addClass('placeholder-red');
        textCommentSpan.addClass('placeholder-red');
        emailFieldSpan.addClass('placeholder-red');
    } else {
        submitButton.prop('disabled', false);
        submitButton.css('background','rgba(0, 0, 0, 1)');
        lastNameFieldInput.removeClass('placeholder-red');
        firstNameFieldInput.removeClass('placeholder-red');
        textCommentSpan.removeClass('placeholder-red');
        emailFieldSpan.removeClass('placeholder-red');
        checkFormStatus();
    }
  
    setTimeout(checkFormStatus, 5000);
  }
});

function checkFormStatus() {
    const status = $('.wpcf7-form').attr('data-status');
    console.log('Статус:', status);
    if (status === 'sent') {
        console.log('Processing status:', status);
        $('.popup-wrapp-container').addClass('active');
        $('.popup-content').remove();
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
