$(function() {
    $('#submit').prop('disabled', true);

    $('#agree').on('click', function() {
        if ($(this).prop('checked') == false) {
            $('#submit').prop('disabled', true);
        } else {
            $('#submit').prop('disabled', false);
        }
    });
});