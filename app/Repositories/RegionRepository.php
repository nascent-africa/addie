<?php


namespace App\Repositories;


use App\Region;

class RegionRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    function model()
    {
        return Region::class;
    }
}
