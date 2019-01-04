@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Nástěnka') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Města') }}</div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1 class="h2">{{ __('Města') }}</h1></div>

                    <div class="card-body">
                        @include('admin.layout.status')

                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Název') }}</th>
                                <th scope="col">{{ __('Počet kroužků') }}</th>
                                <th scope="col">{{ __('Souřadnice') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $city)
                                <tr>
                                    <th scope="row">{{ $city->id }}</th>
                                    <td>{{ $city->name }}</td>
                                    <td>{{ count($city->trainings) }}</td>
                                    <td>{{ $city->x }}: {{ $city->y }}</td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a
                                                href="/admin/cities/{{ $city->id }}"
                                                class="btn btn-primary"
                                            >{{ __('Detail') }}</a>

                                            <button
                                                type="button"
                                                class="btn btn-danger"
                                                data-toggle="modal" 
                                                data-target="#deleteCityModal_{{ $city->id }}"
                                            >{{ __('Smazat') }}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCityModal">
                            {{ __('Přidat město') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@include('admin.cities.add')

@foreach($cities as $city)
    @include('admin.cities.delete')
@endforeach