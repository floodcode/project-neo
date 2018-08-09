<?php

namespace App\Rules;

use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

class Recaptcha implements Rule
{
    const RECAPTCHA_VALIDATION_URL = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Do not validate captcha result if recaptcha is not available
        if (!recaptchaAvailable()) {
            return true;
        }

        if (empty($value) || !is_string($value)) {
            return false;
        }

        $httpClient = new Client();
        $response = $httpClient->post(self::RECAPTCHA_VALIDATION_URL, [
            'form_params' => [
                'secret' => config('recaptcha.secret'),
                'response' => $value
            ]
        ]);

        $responseBody = json_decode((string)$response->getBody());
        return $responseBody->success ?? false;
    }

    public function message()
    {
        //
    }
}
