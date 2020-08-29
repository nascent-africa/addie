<?php


namespace App\Concerns;


use App\LocalGovernmentArea;
use App\Support\Helpers;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

trait HasManyLocalGovernmentAreas
{
    /**
     * Get local government area for this entity.
     *
     * @return HasMany
     */
    public function localGovernmentAreas()
    {
        return $this->hasMany(LocalGovernmentArea::class);
    }

    /**
     * @return mixed
     */
    public function getCachedLocalGovernmentAreasAttribute()
    {
        return Cache::remember($this->cacheKey() . ':local_government_areas', Helpers::CACHE_TIME, function () {
            return $this->localGovernmentAreas;
        });
    }
}
