<?php


namespace App\Repositories;


use App\Support\Helpers;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

abstract class BaseRepository implements BaseRepositoryInterface
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
     * @return BaseRepositoryInterface
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
    public function withCollectionRelationship()
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
            $result = $this->model->latest()->with($this->withCollectionRelationship());
        }

        return $result->paginate(30);
    }

    /**
     * Get all the records for this entity.
     *
     * @param string $cacheKey
     * @return Collection|mixed
     */
    public function apiAll(string $cacheKey)
    {
        return Cache::remember($cacheKey, Helpers::CACHE_TIME, function () {
            return $this->model->orderBy("name->".app()->getLocale(), 'asc')->get();
        });
    }

    /**
     * Get a record alongside the listed relationships
     *
     * @param string $name
     * @param array|string $relationship
     * @param string $cacheKey
     * @return Model
     */
    public function apiFindByNameWithRelationship(string $name, $relationship, string $cacheKey)
    {
        return Cache::remember($cacheKey, Helpers::CACHE_TIME, function () use($name, $relationship) {
            return $this->model->with($relationship)
                ->where("name->".app()->getLocale(), $name)
                ->firstOrFail();
        });
    }

    /**
     * Get the relationship specified for this model.
     *
     * @param string $name
     * @param string $relationship
     * @return Collection|Model|mixed
     */
    public function getRelationshipBelongingTo(string $name, string $relationship)
    {
        return ($this->model->where("name->".app()->getLocale(), $name)
                            ->firstOrFail())
                            ->{$relationship};
    }
}
