<div class="modal fade" id="editCityModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/cities/{{ $city->id }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Upravit město')  }}</h5>

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
                        'type' => 'text', 
                        'name' => 'name', 
                        'default' => $city->name
                    ]){{ __('Název') }}
                    @endcomponent

                    <div class="row">
                        <div class="col">
                            @component('admin.input', [
                                'type' => 'number', 
                                'name' => 'x', 
                                'default' => $city->x, 
                                'min' => 0, 
                                'max' => 100,
                            ]){{ __('X') }}
                            @endcomponent
                        </div>

                        <div class="col">
                            @component('admin.input', [
                                'type' => 'number', 
                                'name' => 'y', 
                                'default' => $city->y, 
                                'min' => 0, 
                                'max' => 100,
                            ]){{ __('Y') }}
                            @endcomponent
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Zavřít') }}</button>

                    <button type="submit" class="btn btn-primary">{{ __('Upravit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
