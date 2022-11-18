<?php

namespace App\Providers;

use App\Services\Traits\RepositorySetup;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    use RepositorySetup;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->callApp();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Paginator::useBootstrap();
        // Paginator::useBootstrapFive();
    }
}