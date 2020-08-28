<?php


namespace App\Repositories;


use App\Country;

class CountryRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    function model()
    {
        return Country::class;
    }
}
