<?php

namespace App\Observers;

use App\Country;
use Illuminate\Support\Facades\Cache;

class CountryObserver
{
    /**
     * Handle the country "created" event.
     *
     * @param Country $country
     * @return void
     */
    public function created(Country $country)
    {
        // Clean cache...
        Cache::forget('country:'.$country->slug);
    }

    /**
     * Handle the country "updated" event.
     *
     * @param Country $country
     * @return void
     */
    public function updated(Country $country)
    {
        // Clean cache...
        Cache::forget('country:'.$country->slug);
    }

    /**
     * Handle the country "deleted" event.
     *
     * @param Country $country
     * @return void
     */
    public function deleted(Country $country)
    {
        // Clean cache...
        Cache::forget('country:'.$country->slug);
    }

    /**
     * Handle the country "restored" event.
     *
     * @param Country $country
     * @return void
     */
    public function restored(Country $country)
    {
        // Clean cache...
        Cache::forget('country:'.$country->slug);
    }

    /**
     * Handle the country "force deleted" event.
     *
     * @param Country $country
     * @return void
     */
    public function forceDeleted(Country $country)
    {
        // Clean cache...
        Cache::forget('country:'.$country->slug);
    }
}
