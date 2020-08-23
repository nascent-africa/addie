<?php

namespace App\Http\Controllers;

use App\Region;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class RegionController extends Controller
{
    /**
     * CountryController constructor.
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
        $regions = Region::latest()->paginate(30);

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
            'name'          => ['required', 'string', 'max:20', 'unique:countries'],
            'longitude'     => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['required']
        ]);

        $country = Region::create($data);

        flash()->success($country->name . ' was created successfully!');

        return redirect()->route('regions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Region $region
     * @return Application|Factory|View
     */
    public function edit(Region $region)
    {
        return view('pages.region.form')->with([
            'region' => $region
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Region $region
     * @return RedirectResponse
     */
    public function update(Request $request, Region $region)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:20', Rule::unique('regions')->ignore($region->id)],
            'longitude'     => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['required']
        ]);

        $data['country_id'] = (int) $data['country_id'];

        $region->update($data);

        flash()->success($region->name . ' was updated successfully!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Region $region
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Region $region)
    {
        $model = clone $region;

        $region->delete();

        flash()->success($model->name . ' deleted successfully!');

        return redirect()->route('regions.index');
    }
}
