// jQuery(document).ready(function($) {

 
//         var $preloader = $('#preloader');
//         if (!getCookie('preloader_show')) {
//             $preloader.show();
//             $preloader.delay(1800).fadeOut('slow', function () {
//                 setCookie('preloader_show', 'true', 365); 
//                 if (!getCookie('age_verified')) {
//                     $('.age-verification').fadeIn('slow');
//                 }
//             });
//         }else {
//             $preloader.hide();
//             console.log(" куки записана");
//         }
     
        
//         $('.age-yes').on('click', function () {
//             setCookie('age_verified', 'true', 365); 
//             $('.age-verification').fadeOut('slow');
//         });
        
//         $('.age-no').on('click', function () {
//             $('.age-verification-wrapp').remove();
//             $('.age-no-text').css('display','block');
//         });


//         $(".dws-progress-bar").circularProgress({
//             color: "#FFFFFF",
//             line_width: 17,
//             height: "350px",
//             width: "350px",
//             percent: 0,
//             // counter_clockwise: true,
//             starting_position: 25
//         }).circularProgress('animate', 100, 2000);
    
    
    
//     // Функция для установки cookie
//     function setCookie(name, value, days) {
//         var expires = "";
//         if (days) {
//             var date = new Date();
//             date.setTime(date.getTime() + (days*24*60*60*1000));
//             expires = "; expires=" + date.toUTCString();
//         }
//         document.cookie = name + "=" + (value || "")  + expires + "; path=/";
//     }
    
//     // Функция для получения значения cookie
//     function getCookie(name) {
//         var nameEQ = name + "=";
//         var ca = document.cookie.split(';');
//         for(var i=0;i < ca.length;i++) {
//             var c = ca[i];
//             while (c.charAt(0)==' ') c = c.substring(1,c.length);
//             if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
//         }
//         return null;
//     }

// });


// jQuery(document).ready(function($) {
//     var $preloader = $('#preloader');
//     var animationCompleted = false;
//     var pageLoaded = false;

//     // Проверка и управление прелоадером
//     if (!getCookie('preloader_show')) {
//         $preloader.show();
//         $preloader.delay(1800).fadeOut('slow', function () {
//             setCookie('preloader_show', 'true', 365);
//             if (!getCookie('age_verified')) {
//                 $('.age-verification').fadeIn('slow');
//             }
//         });
//     } else {
//         $preloader.hide();
//         console.log("Куки записана");
//     }

//     // Обработчики кликов
//     $('.age-yes').on('click', function () {
//         setCookie('age_verified', 'true', 365);
//         $('.age-verification').fadeOut('slow');
//     });
    
//     $('.age-no').on('click', function () {
//         $('.age-verification-wrapp').remove();
//         $('.age-no-text').css('display', 'block');
//     });

//     // Инициализация и анимация прогресс-бара
//     $(".dws-progress-bar").circularProgress({
//         color: "#FFFFFF",
//         line_width: 17,
//         height: "350px",
//         width: "350px",
//         percent: 0,
//         starting_position: 25
//     }).circularProgress('animate', 100, 2000, function() {
//         animationCompleted = true; 
//         checkAndHidePreloader();
//     });

//     // Проверка и скрытие прелоадера
//     function checkAndHidePreloader() {
//         if (animationCompleted && pageLoaded) {
//             $('#preloader').fadeOut('slow');
//         }
//     }

//     // Событие для полной загрузки страницы
//     $(window).on('load', function () {
//         pageLoaded = true;
//         checkAndHidePreloader();
//     });

//     // Функция для установки cookie
//     function setCookie(name, value, days) {
//         var expires = "";
//         if (days) {
//             var date = new Date();
//             date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
//             expires = "; expires=" + date.toUTCString();
//         }
//         document.cookie = name + "=" + (value || "")  + expires + "; path=/";
//     }
    
//     // Функция для получения значения cookie
//     function getCookie(name) {
//         var nameEQ = name + "=";
//         var ca = document.cookie.split(';');
//         for (var i = 0; i < ca.length; i++) {
//             var c = ca[i];
//             while (c.charAt(0) == ' ') c = c.substring(1, c.length);
//             if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
//         }
//         return null;
//     }
// });

jQuery(document).ready(function($) {
    var $preloader = $('#preloader');
    var animationCompleted = false;
    var pageLoaded = false;

    // Проверка и управление прелоадером
    if (!getCookie('preloader_show')) {
        $preloader.show();
        $preloader.delay(1800).fadeOut('slow', function () {
            setSessionCookie('preloader_show', 'true'); // Устанавливаем сессионную куку
            if (!getCookie('age_verified')) {
                $('.age-verification').fadeIn('slow');
            }
        });
    } else {
        $preloader.hide();
        console.log("Куки записана");
    }

    // Обработчики кликов
    $('.age-yes').on('click', function () {
        setSessionCookie('age_verified', 'true'); // Устанавливаем сессионную куку
        $('.age-verification').fadeOut('slow');
    });
    
    $('.age-no').on('click', function () {
        $('.age-verification-wrapp').remove();
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

    // Функция для установки сессионной куки
    function setSessionCookie(name, value) {
        document.cookie = name + "=" + (value || "") + "; path=/"; // Устанавливаем сессионную куку без указания expires
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