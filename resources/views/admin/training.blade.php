@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Nástěnka') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.cities') }}">{{ __('Města')  }}</a></div>
                    <div class="breadcrumb-item"><a href="/admin/cities/{{ $city->id }}">{{ $city->name }}</a></div>
                    <div class="breadcrumb-item">
                        @if ($training->type == 1)
                            {{ $training->date }}
                        @elseif ($training->type == 2)
                            {{ $training->date }} - {{ $training->date_to }}
                        @else
                            {{ $training->day }}
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h2">
                            @if ($training->type == 1)
                                <small>{{ __('workshop') }}</small> {{ $training->date }}
                            @elseif ($training->type == 2)
                                <small>{{ __('Kemp') }}</small> {{ $training->date }} - {{ $training->date_to }}
                            @else
                                <small>{{ __('Kroužek') }}</small> {{ $training->day }}
                            @endif
                        </h1>
                    </div>

                    <div class="card-body">
                        @include('admin.layout.status')

                        <div class="row">
                            <div class="col">
                                @if ($training->type == 1)
                                    @include('admin.trainings.info.workshop')
                                @elseif ($training->type == 2)
                                    @include('admin.trainings.info.camp')
                                @else
                                    @include('admin.trainings.info.training')
                                @endif
                            </div>
                            <div class="col text-right">
                                <div class="row" style="height: 100%">
                                    <div class="col-md-12">
                                        <div>
                                            <button
                                                data-toggle="modal" data-target="#editTrainingModal"
                                                type="button"
                                                class="btn btn-success"
                                            >{{ __('Upravit') }}
                                            </button>

                                            <br><br>
                                        </div>
                                        <div>
                                            <button
                                                data-toggle="modal" data-target="#uploadImageModal"
                                                type="button"
                                                class="btn btn-success"
                                            >{{ __('Nahrát obrázek') }}
                                            </button>
                                        </div>
                                    </div>
                             
                                    <div class="col-md-12">       
                                        @isset($training->images[0])
                                            <img class="img" src="{{ asset($training->images[0]->path) }}" alt="img" height="150">
                                        @endisset                            
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        @include('admin.trainings.orders')
                    </div>

                    <div class="card-footer">
                        <button
                            class="btn btn-primary"
                            data-toggle="modal" 
                            data-target="#sendMailModal"
                        >{{ __('Poslat email') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($training->type == 1)
        @include('admin.trainings.edit.workshop')
    @elseif ($training->type == 2)
        @include('admin.trainings.edit.camp')
    @else
        @include('admin.trainings.edit.training')
    @endif

    @include('admin.trainings.mail')

    @include('admin.trainings.image')
@endsection
