<?php

namespace App\Observers;

use App\Region;
use Illuminate\Support\Facades\Cache;

class RegionObserver
{
    /**
     * Handle the region "created" event.
     *
     * @param Region $region
     * @return void
     */
    public function created(Region $region)
    {
        // Clean cache...
        Cache::forget('region:'.$region->slug);
        Cache::forget('api:regions');
        Cache::forget('api:regions:'.$region->name);
    }

    /**
     * Handle the region "updated" event.
     *
     * @param Region $region
     * @return void
     */
    public function updated(Region $region)
    {
        // Clean cache...
        Cache::forget('region:'.$region->slug);
        Cache::forget('api:regions');
        Cache::forget('api:regions:'.$region->name);
    }

    /**
     * Handle the region "deleted" event.
     *
     * @param Region $region
     * @return void
     */
    public function deleted(Region $region)
    {
        // Clean cache...
        Cache::forget('region:'.$region->slug);
        Cache::forget('api:regions');
        Cache::forget('api:regions:'.$region->name);
    }

    /**
     * Handle the region "restored" event.
     *
     * @param Region $region
     * @return void
     */
    public function restored(Region $region)
    {
        // Clean cache...
        Cache::forget('region:'.$region->slug);
        Cache::forget('api:regions');
        Cache::forget('api:regions:'.$region->name);
    }

    /**
     * Handle the region "force deleted" event.
     *
     * @param Region $region
     * @return void
     */
    public function forceDeleted(Region $region)
    {
        // Clean cache...
        Cache::forget('region:'.$region->slug);
        Cache::forget('api:regions');
        Cache::forget('api:regions:'.$region->name);
    }
}
