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
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <test-address-component></test-address-component>
                    </div>
                </div>
            </div>
        </div>
    </x-page-wrapper>
@endsection
