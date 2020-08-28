@extends('layouts.app')

@section('search')
    <x-search-input></x-search-input>
@endsection

@section('content')
    @component('pages.region.wrapper')
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 4%"></th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col" style="width: 10%">{{ __('Longitude') }}</th>
                    <th scope="col" style="width: 10%">{{ __('Latitude') }}</th>
                    <th scope="col" style="width: 10%">{{ __('Added') }}</th>
                    <th scope="col" style="width: 15%">{{ __('Country') }}</th>
                    <th scope="col" style="width: 3%"></th>
                    @can('administrator')
                    <th scope="col" style="width: 3%"></th>
                    @endcan
                    @can('superuser')
                    <th scope="col" style="width: 3%"></th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @foreach($regions as $region)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $region->name }}</td>
                        <td>{{ $region->longitude }}</td>
                        <td>{{ $region->latitude }}</td>
                        <td>{{ $region->created_at->diffForHumans() }}</td>
                        <td>{{ $region->country->name }}</td>
                        <td>
                            <a class="btn btn-light" href="{{ route('regions.show', $region) }}" title="View {{ $region->name }}">
                                <span data-feather="eye"></span>
                            </a>
                        </td>
                        @can('administrator')
                        <td>
                            <a class="btn btn-light" href="{{ route('regions.edit', $region) }}" title="Edit {{ $region->name }}">
                                <span data-feather="edit"></span>
                            </a>
                        </td>
                        @endcan
                        @can('superuser')
                        <td>
                            <x-delete-button name="{{ $region->name }}"
                                             url="{{ route('regions.destroy', $region) }}"
                                             id="{{ $region->slug }}"></x-delete-button>
                        </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $regions->links() }}
    @endcomponent
@endsection
