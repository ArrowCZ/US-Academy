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
                                >{{ __('Upravit')  }}
                                </button>
                            </div>
                        </div>

                        <hr>

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
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($city->getTrainings(0) as $training)
                                <tr>
                                    <th>{{ $training->id }}</th>
                                    <td>{{ $training->day }}</td>
                                    <td>{{ $training->season }}</td>
                                    <td>{{ $training->time }}</td>
                                    <td>{{ $training->trainer }}</td>
                                    <td>{{ $training->paid_count() }}
                                        <small>({{$training->new_count()}})</small>
                                        / {{ $training->capacity }}</td>
                                    <td>{{ $training->price }}</td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a
                                                class="btn btn-primary"
                                                href="/admin/trainings/{{ $training->id }}"
                                            >{{ __('Detail')  }}
                                            </a>

                                            <button
                                                type="button"
                                                class="btn btn-danger"
                                                data-toggle="modal"
                                                data-target="#deleteTrainingModal_{{ $training->id }}"
                                            >{{ __('Smazat')  }}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <hr>
                        <h2 class="card-title">{{ __('Workshopy') }}</h2>

                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Datum') }}</th>
                                <th scope="col">{{ __('Čas') }}</th>
                                <th scope="col">{{ __('Trenér') }}</th>
                                <th scope="col">{{ __('Kapacita') }}</th>
                                <th scope="col">{{ __('Cena') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($city->getTrainings(1) as $training)
                                <tr>
                                    <th>{{ $training->id }}</th>
                                    <td>{{ $training->date }}</td>
                                    <td>{{ $training->time }}</td>
                                    <td>{{ $training->trainer }}</td>
                                    <td>{{ $training->paid_count() }}
                                        <small>({{$training->new_count()}})</small>
                                        / {{ $training->capacity }}</td>
                                    <td>{{ $training->price }}</td>
                                    <td class="text-right">
                                        <div class="btn-group">
                                            <a
                                                class="btn btn-primary"
                                                href="/admin/trainings/{{ $training->id }}"
                                            >{{ __('Detail')  }}
                                            </a>

                                            <button
                                                type="button"
                                                class="btn btn-danger"
                                                data-toggle="modal"
                                                data-target="#deleteTrainingModal_{{ $training->id }}"
                                            >{{ __('Smazat')  }}
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <h2 class="card-title">{{ __('Kempy') }}</h2>


                    </div>

                    <div class="card-footer text-right">
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal" data-target="#addTrainingModal"
                        >{{ __('Přidat kroužek')  }}
                        </button>

                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal" data-target="#addWorkshopModal"
                        >{{ __('Přidat workshop')  }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCityModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/cities/{{ $city->id }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Upravit město')  }}</h5>

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

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="name">{{ __('Název') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="name"
                                name="name"
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

    <div class="modal fade" id="addTrainingModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/trainings" method="POST">
                    @csrf
                    <input type="hidden" name="city_id" value="{{ $city->id }}">

                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Přidat kroužek')  }}</h5>

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

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address">{{ __('Adresa') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="address"
                                name="address"
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

    <div class="modal fade" id="addWorkshopModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/trainings" method="POST">
                    @csrf
                    <input type="hidden" name="city_id" value="{{ $city->id }}">
                    <input type="hidden" name="type" value="1">

                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Přidat workshop')  }}</h5>

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

                        <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                            <label for="date">{{ __('Datum') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="date"
                                name="date"
                                placeholder="dd.mm. rrrr"
                                required
                                value="{{ old('date') }}"
                            >
                            @if($errors->has('date'))
                                <span class="help-block">{{ $errors->first('date') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                            <label for="time">{{ __('Čas') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="time"
                                name="time"
                                required
                                value="{{ old('time') }}"
                            >
                            @if($errors->has('time'))
                                <span class="help-block">{{ $errors->first('time') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address">{{ __('Adresa') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="address"
                                name="address"
                                required
                                value="{{ old('address') }}"
                            >
                            @if($errors->has('address'))
                                <span class="help-block">{{ $errors->first('address') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('trainer') ? ' has-error' : '' }}">
                            <label for="trainer">{{ __('Trenér') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="trainer"
                                name="trainer"
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
                                min="0"
                                required
                                value="{{ old('capacity') }}"
                            >
                            @if($errors->has('capacity'))
                                <span class="help-block">{{ $errors->first('capacity') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                            <label for="price">{{ __('Cena') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="price"
                                name="price"
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
        <div class="modal fade" id="deleteTrainingModal_{{ $training->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Opravdu smazat kroužek') }} {{ $training->day  }} {{ __('se všemi lidmi?') }}</h5>

                        <button type="button" class="close" data-dismiss="modal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-footer">
                        <form action="/admin/trainings/{{ $training->id  }}" method="POST" class="d-inline-block mb-0">
                            @method('DELETE')
                            @csrf

                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('Zavřít') }}</button>

                            <button type="submit" class="btn btn-danger">{{ __('Smazat') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
