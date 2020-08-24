<?php

namespace App\Http\Controllers;

use App\Province;
use App\Support\Helpers;
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
     * ProvinceController constructor.
     *
     * @return void
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
        $provinces = Province::latest()->paginate(30);

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
            'name'          => ['required', 'string', 'max:20', 'unique:countries'],
            'longitude'     => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['required'],
            'region_id'     => ['required']
        ]);

        $data['country_id'] = (int) $data['country_id'];
        $data['region_id'] = (int) $data['region_id'] ?? null;

        $province = Province::create($data);

        flash()->success($province->name . ' was created successfully!');

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
     * @param Province $province
     * @return RedirectResponse
     */
    public function update(Request $request, Province $province)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:20', Rule::unique('regions')->ignore($province->id)],
            'longitude'     => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['required'],
            'region_id'     => ['required']
        ]);

        $data['country_id'] = (int) $data['country_id'];
        $data['region_id'] = (int) $data['region_id'] ?? null;

        $province->update($data);

        flash()->success($province->name . ' was updated successfully!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Province $province
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Province $province)
    {
        $model = clone $province;

        $province->delete();

        flash()->success($model->name . ' deleted successfully!');

        return redirect()->route('provinces.index');
    }
}
