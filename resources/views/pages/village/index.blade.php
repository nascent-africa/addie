@extends('layouts.app')

@section('search')
    <x-search-input></x-search-input>
@endsection

@section('content')
    @component('pages.village.wrapper')
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
                    <th scope="col" style="width: 3%"></th>
                    @can('superuser')
                    <th scope="col" style="width: 3%"></th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @foreach($villages as $village)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $village->name }}</td>
                        <td>{{ $village->longitude }}</td>
                        <td>{{ $village->latitude }}</td>
                        <td>{{ $village->created_at->diffForHumans() }}</td>
                        <td>{{ $village->country->name }}</td>
                        <td>
                            <a class="btn btn-light" href="{{ route('villages.show', $village) }}" title="View {{ $village->name }}">
                                <span data-feather="eye"></span>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-light" href="{{ route('villages.edit', $village) }}" title="Edit {{ $village->name }}">
                                <span data-feather="edit"></span>
                            </a>
                        </td>
                        @can('superuser')
                        <td>
                            <x-delete-button name="{{ $village->name }}"
                                             url="{{ route('villages.destroy', $village) }}"
                                             id="{{ $village->slug }}"></x-delete-button>
                        </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $villages->links() }}
    @endcomponent
@endsection
