<?php


namespace App\Contracts;

use Spatie\Sluggable\HasSlug as SlugTrait;
use Spatie\Sluggable\SlugOptions;

trait HasSlug
{
    use SlugTrait;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
