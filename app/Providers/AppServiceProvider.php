<?php

namespace App\Providers;

use App\Composers\ViewComposer;
use Illuminate\Contracts\View\Factory;
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
        $this->app->singleton(ViewComposer::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @param Factory $view
     * @return void
     */
    public function boot(Factory $view)
    {
        $view->composer('*', ViewComposer::class);
    }
}
