<?php

namespace App\Providers;

use App\Services\PhoneDataService;
use Illuminate\Pagination\Paginator;
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
        $this->app->bind(PhoneDataService::class, function ($app) {
            return new PhoneDataService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultSimpleView('vendor.pagination.simple-bootstrap-4');
    }
}
