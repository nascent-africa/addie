<?php

namespace App\Http\Controllers\Api\V1;

use App\Exceptions\InvalidLocaleException;
use App\Http\Resources\City as CityResource;
use App\Http\Resources\Country as CountryResource;
use App\Http\Resources\LocalGovernmentArea as LocalGovernmentAreaResource;
use App\Http\Resources\Province as ProvinceResource;
use App\Http\Resources\Region as RegionResource;
use App\Http\Resources\Village as VillageResource;
use App\Http\Resources\VillageCollection;
use App\Repositories\VillageRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class VillageController extends Controller
{
    /**
     * @var VillageRepository $repository
     */
    protected $repository;

    /**
     * VillageController constructor.
     *
     * @param VillageRepository $repository
     */
    public function __construct(VillageRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * Display a listing of village.
     *
     * @param string $locale
     * @return JsonResponse
     */
    public function index(string $locale)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $villages = $this->repository->apiAll('api:villages');

            return response()->json([
                'success' => true,
                'villages' => new VillageCollection($villages)
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

            $village = $this->repository->apiFindByNameWithRelationship(
                $name,
                ['country', 'region', 'province', 'localGovernmentArea', 'city'],
                'api:villages:'.$name
            );

            return response()->json([
                'success'       => true,
                'village'       => new VillageResource($village)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No village named '{$name}' was found in the {$this->localeFullName($locale)} database"
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
                'message'       => "No village named '{$name}' was found in the {$this->localeFullName($locale)} database."
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
                'message'       => "No village named '{$name}' was found in the {$this->localeFullName($locale)} database."
            ]);

        } catch (InvalidLocaleException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of village.
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
                ->getRelationshipBelongingTo($name, 'cached_province');

            return response()->json([
                'success'       => true,
                'state' => new ProvinceResource($localGovernmentAreas)
            ]);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => "No village named '{$name}' was found in the {$this->localeFullName($locale)} database."
            ]);
        } catch (InvalidLocaleException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }

    /**
     * Display a listing of village.
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
                ->getRelationshipBelongingTo($name, 'cached_province');

            return response()->json([
                'success'       => true,
                'province' => new ProvinceResource($localGovernmentAreas)
            ]);

        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => "No village named '{$name}' was found in the {$this->localeFullName($locale)} database."
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
    public function localGovernmentAreas(string $locale, string $name)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $localGovernmentArea = $this->repository
                ->getRelationshipBelongingTo($name, 'cached_local_government_area');

            return response()->json([
                'success'       => true,
                'local_government_area'        => new LocalGovernmentAreaResource($localGovernmentArea)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No village named '{$name}' was found in the {$this->localeFullName($locale)} database."
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
    public function cities(string $locale, string $name)
    {
        try {
            $this->checkLocale($locale);

            app()->setLocale($locale);

            $city = $this->repository
                ->getRelationshipBelongingTo($name, 'cached_city');

            return response()->json([
                'success'       => true,
                'city'        => new CityResource($city)
            ]);

        } catch (ModelNotFoundException $exception) {

            return response()->json([
                'success'       => false,
                'message'       => "No village named '{$name}' was found in the {$this->localeFullName($locale)} database."
            ]);

        } catch (InvalidLocaleException $exception) {
            return response()->json([
                'success'       => false,
                'message'       => $exception->getMessage()
            ]);
        }
    }
}
