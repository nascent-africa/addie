<?php

namespace App\Http\Controllers;

use App\City;
use App\Repositories\CityRepository;
use App\Support\Helpers;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CityController extends Controller
{
    /**
     * @var CityRepository $repository
     */
    protected $repository;

    /**
     * CityController constructor.
     *
     * @param CityRepository $repository
     */
    public function __construct(CityRepository $repository)
    {
        $this->middleware(['auth', 'can:administrator'])->except(['index', 'show']);
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $cities = $this->repository->all();

        return view('pages.city.index')->with([
            'cities' => $cities
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('pages.city.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name.en'       => ['required', 'string', 'max:20', 'unique_translation:cities'],
            'name.fr'       => ['required', 'string', 'max:20', 'unique_translation:cities'],
            'longitude'     => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['nullable', 'exists:countries,id'],
            'region_id'     => ['nullable', 'exists:regions,id'],
            'province_id'   => ['nullable', 'exists:provinces,id']
        ]);

        $city = City::create($data);

        flash()->success(Helpers::createdSuccess());

        return redirect()->route('cities.show', $city);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $city = Cache::remember('city:'.$slug, Helpers::CACHE_TIME, function () use($slug) {
            return City::whereSlug($slug)->with(['country', 'region'])->firstOrfail();
        });

        return view('pages.city.show')->with([
            'city' => $city->load(['country'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function edit($slug)
    {
        $city = Cache::remember('city:'.$slug, Helpers::CACHE_TIME, function () use($slug) {
            return City::whereSlug($slug)->with(['country', 'region', 'province'])->firstOrfail();
        });

        return view('pages.city.form')->with([
            'city' => $city
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param string $slug
     * @return RedirectResponse
     */
    public function update(Request $request, string $slug)
    {
        $city = City::whereSlug($slug)->firstOrfail();

        $data = $request->validate([
            'name.en'       => ['required', 'string', 'max:20', UniqueTranslationRule::for('cities')->ignore($city->id)],
            'name.fr'       => ['required', 'string', 'max:20', UniqueTranslationRule::for('cities')->ignore($city->id)],
            'longitude'     => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['nullable', 'exists:countries,id'],
            'region_id'     => ['nullable', 'exists:regions,id'],
            'province_id'   => ['nullable', 'exists:provinces,id']
        ]);

        $city->update($data);

        flash()->success(Helpers::updatedSuccess());

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(string $slug)
    {
        $city = City::whereSlug($slug)->firstOrfail();

        $model = clone $city;

        $city->delete();

        flash()->success(Helpers::deletedSuccess());

        return redirect()->route('cities.index');
    }
}
