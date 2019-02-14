@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Nástěnka') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.cities') }}">{{ __('Města') }}</a></div>
                    <div class="breadcrumb-item"><a href="/admin/cities/{{ $city->id }}">{{ $city->name }}</a></div>
                    <div class="breadcrumb-item"><a href="/admin/trainings/{{ $training->id }}">
                        {{ $training->day }}
                        {{ $training->date }}
                    </a>
                    </div>
                    <div class="breadcrumb-item">{{ $order->name }}</div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h2">
                            <small>{{ __('Objednávka')  }}</small>
                            {{ $order->name }}
                        </h1>
                    </div>

                    <div class="card-body">
                        @include('admin.layout.status')

                        <div class="h4">
                            Stav: <strong>{{ $order->_state() }}</strong>
                        </div>

                        <div class="row">
                            <div class="col">
                                <dl class="row">
                                    <dt class="col-sm-6">{{ __('Variabilní symbol') }}</dt>
                                    <dd class="col-sm-6">{{ $order->id }}</dd>

                                    <dt class="col-sm-6">{{ __('Jméno') }}</dt>
                                    <dd class="col-sm-6">{{ $order->name }}</dd>

                                    <dt class="col-sm-6">{{ __('Rodič') }}</dt>
                                    <dd class="col-sm-6">{{ $order->parent }}</dd>

                                    <dt class="col-sm-6">{{ __('Email') }}</dt>
                                    <dd class="col-sm-6">{{ $order->email }}</dd>

                                    <dt class="col-sm-6">{{ __('Telefon') }}</dt>
                                    <dd class="col-sm-6">{{ $order->phone }}</dd>

                                    <dt class="col-sm-6">{{ __('Datum přihlášení') }}</dt>
                                    <dd class="col-sm-6">{{ $order->created_at }}</dd>

                                    @if ($training->type == 2)
                                        <dt class="col-sm-6">{{ __('Ulice') }}</dt>
                                        <dd class="col-sm-6">{{ $order->street }}</dd>

                                        <dt class="col-sm-6">{{ __('Město') }}</dt>
                                        <dd class="col-sm-6">{{ $order->city }}</dd>

                                        <dt class="col-sm-6">{{ __('PSČ') }}</dt>
                                        <dd class="col-sm-6">{{ $order->postal_code }}</dd>

                                        <dt class="col-sm-6">{{ __('Firma') }}</dt>
                                        <dd class="col-sm-6">{{ $order->company }}</dd>

                                        <dt class="col-sm-6">{{ __('IČ') }}</dt>
                                        <dd class="col-sm-6">{{ $order->tin }}</dd>

                                        <dt class="col-sm-6">{{ __('Pojišťovna') }}</dt>
                                        <dd class="col-sm-6">{{ $order->insurance }}</dd>

                                        <dt class="col-sm-6">{{ __('Rodné číslo') }}</dt>
                                        <dd class="col-sm-6">{{ $order->pid_number }}</dd>

                                        <dt class="col-sm-6">{{ __('Zdravotní omezení') }}</dt>
                                        <dd class="col-sm-6">{{ $order->condition }}</dd>
                                    @endif
                                </dl>

                                @if ($training->type == 1)
                                    <h2 class="h3">Workshop</h2>

                                    <dl class="row">
                                        <dt class="col-sm-6">{{ __('Město') }}</dt>
                                        <dd class="col-sm-6">{{ $city->name }}</dd>

                                        <dt class="col-sm-6">{{ __('Datum') }}</dt>
                                        <dd class="col-sm-6">{{ $training->date() }}</dd>

                                        <dt class="col-sm-6">{{ __('Čas') }}</dt>
                                        <dd class="col-sm-6">{{ $training->time }}</dd>

                                        <dt class="col-sm-6">{{ __('Cena') }}</dt>
                                        <dd class="col-sm-6">{{ $order->price }}</dd>

                                        <dt class="col-sm-6">{{ __('Poznámka') }}</dt>
                                        <dd class="col-sm-6">{{ $order->text }}</dd>
                                    </dl>
                                @else
                                    <h2 class="h3">Kroužek</h2>

                                    <dl class="row">
                                        <dt class="col-sm-6">{{ __('Město') }}</dt>
                                        <dd class="col-sm-6">{{ $city->name }}</dd>

                                        <dt class="col-sm-6">{{ __('Období') }}</dt>
                                        <dd class="col-sm-6">{{ $training->season }}</dd>

                                        <dt class="col-sm-6">{{ __('Den, čas') }}</dt>
                                        <dd class="col-sm-6">{{ $training->day }}, {{ $training->time }}</dd>

                                        <dt class="col-sm-6">{{ __('Trenér') }}</dt>
                                        <dd class="col-sm-6">{{ $training->trainer }}</dd>

                                        <dt class="col-sm-6">{{ __('Cena') }}</dt>
                                        <dd class="col-sm-6">{{ $order->price }}</dd>

                                        <dt class="col-sm-6">{{ __('Poznámka') }}</dt>
                                        <dd class="col-sm-6">{{ $order->text }}</dd>
                                    </dl>
                                @endif
                            </div>

                            <div class="col text-right">
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#editOrderModal">
                                    {{ __('Upravit')  }}
                                </button>

                                <br><br>

                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#editStateModal">
                                    {{ __('Změnit stav')  }}
                                </button>

                                <br><br>
                                <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#editTrainingModal">
                                    {{ __('Změnit kroužek / workshop / kemp')  }}
                                </button>

                                <br><br>
                                <a href="{{ route('inovice', $order->id) }}" class="btn btn-success">
                                    {{ __('Zobrazit fakturu')  }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editOrderModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/orders/{{ $order->id }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Upravit objednávku')  }}</h5>
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

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name">{{ __('Jméno') }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $order->name) }}"
                                >
                                @if($errors->has('name'))
                                    <span class="help-block">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('parent') ? ' has-error' : '' }}">
                                <label for="parent">{{ __('Rodič') }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="parent"
                                    name="parent"
                                    value="{{ old('parent', $order->parent) }}"
                                >
                                @if($errors->has('parent'))
                                    <span class="help-block">{{ $errors->first('parent') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">{{ __('Email') }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    value="{{ old('email', $order->email) }}"
                                >
                                @if($errors->has('email'))
                                    <span class="help-block">{{ $errors->first('email') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label for="phone">{{ __('Telefon') }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone', $order->phone) }}"
                                >
                                @if($errors->has('phone'))
                                    <span class="help-block">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                                <label for="price">{{ __('Cena') }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="price"
                                    name="price"
                                    value="{{ old('price', $order->price) }}"
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

    <div class="modal fade" id="editStateModal" tabindex="-1" role="dialog" aria-labelledby="editStateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/admin/orders/{{ $order->id }}" method="POST">
                    @method('PATCH')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTrainingModalLabel">{{ __('Změnit stav objednávky')  }}</h5>
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
                            <div class="col-sm-10">
                                @if ($training->type == 1)
                                @else
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="state" id="state_3"
                                            value="3" {{ $order->state == 3 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="state_3">
                                            {{ __('Náhradník') }}
                                        </label>
                                    </div>
                                @endif

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="state" id="state_0"
                                        value="0" {{ $order->state == 0 ? 'checked' : ''}}>
                                    <label class="form-check-label" for="state_0">
                                        {{ __('Nový (nezaplaceno)') }}
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="state" id="state_1"
                                        value="1" {{ $order->state == 1 ? 'checked' : ''}}>
                                    <label class="form-check-label" for="state_1">
                                        {{ __('Aktuální (zaplaceno)') }}
                                    </label>
                                </div>
                                <div class="form-check disabled">
                                    <input class="form-check-input" type="radio" name="state" id="state_2"
                                        value="2" {{ $order->state == 2 ? 'checked' : ''}}>
                                    <label class="form-check-label" for="state_2">
                                        {{ __('Zrušeno') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Zavřít') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Upravit (a poslat email)') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editTrainingModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="/admin/orders/{{ $order->id }}" method="POST">
                    @method('PATCH')
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="editTrainingModalLabel">{{ __('Změnit kroužek / workshop / kemp objednávky')  }}</h5>
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

                        <select class="custom-select" name="training_id">
                            @foreach ($cities as $_city)
                                @foreach ($_city->trainings as $_training)
                                    @if ($_training->type === $training->type)
                                        <option value="{{ $_training->id }}">
                                            @if ($training->type == 1)
                                                {{ $_city->name }} -
                                                {{ $_training->date }} -
                                                {{ $_training->time }}
                                            @elseif ($training->type == 2)
                                                {{ $_city->name }} -
                                                {{ $_training->date }}
                                                {{ $_training->date_to }}
                                            @else
                                                {{ $_city->name }} -
                                                {{ $_training->day }} -
                                                {{ $_training->time }} -
                                                {{ $_training->season }} -
                                            @endif

                                            {{ $_training->paid_count() }}
                                            <small>({{$_training->new_count()}})</small>
                                            / {{ $_training->capacity }}
                                        </option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
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
