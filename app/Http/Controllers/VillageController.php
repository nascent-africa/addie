<?php

namespace App\Http\Controllers;

use App\Village;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VillageController extends Controller
{
    /**
     * VillageController constructor.
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
        $villages = Village::with(['country'])->latest()->paginate(30);

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
            'name'          => ['required', 'string', 'max:20'],
            'longitude'     => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['nullable', 'exists:countries,id'],
            'region_id'     => ['nullable', 'exists:regions,id'],
            'province_id'   => ['nullable', 'exists:provinces,id'],
            'city_id'       => ['nullable', 'exists:cities,id']
        ]);

        $data['country_id'] = (int) $data['country_id'];
        $data['region_id'] = (int) $data['region_id'] ?? null;
        $data['province_id'] = (int) $data['province_id'] ?? null;
        $data['city_id'] = (int) $data['city_id'] ?? null;

        $village = Village::create($data);

        flash()->success($village->name . ' was created successfully!');

        return redirect()->route('villages.show', $village);
    }

    /**
     * Display the specified resource.
     *
     * @param Village $village
     * @return Application|Factory|View
     */
    public function show(Village $village)
    {
        $village->load(['country', 'region']);

        return view('pages.village.show')->with([
            'village' => $village->load(['country'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Village $village
     * @return Application|Factory|View
     */
    public function edit(Village $village)
    {
        $village->load(['country', 'region', 'province']);

        return view('pages.village.form')->with([
            'village' => $village
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Village $village
     * @return RedirectResponse
     */
    public function update(Request $request, Village $village)
    {
        $village->load(['country', 'region']);

        $data = $request->validate([
            'name'          => ['required', 'string', 'max:20'],
            'longitude'     => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['nullable', 'exists:countries,id'],
            'region_id'     => ['nullable', 'exists:regions,id'],
            'province_id'   => ['nullable', 'exists:provinces,id'],
            'city_id'       => ['nullable', 'exists:cities,id']
        ]);

        $data['country_id'] = (int) $data['country_id'];
        $data['region_id'] = (int) $data['region_id'] ?? null;
        $data['province_id'] = (int) $data['province_id'] ?? null;
        $data['city_id'] = (int) $data['city_id'] ?? null;

        $village->update($data);

        flash()->success($village->name . ' was updated successfully!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Village $village
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Village $village)
    {
        $model = clone $village;

        $village->delete();

        flash()->success($model->name . ' deleted successfully!');

        return redirect()->route('villages.index');
    }
}
