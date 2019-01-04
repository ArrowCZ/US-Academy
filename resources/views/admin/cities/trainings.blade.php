<h2 class="card-title">{{ __('Kroužky') }}</h2>

<table class="table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">{{ __('Skrytý') }}</th>
        <th scope="col">{{ __('Období') }}</th>
        <th scope="col">{{ __('Den') }}</th>
        <th scope="col">{{ __('Čas') }}</th>
        <th scope="col">{{ __('Pokročilý') }}</th>
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
            <td>{{ $training->hidden ? 'ano' : 'ne' }}</td>
            <td>{{ $training->season }}</td>
            <td>{{ $training->day }}</td>
            <td>{{ $training->time }}</td>
            <td>{{ $training->advanced ? 'ano' : 'ne' }}</td>
            <td>{{ $training->trainer }}</td>
            <td>
                {{ $training->paid_count() }}
                <small>({{ $training->new_count() }})</small>
                /
                {{ $training->capacity }}
            </td>
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
