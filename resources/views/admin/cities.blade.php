@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="breadcrumb">
                    <div class="breadcrumb-item"><a href="{{ route('admin') }}">{{ __('Nástěnka') }}</a></div>
                    <div class="breadcrumb-item">{{ __('Města')  }}</div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h1 class="h2">{{ __('Města')  }}</h1></div>

                    <div class="card-body">
                        @include('admin.layout.status')

                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Název') }}</th>
                                <th scope="col">{{ __('Počet kroužků') }}</th>
                                <th scope="col">{{ __('Souřadnice') }}</th>
                                <th scope="col"></th>
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
                                        <div class="btn-group">
                                            <a
                                                href="/admin/cities/{{ $city->id }}"
                                                class="btn btn-primary"
                                            >{{ __('Detail')  }}</a>

                                            <button
                                                type="button"
                                                class="btn btn-danger"
                                                data-toggle="modal" data-target="#deleteCityModal_{{ $city->id  }}"
                                            >{{ __('Smazat')  }}
                                            </button>
                                        </div>
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

<div class="modal fade" id="addCityModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/cities" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Přidat město')  }}</h5>

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

                    @component('admin.input', ['type' => 'text', 'name' => 'name'])
                        {{ __('Název') }}
                    @endcomponent

                    <div class="row">
                        <div class="col">
                            @component('admin.input', ['type' => 'number', 'name' => 'x', 'min' => 0, 'max' => 100])
                                {{ __('X') }}
                            @endcomponent
                        </div>

                        <div class="col">
                            @component('admin.input', ['type' => 'number', 'name' => 'y', 'min' => 0, 'max' => 100])
                                {{ __('Y') }}
                            @endcomponent
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
    <div class="modal fade" id="deleteCityModal_{{ $city->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __("Opravdu smazat město {$city->name} se všemi kroužky a lidmi?")  }}</h5>

                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer">
                    <form action="/admin/cities/{{ $city->id  }}" method="POST" class="d-inline-block mb-0">
                        @method('DELETE')
                        @csrf

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Zavřít') }}</button>

                        <button class="btn btn-danger" type="submit">{{ __('Smazat')  }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach