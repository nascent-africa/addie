@extends('layouts.app')

@section('content')
    <x-page-wrapper>
        <div class="py-5 text-center">
            <h2>{{ __('Verify Your Email Address') }}</h2>
            <p class="lead">
                {{ __('Before proceeding, please check your email for a verification link.') }}<br />
                {{ __('If you did not receive the email') }},
            </p>
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('A fresh verification link has been sent to your email address.') }}
                </div>
            @endif
        </div>

        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
        </form>
    </x-page-wrapper>
@endsection
