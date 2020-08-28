<?php

namespace App;

use App\Concerns\HasSearch;
use App\Concerns\HasSlug;
use App\Support\Helpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;
use Laravel\Scout\Searchable;

class Village extends Model
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
        'name', 'longitude', 'latitude', 'city_id',
        'country_id', 'region_id', 'province_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'country_id' => 'integer',
        'region_id' => 'integer',
        'province_id' => 'integer',
        'city_id' => 'integer'
    ];

    /**
     * Get this region of this village.
     *
     * @return BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Get the region for this village
     *
     * @return BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the province of this village
     *
     * @return BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get the local government of this village.
     *
     * @return BelongsTo
     */
    public function localGovernmentArea()
    {
        return $this->belongsTo(LocalGovernmentArea::class);
    }

    /**
     * Get the city this village is in.
     *
     * @return BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return Province|null
     */
    public function resolveRouteBinding($value, $field = null)
    {
        return Cache::remember('village:'.$value, Helpers::CACHE_TIME, function () use($value) {
            return $this->querySlug($value)->firstOrFail();
        });
    }
}
