<?php


namespace App\Repositories;


use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /**
     * @var Collection|Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->makeModel();
    }

    abstract function model();

    /**
     * @return $this
     * @throws BindingResolutionException
     */
    protected function makeModel()
    {
        $this->model = app()->make($this->model());

        return $this;
    }

    /**
     * The relations to eager load on every query.
     *
     * @return array
     */
    public function with()
    {
        return [];
    }

    /**
     * @return mixed
     */
    public function all()
    {
        if ($search = request()->get('search')) {
            $result = $this->model->search($search);
        } else {
            $result = $this->model->latest()->with($this->with());
        }

        return $result->paginate(30);
    }
}
