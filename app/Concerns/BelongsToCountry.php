<?php


namespace App\Concerns;


use App\Country;
use App\Support\Helpers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

trait BelongsToCountry
{
    /**
     * Get this region's country.
     *
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class)->withDefault();
    }

    /**
     * @return mixed
     */
    public function getCachedCountryAttribute()
    {
        return Cache::remember($this->cacheKey() . ':country', Helpers::CACHE_TIME, function () {
            return $this->country;
        });
    }
}
