@extends('layouts.app')

@section('content')
    @component('pages.localGovernmentArea.wrapper')
        @if (isset($city))
            @slot('actions')
                <a class="btn btn-sm btn-outline-secondary ml-3" href="{{ route('local_government_areas.edit', $city) }}">
                    <span data-feather="edit"></span>
                </a>

                <x-delete-button
                    classes="btn btn-sm btn-outline-danger ml-3"
                    name="{{ $city->name }}"
                                 url="{{ route('local_government_areas.destroy', $city) }}"
                                 id="{{ $city->slug }}"></x-delete-button>
            @endslot
        @endif

        <div class="row">
            <div class="col-12">
                <h3>{{ $city->name }}</h3>

                <span class="font-weight-bold">Country:</span> <span class="text-muted">{{ $city->country->name }}</span> &nbsp; | &nbsp;
                <span class="font-weight-bold">Latitude:</span> <span class="text-muted">{{ $city->latitude }}</span> &nbsp; | &nbsp;
                <span class="font-weight-bold">Longitude:</span> <span class="text-muted">{{ $city->longitude }}</span> &nbsp; | &nbsp;
            </div>
        </div>
        <!-- /.row -->
    @endcomponent
@endsection
