<div class="modal fade" id="editTrainingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/trainings/{{ $training->id }}" method="POST">
                @method('PATCH')
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Upravit kemp') }}</h5>

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

                    @component('admin.input', [
                        'type'    => 'text', 
                        'name'    => 'address',
                        'default' => $training->address,
                    ]){{ __('Adresa') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'text', 
                        'name'    => 'text',
                        'default' => $training->text,
                    ]){{ __('Popis') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'        => 'text', 
                        'name'        => 'date',
                        'placeholder' => 'dd.mm. rrrr',
                        'default'     => $training->date(),
                    ]){{ __('Datum od') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'        => 'text', 
                        'name'        => 'date_to',
                        'placeholder' => 'dd.mm. rrrr',
                        'default'     => $training->dateTo(),
                    ]){{ __('Datum do') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'text', 
                        'name'    => 'age',
                        'default' => $training->age,
                    ]){{ __('Věk') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'text', 
                        'name'    => 'difficulty',
                        'default' => $training->difficulty,
                    ]){{ __('Náročnost') }}
                    @endcomponent

                    <div class="form-group">
                        <label for="leader">{{ __('Vedoucí') }}</label>
                        <select class="form-control" id="leader" name="leader_id">
                            <option value="">-</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    @component('admin.input', [
                        'type'    => 'number', 
                        'name'    => 'capacity',
                        'min'     => 0,
                        'default' => $training->capacity,
                    ]){{ __('Kapacita') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'number', 
                        'name'    => 'price',
                        'min'     => 0,
                        'default' => $training->price,
                    ]){{ __('Cena') }}
                    @endcomponent

                    @component('admin.input', [
                        'type'    => 'checkbox', 
                        'name'    => 'hidden',
                        'checked' => $training->hidden,
                    ]){{ __('Skrytý') }}
                    @endcomponent
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Zavřít') }}</button>

                    <button type="submit" class="btn btn-primary">{{ __('Upravit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>