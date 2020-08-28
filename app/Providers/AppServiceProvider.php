<?php

namespace App\Providers;

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
        //
        $this->observersHandle();
    }

    protected function observersHandle()
    {
        \App\Country::observe(\App\Observers\CountryObserver::class);
        \App\Region::observe(\App\Observers\RegionObserver::class);
        \App\Province::observe(\App\Observers\ProvinceObserver::class);
        \App\LocalGovernmentArea::observe(\App\Observers\LocalGovernmentAreaObserver::class);
        \App\City::observe(\App\Observers\CityObserver::class);
        \App\Village::observe(\App\Observers\VillageObserver::class);
    }

    public function bindings()
    {
        $this->app->bind(\App\Repositories\BaseRepositoryInterface::class, \App\Repositories\BaseRepository::class);
    }
}
