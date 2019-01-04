<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/users" method="POST">
                @csrf
        
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Přidat uživatele')  }}</h5>

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
                        'name' => 'email',
                    ]){{ __('Přihlašovací jméno') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'text', 
                        'name' => 'password',
                    ]){{ __('Heslo') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'text', 
                        'name' => 'name',
                    ]){{ __('Jméno') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'text', 
                        'name' => 'function',
                    ]){{ __('Funkce') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'number', 
                        'name' => 'payment',
                        'min' => 0,
                    ]){{ __('Plat (Kč/h)') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'text', 
                        'name' => 'email',
                    ]){{ __('Email') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'text', 
                        'name' => 'phone',
                    ]){{ __('Telefon') }}
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