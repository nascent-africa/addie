<?php


namespace App\Concerns;


use App\Region;
use App\Support\Helpers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

trait BelongsToRegion
{
    /**
     * Get the region this entity belongs to
     *
     * @return BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class)->withDefault();
    }

    /**
     * @return mixed
     */
    public function getCachedRegionAttribute()
    {
        return Cache::remember($this->cacheKey() . ':region', Helpers::CACHE_TIME, function () {
            return $this->region;
        });
    }
}
