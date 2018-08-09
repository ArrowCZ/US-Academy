@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1 class="h2">{{ __('Města')  }}</h1></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Název') }}</th>
                                <th scope="col">{{ __('Počet kroužků') }}</th>
                                <th scope="col">{{ __('Souřadnice') }}</th>
                                <th scope="col" class="text-right"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($cities as $city)
                                <tr>
                                    <th scope="row">{{ $city->id  }}</th>
                                    <td>{{ $city->name  }}</td>
                                    <td>{{ count($city->trainings)  }}</td>
                                    <td>{{ $city->x  }}: {{ $city->y  }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-primary" href="/admin/cities/{{ $city->id }}"
                                            role="button">{{ __('Detail')  }}</a>

                                        <button type="button" class="btn btn-danger" data-toggle="modal"
                                            data-target="#deleteCityModal_{{ $city->id  }}">
                                            {{ __('Smazat')  }}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                    <div class="card-footer text-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCityModal">
                            {{ __('Přidat město')  }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<div class="modal fade" id="addCityModal" tabindex="-1" role="dialog" aria-labelledby="Přidat město" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/admin/cities" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Přidat město')  }}</h5>
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

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <label for="name">{{ __('Název') }}</label>
                        <input
                            type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            placeholder=""
                            value="{{ old('name') }}"
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
                                    value="{{ old('x') }}"
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
                                    value="{{ old('y') }}"
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
                    <button type="submit" class="btn btn-primary">{{ __('Přidat') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($cities as $city)
<div class="modal fade" id="deleteCityModal_{{ $city->id }}" tabindex="-1" role="dialog" aria-labelledby="Opravdu smazat město {{ $city->name }}?"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __("Opravdu smazat město {$city->name}?")  }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <form action="/admin/cities/{{ $city->id  }}" method="POST" class="d-inline-block mb-0">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Zavřít') }}</button>

                    <button class="btn btn-danger" type="submit">{{ __('Smazat')  }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach