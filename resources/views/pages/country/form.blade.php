@extends('layouts.app')

@section('content')
    @component('pages.country.wrapper')
        @if (isset($country))
            @slot('actions')
                <a class="btn btn-sm btn-outline-secondary ml-3" href="{{ route('regions.show', $country) }}">
                    <span data-feather="eye"></span>
                </a>

                <x-delete-button
                    classes="btn btn-sm btn-outline-danger ml-3"
                    name="{{ $country->name }}"
                                 url="{{ route('countries.destroy', $country) }}"
                                 id="{{ $country->slug }}"></x-delete-button>
            @endslot
        @endif
        <div class="container">
            <div class="row pb-5">
                <div class="col-lg-4">
                    <div class="px-4">
                        <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Basic country information useful for an address form field.
                        </p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <form action="{{ isset($country) ? route('countries.update', $country) : route('countries.store') }}" method="POST">
                            @csrf
                            @if(isset($country))
                                @method('PATCH')
                            @endif

                            <div class="card-body">
                                <div class="row g-1">
                                    <div class="col-sm-2">
                                        <div class="mb-3">
                                            <label for="code" class="form-label">{{ __('Code') }}</label>

                                            <input type="text" name="iso_code" class="form-control @error('iso_code') is-invalid @enderror"
                                                   value="{{ old('iso_code', $country->iso_code ?? null) }}" id="code" placeholder="BF">

                                            @error('iso_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label for="calling_code" class="form-label">{{ __('Calling Code') }}</label>

                                            <input type="text" name="calling_code" class="form-control @error('calling_code') is-invalid @enderror"
                                                   value="{{ old('calling_code', $country->calling_code ?? null) }}" id="calling_code" placeholder="+226">

                                            @error('calling_code')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __('Name') }}</label>

                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                   value="{{ old('name', $country->name ?? null) }}" id="name" placeholder="Burkina Faso">

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-1">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="latitude" class="form-label">{{ __('Latitude') }}</label>

                                            <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror"
                                                   value="{{ old('latitude', $country->latitude ?? null) }}" id="latitude" placeholder="12.366667">

                                            @error('latitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="longitude" class="form-label">{{ __('Longitude') }}</label>
                                            <input type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror"
                                                   value="{{ old('longitude', $country->longitude ?? null) }}"id="longitude" placeholder="-1.533333">
                                            @error('longitude')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endcomponent
@endsection
