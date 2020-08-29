<?php


namespace App\Concerns;


use App\Province;
use App\Support\Helpers;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

trait HasManyProvinces
{
    /**
     * Get the provinces for this entity
     *
     * @return HasMany
     */
    public function provinces()
    {
        return $this->hasMany(Province::class);
    }

    /**
     * @return mixed
     */
    public function getCachedProvincesAttribute()
    {
        return Cache::remember($this->cacheKey() . ':provinces', Helpers::CACHE_TIME, function () {
            return $this->provinces;
        });
    }
}
