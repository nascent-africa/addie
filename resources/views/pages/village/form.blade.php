@extends('layouts.app')

@section('content')
    @component('pages.village.wrapper')
        @if (isset($village))
            @slot('actions')
                <a class="btn btn-sm btn-outline-secondary ml-3" href="{{ route('villages.show', $village) }}">
                    <span data-feather="eye"></span>
                </a>

                <x-delete-button
                    classes="btn btn-sm btn-outline-danger ml-3"
                    name="{{ $village->name }}"
                                 url="{{ route('villages.destroy', $village) }}"
                                 id="{{ $village->slug }}"></x-delete-button>
            @endslot
        @endif
        <div class="container">
            <div class="row pb-5">
                <div class="col-lg-4">
                    <div class="px-4">
                        <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Basic village information useful for an address form field.
                        </p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <form action="{{ isset($village) ? route('villages.update', $village) : route('villages.store') }}" method="POST">
                            @csrf
                            @if(isset($village))
                                @method('PATCH')
                            @endif

                            <div class="card-body">
                                <div class="row g-1">
                                    <div class="col-sm-3">
                                        <x-country-select :country="$village->country ?? null"></x-country-select>
                                    </div>
                                    <div class="col-sm-3">
                                        <x-region-select :region="$village->region ?? null"></x-region-select>
                                    </div>
                                    <div class="col-sm-3">
                                        <x-province-select :province="$village->province ?? null"></x-province-select>
                                    </div>
                                    <div class="col-sm-3">
                                        <x-local-government-area-select :localGovernmentArea="$village->local_government_area ?? null"></x-local-government-area-select>
                                    </div>
                                    <div class="col-sm-3">
                                        <x-city-select :city="$village->city ?? null"></x-city-select>
                                    </div>
                                </div>

                                <x-name-field :node="$village ?? null"></x-name-field>

                                <div class="row g-1">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="latitude" class="form-label">{{ __('Latitude') }}</label>

                                            <input type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror"
                                                   value="{{ old('latitude', $village->latitude ?? null) }}" id="latitude" placeholder="12.366667">

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
                                                   value="{{ old('longitude', $village->longitude ?? null) }}"id="longitude" placeholder="-1.533333">
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
