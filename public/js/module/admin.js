'use strict';

$(function() {
    $('.create-category').on('click', function() {
        $('#create-category-modal').modal('show');
        $('#create-category-confirm').data('id', $(this).data('id'));
    });

    $('#create-category-confirm').on('click', function() {
        var data = {
            name: $('#create-category-modal input[name="name"]').val(),
            slug: $('#create-category-modal input[name="slug"]').val()
        };

        App.sendRequest('/admin/news/categories/create', data, function (data) {
            if (data.success) {
                window.location.reload();
            }
        });
    });

    $('.edit-category').on('click', function() {
        var me = $(this),
            id = me.data('id'),
            name = me.data('name'),
            slug = me.data('slug');

        $('#edit-category-modal input[name="name"]').val(name);
        $('#edit-category-modal input[name="slug"]').val(slug);
        $('#edit-category-confirm').data('id', id);
        $('#edit-category-modal').modal('show');
    });

    $('#edit-category-confirm').on('click', function() {
        var me = $(this),
            id = me.data('id');

        var data = {
            name: $('#edit-category-modal input[name="name"]').val(),
            slug: $('#edit-category-modal input[name="slug"]').val()
        };

        App.sendRequest('/admin/news/categories/edit/' + id, data, function (data) {
            if (data.success) {
                window.location.reload();
            }
        });
    });

    $('.delete-category').on('click', function() {
        $('#delete-category-confirm').data('id', $(this).data('id'));
        $('#delete-category-modal').modal('show');
    });

    $('#delete-category-confirm').on('click', function() {
        var me = $(this),
            id = me.data('id');

        App.sendRequest('/admin/news/categories/delete/' + id, null, function (data) {
            if (data.success) {
                window.location.reload();
            }
        });
    });
});