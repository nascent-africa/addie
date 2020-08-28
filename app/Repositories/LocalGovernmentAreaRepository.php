<?php


namespace App\Repositories;


use App\LocalGovernmentArea;

class LocalGovernmentAreaRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    function model()
    {
        return LocalGovernmentArea::class;
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
