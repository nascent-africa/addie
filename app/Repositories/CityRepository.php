<?php


namespace App\Repositories;


use App\City;

class CityRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    function model()
    {
        return City::class;
    }
}
