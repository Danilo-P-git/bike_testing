<?php

namespace App\Providers;
use App\Observers\BikeObserver;
use App\Models\Bike;

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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Bike::observe(BikeObserver::class);
    }
}
