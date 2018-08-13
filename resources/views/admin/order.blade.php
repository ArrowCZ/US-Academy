@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1 class="h2">{{ __('Objednávka')  }} #{{ $order->id }}</h1></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                            <div class="row">
                                <div class="col">
                                    <dl class="row">
                                        <dt class="col-sm-3">{{ __('Jméno') }}</dt>
                                        <dd class="col-sm-9">{{ $order->name }}</dd>

                                        <dt class="col-sm-3">{{ __('Email') }}</dt>
                                        <dd class="col-sm-9">{{ $order->email }}</dd>

                                        <dt class="col-sm-3">{{ __('Datum přihlášení') }}</dt>
                                        <dd class="col-sm-9">{{ $order->created_at }}</dd>

                                        <dt class="col-sm-3">{{ __('Město') }}</dt>
                                        <dd class="col-sm-9">{{ $city->name }}</dd>

                                        <dt class="col-sm-3">{{ __('Období') }}</dt>
                                        <dd class="col-sm-9">{{ $training->season }}</dd>

                                        <dt class="col-sm-3">{{ __('Den, čas') }}</dt>
                                        <dd class="col-sm-9">{{ $training->day }}, {{ $training->time }}</dd>

                                        <dt class="col-sm-3">{{ __('Trenér') }}</dt>
                                        <dd class="col-sm-9">{{ $training->trainer }}</dd>

                                        <dt class="col-sm-3">{{ __('Cena') }}</dt>
                                        <dd class="col-sm-9">{{ $order->price }}</dd>
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
