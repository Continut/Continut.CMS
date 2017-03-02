$(document).ready(function() {
    $("#dtBox").DateTimePicker({language: "ro"});
});

// Whenever an ajax request is completed in the backend, check if the Continut-Redirect headers are set
// and if so, redirect to this page (session expired)
$(document).ajaxSuccess(function(event, xhr, settings) {
    if (xhr.getResponseHeader('Continut-Redirect')) {
        window.location = xhr.getResponseHeader('Continut-Redirect');
    }
});