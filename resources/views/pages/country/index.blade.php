@extends('layouts.app')

@section('content')
    @component('pages.country.wrapper')
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 5%">{{ __('Call Code') }}</th>
                    <th scope="col" style="width: 5%">{{ __('ISO Code') }}</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col" style="width: 10%">{{ __('Longitude') }}</th>
                    <th scope="col" style="width: 10%">{{ __('Latitude') }}</th>
                    <th scope="col" style="width: 10%">{{ __('Added') }}</th>
                    <th scope="col" style="width: 10%">{{ __('Updated') }}</th>
                    <th scope="col" style="width: 3%"></th>
                    <th scope="col" style="width: 3%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($countries as $country)
                    <tr>
                        <td>{{ $country->calling_code }}</td>
                        <td>{{ $country->iso_code }}</td>
                        <td>{{ $country->name }}</td>
                        <td>{{ $country->longitude }}</td>
                        <td>{{ $country->latitude }}</td>
                        <td>{{ $country->created_at->diffForHumans() }}</td>
                        <td>{{ $country->updated_at->diffForHumans() }}</td>
                        <td>
                            <a class="btn btn-light" href="{{ route('countries.edit', $country) }}" title="Edit {{ $country->name }}">
                                <span data-feather="edit"></span>
                            </a>
                        </td>
                        <td>
                            <x-delete-button :name="$country->name"
                                             :url="route('countries.destroy', $country)"
                                             :id="$country->slug"></x-delete-button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $countries->links() }}
    @endcomponent
@endsection
