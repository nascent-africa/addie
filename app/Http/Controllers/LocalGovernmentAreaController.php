<?php

namespace App\Http\Controllers;

use App\LocalGovernmentArea;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LocalGovernmentAreaController extends Controller
{
    /**
     * LocalGovernmentAreaController constructor.
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
        $localGovernmentAreas = LocalGovernmentArea::with(['country'])->latest()->paginate(30);

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
            'name'          => ['required', 'string', 'max:20'],
            'longitude'     => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['nullable', 'exists:countries,id'],
            'region_id'     => ['nullable', 'exists:regions,id'],
            'province_id'   => ['nullable', 'exists:provinces,id']
        ]);

        $data['country_id'] = (int) $data['country_id'];
        $data['region_id'] = (int) $data['region_id'];

        $city = LocalGovernmentArea::create($data);

        flash()->success($city->name . ' was created successfully!');

        return redirect()->route('localGovernmentAreas.show', $city);
    }

    /**
     * Display the specified resource.
     *
     * @param LocalGovernmentArea $localGovernmentArea
     * @return Application|Factory|View
     */
    public function show(LocalGovernmentArea $localGovernmentArea)
    {
        $localGovernmentArea->load(['country', 'region']);

        return view('pages.localGovernmentArea.show')->with([
            'localGovernmentArea' => $localGovernmentArea->load(['country'])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param LocalGovernmentArea $localGovernmentArea
     * @return Application|Factory|View
     */
    public function edit(LocalGovernmentArea $localGovernmentArea)
    {
        $localGovernmentArea->load(['country', 'region', 'province']);

        return view('pages.localGovernmentArea.form')->with([
            'localGovernmentArea' => $localGovernmentArea
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param LocalGovernmentArea $localGovernmentArea
     * @return RedirectResponse
     */
    public function update(Request $request, LocalGovernmentArea $localGovernmentArea)
    {
        $localGovernmentArea->load(['country', 'region']);

        $data = $request->validate([
            'name'          => ['required', 'string', 'max:20'],
            'longitude'     => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'country_id'    => ['nullable', 'exists:countries,id'],
            'region_id'     => ['nullable', 'exists:regions,id'],
            'province_id'   => ['nullable', 'exists:provinces,id']
        ]);

        $data['country_id'] = (int) $data['country_id'];
        $data['region_id'] = (int) $data['region_id'];

        $localGovernmentArea->update($data);

        flash()->success($localGovernmentArea->name . ' was updated successfully!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LocalGovernmentArea $localGovernmentArea
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(LocalGovernmentArea $localGovernmentArea)
    {
        $model = clone $localGovernmentArea;

        $localGovernmentArea->delete();

        flash()->success($model->name . ' deleted successfully!');

        return redirect()->route('localGovernmentAreas.index');
    }
}
