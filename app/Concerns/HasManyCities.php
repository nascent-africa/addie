<?php


namespace App\Concerns;


use App\City;
use App\Support\Helpers;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

trait HasManyCities
{
    /**
     * Get cities belonging to this entity
     *
     * @return HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * @return mixed
     */
    public function getCachedCitiesAttribute()
    {
        return Cache::remember($this->cacheKey() . ':cities', Helpers::CACHE_TIME, function () {
            return $this->cities;
        });
    }
}
