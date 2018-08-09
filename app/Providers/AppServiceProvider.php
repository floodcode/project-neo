<?php

namespace App\Providers;

use App\Core\Locale;
use App\Models\News;
use App\Observers\NewsObserver;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    const RECAPTCHA_VALIDATION_URL = 'https://www.google.com/recaptcha/api/siteverify';

    /**
     * Bootstrap application services.
     */
    public function boot()
    {
        $this->bootValidation();
        $this->bootLocale();
        $this->bootBlade();
        $this->bootObservers();
    }

    protected function bootLocale()
    {
        $host = request()->getHttpHost();
        $locale = Locale::getLocaleByHost($host);
        app()->setLocale($locale);
    }

    protected function bootBlade()
    {
        Blade::if('role', function($roleName) {
            $user = Auth::user();
            if (!$user) {
                return false;
            }

            return $user->hasRoleName($roleName);
        });

        Blade::if('recaptcha', function() {
            return recaptchaAvailable();
        });
    }

    protected function bootObservers()
    {
        News::observe(NewsObserver::class);
    }

    protected function bootValidation()
    {
        Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
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
        });
    }

    /**
     * Register application services.
     */
    public function register()
    {
        //
    }
}
