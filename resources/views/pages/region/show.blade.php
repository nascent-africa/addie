@extends('layouts.app')

@section('content')
    @component('pages.region.wrapper')
        @if (isset($region))
            @slot('actions')
                <a class="btn btn-sm btn-outline-secondary ml-3" href="{{ route('regions.edit', $region) }}">
                    <span data-feather="edit"></span>
                </a>

                <x-delete-button
                    classes="btn btn-sm btn-outline-danger ml-3"
                    name="{{ $region->name }}"
                                 url="{{ route('regions.destroy', $region) }}"
                                 id="{{ $region->slug }}"></x-delete-button>
            @endslot
        @endif

        <div class="row">
            <div class="col-12">
                <h3>{{ $region->name }}</h3>

                <span class="font-weight-bold">Country:</span> <span class="text-muted">{{ $region->country->name }}</span> &nbsp; | &nbsp;
                <span class="font-weight-bold">Latitude:</span> <span class="text-muted">{{ $region->latitude }}</span> &nbsp; | &nbsp;
                <span class="font-weight-bold">Longitude:</span> <span class="text-muted">{{ $region->longitude }}</span> &nbsp; | &nbsp;
            </div>
        </div>
        <!-- /.row -->
    @endcomponent
@endsection
