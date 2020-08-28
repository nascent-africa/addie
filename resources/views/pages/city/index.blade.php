@extends('layouts.app')

@section('search')
    <x-search-input></x-search-input>
@endsection

@section('content')
    @component('pages.city.wrapper')
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
                @foreach($cities as $city)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $city->name }}</td>
                        <td>{{ $city->longitude }}</td>
                        <td>{{ $city->latitude }}</td>
                        <td>{{ $city->created_at->diffForHumans() }}</td>
                        <td>{{ $city->country->name }}</td>
                        <td>
                            <a class="btn btn-light" href="{{ route('cities.show', $city) }}" title="View {{ $city->name }}">
                                <span data-feather="eye"></span>
                            </a>
                        </td>
                        @can('administrator')
                        <td>
                            <a class="btn btn-light" href="{{ route('cities.edit', $city) }}" title="Edit {{ $city->name }}">
                                <span data-feather="edit"></span>
                            </a>
                        </td>
                        @endcan
                        @can('superuser')
                        <td>
                            <x-delete-button name="{{ $city->name }}"
                                             url="{{ route('cities.destroy', $city) }}"
                                             id="{{ $city->slug }}"></x-delete-button>
                        </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $cities->links() }}
    @endcomponent
@endsection
