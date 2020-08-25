<?php


namespace App\Repositories;


use App\Province;

class ProvinceRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    function model()
    {
        return Province::class;
    }
}
