<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\InvalidLocaleException;
use App\Http\Resources\CityCollection;
use App\Http\Resources\Country as CountryResource;
use App\Http\Resources\LocalGovernmentAreaCollection;
use App\Http\Resources\Province as ProvinceResource;
use App\Http\Resources\Region as RegionResource;
use App\Http\Resources\ProvinceCollection;
use App\Http\Resources\VillageCollection;
use App\Repositories\ProvinceRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ProvinceController extends Controller
{
    /**
     * @var ProvinceRepository $repository
     */
    protected $repository;

    /**
     * ProvinceController constructor.
     *
     * @param ProvinceRepository $repository
     */
    public function __construct(ProvinceRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Display a listing of provinces.
     *
     * @param string $locale
     * @return JsonResponse
     */
    public function index(string $locale)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $provinces = $this->repository->apiAll('api:provinces');

            return response()->json([
                'success' => true,
                'provinces' => new ProvinceCollection($provinces)
            ]);

        } catch (InvalidLocaleException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of provinces.
     *
     * @param string $locale
     * @return JsonResponse
     */
    public function stateIndex(string $locale)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $provinces = $this->repository->apiAll('api:provinces');

            return response()->json([
                'success' => true,
                'states' => new ProvinceCollection($provinces)
            ]);

        } catch (InvalidLocaleException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param $locale
     * @param $name
     * @return JsonResponse
     */
    public function show($locale, $name)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $province = $this->repository->apiFindByNameWithRelationship(
                $name,
                ['country', 'region', 'cities', 'localGovernmentAreas', 'villages'],
                'api:provinces:'.$name
            );

            return response()->json([
                'success'       => true,
                'province'       => new ProvinceResource($province)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No province named '{$name}' was found in the {$this->localeFullName($locale)} database"
            ]);

        } catch (InvalidLocaleException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * @param $locale
     * @param $name
     * @return JsonResponse
     */
    public function states($locale, $name)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $province = $this->repository->apiFindByNameWithRelationship(
                $name,
                ['country', 'region', 'cities', 'localGovernmentAreas', 'villages'],
                'api:provinces:'.$name
            );

            return response()->json([
                'success'       => true,
                'state'       => new ProvinceResource($province)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No province named '{$name}' was found in the {$this->localeFullName($locale)} database"
            ]);

        } catch (InvalidLocaleException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of provinces.
     *
     * @param string $locale
     * @param string $name
     * @return JsonResponse
     */
    public function regions(string $locale, string $name)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $region = $this->repository
                ->getRelationshipBelongingTo($name, 'cached_region');

            return response()->json([
                'success'       => true,
                'region'     => new RegionResource($region)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No province named '{$name}' was found in the {$this->localeFullName($locale)} database."
            ]);

        } catch (InvalidLocaleException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of provinces.
     *
     * @param string $locale
     * @param string $name
     * @return JsonResponse
     */
    public function countries(string $locale, string $name)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $country = $this->repository
                ->getRelationshipBelongingTo($name, 'cached_country');

            return response()->json([
                'success'       => true,
                'country'       => new CountryResource($country)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No province named '{$name}' was found in the {$this->localeFullName($locale)} database."
            ]);

        } catch (InvalidLocaleException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of local government areas.
     *
     * @param string $locale
     * @param string $name
     * @return JsonResponse
     */
    public function localGovernmentAreas(string $locale, string $name)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $localGovernmentAreas = $this->repository
                ->getRelationshipBelongingTo($name, 'cached_local_government_areas');

            return response()->json([
                'success'       => true,
                'local_government_areas' => new LocalGovernmentAreaCollection($localGovernmentAreas)
            ]);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => "No province named '{$name}' was found in the {$this->localeFullName($locale)} database."
            ]);
        } catch (InvalidLocaleException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of cities.
     *
     * @param string $locale
     * @param string $name
     * @return JsonResponse
     */
    public function cities(string $locale, string $name)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $cities = $this->repository
                ->getRelationshipBelongingTo($name, 'cached_cities');

            return response()->json([
                'success'       => true,
                'cities'        => new CityCollection($cities)
            ]);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => "No province named '{$name}' was found in the {$this->localeFullName($locale)} database."
            ]);
        } catch (InvalidLocaleException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of villages.
     *
     * @param string $locale
     * @param string $name
     * @return JsonResponse
     */
    public function villages(string $locale, string $name)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $villages = $this->repository
                ->getRelationshipBelongingTo($name, 'cached_villages');

            return response()->json([
                'success'       => true,
                'villages'        => new VillageCollection($villages)
            ]);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => "No province named '{$name}' was found in the {$this->localeFullName($locale)} database."
            ]);
        } catch (InvalidLocaleException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }
}
