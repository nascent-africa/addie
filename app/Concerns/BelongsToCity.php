<?php


namespace App\Concerns;


use App\City;
use App\Support\Helpers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

trait BelongsToCity
{
    /**
     * Get the city this village is in.
     *
     * @return BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class)->withDefault();
    }

    /**
     * @return mixed
     */
    public function getCachedCityAttribute()
    {
        return Cache::remember($this->cacheKey() . ':city', Helpers::CACHE_TIME, function () {
            return $this->city;
        });
    }
}
