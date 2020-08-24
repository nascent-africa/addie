@extends('layouts.app')

@section('content')
    @component('pages.province.wrapper')
        @if (isset($province))
            @slot('actions')
                <a class="btn btn-sm btn-outline-secondary ml-3" href="{{ route('provinces.show', $province) }}">
                    <span data-feather="eye"></span>
                </a>

                <x-delete-button
                    classes="btn btn-sm btn-outline-danger ml-3"
                    name="{{ $province->name }}"
                                 url="{{ route('provinces.destroy', $province) }}"
                                 id="{{ $province->slug }}"></x-delete-button>
            @endslot
        @endif
        <div class="container">
            <div class="row pb-5">
                <div class="col-lg-4">
                    <div class="px-4">
                        <h3 class="text-lg font-medium text-gray-900">Basic Information</h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Basic province information useful for an address form field.
                        </p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <form action="{{ isset($province) ? route('provinces.update', $province) : route('provinces.store') }}" method="POST">
                            @csrf
                            @if(isset($province))
                                @method('PATCH')
                            @endif

                            <div class="card-body">
                                <div class="row g-1">
                                    <div class="col-sm-3">
                                        <x-country-select :country="$province->country ?? null"></x-country-select>
                                    </div>
                                    <div class="col-sm-3">
                                        <x-region-select :region="$province->region ?? null"></x-region-select>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">{{ __('Name') }}</label>

                                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                                   value="{{ old('name', $province->name ?? null) }}" id="name" placeholder="Burkina Faso">

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
                                                   value="{{ old('latitude', $province->latitude ?? null) }}" id="latitude" placeholder="12.366667">

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
                                                   value="{{ old('longitude', $province->longitude ?? null) }}"id="longitude" placeholder="-1.533333">
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
