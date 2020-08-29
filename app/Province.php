<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Province extends Model
{
    use Searchable,
        Concerns\HasSlug,
        Concerns\HasCache,
        Concerns\HasManyLocalGovernmentAreas,
        Concerns\HasManyCities,
        Concerns\HasManyVillages,
        Concerns\BelongsToCountry,
        Concerns\BelongsToRegion;

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['country', 'region'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'longitude', 'latitude', 'country_id', 'region_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'country_id'    => 'integer',
        'region_id'     => 'integer'
    ];

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
}
