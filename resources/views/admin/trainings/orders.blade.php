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