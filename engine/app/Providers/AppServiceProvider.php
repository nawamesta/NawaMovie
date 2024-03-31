<?php

namespace App\Providers;

use config;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return realpath(base_path('/..'));
        });

        Schema::defaultStringLength(191);

        if(env('APP_SCHEME') == "https") {
            \URL::forceScheme('https');
        }

        Paginator::defaultView('paginate');

        $this->app->useLangPath(realpath(public_path('lang')));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        App::setLocale(conf('default_lang'));
    }
}
