<?php


namespace App\Concerns;

use Illuminate\Database\Eloquent\Builder;
use Spatie\Sluggable\HasSlug as SlugTrait;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

trait HasSlug
{
    use HasTranslations, HasTranslatableSlug;

    public $translatable = ['name', 'slug'];

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

    /**
     * Scope a query to only include popular users.
     *
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeWhereSlug($query, $value)
    {
        return $query->where("slug->".app()->getLocale(), $value);
    }
}
