@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Nástěnka') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.cities') }}">{{ __('Města')  }}</a></div>
                    <div class="breadcrumb-item">{{ $city->name }}</div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h2">
                            <small>{{ __('Město') }}</small> {{ $city->name }}
                        </h1>
                    </div>

                    <div class="card-body">
                        @include('admin.layout.status')

                        <div class="row">
                            <div class="col">
                                <dl class="row">
                                    <dt class="col-sm-6">{{ __('Název') }}</dt>
                                    <dd class="col-sm-6">{{ $city->name }}</dd>

                                    <dt class="col-sm-6">{{ __('Souřadnice') }}</dt>
                                    <dd class="col-sm-6">{{ $city->x }}, {{ $city->y }}</dd>
                                </dl>
                            </div>

                            <div class="col text-right">
                                <button
                                    type="button"
                                    class="btn btn-success"
                                    data-toggle="modal" data-target="#editCityModal"
                                >{{ __('Upravit') }}
                                </button>
                            </div>
                        </div>

                        <hr>

                        @include('admin.cities.trainings')

                        <hr>

                        @include('admin.cities.workshops')

                        <hr>

                        @include('admin.cities.camps')
                    </div>

                    <div class="card-footer text-right">
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal" data-target="#addTrainingModal"
                        >{{ __('Přidat kroužek') }}
                        </button>

                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal" data-target="#addWorkshopModal"
                        >{{ __('Přidat workshop') }}
                        </button>

                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal" data-target="#addCampModal"
                        >{{ __('Přidat kemp') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.cities.edit')

    @include('admin.trainings.add.training')
    @include('admin.trainings.add.workshop')
    @include('admin.trainings.add.camp')

    @foreach($city->trainings as $training)
        @include('admin.trainings.delete')
    @endforeach

@endsection
