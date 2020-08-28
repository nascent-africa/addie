<?php


namespace App\Repositories;


use App\User;

class UserRepository extends BaseRepository implements BaseRepositoryInterface
{
    /**
     * @return mixed
     */
    function model()
    {
        return User::class;
    }
}
