@extends('layouts.app')

@section('content')
    @component('pages.localGovernmentArea.wrapper')
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
                @foreach($localGovernmentAreas as $localGovernmentArea)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $localGovernmentArea->name }}</td>
                        <td>{{ $localGovernmentArea->longitude }}</td>
                        <td>{{ $localGovernmentArea->latitude }}</td>
                        <td>{{ $localGovernmentArea->created_at->diffForHumans() }}</td>
                        <td>{{ $localGovernmentArea->country->name }}</td>
                        <td>
                            <a class="btn btn-light" href="{{ route('local_government_areas.show', $localGovernmentArea) }}" title="View {{ $localGovernmentArea->name }}">
                                <span data-feather="eye"></span>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-light" href="{{ route('local_government_areas.edit', $localGovernmentArea) }}" title="Edit {{ $localGovernmentArea->name }}">
                                <span data-feather="edit"></span>
                            </a>
                        </td>
                        @can('superuser')
                        <td>
                            <x-delete-button name="{{ $localGovernmentArea->name }}"
                                             url="{{ route('local_government_areas.destroy', $localGovernmentArea) }}"
                                             id="{{ $localGovernmentArea->slug }}"></x-delete-button>
                        </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $localGovernmentAreas->links() }}
    @endcomponent
@endsection
