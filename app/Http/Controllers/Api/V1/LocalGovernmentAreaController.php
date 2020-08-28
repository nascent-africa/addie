<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\InvalidLocaleException;
use App\Http\Resources\CityCollection;
use App\Http\Resources\Country as CountryResource;
use App\Http\Resources\Province as ProvinceResource;
use App\Http\Resources\LocalGovernmentAreaCollection;
use App\Http\Resources\LocalGovernmentArea as LocalGovernmentAreaResource;
use App\Http\Resources\Region as RegionResource;
use App\Http\Resources\VillageCollection;
use App\Repositories\LocalGovernmentAreaRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class LocalGovernmentAreaController extends Controller
{
    /**
     * @var LocalGovernmentAreaRepository $repository
     */
    protected $repository;

    /**
     * LocalGovernmentAreaRepositoryController constructor.
     *
     * @param LocalGovernmentAreaRepository $repository
     */
    public function __construct(LocalGovernmentAreaRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Display a listing of local government areas.
     *
     * @param string $locale
     * @return JsonResponse
     */
    public function index(string $locale)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $local_government_areas = $this->repository->apiAll('api:local_government_areas');

            return response()->json([
                'success' => true,
                'local_government_areas' => new LocalGovernmentAreaCollection($local_government_areas)
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

            $localGovernmentArea = $this->repository->apiFindByNameWithRelationship(
                $name,
                ['country', 'region', 'province', 'cities', 'villages'],
                'api:local_government_areas:'.$name
            );

            return response()->json([
                'success'       => true,
                'local_government_area'       => new LocalGovernmentAreaResource($localGovernmentArea)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No local government area named '{$name}' was found in the {$this->localeFullName($locale)} database"
            ]);

        } catch (InvalidLocaleException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of local_government_areas.
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
                ->getRelationshipBelongingTo($name, 'region', 'api:local_government_areas:region');

            return response()->json([
                'success'       => true,
                'region'     => new RegionResource($region)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No local government area named '{$name}' was found in the {$this->localeFullName($locale)} database."
            ]);

        } catch (InvalidLocaleException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of local_government_areas.
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
                ->getRelationshipBelongingTo($name, 'country', 'api:local_government_areas:country');

            return response()->json([
                'success'       => true,
                'country'       => new CountryResource($country)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No local government area named '{$name}' was found in the {$this->localeFullName($locale)} database."
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
    public function states(string $locale, string $name)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $localGovernmentAreas = $this->repository
                ->getRelationshipBelongingTo($name, 'province', 'api:local_government_areas:province');

            return response()->json([
                'success'       => true,
                'state' => new ProvinceResource($localGovernmentAreas)
            ]);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => "No local government area named '{$name}' was found in the {$this->localeFullName($locale)} database."
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
    public function provinces(string $locale, string $name)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $localGovernmentAreas = $this->repository
                ->getRelationshipBelongingTo($name, 'province', 'api:local_government_areas:province');

            return response()->json([
                'success'       => true,
                'province' => new ProvinceResource($localGovernmentAreas)
            ]);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => "No local government area named '{$name}' was found in the {$this->localeFullName($locale)} database."
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
                ->getRelationshipBelongingTo($name, 'cities', 'api:local_government_areas:cities');

            return response()->json([
                'success'       => true,
                'cities'        => new CityCollection($cities)
            ]);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => "No local government area named '{$name}' was found in the {$this->localeFullName($locale)} database."
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
                ->getRelationshipBelongingTo($name, 'villages', 'api:local_government_areas:villages');

            return response()->json([
                'success'       => true,
                'villages'        => new VillageCollection($villages)
            ]);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => "No local government area named '{$name}' was found in the {$this->localeFullName($locale)} database."
            ]);
        } catch (InvalidLocaleException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }
}
