jQuery(document).ready(function ($) {
    $('#fetch-birthdays-btn').on('click', function () {
        const month = $('#birth-month').val();
        const year = $('#birth-year').val();
        const nonce = birthdayFilterData.nonce;

        $.ajax({
            url: birthdayFilterData.ajax_url,
            method: 'POST',
            data: {
                action: 'fetch_birthdays',
                nonce: nonce,
                month: month,
                year: year
            },
            success: function (response) {
                if (response.success) {
                    $('#birthday-results').html(response.data.html);
                    alert('Total Birthdays: ' + response.data.total_count);
                } else {
                    $('#birthday-results').html('<p>' + response.data.message + '</p>');
                }
            },
            error: function () {
                $('#birthday-results').html('<p>Something went wrong.</p>');
            }
        });
    });
});
