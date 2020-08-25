<?php


namespace App\Repositories;


use App\Village;

class VillageRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    function model()
    {
        return Village::class;
    }
}
