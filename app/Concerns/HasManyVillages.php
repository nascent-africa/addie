<?php


namespace App\Concerns;


use App\Support\Helpers;
use App\Village;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

trait HasManyVillages
{
    /**
     * Get villages belonging to this entity
     *
     * @return HasMany
     */
    public function villages()
    {
        return $this->hasMany(Village::class);
    }

    /**
     * @return mixed
     */
    public function getCachedVillagesAttribute()
    {
        return Cache::remember($this->cacheKey() . ':villages', Helpers::CACHE_TIME, function () {
            return $this->villages;
        });
    }
}
