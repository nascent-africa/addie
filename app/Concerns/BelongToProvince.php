<?php


namespace App\Concerns;


use App\Province;
use App\Support\Helpers;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

trait BelongToProvince
{
    /**
     * Get the province of this city
     *
     * @return BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class)->withDefault();
    }

    /**
     * @return mixed
     */
    public function getCachedProvinceAttribute()
    {
        return Cache::remember($this->cacheKey() . ':province', Helpers::CACHE_TIME, function () {
            return $this->province;
        });
    }
}
