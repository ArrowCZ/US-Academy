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
                                <td>{{ 0 }}</td>
                                <td>{{ $user->payment }}</td>
                                <td>{{ $user->payment * 0 }}</td>
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


<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/users" method="POST">
                @csrf
        
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Přidat uživatele')  }}</h5>

                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            Please fix the following errors
                        </div>
                    @endif
        
                    @component('admin.input', [
                        'type' => 'text', 
                        'name' => 'email'
                    ]){{ __('Přihlašovací jméno') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'text', 
                        'name' => 'password'
                    ]){{ __('Heslo') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'text', 
                        'name' => 'name'
                    ]){{ __('Jméno') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'number', 
                        'name' => 'payment',
                        'min' => 0,
                    ]){{ __('Plat (Kč/h)') }}
                    @endcomponent

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Zavřít') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Přidat') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection