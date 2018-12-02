@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        <div class="col">
            <div class="breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Nástěnka') }}</a></div>
                <div class="breadcrumb-item">{{ __('Odpracováno')  }}</div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="h2">{{ __('Odpracováno') }}</h1>
        </div>

        <div class="card-body">
            @include('admin.layout.status')
            
            <button 
                type="button" 
                class="btn btn-primary" 
                data-toggle="modal" 
                data-target="#writeModal"
            >
                {{ __('Zapsat hodiny')  }}
            </button>

            <br><br>

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

<div class="modal fade" id="writeModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/worked" method="POST">
                @csrf
        
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Zapsat hodiny')  }}</h5>

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
                        'type' => 'number', 
                        'name' => 'hours',
                        'min'  => 0,
                    ]){{ __('Odpracováno hodin') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'text', 
                        'name' => 'date',
                        'placeholder' => 'dd.mm. rrrr',
                    ]){{ __('Datum (prázdné = dnes)') }}
                    @endcomponent

                    <label for="city_id">Město</label>
                    <select class="custom-select" name="city_id" id="city_id">
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}">
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Zavřít') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('Přidat') }}</button>
                </div>  
            </form>
        </div>
    </div>
</div>

@endsection