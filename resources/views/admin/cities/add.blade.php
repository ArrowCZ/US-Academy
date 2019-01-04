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

                    @component('admin.input', [
                        'type'     => 'text', 
                        'name'     => 'name',
                        'required' => true,
                    ]){{ __('Název') }}
                    @endcomponent

                    <div class="row">
                        <div class="col">
                            @component('admin.input', [
                                'type' => 'number', 
                                'name' => 'x', 
                                'min'  => 0, 
                                'max'  => 100,
                                'required' => true,
                            ]){{ __('X') }}
                            @endcomponent
                        </div>

                        <div class="col">
                            @component('admin.input', [
                                'type' => 'number', 
                                'name' => 'y',
                                'min'  => 0, 
                                'max ' => 100,
                                'required' => true,
                            ]){{ __('Y') }}
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
