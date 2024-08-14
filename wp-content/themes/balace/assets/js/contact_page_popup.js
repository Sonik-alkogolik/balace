jQuery(document).ready(function($) {

  function openPopup(popupContainer) {
      $(popupContainer).addClass('active');
  }

  function closePopup(popupContainer) {
      $(popupContainer).removeClass('active');
      console.log(true);
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
  const submitButton = $('.wpcf7-submit');
  const sendPopup = $('.send-popup');
  const agreePersonal = $('.agree-personal-data');

  function checkFields() {
      console.log('Toggle Switch Class:', toggleSwitch.attr('class'));

      if (!toggleSwitch.hasClass('switch-on')) {
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
          submitButton.prop('disabled', false);
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
    
      setTimeout(function() {
          const status = $('.wpcf7-form.failed').attr('data-status'); 
          if (status === 'sent') {
              sendPopup.addClass('active');
              setTimeout(function() {
               location.reload();
            }, 2000); 
          }
      }, 5000); 
  });

  sendPopup.click(function() {
    sendPopup.removeClass('active');
  });

  lastNameField.add(firstNameField).on('input', checkFields);
  checkFields();
});
