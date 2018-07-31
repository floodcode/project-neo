<?php

namespace App\Providers;

use App\Core\Locale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $host = request()->getHttpHost();
        $locale = Locale::getLocaleByHost($host);
        app()->setLocale($locale);

        Blade::if('role', function($roleName) {
            $user = Auth::user();
            if (!$user) {
                return false;
            }

            return $user->hasRoleName($roleName);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
