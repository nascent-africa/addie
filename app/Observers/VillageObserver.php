<?php

namespace App\Observers;

use App\Village;
use Illuminate\Support\Facades\Cache;

class VillageObserver
{
    /**
     * Handle the village "created" event.
     *
     * @param Village $village
     * @return void
     */
    public function created(Village $village)
    {
        // Clean cache...
        Cache::forget('village:'.$village->slug);
        Cache::forget('api:villages');
        Cache::forget('api:villages:'.$village->name);
    }

    /**
     * Handle the village "updated" event.
     *
     * @param Village $village
     * @return void
     */
    public function updated(Village $village)
    {
        // Clean cache...
        Cache::forget('village:'.$village->slug);
        Cache::forget('api:villages');
        Cache::forget('api:villages:'.$village->name);
    }

    /**
     * Handle the village "deleted" event.
     *
     * @param Village $village
     * @return void
     */
    public function deleted(Village $village)
    {
        // Clean cache...
        Cache::forget('village:'.$village->slug);
        Cache::forget('api:villages');
        Cache::forget('api:villages:'.$village->name);
    }

    /**
     * Handle the village "restored" event.
     *
     * @param Village $village
     * @return void
     */
    public function restored(Village $village)
    {
        // Clean cache...
        Cache::forget('village:'.$village->slug);
        Cache::forget('api:villages');
        Cache::forget('api:villages:'.$village->name);
    }

    /**
     * Handle the village "force deleted" event.
     *
     * @param Village $village
     * @return void
     */
    public function forceDeleted(Village $village)
    {
        // Clean cache...
        Cache::forget('village:'.$village->slug);
        Cache::forget('api:villages');
        Cache::forget('api:villages:'.$village->name);
    }
}
