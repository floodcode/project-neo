'use strict';

$(function() {
    // Footer language selector
    $('#language-select').on('change', function() {
        window.location.host = $(this).val() + '.' + App.host;
    });
});