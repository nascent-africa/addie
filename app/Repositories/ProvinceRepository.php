<?php


namespace App\Repositories;


use App\Province;

class ProvinceRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    function model()
    {
        return Province::class;
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
