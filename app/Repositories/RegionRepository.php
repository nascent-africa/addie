<?php


namespace App\Repositories;


use App\Region;

class RegionRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    function model()
    {
        return Region::class;
    }

    /**
     * The relations to eager load on every query.
     *
     * @return array
     */
    public function withCollectionRelationship()
    {
        return ['country'];
    }
}
