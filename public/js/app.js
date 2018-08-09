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
    },
    recaptchaUpdate: function(result) {
        var recaptchaInput = $('input.recaptha-result');
        if (recaptchaInput.length) {
            recaptchaInput.val(result);
            recaptchaInput.trigger('input');
        }
    }
};

/**
 * Recaptcha callbacks
 */

function recaptchaCallback(result) {
    App.recaptchaUpdate(result);
}

function recaptchaExpiredCallback() {
    App.recaptchaUpdate('');
}

function recaptchaErrorCallback() {
    App.recaptchaUpdate('');
}

/**
 * End
 */