@extends('layouts.app')

@section('content')
    @component('pages.village.wrapper')
        @if (isset($village))
            @slot('actions')
                <a class="btn btn-sm btn-outline-secondary ml-3" href="{{ route('villages.edit', $village) }}">
                    <span data-feather="edit"></span>
                </a>

                <x-delete-button
                    classes="btn btn-sm btn-outline-danger ml-3"
                    name="{{ $village->name }}"
                                 url="{{ route('villages.destroy', $village) }}"
                                 id="{{ $village->slug }}"></x-delete-button>
            @endslot
        @endif

        <div class="row">
            <div class="col-12">
                <h3>{{ $village->name }}</h3>

                <span class="font-weight-bold">Country:</span> <span class="text-muted">{{ $village->country->name }}</span> &nbsp; | &nbsp;
                <span class="font-weight-bold">Latitude:</span> <span class="text-muted">{{ $village->latitude }}</span> &nbsp; | &nbsp;
                <span class="font-weight-bold">Longitude:</span> <span class="text-muted">{{ $village->longitude }}</span> &nbsp; | &nbsp;
            </div>
        </div>
        <!-- /.row -->
    @endcomponent
@endsection
