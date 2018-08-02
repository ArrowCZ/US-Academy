@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="h2">{{ __('City') }}: {{ $city->name }}</h1>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <h2 class="card-title">{{ __('Trainings') }}</h2>

                        <table class="table">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Day') }}</th>
                                <th scope="col">{{ __('Capacity') }}</th>
                                <th scope="col">{{ __('Time') }}</th>
                                <th scope="col">{{ __('Price') }}</th>
                                <th scope="col" class="text-right">{{ __('Actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($city->trainings as $training)
                                <tr>
                                    <th scope="row">{{ $training->id }}</th>
                                    <td>{{ $training->day }}</td>
                                    <td>0 / {{ $training->capacity }}</td>
                                    <td>{{ $training->time }}</td>
                                    <td>{{ $training->price }}</td>
                                    <td class="text-right">
                                        <a class="btn btn-primary" href="/admin/cities/{{ $city->id }}" role="button">{{ __('Detail')  }}</a>

                                        <form action="/admin/cities/{{ $city->id  }}" method="POST" class="d-inline-block mb-0">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button class="btn btn-primary" type="submit">{{ __('Delete')  }}</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
