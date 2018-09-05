'use strict';

$(function() {
    // Footer language selector
    $('#language-select .dropdown-item').on('click', function() {
        var me = $(this),
            subdomain = me.data('subdomain');

        if (!me.hasClass('active')) {
            var prefix = '';
            if (subdomain.length) {
                prefix = subdomain + '.';
            }

            window.location.host = prefix + App.host;
        }
    });
});