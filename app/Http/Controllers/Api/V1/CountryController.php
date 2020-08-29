<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\InvalidLocaleException;
use App\Http\Resources\CityCollection;
use App\Http\Resources\Country as CountryResource;
use App\Http\Resources\CountryCollection;
use App\Http\Resources\LocalGovernmentAreaCollection;
use App\Http\Resources\ProvinceCollection;
use App\Http\Resources\RegionCollection;
use App\Http\Resources\VillageCollection;
use App\Repositories\CountryRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class CountryController extends Controller
{
    /**
     * @var CountryRepository $repository
     */
    protected $repository;

    /**
     * CountryController constructor.
     *
     * @param CountryRepository $repository
     */
    public function __construct(CountryRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Display a listing of countries.
     *
     * @param string $locale
     * @return JsonResponse
     */
    public function index(string $locale)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $countries = $this->repository->apiAll('api:countries');

            return response()->json([
                'success' => true,
                'countries' => new CountryCollection($countries)
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

            $country = $this->repository->apiFindByNameWithRelationship(
                $name,
                ['regions', 'provinces', 'cities', 'localGovernmentAreas', 'villages'],
                'api:countries:'.$name
            );

            return response()->json([
                'success'       => true,
                'country'       => new CountryResource($country)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No country named '{$name}' was found in the {$this->localeFullName($locale)} database"
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
    public function provinces(string $locale, string $name)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $provinces = $this->repository
                ->getRelationshipBelongingTo($name, 'cached_provinces');

            return response()->json([
                'success'       => true,
                'provinces'       => new ProvinceCollection($provinces)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No country named '{$name}' was found in the {$this->localeFullName($locale)} database."
            ]);

        } catch (InvalidLocaleException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of states.
     *
     * Note: States returns provinces because they are basically the same thing.
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

            $provinces = $this->repository
                ->getRelationshipBelongingTo($name, 'cached_provinces');

            return response()->json([
                'success'       => true,
                'states'       => new ProvinceCollection($provinces)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No country named '{$name}' was found in the {$this->localeFullName($locale)} database."
            ]);

        } catch (InvalidLocaleException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of regions.
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

            $regions = $this->repository
                ->getRelationshipBelongingTo($name, 'cached_regions');

            return response()->json([
                'success'       => true,
                'regions'       => new RegionCollection($regions)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No country named '{$name}' was found in the {$this->localeFullName($locale)} database."
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
                'message'       => "No country named '{$name}' was found in the {$this->localeFullName($locale)} database."
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
                'message'       => "No country named '{$name}' was found in the {$this->localeFullName($locale)} database."
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
                'message'       => "No country named '{$name}' was found in the {$this->localeFullName($locale)} database."
            ]);

        } catch (InvalidLocaleException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }
}
