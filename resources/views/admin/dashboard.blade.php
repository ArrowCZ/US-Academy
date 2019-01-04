@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mt-3">
                <div class="card mt-5">
                    <div class="card-header">
                        <h1 class="h2">{{ __('Nástěnka') }}</h1>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <status-messages>{{ session('status') }}</status-messages>
                        @endif

                        @if (\Auth::user()->isAdmin())
                            <div class="row">
                                <div class="col">
                                    <a class="card" href="{{ route('admin.cities') }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ __('Města') }}</h5>
                                            <p class="card-text">{{ __('přehled') }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <br>

                            <div class="row">
                                <div class="col">
                                    <a class="card" href="{{ route('admin.users') }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ __('Uživatelé') }}</h5>
                                            <p class="card-text">{{ __('přehled') }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <br><br><br>

                            <h2>{{ __('Nové objednávky') }}</h2>

                            @if($orders)
                                <div class="row">
                                    <div class="col">
                                        <table class="table">
                                            <thead class="thead-dark">
                                            <tr>
                                                <th scope="col" title="{{ __('Variabilní symbol') }}">{{ __('VS') }}</th>
                                                <th scope="col">{{ __('Jméno') }}</th>
                                                <th scope="col">{{ __('Email') }}</th>
                                                <th scope="col">{{ __('Telefon') }}</th>
                                                <th scope="col">{{ __('Stav') }}</th>
                                                <th scope="col">{{ __('Datum') }}</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($orders as $order)
                                                <tr class="{{ $order->tableColor() }}">
                                                    <th>{{ $order->id }}</th>
                                                    <td>
                                                        {{ $order->name }}<br>
                                                        <small>{{ $order->parent }}</small>
                                                    </td>
                                                    <td>{{ $order->email }}</td>
                                                    <td>{{ $order->phone }}</td>
                                                    <td>{{ $order->_state() }}</td>
                                                    <td>{{ $order->created_at }}</td>
                                                    <td>
                                                        <a
                                                            href="/admin/orders/{{ $order->id }}"
                                                            class="btn btn-primary"
                                                        >{{ __('Detail') }}</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                @else
                                <div class="alert alert-info">
                                    {{ __('Žádné') }}
                                </div>
                            @endif

                        @else
                            <div class="row">
                                <div class="col">
                                    <a class="card" href="{{ route('admin.worked') }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ __('Zapsat hodiny') }}</h5>
                                            <p class="card-text">{{ __('...') }}</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
