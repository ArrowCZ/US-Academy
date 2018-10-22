@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Nástěnka') }}</a></div>
                    <div class="breadcrumb-item"><a href="{{ route('admin.cities') }}">{{ __('Města')  }}</a></div>
                    <div class="breadcrumb-item"><a href="/admin/cities/{{ $city->id }}">{{ $city->name }}</a></div>
                    <div class="breadcrumb-item"><a href="/admin/trainings/{{ $training->id }}">{{ $training->day }}</a>
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
                            <small>{{ __('Objednávka')  }}</small> {{ $order->name }}
                        </h1>
                    </div>

                    <div class="card-body">
                        @include('admin.layout.status')

                        <div class="h4">
                            Stav: <strong> {{ $order->_state() }} </strong>
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
                                </dl>

                                @if ($training->type == 1)
                                    <h2 class="h3">Workshop</h2>

                                    <dl class="row">
                                        <dt class="col-sm-6">{{ __('Město') }}</dt>
                                        <dd class="col-sm-6">{{ $city->name }}</dd>

                                        <dt class="col-sm-6">{{ __('Datum') }}</dt>
                                        <dd class="col-sm-6">{{ $training->date()->format('j.n. Y') }}</dd>

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
                                    data-target="#editStateModal">
                                    {{ __('Změnit stav')  }}
                                </button>

                                @if ($training->type == 1)
                                @else
                                    <br><br>
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#editTrainingModal">
                                        {{ __('Změnit kroužek')  }}
                                    </button>
                                @endif

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
                        <h5 class="modal-title" id="editTrainingModalLabel">{{ __('Změnit kroužek objednávky')  }}</h5>
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
                                    <option value="{{ $_training->id }}">
                                        {{ $_city->name }} -
                                        {{ $_training->day }} -
                                        {{ $_training->trainer }} -

                                        {{ $_training->paid_count() }}
                                        <small>({{$_training->new_count()}})</small>
                                        / {{ $_training->capacity }}
                                    </option>
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
