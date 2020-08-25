@extends('layouts.app')

@section('search')
    <x-search-input></x-search-input>
@endsection

@section('content')
    @component('pages.user.wrapper')
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 3%">#</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Email Address') }}</th>
                    <th scope="col" style="width: 10%">{{ __('Joined') }}</th>
                    <th scope="col" style="width: 10%">{{ __('Updated') }}</th>
                    <th scope="col" style="width: 3%"></th>
                    <th scope="col" style="width: 3%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->diffForHumans() }}</td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                        <td>
                            <x-role-select :user="$user" id="{{ $user->id }}"></x-role-select>
                        </td>
                        <td>
                            <x-delete-button name="{{ $user->name }}"
                                             url="{{ route('users.destroy', $user) }}"
                                             id="{{ $user->slug }}"></x-delete-button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $users->links() }}
    @endcomponent
@endsection
