<?php


namespace App\Repositories;


use App\Country;

class CountryRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    function model()
    {
        return Country::class;
    }
}
