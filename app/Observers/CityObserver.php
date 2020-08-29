<?php

namespace App\Observers;

use App\City;
use Illuminate\Support\Facades\Cache;

class CityObserver
{
    /**
     * Handle the city "created" event.
     *
     * @param City $city
     * @return void
     */
    public function created(City $city)
    {
        // Clean cache...
        Cache::forget('city:'.$city->slug);
        Cache::forget('api:cities');
        Cache::forget('api:cities:'.$city->name);
    }

    /**
     * Handle the city "updated" event.
     *
     * @param City $city
     * @return void
     */
    public function updated(City $city)
    {
        // Clean cache...
        Cache::forget('city:'.$city->slug);
        Cache::forget('api:cities');
        Cache::forget('api:cities:'.$city->name);
    }

    /**
     * Handle the city "deleted" event.
     *
     * @param City $city
     * @return void
     */
    public function deleted(City $city)
    {
        // Clean cache...
        Cache::forget('city:'.$city->slug);
        Cache::forget('api:cities');
        Cache::forget('api:cities:'.$city->name);
    }

    /**
     * Handle the city "restored" event.
     *
     * @param City $city
     * @return void
     */
    public function restored(City $city)
    {
        // Clean cache...
        Cache::forget('city:'.$city->slug);
        Cache::forget('api:cities');
        Cache::forget('api:cities:'.$city->name);
    }

    /**
     * Handle the city "force deleted" event.
     *
     * @param City $city
     * @return void
     */
    public function forceDeleted(City $city)
    {
        // Clean cache...
        Cache::forget('city:'.$city->slug);
        Cache::forget('api:cities');
        Cache::forget('api:cities:'.$city->name);
    }
}
