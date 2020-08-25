<?php

namespace App\Http\Controllers;

use App\Country;
use App\Repositories\CountryRepository;
use App\Support\Helpers;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CountryController extends Controller
{
    /**
     * @var CountryRepository $repository
     */
    protected $repository;

    /**
     * CountryController constructor.
     *
     * @param CountryRepository $repository
     */
    public function __construct(CountryRepository $repository)
    {
        $this->middleware(['auth', 'can:administrator'])->except('index');
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $countries = $this->repository->all();

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
     * @param string $slug
     * @return Application|Factory|View
     */
    public function show($slug)
    {
        $country = Cache::remember('country:'.$slug, Helpers::CACHE_TIME, function () use($slug) {
            return Country::whereSlug($slug)->firstOrfail();
        });

        return view('pages.country.show')->with([
            'country' => $country
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
        $country = Cache::remember('country:'.$slug, Helpers::CACHE_TIME, function () use($slug) {
            return Country::whereSlug($slug)->firstOrfail();
        });

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
     * @return RedirectResponse
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
