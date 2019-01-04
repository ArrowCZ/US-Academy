<div class="modal fade" id="addWorkshopModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/trainings" method="POST">
                @csrf
                <input type="hidden" name="city_id" value="{{ $city->id }}">
                <input type="hidden" name="type" value="1">

                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Přidat workshop')  }}</h5>

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
                        'type'        => 'text', 
                        'name'        => 'date',
                        'placeholder' => 'dd.mm. rrrr',
                        'required' => true,
                    ]){{ __('Datum') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'text', 
                        'name'    => 'time',
                        'required' => true,
                    ]){{ __('Čas') }}
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
                        'min'     => 0,
                        'required' => true,
                    ]){{ __('Kapacita') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'number', 
                        'name'    => 'price',
                        'min'     => 0,
                        'required' => true,
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