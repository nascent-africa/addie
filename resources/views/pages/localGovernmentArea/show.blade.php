@extends('layouts.app')

@section('content')
    @component('pages.localGovernmentArea.wrapper')
        @if (isset($localGovernmentArea))
            @slot('actions')
                <a class="btn btn-sm btn-outline-secondary ml-3" href="{{ route('local_government_areas.edit', $localGovernmentArea) }}">
                    <span data-feather="edit"></span>
                </a>

                <x-delete-button
                    classes="btn btn-sm btn-outline-danger ml-3"
                    name="{{ $localGovernmentArea->name }}"
                                 url="{{ route('local_government_areas.destroy', $localGovernmentArea) }}"
                                 id="{{ $localGovernmentArea->slug }}"></x-delete-button>
            @endslot
        @endif

        <div class="row">
            <div class="col-12">
                <h3>{{ $localGovernmentArea->name }}</h3>

                <span class="font-weight-bold">Country:</span> <span class="text-muted">{{ $localGovernmentArea->country->name }}</span> &nbsp; | &nbsp;
                <span class="font-weight-bold">Latitude:</span> <span class="text-muted">{{ $localGovernmentArea->latitude }}</span> &nbsp; | &nbsp;
                <span class="font-weight-bold">Longitude:</span> <span class="text-muted">{{ $localGovernmentArea->longitude }}</span> &nbsp; | &nbsp;
            </div>
        </div>
        <!-- /.row -->
    @endcomponent
@endsection
