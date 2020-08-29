<?php


namespace App\Concerns;


use App\Region;
use App\Support\Helpers;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

trait HasManyRegions
{
    /**
     * Get all the regions in this country.
     *
     * @return HasMany
     */
    public function regions()
    {
        return $this->hasMany(Region::class);
    }

    /**
     * @return mixed
     */
    public function getCachedRegionsAttribute()
    {
        return Cache::remember($this->cacheKey() . ':regions', Helpers::CACHE_TIME, function () {
            return $this->regions;
        });
    }
}
