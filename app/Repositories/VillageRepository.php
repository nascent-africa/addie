<?php


namespace App\Repositories;


use App\Village;

class VillageRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    function model()
    {
        return Village::class;
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
