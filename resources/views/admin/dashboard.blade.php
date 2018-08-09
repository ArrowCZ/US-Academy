@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h2">{{ __('Nástěnka')  }}</h1>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="row">
                            <div class="col-md">
                                <a class="card" href="{{ route('admin.orders') }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ __('Objednávky') }}</h5>
                                        <p class="card-text">{{ __('text')  }}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md">
                                <a class="card" href="{{ route('admin.cities') }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ __('Města') }}</h5>
                                        <p class="card-text">{{ __('text')  }}</p>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md">
                                <a class="card" href="{{ route('admin.trainings') }}">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ __('Kroužky') }}</h5>
                                        <p class="card-text">{{ __('text')  }}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
