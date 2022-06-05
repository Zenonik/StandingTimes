@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Willkommen') }}</div>

                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Auth::user())
                            <div class="alert alert-success" role="alert">
                                <strong>{{ __('Willkommen zurück!') }}</strong>
                            </div>

                        @else
                            <div class="alert alert-danger" role="alert">
                                <strong>Um Fortzufahren logge dich bitte ein, oder registriere dich.</strong>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
