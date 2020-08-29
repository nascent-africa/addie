<?php

namespace App;

use App\Contracts\CacheableModelInterface;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Country extends Model implements CacheableModelInterface
{
    use Searchable,
        Concerns\HasSlug,
        Concerns\HasCache,
        Concerns\HasManyRegions,
        Concerns\HasManyProvinces,
        Concerns\HasManyLocalGovernmentAreas,
        Concerns\HasManyCities,
        Concerns\HasManyVillages;

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['regions', 'provinces', 'localGovernmentAreas', 'cities', 'villages'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'longitude', 'latitude', 'iso_code', 'calling_code'
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
