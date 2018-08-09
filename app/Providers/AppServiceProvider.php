<?php

namespace App\Providers;

use App\Core\Locale;
use App\Models\News;
use App\Observers\NewsObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap application services.
     */
    public function boot()
    {
        $this->bootLocale();
        $this->bootBlade();
        $this->bootObservers();
        $this->bootValidation();
    }

    protected function bootLocale()
    {
        Locale::init();
    }

    protected function bootBlade()
    {
        Blade::if('role', function($roleName) {
            return userHasRole($roleName);
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
        Validator::extend('recaptcha', 'App\Rules\Recaptcha@passes');
    }

    /**
     * Register application services.
     */
    public function register()
    {
        //
    }
}
