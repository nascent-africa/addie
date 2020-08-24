<?php

namespace App;

use App\Contracts\HasSlug;
use App\Support\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Country extends Model
{
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'longitude', 'latitude', 'iso_code', 'calling_code'
    ];

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
     * Get this country's provinces
     *
     * @return HasMany
     */
    public function provinces()
    {
        return $this->hasMany(Province::class);
    }

    /**
     * Get this country's cities
     *
     * @return HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class);
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return Country|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return Cache::remember('country:'.$value, Helpers::CACHE_TIME, function () use($value) {
            return $this->where('slug', $value)->firstOrFail();
        });
    }
}
