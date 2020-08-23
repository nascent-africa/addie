<?php

namespace App;

use App\Contracts\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
