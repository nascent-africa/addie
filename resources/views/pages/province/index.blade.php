@extends('layouts.app')

@section('content')
    @component('pages.province.wrapper')
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
                @foreach($provinces as $province)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $province->name }}</td>
                        <td>{{ $province->longitude }}</td>
                        <td>{{ $province->latitude }}</td>
                        <td>{{ $province->created_at->diffForHumans() }}</td>
                        <td>{{ $province->country->name }}</td>
                        <td>
                            <a class="btn btn-light" href="{{ route('provinces.show', $province) }}" title="View {{ $province->name }}">
                                <span data-feather="eye"></span>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-light" href="{{ route('provinces.edit', $province) }}" title="Edit {{ $province->name }}">
                                <span data-feather="edit"></span>
                            </a>
                        </td>
                        @can('superuser')
                        <td>
                            <x-delete-button name="{{ $province->name }}"
                                             url="{{ route('provinces.destroy', $province) }}"
                                             id="{{ $province->slug }}"></x-delete-button>
                        </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $provinces->links() }}
    @endcomponent
@endsection
