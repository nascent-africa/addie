<?php

namespace App\Http\Controllers;

use App\Repositories\VillageRepository;
use App\Support\Helpers;
use App\Village;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

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
        $villages = $this->repository->all();

        return view('pages.village.index')->with([
            'villages' => $villages
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('pages.village.form');
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
            'name.en'       => ['required', 'string', 'max:20', 'unique_translation:villages'],
            'name.fr'       => ['required', 'string', 'max:20', 'unique_translation:villages'],
            'longitude'     => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['nullable', 'exists:countries,id'],
            'region_id'     => ['nullable', 'exists:regions,id'],
            'province_id'   => ['nullable', 'exists:provinces,id'],
            'city_id'       => ['nullable', 'exists:cities,id']
        ]);

        $village = Village::create($data);

        flash()->success(Helpers::createdSuccess());

        return redirect()->route('villages.show', $village);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $village = Cache::remember('village:'.$slug, Helpers::CACHE_TIME, function () use($slug) {
            return Village::whereSlug($slug)->with(['country', 'region', 'province'])->firstOrfail();
        });

        return view('pages.village.show')->with([
            'village' => $village->load(['country'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function edit(string $slug)
    {
        $village = Cache::remember('village:'.$slug, Helpers::CACHE_TIME, function () use($slug) {
            return Village::whereSlug($slug)->with(['country', 'region', 'province'])->firstOrfail();
        });

        return view('pages.village.form')->with([
            'village' => $village
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
        $village = Village::whereSlug($slug)->firstOrfail();

        $data = $request->validate([
            'name.en'       => ['required', 'string', 'max:20', UniqueTranslationRule::for('villages')->ignore($village->id)],
            'name.fr'       => ['required', 'string', 'max:20', UniqueTranslationRule::for('villages')->ignore($village->id)],
            'longitude'     => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['nullable', 'exists:countries,id'],
            'region_id'     => ['nullable', 'exists:regions,id'],
            'province_id'   => ['nullable', 'exists:provinces,id'],
            'city_id'       => ['nullable', 'exists:cities,id']
        ]);

        $village->update($data);

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
        $village = Village::whereSlug($slug)->firstOrfail();

        $model = clone $village;

        $village->delete();

        flash()->success(Helpers::deletedSuccess());

        return redirect()->route('villages.index');
    }
}
