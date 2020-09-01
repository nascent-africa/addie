<?php

namespace App\Http\Controllers;

use App\LocalGovernmentArea;
use App\Repositories\LocalGovernmentAreaRepository;
use App\Support\Helpers;
use CodeZero\UniqueTranslation\UniqueTranslationRule;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class LocalGovernmentAreaController extends Controller
{
    /**
     * @var LocalGovernmentAreaRepository $repository
     */
    protected $repository;

    /**
     * LocalGovernmentAreaController constructor.
     *
     * @param LocalGovernmentAreaRepository $repository
     */
    public function __construct(LocalGovernmentAreaRepository $repository)
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
        $localGovernmentAreas = $this->repository->all();

        return view('pages.localGovernmentArea.index')->with([
            'localGovernmentAreas' => $localGovernmentAreas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('pages.localGovernmentArea.form');
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
            'name.en'       => ['required', 'string', 'max:20', 'unique_translation:local_government_areas'],
            'name.fr'       => ['required', 'string', 'max:20', 'unique_translation:local_government_areas'],
            'longitude'     => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['nullable', 'exists:countries,id'],
            'region_id'     => ['nullable', 'exists:regions,id'],
            'province_id'   => ['nullable', 'exists:provinces,id']
        ]);

        $city = LocalGovernmentArea::create($data);

        flash()->success(Helpers::createdSuccess());

        return redirect()->route('localGovernmentAreas.show', $city);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function show(string $slug)
    {
        $localGovernmentArea = Cache::remember('local-government-area:'.$slug, Helpers::CACHE_TIME, function () use($slug) {
            return LocalGovernmentArea::whereSlug($slug)->with(['country', 'region', 'province'])->firstOrfail();
        });

        return view('pages.localGovernmentArea.show')->with([
            'localGovernmentArea' => $localGovernmentArea->load(['country'])
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
        $localGovernmentArea = Cache::remember('local-government-area:'.$slug, Helpers::CACHE_TIME, function () use($slug) {
            return LocalGovernmentArea::whereSlug($slug)->with(['country', 'region', 'province'])->firstOrfail();
        });

        return view('pages.localGovernmentArea.form')->with([
            'localGovernmentArea' => $localGovernmentArea
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
        $localGovernmentArea = LocalGovernmentArea::whereSlug($slug)->firstOrfail();

        $data = $request->validate([
            'name.en'       => ['required', 'string', 'max:20', UniqueTranslationRule::for('local_government_areas')
                                ->ignore($localGovernmentArea->id)],
            'name.fr'       => ['required', 'string', 'max:20', UniqueTranslationRule::for('local_government_areas')
                                ->ignore($localGovernmentArea->id)],
            'longitude'     => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['nullable', 'exists:countries,id'],
            'region_id'     => ['nullable', 'exists:regions,id'],
            'province_id'   => ['nullable', 'exists:provinces,id']
        ]);

        $localGovernmentArea->update($data);

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
        $localGovernmentArea = LocalGovernmentArea::whereSlug($slug)->firstOrfail();

        $model = clone $localGovernmentArea;

        $localGovernmentArea->delete();

        flash()->success(Helpers::deletedSuccess());

        return redirect()->route('localGovernmentAreas.index');
    }
}
