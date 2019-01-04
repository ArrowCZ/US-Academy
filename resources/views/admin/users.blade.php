@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Nástěnka') }}</a></div>
                <div class="breadcrumb-item">{{ __('Uživatelé')  }}</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="h2">{{ __('Uživatelé') }}</h1>
        </div>

        <div class="card-body">
            @include('admin.layout.status')

            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">{{ __('Jméno') }}</th>
                    <th scope="col">{{ __('Funkce') }}</th>
                    <th scope="col">{{ __('Odpracovaných hodin') }}</th>
                    <th scope="col">{{ __('Plat (Kč/h)') }}</th>
                    <th scope="col">{{ __('Celkem') }}</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->function }}</td>
                            <td>{{ $user->hours() }}</td>
                            <td>{{ $user->payment }}</td>
                            <td>{{ $user->payment * $user->hours() }}</td>
                            <td>
                                <a
                                    href="/admin/users/{{ $user->id }}"
                                    class="btn btn-primary"
                                >{{ __('Detail')  }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer text-right">
            <button 
                type="button" 
                class="btn btn-primary" 
                data-toggle="modal" 
                data-target="#addUserModal"
            >
                {{ __('Přidat uživatele')  }}
            </button>
        </div>
    </div>
</div>

@include('admin.users.add')

@endsection