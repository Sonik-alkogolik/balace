jQuery(document).ready(function($) {
    var compareFlag = false;
    var button = $('button.ever_compare_button > span > a');
    function checkForButton() {
        if (button.length && !compareFlag) {
            compareFlag = true; 
            checkProductStatus(button);
        }
    }
    function checkProductStatus(button) {
        if (button.hasClass('added')) {
            //console.log("Товар в сравнении, показываем кнопку");
            $('.btn_ever_compare').show();
        } else {
            //console.log("Товар не в сравнении, скрываем кнопку");
            $('.btn_ever_compare').hide();
        }
    }
    var interval = setInterval(function() {
        checkForButton();
        if (compareFlag) {
            clearInterval(interval);
        }
    }, 500);
    $(document).on('click', '.ever_compare_button', function(e) {
        e.preventDefault();
        setTimeout(function() {
        checkProductStatus(button); 
      }, 8000);
    });

});