<?php


namespace App\Contracts;


interface CacheableModelInterface
{
    /**
     * Get cache key
     *
     * @return string
     */
    public function cacheKey(): string;
}
