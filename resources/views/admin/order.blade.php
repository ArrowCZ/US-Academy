@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h2">{{ __('Objednávka')  }} #{{ $order->id }}</h1>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="h4">
                            Stav:
                            <strong>
                                @switch($order->state)
                                    @case(0)
                                        {{ __('Nový (nezaplaceno)') }}
                                        @break
                                    @case(1)
                                        {{ __('Aktuální (zaplaceno)') }}
                                        @break
                                    @case(2)
                                        {{ __('Zrušeno') }}
                                        @break
                                @endswitch
                            </strong>
                        </div>

                            <div class="row">
                                <div class="col">
                                    <dl class="row">
                                        <dt class="col-sm-3">{{ __('Jméno') }}</dt>
                                        <dd class="col-sm-9">{{ $order->name }}</dd>

                                        <dt class="col-sm-3">{{ __('Email') }}</dt>
                                        <dd class="col-sm-9">{{ $order->email }}</dd>

                                        <dt class="col-sm-3">{{ __('Datum přihlášení') }}</dt>
                                        <dd class="col-sm-9">{{ $order->created_at }}</dd>

                                        <dt class="col-sm-3">{{ __('Město') }}</dt>
                                        <dd class="col-sm-9">{{ $city->name }}</dd>

                                        <dt class="col-sm-3">{{ __('Období') }}</dt>
                                        <dd class="col-sm-9">{{ $training->season }}</dd>

                                        <dt class="col-sm-3">{{ __('Den, čas') }}</dt>
                                        <dd class="col-sm-9">{{ $training->day }}, {{ $training->time }}</dd>

                                        <dt class="col-sm-3">{{ __('Trenér') }}</dt>
                                        <dd class="col-sm-9">{{ $training->trainer }}</dd>

                                        <dt class="col-sm-3">{{ __('Cena') }}</dt>
                                        <dd class="col-sm-9">{{ $order->price }}</dd>
                                    </dl>
                                </div>
                                <div class="col text-right">
                                    <button type="button" class="btn btn-success" data-toggle="modal"
                                        data-target="#editStateModal">
                                        {{ __('Změnit stav')  }}
                                    </button>
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


                       {{-- <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
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
                        </div>--}}

                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="state" id="state_0" value="0" {{ $order->state == 0 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="state_0">
                                            {{ __('Nový (nezaplaceno)') }}
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="state" id="state_1" value="1" {{ $order->state == 1 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="state_1">
                                            {{ __('Aktuální (zaplaceno)') }}
                                        </label>
                                    </div>
                                    <div class="form-check disabled">
                                        <input class="form-check-input" type="radio" name="state" id="state_2" value="2" {{ $order->state == 2 ? 'checked' : ''}}>
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

@endsection
