jQuery(document).ready(function($) {
    $(".dws-progress-bar").circularProgress({
        color: "#FFFFFF",
        line_width: 17,
        height: "350px",
        width: "350px",
        percent: 0,
        // counter_clockwise: true,
        starting_position: 25
    }).circularProgress('animate', 100, 2000);


    $(window).on('load', function () {
        var $preloader = $('#preloader');
        $preloader.delay(1800).fadeOut('slow', function () {
            if (!getCookie('age_verified')) {
                $('.age-verification').fadeIn('slow');
            }
        });
        
        $('.age-yes').on('click', function () {
            setCookie('age_verified', 'true', 365); 
            $('.age-verification').fadeOut('slow');
        });
        
        $('.age-no').on('click', function () {
            alert('Извините, доступ к сайту ограничен.');
            window.location.href = 'https://www.google.com';
        });
    });
    
    // Функция для установки cookie
    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days*24*60*60*1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "")  + expires + "; path=/";
    }
    
    // Функция для получения значения cookie
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }


});