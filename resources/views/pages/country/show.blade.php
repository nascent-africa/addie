@extends('layouts.app')

@section('content')
    @component('pages.region.wrapper')
        @if (isset($country))
            @slot('actions')
                <a class="btn btn-sm btn-outline-secondary ml-3" href="{{ route('regions.edit', $country) }}">
                    <span data-feather="edit"></span>
                </a>

                <x-delete-button
                    classes="btn btn-sm btn-outline-danger ml-3"
                    name="{{ $country->name }}"
                                 url="{{ route('regions.destroy', $country) }}"
                                 id="{{ $country->slug }}"></x-delete-button>
            @endslot
        @endif

        <div class="row">
            <div class="col-12">
                <h3>{{ $country->name }}</h3>

                <span class="font-weight-bold">Latitude:</span> <span class="text-muted">{{ $country->latitude }}</span> &nbsp; | &nbsp;
                <span class="font-weight-bold">Longitude:</span> <span class="text-muted">{{ $country->longitude }}</span> &nbsp; | &nbsp;
            </div>
        </div>
        <!-- /.row -->
    @endcomponent
@endsection
