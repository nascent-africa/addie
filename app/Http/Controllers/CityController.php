<?php

namespace App\Http\Controllers;

use App\City;
use App\Support\Helpers;
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
     * CityController constructor.
     */
    public function __construct()
    {
        $this->middleware(['auth', 'can:administrator'])->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $cities = City::with(['country'])->latest()->paginate(30);

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
            'name'          => ['required', 'string', 'max:20'],
            'longitude'     => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['nullable', 'exists:countries,id'],
            'region_id'     => ['nullable', 'exists:regions,id'],
            'province_id'   => ['nullable', 'exists:provinces,id']
        ]);

        $data['country_id'] = (int) $data['country_id'];
        $data['region_id'] = (int) $data['region_id'] ?? null;
        $data['province_id'] = (int) $data['province_id'] ?? null;

        $city = City::create($data);

        flash()->success($city->name . ' was created successfully!');

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

        $city->load(['country', 'region']);

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
     * @param City $city
     * @return RedirectResponse
     */
    public function update(Request $request, City $city)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:20'],
            'longitude'     => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['nullable', 'exists:countries,id'],
            'region_id'     => ['nullable', 'exists:regions,id'],
            'province_id'   => ['nullable', 'exists:provinces,id']
        ]);

        $data['country_id'] = (int) $data['country_id'];
        $data['region_id'] = (int) $data['region_id'] ?? null;
        $data['province_id'] = (int) $data['province_id'] ?? null;

        $city->update($data);

        flash()->success($city->name . ' was updated successfully!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param City $city
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(City $city)
    {
        $model = clone $city;

        $city->delete();

        flash()->success($model->name . ' deleted successfully!');

        return redirect()->route('cities.index');
    }
}
