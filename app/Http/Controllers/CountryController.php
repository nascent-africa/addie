<?php

namespace App\Http\Controllers;

use App\Country;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CountryController extends Controller
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
        $countries = Country::latest()->paginate(30);

        return view('pages.country.index')->with([
            'countries' => $countries
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('pages.country.form');
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
            'iso_code'      => ['required', 'string', 'max:3'],
            'calling_code'  => ['required', 'string', 'max:4']
        ]);

        $country = Country::create($data);

        flash()->success($country->name . ' was created successfully!');

        return redirect()->route('countries.show', $country);
    }

    /**
     * Display the specified resource.
     *
     * @param Country $country
     * @return Application|Factory|View
     */
    public function show(Country $country)
    {
        return view('pages.country.show')->with([
            'country' => $country
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Country $country
     * @return Application|Factory|View
     */
    public function edit(Country $country)
    {
        return view('pages.country.form')->with([
            'country' => $country
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Country $country
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, Country $country)
    {
        $data = $request->validate([
            'name'          => ['required', 'string', 'max:20', Rule::unique('countries')->ignore($country->id)],
            'longitude'     => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'latitude'      => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'iso_code'      => ['required', 'string', 'max:3'],
            'calling_code'  => ['required', 'string', 'max:4']
        ]);

        $country->update($data);

        flash()->success($country->name . ' was updated successfully!');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $country
     * @return Application|RedirectResponse|Redirector
     * @throws Exception
     */
    public function destroy(Country $country)
    {
        $model = clone $country;

        $country->delete();

        flash()->success($model->name . ' deleted successfully!');

        return redirect()->route('countries.index');
    }
}
