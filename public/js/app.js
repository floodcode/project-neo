'use strict';

var App = {
    debug: false,
    host: '',
    init: function(config) {
        this.debug = config.debug;
        this.host = config.host;
    },
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
    },
    log: function(message) {
        if (this.debug) {
            console.log(message);
        }
    }
};

/**
 * Recaptcha callbacks
 */

function recaptchaCallback(result) {
    App.log("Recaptcha updated:\n" + result);
    App.recaptchaUpdate(result);
}

function recaptchaExpiredCallback() {
    App.log('Recaptcha expired');
    App.recaptchaUpdate('');
}

function recaptchaErrorCallback() {
    App.log('Recaptcha error');
    App.recaptchaUpdate('');
}

/**
 * End
 */