jQuery(document).ready(function($) {
    $('.checkNumberButton').on('click', function() {
        var searchNumber = $('#search_number').val();
        var fileUrl = $('#file_url').val();
        if ($.trim(searchNumber) === '' || $.trim(fileUrl) === '') {
            $('#resultMessage').text('Введите номер и URL файла.');
            return;
        }
        $.ajax({
            url: licenseVerification.ajaxurl, 
            type: 'POST',
            data: {
                action: 'check_number_in_file', 
                search_number: searchNumber,
                file_url: fileUrl
            },
            success: function(response) {
                $('.result-search').css('display','flex');
                $('.result-number-span').html(searchNumber);
                $('#resultMessage').html(response);
            },
            error: function() {
                $('#resultMessage').html('Ошибка запроса. Попробуйте снова.');
            }
        });
    });
});