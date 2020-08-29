<?php

namespace App;

use App\Contracts\CacheableModelInterface;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class City extends Model implements CacheableModelInterface
{
    use Searchable,
        Concerns\HasSlug,
        Concerns\HasCache,
        Concerns\HasManyVillages,
        Concerns\BelongsToCountry,
        Concerns\BelongsToRegion,
        Concerns\BelongToProvince,
        Concerns\BelongsToLocalGovernmentArea;

    /**
     * The relationships that should be touched on save.
     *
     * @var array
     */
    protected $touches = ['country', 'region', 'province', 'localGovernmentArea', 'villages'];

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
        'name', 'longitude', 'latitude', 'local_government_area_id',
        'country_id', 'region_id', 'province_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'country_id'                => 'integer',
        'region_id'                 => 'integer',
        'province_id'               => 'integer',
        'local_government_area_id'  => 'integer',
    ];
}
