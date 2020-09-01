<?php

namespace App\Http\Controllers;

use App\Region;
use App\Repositories\RegionRepository;
use App\Support\Helpers;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegionController extends Controller
{
    /**
     * @var RegionRepository $repository
     */
    protected $repository;

    /**
     * CountryController constructor.
     *
     * @param RegionRepository $repository
     */
    public function __construct(RegionRepository $repository)
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
        $regions = $this->repository->all();

        return view('pages.region.index')->with([
            'regions' => $regions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('pages.region.form');
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
            'name.en'       => ['required', 'string', 'max:20', 'unique_translation:regions'],
            'name.fr'       => ['required', 'string', 'max:20', 'unique_translation:regions'],
            'longitude'     => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['required']
        ]);

        $region = Region::create($data);

        flash()->success(Helpers::createdSuccess());

        return redirect()->route('regions.show', $region);
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $region = Cache::remember('region:'.$slug, Helpers::CACHE_TIME, function () use($slug) {
            return Region::whereSlug($slug)->with(['country'])->firstOrfail();
        });

        return view('pages.region.show')->with([
            'region' => $region->load(['country'])
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
        $region = Cache::remember('region:'.$slug, Helpers::CACHE_TIME, function () use($slug) {
            return Region::whereSlug($slug)->with(['country'])->firstOrfail();
        });

        return view('pages.region.form')->with([
            'region' => $region
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
        $region = Region::whereSlug($slug)->firstOrfail();

        $data = $request->validate([
            'name.en'       => ['required', 'string', 'max:20', UniqueTranslationRule::for('regions')->ignore($region->id)],
            'name.fr'       => ['required', 'string', 'max:20', UniqueTranslationRule::for('regions')->ignore($region->id)],
            'longitude'     => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['required']
        ]);

        $region->update($data);

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
        $region = Region::whereSlug($slug)->firstOrfail();

        $model = clone $region;

        $region->delete();

        flash()->success(Helpers::deletedSuccess());

        return redirect()->route('regions.index');
    }
}
