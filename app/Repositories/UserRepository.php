<?php


namespace App\Repositories;


use App\User;

class UserRepository extends BaseRepository
{
    /**
     * @return mixed
     */
    function model()
    {
        return User::class;
    }
}
