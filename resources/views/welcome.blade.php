@extends('layouts.app')

@section('content')
    <x-page-wrapper>
        <div class="p-4 p-md-5 mt-3 mb-4 text-white rounded bg-dark">
            <div class="col-md-6 px-0">
                <h1 class="display-4">Addie</h1>
                <p class="lead my-3">Addie is a simple resource for an address form field auto-complete.</p>
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
