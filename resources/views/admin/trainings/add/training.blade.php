<div class="modal fade" id="addTrainingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/trainings" method="POST">
                @csrf
                <input type="hidden" name="city_id" value="{{ $city->id }}">

                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Přidat kroužek')  }}</h5>

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

                    @component('admin.input', [
                        'type'    => 'text', 
                        'name'    => 'day',
                        'required' => true,
                    ]){{ __('Den') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'text', 
                        'name'    => 'season',
                        'required' => true,
                    ]){{ __('Období') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'text', 
                        'name'    => 'time',
                        'required' => true,
                    ]){{ __('Čas') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'checkbox', 
                        'name'    => 'advanced',
                        'checked' => false,
                    ]){{ __('Pokročilý') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'text', 
                        'name'    => 'address',
                        'required' => true,
                    ]){{ __('Adresa') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'text', 
                        'name'    => 'trainer',
                    ]){{ __('Trenér') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'number', 
                        'name'    => 'capacity',
                        'required' => true,
                        'min'     => 0,
                    ]){{ __('Kapacita') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'number', 
                        'name'    => 'price',
                        'required' => true,
                        'min'     => 0,
                    ]){{ __('Cena') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'checkbox', 
                        'name'    => 'hidden',
                        'checked' => true,
                    ]){{ __('Skrytý') }}
                    @endcomponent
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Zavřít') }}</button>

                    <button type="submit" class="btn btn-primary">{{ __('Přidat') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>