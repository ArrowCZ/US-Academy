@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Nástěnka') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.cities') }}">{{ __('Města')  }}</a></div>
                    <div class="breadcrumb-item"><a href="/admin/cities/{{ $city->id }}">{{ $city->name }}</a></div>
                    <div class="breadcrumb-item"><a href="/admin/trainings/{{ $training->id }}">{{ $training->day }}</a>
                    </div>
                    <div class="breadcrumb-item">{{ $order->name }}</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h2">
                            <small>{{ __('Objednávka')  }}</small> {{ $order->name }}
                        </h1>
                    </div>

                    <div class="card-body">
                        @include('admin.layout.status')

                        <div class="row">
                            <div class="col">
                                <dl class="row">
                                    <dt class="col-sm-6">{{ __('Jméno') }}</dt>
                                    <dd class="col-sm-6">{{ $order->name }}</dd>

                                    <dt class="col-sm-6">{{ __('Rodič') }}</dt>
                                    <dd class="col-sm-6">{{ $order->parent }}</dd>

                                    <dt class="col-sm-6">{{ __('Email') }}</dt>
                                    <dd class="col-sm-6">{{ $order->email }}</dd>

                                    <dt class="col-sm-6">{{ __('Datum přihlášení') }}</dt>
                                    <dd class="col-sm-6">{{ $order->created_at }}</dd>

                                    <dt class="col-sm-6">{{ __('Město') }}</dt>
                                    <dd class="col-sm-6">{{ $city->name }}</dd>

                                    <dt class="col-sm-6">{{ __('Období') }}</dt>
                                    <dd class="col-sm-6">{{ $training->season }}</dd>

                                    <dt class="col-sm-6">{{ __('Den, čas') }}</dt>
                                    <dd class="col-sm-6">{{ $training->day }}, {{ $training->time }}</dd>

                                    <dt class="col-sm-6">{{ __('Trenér') }}</dt>
                                    <dd class="col-sm-6">{{ $training->trainer }}</dd>

                                    <dt class="col-sm-6">{{ __('Cena') }}</dt>
                                    <dd class="col-sm-6">{{ $order->price }}</dd>
                                </dl>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#editStateModal">
                                    {{ __('Změnit stav')  }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
