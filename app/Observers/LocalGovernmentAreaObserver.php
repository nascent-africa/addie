<?php

namespace App\Observers;

use App\LocalGovernmentArea;
use Illuminate\Support\Facades\Cache;

class LocalGovernmentAreaObserver
{
    /**
     * Handle the local government area "created" event.
     *
     * @param LocalGovernmentArea $localGovernmentArea
     * @return void
     */
    public function created(LocalGovernmentArea $localGovernmentArea)
    {
        // Clean cache...
        Cache::forget('local-government-area:'.$localGovernmentArea->slug);
    }

    /**
     * Handle the local government area "updated" event.
     *
     * @param LocalGovernmentArea $localGovernmentArea
     * @return void
     */
    public function updated(LocalGovernmentArea $localGovernmentArea)
    {
        // Clean cache...
        Cache::forget('local-government-area:'.$localGovernmentArea->slug);
    }

    /**
     * Handle the local government area "deleted" event.
     *
     * @param LocalGovernmentArea $localGovernmentArea
     * @return void
     */
    public function deleted(LocalGovernmentArea $localGovernmentArea)
    {
        // Clean cache...
        Cache::forget('local-government-area:'.$localGovernmentArea->slug);
    }

    /**
     * Handle the local government area "restored" event.
     *
     * @param LocalGovernmentArea $localGovernmentArea
     * @return void
     */
    public function restored(LocalGovernmentArea $localGovernmentArea)
    {
        // Clean cache...
        Cache::forget('local-government-area:'.$localGovernmentArea->slug);
    }

    /**
     * Handle the local government area "force deleted" event.
     *
     * @param LocalGovernmentArea $localGovernmentArea
     * @return void
     */
    public function forceDeleted(LocalGovernmentArea $localGovernmentArea)
    {
        // Clean cache...
        Cache::forget('local-government-area:'.$localGovernmentArea->slug);
    }
}
