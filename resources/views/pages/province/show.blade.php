@extends('layouts.app')

@section('content')
    @component('pages.province.wrapper')
        @if (isset($province))
            @slot('actions')
                <a class="btn btn-sm btn-outline-secondary ml-3" href="{{ route('provinces.edit', $province) }}">
                    <span data-feather="edit"></span>
                </a>

                <x-delete-button
                    classes="btn btn-sm btn-outline-danger ml-3"
                    name="{{ $province->name }}"
                                 url="{{ route('provinces.destroy', $province) }}"
                                 id="{{ $province->slug }}"></x-delete-button>
            @endslot
        @endif

        <div class="row">
            <div class="col-12">
                <h3>{{ $province->name }}</h3>

                <span class="font-weight-bold">Country:</span> <span class="text-muted">{{ $province->country->name }}</span> &nbsp; | &nbsp;
                <span class="font-weight-bold">Latitude:</span> <span class="text-muted">{{ $province->latitude }}</span> &nbsp; | &nbsp;
                <span class="font-weight-bold">Longitude:</span> <span class="text-muted">{{ $province->longitude }}</span> &nbsp; | &nbsp;
            </div>
        </div>
        <!-- /.row -->
    @endcomponent
@endsection
