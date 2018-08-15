@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h2">{{ __('Město') }}: {{ $city->name }}</h1>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="row">
                            <div class="col">
                                <dl class="row">
                                    <dt class="col-sm-3">{{ __('Název') }}</dt>
                                    <dd class="col-sm-9">{{ $city->name }}</dd>

                                    <dt class="col-sm-3">{{ __('Souřadnice') }}</dt>
                                    <dd class="col-sm-9">{{ $city->x }}, {{ $city->y }}</dd>
                                </dl>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#editCityModal">
                                    {{ __('Upravit')  }}
                                </button>
                            </div>
                        </div>

                        <br>
                        <h2 class="card-title">{{ __('Kroužky') }}</h2>

                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Den') }}</th>
                                <th scope="col">{{ __('Období') }}</th>
                                <th scope="col">{{ __('Čas') }}</th>
                                <th scope="col">{{ __('Trenér') }}</th>
                                <th scope="col">{{ __('Kapacita') }}</th>
                                <th scope="col">{{ __('Cena') }}</th>
                                <th scope="col" class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($city->trainings as $training)
                                <tr>
                                    <th scope="row">{{ $training->id }}</th>
                                    <td>{{ $training->day }}</td>
                                    <td>{{ $training->season }}</td>
                                    <td>{{ $training->time }}</td>
                                    <td>{{ $training->trainer }}</td>
                                    <td>{{ $training->free_count() }} / {{ $training->capacity }}</td>
                                    <td>{{ $training->price }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-primary" href="/admin/trainings/{{ $training->id }}"
                                            role="button">{{ __('Detail')  }}</a>

                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteTrainingModal_{{ $training->id }}">
                                            {{ __('Smazat')  }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                            data-target="#addTrainingModal">
                            {{ __('Přidat kroužek')  }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCityModal" tabindex="-1" role="dialog" aria-labelledby="editCityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/admin/cities/{{ $city->id }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCityModalLabel">{{ __('Upravit město')  }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="_method" value="PATCH">

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                Please fix the following errors
                            </div>
                        @endif

                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name">{{ __('Název') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
                                placeholder=""
                                value="{{ old('name', $city->name) }}"
                            >
                            @if($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group{{ $errors->has('x') ? ' has-error' : '' }}">
                                    <label for="x">{{ __('X') }}</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="x"
                                        name="x"
                                        min="0"
                                        max="100"
                                        placeholder="0 - 100"
                                        value="{{ old('x', $city->x) }}"
                                    >
                                    @if($errors->has('x'))
                                        <span class="help-block">{{ $errors->first('x') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group{{ $errors->has('y') ? ' has-error' : '' }}">
                                    <label for="y">{{ __('Y') }}</label>
                                    <input
                                        type="number"
                                        class="form-control"
                                        id="y"
                                        name="y"
                                        min="0"
                                        max="100"
                                        required
                                        placeholder="0 - 100"
                                        value="{{ old('y', $city->y) }}"
                                    >
                                    @if($errors->has('y'))
                                        <span class="help-block">{{ $errors->first('y') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Zavřít') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Upravit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addTrainingModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/admin/trainings" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{ __('Přidat kroužek')  }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                Please fix the following errors
                            </div>
                        @endif

                        {!! csrf_field() !!}

                        <input type="hidden" name="city_id" value="{{ $city->id }}">

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="day">{{ __('Adresa') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="address"
                                name="address"
                                placeholder=""
                                required
                                value="{{ old('address') }}"
                            >
                            @if($errors->has('address'))
                                <span class="help-block">{{ $errors->first('address') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('day') ? ' has-error' : '' }}">
                            <label for="day">{{ __('Den') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="day"
                                name="day"
                                placeholder=""
                                required
                                value="{{ old('day') }}"
                            >
                            @if($errors->has('day'))
                                <span class="help-block">{{ $errors->first('day') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('season') ? ' has-error' : '' }}">
                            <label for="season">{{ __('Období') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="season"
                                name="season"
                                placeholder=""
                                required
                                value="{{ old('season') }}"
                            >
                            @if($errors->has('season'))
                                <span class="help-block">{{ $errors->first('season') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('trainer') ? ' has-error' : '' }}">
                            <label for="trainer">{{ __('Trenér') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="trainer"
                                name="trainer"
                                placeholder=""
                                required
                                value="{{ old('trainer') }}"
                            >
                            @if($errors->has('trainer'))
                                <span class="help-block">{{ $errors->first('trainer') }}</span>
                            @endif
                        </div>

                            <div class="form-group{{ $errors->has('capacity') ? ' has-error' : '' }}">
                                <label for="capacity">{{ __('Kapacita') }}</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    id="capacity"
                                    name="capacity"
                                    placeholder=""
                                    min="0"
                                    required
                                    value="{{ old('capacity') }}"
                                >
                                @if($errors->has('capacity'))
                                    <span class="help-block">{{ $errors->first('capacity') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                                <label for="time">{{ __('Čas') }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="time"
                                    name="time"
                                    placeholder=""
                                    required
                                    value="{{ old('time') }}"
                                >
                                @if($errors->has('time'))
                                    <span class="help-block">{{ $errors->first('time') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price">{{ __('Cena') }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="price"
                                    name="price"
                                    placeholder=""
                                    required
                                    value="{{ old('price') }}"
                                >
                                @if($errors->has('price'))
                                    <span class="help-block">{{ $errors->first('price') }}</span>
                                @endif
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Zavřít') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Přidat') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @foreach($city->trainings as $training)
        <div class="modal fade" id="deleteTrainingModal_{{ $training->id }}" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __("Opravdu smazat kroužek {$training->day}?")  }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <form action="/admin/trainings/{{ $training->id  }}" method="POST" class="d-inline-block mb-0">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('Zavřít') }}</button>

                            <button class="btn btn-danger" type="submit">{{ __('Smazat')  }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
