'use strict';

$(function() {
    // Post actions
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

    $('.delete-post-translation').on('click', function() {
        $('#delete-news-translation-modal').modal('show');
        $('#delete-post-translation-confirm').data('id', $(this).data('id'));
    });

    $('#delete-post-translation-confirm').on('click', function() {
        var me = $(this),
            id = me.data('id');

        App.sendRequest('/news/delete-translation/' + id, null, function (data) {
            if (data.success) {
                window.location.reload();
            }
        });
    });

    $('#comment-create').on('click', function() {
        var me = $(this),
            id = me.data('id'),
            message = $('#comment-message').val();

        var data = {
            message: message
        };

        App.sendRequest('/news/comment/create/' + id, data, function (data) {
            if (data.success) {
                window.location.reload();
            }
        });
    });

    $('.delete-comment').on('click', function() {
        $('#delete-comment-modal').modal('show');
        $('#delete-comment-confirm').data('id', $(this).data('id'));
    });

    $('#delete-comment-confirm').on('click', function() {
        var me = $(this),
            id = me.data('id');

        App.sendRequest('/news/comment/delete/' + id, null, function (data) {
            if (data.success) {
                window.location.reload();
            }
        });
    });
});