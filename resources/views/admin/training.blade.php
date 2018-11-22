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
                                <small>{{ __('workshop')  }}</small> {{ $training->date }}
                            @elseif ($training->type == 2)
                                <small>{{ __('Kemp')  }}</small> {{ $training->date }} - {{ $training->date_to }}
                            @else
                                <small>{{ __('Kroužek')  }}</small> {{ $training->day }}
                            @endif
                        </h1>
                    </div>

                    <div class="card-body">
                        @include('admin.layout.status')

                        <div class="row">
                            <div class="col">
                                <dl class="row">

                                    @if ($training->type == 1)
                                        <dt class="col-sm-6">{{ __('Adresa') }}</dt>
                                        <dd class="col-sm-6">{{ $training->address }}</dd>

                                        <dt class="col-sm-6">{{ __('Datum') }}</dt>
                                        <dd class="col-sm-6">{{ $training->date }}</dd>

                                        <dt class="col-sm-6">{{ __('Čas') }}</dt>
                                        <dd class="col-sm-6">{{ $training->time }}</dd>

                                        <dt class="col-sm-6">{{ __('Trenér') }}</dt>
                                        <dd class="col-sm-6">{{ $training->trainer }}</dd>
                                    @elseif ($training->type == 2)
                                        <dt class="col-sm-6">{{ __('Adresa') }}</dt>
                                        <dd class="col-sm-6">{{ $training->address }}</dd>

                                        <dt class="col-sm-6">{{ __('Popis') }}</dt>
                                        <dd class="col-sm-6">{{ $training->text }}</dd>

                                        <dt class="col-sm-6">{{ __('Datum od') }}</dt>
                                        <dd class="col-sm-6">{{ $training->date }}</dd>

                                        <dt class="col-sm-6">{{ __('Datum do') }}</dt>
                                        <dd class="col-sm-6">{{ $training->date_to }}</dd>
                                    @else
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
                                    @endif

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
                                <th scope="col" title="{{ __('Variabilní symbol') }}">{{ __('VS') }}</th>
                                <th scope="col">{{ __('Jméno') }}</th>
                                <th scope="col">{{ __('Email') }}</th>
                                <th scope="col">{{ __('Telefon') }}</th>
                                <th scope="col">{{ __('Stav') }}</th>
                                <th scope="col">{{ __('Datum') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($training->state(3) as $order)
                                <tr class="{{ $order->tableColor() }}">
                                    <th>{{ $order->id }}</th>
                                    <th>
                                        {{ $order->name }}<br>
                                        <small>{{ $order->parent }}</small>
                                    </th>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->phone }}</td>
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

                            @foreach ($training->state(0) as $order)
                                <tr class="{{ $order->tableColor() }}">
                                    <th>{{ $order->id }}</th>
                                    <th>
                                        {{ $order->name }}<br>
                                        <small>{{ $order->parent }}</small>
                                    </th>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->phone }}</td>
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
                                <tr class="{{ $order->tableColor() }}">
                                    <th>{{ $order->id }}</th>
                                    <th>
                                        {{ $order->name }}<br>
                                        <small>{{ $order->parent }}</small>
                                    </th>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->phone }}</td>
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
                                <tr class="{{ $order->tableColor() }}">
                                    <th>{{ $order->id }}</th>
                                    <th>
                                        {{ $order->name }}<br>
                                        <small>{{ $order->parent }}</small>
                                    </th>
                                    <td>{{ $order->email }}</td>
                                    <td>{{ $order->phone }}</td>
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
                        <h5 class="modal-title">
                            @if ($training->type == 1)
                                {{ __('Upravit workshop')  }}
                            @elseif ($training->type == 2)
                                {{ __('Upravit kemp')  }}
                            @else
                                {{ __('Upravit kroužek')  }}
                            @endif
                        </h5>
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

                            @if ($training->type == 1)
                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address">{{ __('Adresa') }}</label>
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

                                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                    <label for="date">{{ __('Datum') }}</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="date"
                                        name="date"
                                        placeholder="dd.mm. rrrr"
                                        required
                                        value="{{ old('date', $training->date()) }}"
                                    >
                                    @if($errors->has('date'))
                                        <span class="help-block">{{ $errors->first('date') }}</span>
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

                            @elseif ($training->type == 2)

                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address">{{ __('Adresa') }}</label>
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

                                <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                                    <label for="text">{{ __('Popis') }}</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="text"
                                        name="text"
                                        value="{{ old('text', $training->text) }}"
                                    >
                                    @if($errors->has('text'))
                                        <span class="help-block">{{ $errors->first('text') }}</span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                                    <label for="date">{{ __('Datum od') }}</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="date"
                                        name="date"
                                        placeholder="dd.mm. rrrr"
                                        required
                                        value="{{ old('date', $training->date()) }}"
                                    >
                                    @if($errors->has('date'))
                                        <span class="help-block">{{ $errors->first('date') }}</span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('date_to') ? ' has-error' : '' }}">
                                    <label for="date_to">{{ __('Datum do') }}</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="date_to"
                                        name="date_to"
                                        placeholder="dd.mm. rrrr"
                                        required
                                        value="{{ old('date_to', $training->dateTo()) }}"
                                    >
                                    @if($errors->has('date_to'))
                                        <span class="help-block">{{ $errors->first('date_to') }}</span>
                                    @endif
                                </div>


                            @else
                                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                    <label for="address">{{ __('Adresa') }}</label>
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

                                <div class="form-group{{ $errors->has('time') ? ' has-error' : '' }}">
                                    <label for="time">{{ __('Čas') }}</label>
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
                            @endif



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
                        <h5 class="modal-title">{{ __('Poslat hromadný email')  }}</h5>

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

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#mail_text">{{ __('Zpráva') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab"
                                    href="#mail_recipients">{{ __('Příjemci') }}</a>
                            </li>
                        </ul>

                        <br>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="mail_text">
                                <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                    <label for="subject">{{ __('Předmet mailu') }}</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="subject"
                                        name="subject"
                                        value="{{ old('subject') }}"
                                    >
                                    @if($errors->has('subject'))
                                        <span class="help-block">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>

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

                            <div class="tab-pane fade" id="mail_recipients">
                                <button type="button" data-state="3" class="btn btn-info">{{ __('Vybrat náhradníky') }}</button>
                                <button type="button" data-state="0" class="btn btn-warning">{{ __('Vybrat nové') }}</button>
                                <button type="button" data-state="1" class="btn btn-success">{{ __('Vybrat zaplacené') }}</button>
                                <button type="button" data-state="2" class="btn btn-danger">{{ __('Vybrat zrušené') }}</button>

                                <br>
                                <br>

                                <table class="table">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">{{ __('Jméno') }}</th>
                                        <th scope="col">{{ __('Email') }}</th>
                                        <th scope="col">{{ __('Telefon') }}</th>
                                        <th scope="col">{{ __('Stav') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($training->orders as $order)
                                        <tr class="{{ $order->tableColor() }}">
                                            <td>
                                                <div class="form-check form-check-inline">
                                                    <label class="form-check-label">
                                                        <input data-state="{{ $order->state }}" name="orders[]" class="form-check-input" type="checkbox" value="{{ $order->id }}">
                                                    </label>
                                                </div>
                                            </td>
                                            <td>{{ $order->name }}</td>
                                            <td>{{ $order->email }}</td>
                                            <td>{{ $order->phone }}</td>
                                            <td>{{ $order->_state() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Zavřít') }}</button>

                        <button type="submit" class="btn btn-primary">{{ __('Poslat') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
