<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    function model();

    /**
     * The relations to eager load on every query.
     *
     * @return array
     */
    public function withCollectionRelationship();

    /**
     * @return mixed
     */
    public function all();

    /**
     * Get the relationship specified for this model.
     *
     * @param string $name
     * @param string $relationship
     * @param string $cacheKey
     * @return Collection|Model|mixed
     */
    public function getRelationshipBelongingTo(string $name, string $relationship, string $cacheKey);

    /**
     * Get all the records for this entity.
     *
     * @param string $cacheKey
     * @return Collection|mixed
     */
    public function apiAll(string $cacheKey);

    /**
     * Get a record alongside the listed relationships
     *
     * @param string $name
     * @param array|string $relationship
     * @param string $cacheKey
     * @return Model
     */
    public function apiFindByNameWithRelationship(string $name, $relationship, $cacheKey);
}
