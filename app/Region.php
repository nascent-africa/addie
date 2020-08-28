<?php

namespace App;

use App\Concerns\HasSearch;
use App\Concerns\HasSlug;
use App\Support\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Laravel\Scout\Searchable;

class Region extends Model
{
    use HasSlug, Searchable;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'longitude', 'latitude', 'country_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'country_id' => 'integer',
    ];

    /**
     * Get this region's country.
     *
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
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
     * Show local government areas in this region if any.
     *
     * @return HasMany
     */
    public function localGovernmentAreas()
    {
        return $this->hasMany(LocalGovernmentArea::class);
    }

    /**
     * Get the villages in this region
     *
     * @return HasMany
     */
    public function villages()
    {
        return $this->hasMany(Village::class);
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return Region|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return Cache::remember('region:'.$value, Helpers::CACHE_TIME, function () use($value) {
            return $this->querySlug($value)->firstOrFail();
        });
    }
}
