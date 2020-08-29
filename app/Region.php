<?php

namespace App;

use App\Concerns\BelongsToCountry;
use App\Contracts\CacheableModelInterface;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Region extends Model implements CacheableModelInterface
{
    use Searchable,
        Concerns\HasSlug,
        Concerns\HasCache,
        Concerns\HasManyProvinces,
        Concerns\HasManyLocalGovernmentAreas,
        Concerns\HasManyCities,
        Concerns\HasManyVillages,
        BelongsToCountry;

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['country', 'provinces', 'localGovernmentAreas', 'cities', 'villages'];

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
