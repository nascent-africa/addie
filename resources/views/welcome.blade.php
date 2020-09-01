@extends('layouts.app')

@section('content')
    <x-page-wrapper>
        <div class="row p-4 p-md-5 mt-3 mb-4 text-white rounded bg-dark shadow justify-content-center">
            <div class="col-8 px-0 text-center">
                <h1 class="display-4">Addie</h1>
                <p class="lead my-3">{{__('Addie is an alternative to google address auto-complete api built to give more control and flexibility to offer users options of places to choose from.')}}</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <test-address-component token="{{ env('REQUEST_TOKEN') }}"></test-address-component>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row text-white rounded bg-white shadow-sm">
                    <div class="col-12 pt-3 text-dark">
                        <h3 class="display-6">{{ __('Documentation') }}</h3>
                        <p class="lead my-3">
                            {{__("Integrating Addie API is effortless and does not require much configuration like Google address API. To get started, create a free account with Addie, create an API authentication token by navigating to \"My Tokens\", click on the \"Create Token\" button at the top right corner to reveal a pop-up modal, provide the name of the application you wish to use to make the API requests from and then click \"Generate\". You can create as many API tokens for as many applications as you want.")}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </x-page-wrapper>
@endsection
