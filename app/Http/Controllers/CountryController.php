<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryFormRequest;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Country::class);
        $countries = $this->getCountriesOrderedPaginate();
        return view('countries.index', [
            'countries' => $countries
        ]);
    }

    public function create()
    {
        $this->authorize('create', Country::class);
        return view('countries.form');
    }

    public function store(CountryFormRequest $request)
    {
        $this->authorize('create', Country::class);
        Country::query()->create($request->validated());
        $countries = $this->getCountriesOrderedPaginate();
        return redirect()->route('countries.index', [
            'countries' => $countries
        ]);
    }

    public function show(Country $country)
    {
        /*$this->authorize('view', $country);
        return view('countries.show', [
            'country' => $country
        ]);*/
    }

    public function edit(Country $country)
    {
        $this->authorize('update', $country);
        return view('countries.form', [
            'country' => $country
        ]);
    }

    public function update(CountryFormRequest $request, Country $country)
    {
        $this->authorize('update', $country);
        $country->update($request->validated());
        $countries = $this->getCountriesOrderedPaginate();
        return redirect()->route('countries.index', [
            'countries' => $countries
        ]);
    }

    public function destroy(Country $country)
    {
        $this->authorize('delete', $country);
        $country->delete();
        return back();
    }

    function getCountriesOrderedPaginate() {
        return Country::query()
            ->orderBy('name')
            ->paginate(10);
    }
}
