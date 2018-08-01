'use strict';

$(function() {
    $('#news-create-image').on('change', function() {
        var me = $(this);
        var fileName = me.val();
        $('#news-create-image-label').text(fileName);
    });
});