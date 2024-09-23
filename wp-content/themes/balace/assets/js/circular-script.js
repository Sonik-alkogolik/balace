jQuery(document).ready(function($) {
    var $preloader = $('#preloader');
    var animationCompleted = false;
    var pageLoaded = false;

    // Вызов функций для проверки прелоадера и возрастной верификации
    checkPreloader();
    checkAgeVerification();

    // Обработчики кликов
    $('.age-yes').on('click', function () {
        setSessionCookie('age_verified', 'true'); 
        $('.age-verification').fadeOut('slow');
    });
    
    $('.age-no').on('click', function () {
        $('.age-verification-wrapp').remove();
        setSessionCookie('age_verified', 'false'); 
        $('.age-no-text').css('display', 'block');
    });

    // Инициализация и анимация прогресс-бара
    $(".dws-progress-bar").circularProgress({
        color: "#FFFFFF",
        line_width: 17,
        height: "350px",
        width: "350px",
        percent: 0,
        starting_position: 25
    }).circularProgress('animate', 100, 2000, function() {
        animationCompleted = true; 
        checkAndHidePreloader();
    });

    // Проверка и скрытие прелоадера
    function checkAndHidePreloader() {
        if (animationCompleted && pageLoaded) {
            $('#preloader').fadeOut('slow');
        }
    }

    // Событие для полной загрузки страницы
    $(window).on('load', function () {
        pageLoaded = true;
        checkAndHidePreloader();
    });

    // Функция для проверки прелоадера
    function checkPreloader() {
        if (!getCookie('preloader_show')) {
            $preloader.show();
            $preloader.delay(1800).fadeOut('slow', function () {
                // Логика после исчезновения прелоадера (если необходима)
            });
        } else {
            $preloader.hide();
            console.log("Куки 'preloader_show' записана");
        }
    }

    // Функция для проверки возрастной верификации
    function checkAgeVerification() {
        var ageVerified = getCookie('age_verified');
        if (ageVerified === 'false') {
            $('.age-verification').fadeIn('slow');
        } else if (ageVerified === 'true') {
            $('.age-verification').fadeOut('slow');
        } else  {
            $('.age-verification').fadeIn('slow');
        }
    }

    // Функция для установки сессионной куки
    function setSessionCookie(name, value) {
        document.cookie = name + "=" + (value || "") + "; path=/; SameSite=Lax"; 
    }
    
    // Функция для получения значения cookie
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
});
