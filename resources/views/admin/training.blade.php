@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1 class="h2">{{ __('Kroužek')  }} #{{ $training->id }}</h1></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col">
                                <dl class="row">
                                    <dt class="col-sm-3">{{ __('Adresa') }}</dt>
                                    <dd class="col-sm-9">{{ $training->address }}</dd>

                                    <dt class="col-sm-3">{{ __('Den') }}</dt>
                                    <dd class="col-sm-9">{{ $training->day }}</dd>

                                    <dt class="col-sm-3">{{ __('Období') }}</dt>
                                    <dd class="col-sm-9">{{ $training->season }}</dd>

                                    <dt class="col-sm-3">{{ __('Čas') }}</dt>
                                    <dd class="col-sm-9">{{ $training->time }}</dd>

                                    <dt class="col-sm-3">{{ __('Trenér') }}</dt>
                                    <dd class="col-sm-9">{{ $training->trainer }}</dd>

                                    <dt class="col-sm-3">{{ __('Kapacita') }}</dt>
                                    <dd class="col-sm-9">{{ $training->capacity }}</dd>

                                    <dt class="col-sm-3">{{ __('Cena') }}</dt>
                                    <dd class="col-sm-9">{{ $training->price }}</dd>
                                </dl>
                            </div>
                            <div class="col text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#editTrainingModal">
                                    {{ __('Upravit')  }}
                                </button>
                            </div>
                        </div>

                        <hr>

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a
                                    class="nav-item nav-link active"
                                    id="nav-home-tab"
                                    data-toggle="tab"
                                    href="#nav-home"
                                    role="tab"
                                    aria-controls="nav-home"
                                    aria-selected="true"
                                ><h2 class="h4">{{ __('Nový (nezaplaceno)') }} <strong>{{ $training->new_count() }}</strong></h2></a>
                                <a
                                    class="nav-item nav-link"
                                    id="nav-profile-tab"
                                    data-toggle="tab"
                                    href="#nav-profile"
                                    role="tab"
                                    aria-controls="nav-profile"
                                    aria-selected="false"
                                > <h2 class="h4">{{ __('Aktuální (zaplaceno)') }} <strong>{{ $training->paid_count() }}</strong></h2></a>
                                <a
                                    class="nav-item nav-link"
                                    id="nav-contact-tab"
                                    data-toggle="tab"
                                    href="#nav-contact"
                                    role="tab"
                                    aria-controls="nav-contact"
                                    aria-selected="false"
                                ><h2 class="h4">{{ __('Zrušení') }} <strong>{{ $training->canceled_count() }}</strong></h2></a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">{{ __('Email') }}</th>
                                                <th scope="col">{{ __('Počet lidí') }}</th>
                                                <th scope="col">{{ __('Datum') }}</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($training->orders as $order)
                                                @if ($order->state === 0)
                                                    <tr>
                                                        <th scope="row">{{ $order->id }}</th>
                                                        <td>{{ $order->email }}</td>
                                                        <td>{{ $order->count  }}</td>
                                                        <td>{{ $order->created_at }}</td>
                                                        <td>
                                                            <a
                                                                href="/admin/orders/{{ $order->id }}"
                                                                class="btn btn-primary"
                                                                role="button"
                                                            >{{ __('Detail')  }}</a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">{{ __('Email') }}</th>
                                                <th scope="col">{{ __('Počet lidí') }}</th>
                                                <th scope="col">{{ __('Datum') }}</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($training->orders as $order)
                                                @if ($order->state === 1)
                                                    <tr>
                                                        <th scope="row">{{ $order->id }}</th>
                                                        <td>{{ $order->email }}</td>
                                                        <td>{{ $order->count  }}</td>
                                                        <td>{{ $order->created_at }}</td>
                                                        <td>
                                                            <a
                                                                href="/admin/orders/{{ $order->id }}"
                                                                class="btn btn-primary"
                                                                role="button"
                                                            >{{ __('Detail')  }}</a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                aria-labelledby="nav-contact-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">{{ __('Email') }}</th>
                                                <th scope="col">{{ __('Počet lidí') }}</th>
                                                <th scope="col">{{ __('Datum') }}</th>
                                                <th scope="col"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($training->orders as $order)
                                                @if ($order->state === 2)
                                                    <tr>
                                                        <th scope="row">{{ $order->id }}</th>
                                                        <td>{{ $order->email }}</td>
                                                        <td>{{ $order->count  }}</td>
                                                        <td>{{ $order->created_at }}</td>
                                                        <td>
                                                            <a
                                                                href="/admin/orders/{{ $order->id }}"
                                                                class="btn btn-primary"
                                                                role="button"
                                                            >{{ __('Detail')  }}</a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-deck">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTrainingModal" tabindex="-1" role="dialog" aria-labelledby="editTrainingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/admin/trainings/{{ $training->id }}" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTrainingModalLabel">{{ __('Upravit kroužek')  }}</h5>
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

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="day">{{ __('Adresa') }}</label>
                            <input
                                type="text"
                                class="form-control"
                                id="address"
                                name="address"
                                placeholder=""
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
                                placeholder=""
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
                                placeholder=""
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
                                placeholder=""
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
                                placeholder=""
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
                                placeholder=""
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
                                placeholder=""
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

@endsection
