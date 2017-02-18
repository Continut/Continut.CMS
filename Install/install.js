$(function() {
    $( document ).on('submit', '.form', function(event) {
        event.preventDefault();

        $.post($(this).attr('action'), function(data) {
            $('#steps_container').html(data);
        })
            .fail(function() {
                console.log('Could not retrieve data');
            })
            .always(function() {
                console.log('finished');
            });
    });
});