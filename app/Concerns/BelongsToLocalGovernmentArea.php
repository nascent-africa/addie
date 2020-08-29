<?php


namespace App\Concerns;


use App\LocalGovernmentArea;
use App\Support\Helpers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

trait BelongsToLocalGovernmentArea
{
    /**
     * Get the local government of this city.
     *
     * @return BelongsTo
     */
    public function localGovernmentArea()
    {
        return $this->belongsTo(LocalGovernmentArea::class)->withDefault();
    }

    /**
     * @return mixed
     */
    public function getCachedLocalGovernmentAreaAttribute()
    {
        return Cache::remember($this->cacheKey() . ':local_government_area', Helpers::CACHE_TIME, function () {
            return $this->localGovernmentArea;
        });
    }
}
