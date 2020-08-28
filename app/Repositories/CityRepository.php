<?php


namespace App\Repositories;


use App\City;

class CityRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    function model()
    {
        return City::class;
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
