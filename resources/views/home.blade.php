@extends('layouts.app')

@section('content')
    <x-page-wrapper>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ __('Dashboard') }}</h1>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-3 col-xl-3 mb-3">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="fa fa-life-ring"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Users</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $userCount }}</strong>
                                        <span class="text-primary">Total</span>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="#" class="text-decoration-none text-muted text-uppercase">view all</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-6 col-lg-3 col-xl-3 mb-3">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="fa fa-life-ring"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Countries</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $countryCount }}</strong>
                                        <span class="text-primary">Total</span>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('countries.index') }}" class="text-decoration-none text-muted text-uppercase">view all</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-6 col-lg-3 col-xl-3 mb-3">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="fa fa-life-ring"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Regions</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $regionCount }}</strong>
                                        <span class="text-primary">Total</span>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('regions.index') }}" class="text-decoration-none text-muted text-uppercase">view all</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-6 col-lg-3 col-xl-3 mb-3">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="fa fa-life-ring"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Provinces / States</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $provinceCount }}</strong>
                                        <span class="text-primary">Total</span>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('provinces.index') }}" class="text-decoration-none text-muted text-uppercase">view all</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-6 col-lg-3 col-xl-3 mb-3">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="fa fa-life-ring"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Local Government Areas</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $localGovernmentAreaCount }}</strong>
                                        <span class="text-primary">Total</span>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('local_government_areas.index') }}" class="text-decoration-none text-muted text-uppercase">view all</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-6 col-lg-3 col-xl-3 mb-3">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="fa fa-life-ring"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Cities</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $cityCount }}</strong>
                                        <span class="text-primary">Total</span>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('cities.index') }}" class="text-decoration-none text-muted text-uppercase">view all</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-6 col-lg-3 col-xl-3 mb-3">
                <section class="panel panel-featured-left panel-featured-primary">
                    <div class="panel-body">
                        <div class="widget-summary">
                            <div class="widget-summary-col widget-summary-col-icon">
                                <div class="summary-icon bg-primary">
                                    <i class="fa fa-life-ring"></i>
                                </div>
                            </div>
                            <div class="widget-summary-col">
                                <div class="summary">
                                    <h4 class="title">Villages</h4>
                                    <div class="info">
                                        <strong class="amount">{{ $villageCount }}</strong>
                                        <span class="text-primary">Total</span>
                                    </div>
                                </div>
                                <div class="summary-footer">
                                    <a href="{{ route('villages.index') }}" class="text-decoration-none text-muted text-uppercase">view all</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

        </div>

        @push('styles')
            <style>
                /* dashboard card start */
                .panel-featured-primary {
                    border-color: #08c;
                }

                .panel-featured-left {
                    border-left: 3px solid #33353f;
                    border-radius: 8px;
                }

                .panel-body {
                    background: #fdfdfd;
                    -webkit-box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
                    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
                    border-radius: 5px;
                }


                .widget-summary {
                    display: table;
                    width: 100%;
                }

                .widget-summary .widget-summary-col.widget-summary-col-icon {
                    width: 1%;
                }

                .widget-summary .widget-summary-col {
                    display: table-cell;
                    vertical-align: top;
                    width: 100%;
                }


                .widget-summary .summary-icon {
                    margin-right: 8px;
                    margin-left: 8px;
                    margin-top: 8px;
                    font-size: 42px;
                    font-size: 4.2rem;
                    width: 60px;
                    height: 60px;
                    line-height: 40px;
                    text-align: center;
                    color: #fff;
                    -webkit-border-radius: 55px;
                    border-radius: 55px;
                }


                .widget-summary .widget-summary-col {
                    display: table-cell;
                    vertical-align: top;
                    width: 100%;
                }


                .widget-summary .summary {
                    min-height: 65px;
                    word-break: break-all;
                }


                .widget-summary .summary .title {
                    margin: 0;
                    font-size: 14px;
                    line-height: 22px;
                    color: #333;
                    font-weight: 500;
                }


                .widget-summary .summary .info {
                    font-size: 16px;
                    line-height: 30px;
                }

                .widget-summary .summary .amount {
                    margin-right: .2em;
                    font-size: 16px;
                    font-weight: 600;
                    color: #333;
                    vertical-align: middle;
                }


                .widget-summary .summary .info span {
                    vertical-align: middle;
                }
                .summary-icon  i
                {
                    font-size: 35px;
                }

                .widget-summary .summary-footer {
                    padding: 8px 8px 8px;
                    border-top: 1px dotted #ddd;
                    text-align: right;
                    font-size: 12px;
                }

                .bg-primary {
                    background: #08c;
                }
                /* dashboard card end */
            </style>
        @endpush
    </x-page-wrapper>
@endsection
