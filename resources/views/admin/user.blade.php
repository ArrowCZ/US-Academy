@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Nástěnka') }}</a></div>
                <div class="breadcrumb-item"><a href="{{ route('admin.users') }}">{{ __('Uživatelé') }}</a></div>
                <div class="breadcrumb-item">{{ __('Uživatel') }} {{ $user->name }}</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="h2">{{ __('Uživatel') }} {{ $user->name }}</h1>
        </div>

        <div class="card-body">
            @include('admin.layout.status')

            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">{{ __('Datum') }}</th>
                    <th scope="col">{{ __('Odpracovaných hodin') }}</th>
                    <th scope="col">{{ __('Město') }}</th>
                    <th scope="col">{{ __('Celkem Kč') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($user->worked as $work)
                    <tr>
                        <td>{{ $work->date }}</td>
                        <td>{{ $work->hours }}</td>
                        <td>{{ $work->city->name }}</td>
                        <td>{{ $work->hours * $user->payment }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection