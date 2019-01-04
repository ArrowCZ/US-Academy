<dl class="row">
    <dt class="col-sm-6">{{ __('Skrytý') }}</dt>
    <dd class="col-sm-6">{{ $training->hidden ? 'ano' : 'ne' }}</dd>

    <dt class="col-sm-6">{{ __('Adresa') }}</dt>
    <dd class="col-sm-6">{{ $training->address }}</dd>

    <dt class="col-sm-6">{{ __('Datum') }}</dt>
    <dd class="col-sm-6">{{ $training->date }}</dd>

    <dt class="col-sm-6">{{ __('Čas') }}</dt>
    <dd class="col-sm-6">{{ $training->time }}</dd>

    <dt class="col-sm-6">{{ __('Trenér') }}</dt>
    <dd class="col-sm-6">{{ $training->trainer }}</dd>

    <dt class="col-sm-6">{{ __('Vedoucí') }}</dt>
    <dd class="col-sm-6">{{ $training->leader->name ?? '' }}</dd>

    <dt class="col-sm-6">{{ __('Věk') }}</dt>
    <dd class="col-sm-6">{{ $training->age }}</dd>

    <dt class="col-sm-6">{{ __('Náročnost') }}</dt>
    <dd class="col-sm-6">{{ $training->difficulty }}</dd>

    <dt class="col-sm-6">{{ __('Kapacita') }}</dt>
    <dd class="col-sm-6">{{ $training->capacity }}</dd>

    <dt class="col-sm-6">{{ __('Cena') }}</dt>
    <dd class="col-sm-6">{{ $training->price }}</dd>
</dl>