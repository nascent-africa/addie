<?php

namespace App;

use App\Contracts\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'longitude', 'latitude', 'country_id'
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
}
