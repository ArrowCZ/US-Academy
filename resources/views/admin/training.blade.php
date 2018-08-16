@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Nástěnka') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.cities') }}">{{ __('Města')  }}</a></div>
                    <div class="breadcrumb-item"><a href="/admin/cities/{{ $city->id }}">{{ $city->name }}</a></div>
                    <div class="breadcrumb-item">{{ $training->day }}</div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h2">
                            <small>{{ __('Kroužek')  }}</small> {{ $training->day }}
                        </h1>
                    </div>

                    <div class="card-body">
                        @include('admin.layout.status')

                        <div class="row">
                            <div class="col">
                                <dl class="row">
                                    <dt class="col-sm-6">{{ __('Adresa') }}</dt>
                                    <dd class="col-sm-6">{{ $training->address }}</dd>

                                    <dt class="col-sm-6">{{ __('Den') }}</dt>
                                    <dd class="col-sm-6">{{ $training->day }}</dd>

                                    <dt class="col-sm-6">{{ __('Období') }}</dt>
                                    <dd class="col-sm-6">{{ $training->season }}</dd>

                                    <dt class="col-sm-6">{{ __('Čas') }}</dt>
                                    <dd class="col-sm-6">{{ $training->time }}</dd>

                                    <dt class="col-sm-6">{{ __('Trenér') }}</dt>
                                    <dd class="col-sm-6">{{ $training->trainer }}</dd>

                                    <dt class="col-sm-6">{{ __('Kapacita') }}</dt>
                                    <dd class="col-sm-6">{{ $training->capacity }}</dd>

                                    <dt class="col-sm-6">{{ __('Cena') }}</dt>
                                    <dd class="col-sm-6">{{ $training->price }}</dd>
                                </dl>
                            </div>
                            <div class="col text-right">
                                <button
                                    data-toggle="modal" data-target="#editTrainingModal"
                                    type="button"
                                    class="btn btn-success"
                                >{{ __('Upravit')  }}
                                </button>
                            </div>
                        </div>

                        <hr>

                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">{{ __('Jméno') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('Stav') }}</th>
                                <th scope="col">{{ __('Datum') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($training->state(0) as $order)
                                <tr class="table-warning">
                                    <th>{{ $order->name }}</th>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->_state() }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a
                                            href="/admin/orders/{{ $order->id }}"
                                            class="btn btn-primary"
                                        >{{ __('Detail')  }}</a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($training->state(1) as $order)
                                <tr class="table-success">
                                    <th>{{ $order->name }}</th>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->_state() }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a
                                            href="/admin/orders/{{ $order->id }}"
                                            class="btn btn-primary"
                                        >{{ __('Detail')  }}</a>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach ($training->state(2) as $order)
                                <tr class="table-danger">
                                    <th>{{ $order->name }}</th>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->_state() }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        <a
                                            href="/admin/orders/{{ $order->id }}"
                                            class="btn btn-primary"
                                        >{{ __('Detail')  }}</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="card-footer">
                        <button
                            class="btn btn-primary"
                            data-toggle="modal" data-target="#sendMailModal"
                        >{{ __('Poslat email') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTrainingModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/trainings/{{ $training->id }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Upravit kroužek')  }}</h5>
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

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="day">{{ __('Adresa') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="address"
                                name="address"
                                value="{{ old('address', $training->address) }}"
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
                                value="{{ old('day', $training->day) }}"
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
                                value="{{ old('season', $training->season) }}"
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
                                value="{{ old('trainer', $training->trainer) }}"
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
                                value="{{ old('capacity', $training->capacity) }}"
                            >
                            @if($errors->has('capacity'))
                                <span class="help-block">{{ $errors->first('capacity') }}</span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                            <label for="time">{{ __('čas') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="time"
                                name="time"
                                min="0"
                                value="{{ old('time', $training->time) }}"
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
                                min="0"
                                value="{{ old('price', $training->price) }}"
                            >
                            @if($errors->has('price'))
                                <span class="help-block">{{ $errors->first('price') }}</span>
                            @endif
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

    <div class="modal fade" id="sendMailModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="/admin/trainings/{{ $training->id }}/mail" method="POST">
                    @method('POST')
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Poslat hromadny email')  }}</h5>

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

                        <div class="row">
                            <div class="col">
                                <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                                    <label for="text">{{ __('Text') }}</label>
                                    <textarea
                                        type="text"
                                        class="form-control"
                                        id="text"
                                        name="text"
                                        rows="10"
                                    >{{ old('text') }}</textarea>
                                    @if($errors->has('text'))
                                        <span class="help-block">{{ $errors->first('text') }}</span>
                                    @endif
                                </div>
                            </div>
                            {{--<div class="col">--}}
                                {{--<h6>{{ __('Nahled') }}</h6>--}}

                                {{--<div id="preview"></div>--}}
                            {{--</div>--}}
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

@endsection
