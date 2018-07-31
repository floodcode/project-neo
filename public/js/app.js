'use strict';

var App = {
    sendRequest: function(url, data = null, callback = null) {
        $.ajax({
            url: url,
            method: 'POST',
            data: data,
            dataType: 'json',
            success: callback,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
};