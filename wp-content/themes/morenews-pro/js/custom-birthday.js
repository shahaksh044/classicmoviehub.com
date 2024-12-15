jQuery(document).ready(function ($) {
    $('#month-select').on('change', function () {
        let month = $(this).val();
        $('#birthday-results').html('<p>Loading...</p>');

        $.post(customBirthdayAjax.ajax_url, {
            action: 'fetch_birthdays',
            month: month,
        }, function (response) {
            if (response.success) {
                $('#birthday-results').html(response.data.html);
            } else {
                $('#birthday-results').html('<p>' + response.data.message + '</p>');
            }
        });
    });
});
