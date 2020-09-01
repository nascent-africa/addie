@extends('layouts.app')

@section('content')
    @component('pages.token.wrapper')
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered">
                <thead class="table-dark">
                <tr>
                    <th scope="col" style="width: 3%"></th>
                    <th scope="col" style="width: 15%">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Token') }}</th>
                    <th scope="col" style="width: 10%">{{ __('Created') }}</th>
                    <th scope="col" style="width: 10%"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($tokens as $token)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $token->name }}</td>
                        <td>
                            <p class="user-select-all">{{ $token->authorization_token }}</p>
                        </td>
                        <td>{{ $token->created_at->diffForHumans() }}</td>
                        <td>
                            <x-delete-button name="{{ $token->name }}"
                                             url="{{ route('tokens.destroy', $token) }}"
                                             id="{{ $token->id }}">{{ __('Revoke') }}</x-delete-button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endcomponent
@endsection
