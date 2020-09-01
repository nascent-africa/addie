@extends('layouts.app')

@section('content')
    <x-page-wrapper>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ __('Profile') }}</h1>
        </div>

        <div class="container">
            <div class="row pb-5">
                <div class="col-md-4">
                    <div class="px-4">
                        <h3 class="text-lg font-medium text-gray-900">{{__('Contact Information')}}</h3>

                        <p class="mt-1 text-sm text-gray-600">
                            {{__("Update your account's contact information and email address.")}}
                        </p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <form action="{{ route('profile') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ Auth::user()->name }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email address') }}</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ Auth::user()->email }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <hr/>

            <div class="row pt-5">
                <div class="col-md-4">
                    <div class="px-4">
                        <h3 class="text-lg font-medium text-gray-900">{{__('Update Password')}}</h3>

                        <p class="mt-1 text-sm text-gray-600">
                            {{__('Ensure your account is using a long, random password to stay secure.')}}
                        </p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <form action="{{ url('/profile/update-password') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="current-password" class="form-label">{{ __('Current Password') }}</label>
                                    <input type="password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" id="current-password" placeholder="{{ __('Current Password') }}">

                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="new-password" class="form-label">{{ __('New Password') }}</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="new-password" placeholder="{{ __('New Password') }}">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password-confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password-confirmation" placeholder="{{ __('Confirm Password') }}">
                                </div>
                            </div>
                            <div class="card-footer text-muted">
                                <button type="submit" class="btn btn-dark">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-page-wrapper>
@endsection
