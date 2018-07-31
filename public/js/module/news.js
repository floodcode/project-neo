'use strict';

$(function() {
    $('.delete-post').on('click', function() {
        $('#delete-news-modal').modal('show');
        $('#delete-post-confirm').data('id', $(this).data('id'));
    });

    $('#delete-post-confirm').on('click', function() {
        var me = $(this),
            id = me.data('id');

        App.sendRequest('/news/delete/' + id, null, function (data) {
            if (data.success) {
                window.location.href = '/news';
            }
        });
    });
});