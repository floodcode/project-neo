<?php

namespace App\Providers;

use App\Core\Locale;
use App\Models\News;
use App\Observers\NewsObserver;
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
    }

    protected function bootObservers()
    {
        News::observe(NewsObserver::class);
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
