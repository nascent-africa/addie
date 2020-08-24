<?php

namespace App;

use App\Contracts\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class City extends Model
{
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'longitude', 'latitude',
        'country_id', 'region_id', 'province_id'
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
     * Get the region for this province
     *
     * @return BelongsTo
     */
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    /**
     * Get the province of this city
     *
     * @return BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }

    /**
     * Get the local government of this city.
     *
     * @return BelongsTo
     */
    public function localGovernmentArea()
    {
        return $this->belongsTo(LocalGovernmentArea::class);
    }
}
