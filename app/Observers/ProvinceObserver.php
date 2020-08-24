<?php

namespace App\Observers;

use App\Province;
use Illuminate\Support\Facades\Cache;

class ProvinceObserver
{
    /**
     * Handle the province "created" event.
     *
     * @param Province $province
     * @return void
     */
    public function created(Province $province)
    {
        // Clean cache...
        Cache::forget('province:'.$province->slug);
    }

    /**
     * Handle the province "updated" event.
     *
     * @param Province $province
     * @return void
     */
    public function updated(Province $province)
    {
        // Clean cache...
        Cache::forget('province:'.$province->slug);
    }

    /**
     * Handle the province "deleted" event.
     *
     * @param Province $province
     * @return void
     */
    public function deleted(Province $province)
    {
        // Clean cache...
        Cache::forget('province:'.$province->slug);
    }

    /**
     * Handle the province "restored" event.
     *
     * @param Province $province
     * @return void
     */
    public function restored(Province $province)
    {
        // Clean cache...
        Cache::forget('province:'.$province->slug);
    }

    /**
     * Handle the province "force deleted" event.
     *
     * @param Province $province
     * @return void
     */
    public function forceDeleted(Province $province)
    {
        // Clean cache...
        Cache::forget('province:'.$province->slug);
    }
}
