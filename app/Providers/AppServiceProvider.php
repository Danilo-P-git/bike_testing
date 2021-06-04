<?php

namespace App\Providers;
use App\Observers\BikeObserver;
use App\Observers\ContractObserver;

use App\Models\Bike;
use App\Models\Contract;


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
        Contract::observe(ContractObserver::class);

    }
}
