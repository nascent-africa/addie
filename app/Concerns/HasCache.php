<?php


namespace App\Concerns;


trait HasCache
{
    /**
     * Get cache key
     *
     * @return string
     */
    public function cacheKey(): string
    {
        return sprintf(
            "%s/%s-%s",
            $this->getTable(),
            $this->getKey(),
            $this->updated_at->timestamp
        );
    }
}
