@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header" style="background-color: #1266F1">{{ __('Zeit gestanden') }}</div>
                                <div class="card-body" style="background-color: #3a3a3a">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header" style="background-color: #B23CFD">{{ __('Zeit gestanden') }}</div>
                                <div class="card-body" style="background-color: #3a3a3a">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header" style="background-color: #00B74A">{{ __('Zeit gestanden') }}</div>
                                <div class="card-body" style="background-color: #3a3a3a">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header" style="background-color: #FFA900">{{ __('Zeit gestanden') }}</div>
                                <div class="card-body" style="background-color: #3a3a3a">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
