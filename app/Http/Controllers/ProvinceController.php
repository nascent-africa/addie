<?php

namespace App\Http\Controllers;

use App\Province;
use App\Repositories\ProvinceRepository;
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
        $provinces = $this->repository->all();

        return view('pages.province.index')->with([
            'provinces' => $provinces
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('pages.province.form');
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
            'name.en'       => ['required', 'string', 'max:20', 'unique_translation:provinces'],
            'name.fr'       => ['required', 'string', 'max:20', 'unique_translation:provinces'],
            'longitude'     => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['required'],
            'region_id'     => ['required']
        ]);

        $province = Province::create($data);

        flash()->success(Helpers::createdSuccess());

        return redirect()->route('provinces.show', $province);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $province = Cache::remember('province:'.$slug, Helpers::CACHE_TIME, function () use($slug) {
            return Province::whereSlug($slug)->with(['country', 'region'])->firstOrfail();
        });

        return view('pages.province.show')->with([
            'province' => $province->load(['country'])
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
        $province = Cache::remember('province:'.$slug, Helpers::CACHE_TIME, function () use($slug) {
            return Province::whereSlug($slug)->with(['country', 'region'])->firstOrfail();
        });

        return view('pages.province.form')->with([
            'province' => $province
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
        $province = Province::whereSlug($slug)->firstOrfail();

        $data = $request->validate([
            'name.en'       => ['required', 'string', 'max:20', UniqueTranslationRule::for('provinces')->ignore($province->id)],
            'name.fr'       => ['required', 'string', 'max:20', UniqueTranslationRule::for('provinces')->ignore($province->id)],
            'longitude'     => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['required'],
            'region_id'     => ['required']
        ]);

        $province->update($data);

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
        $province = Province::whereSlug($slug)->firstOrfail();

        $model = clone $province;

        $province->delete();

        flash()->success(Helpers::deletedSuccess());

        return redirect()->route('provinces.index');
    }
}
