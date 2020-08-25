<?php


namespace App\Repositories;


use App\LocalGovernmentArea;

class LocalGovernmentAreaRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    function model()
    {
        return LocalGovernmentArea::class;
    }
}
