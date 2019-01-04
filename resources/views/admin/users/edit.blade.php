<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/admin/users/{{ $user->id }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Upravit uživatele')  }}</h5>

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
                        'default' => $user->name,
                    ]){{ __('Jméno') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'text', 
                        'name' => 'function',
                        'default' => $user->function,
                    ]){{ __('Funkce') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'number', 
                        'name' => 'payment',
                        'min' => 0,
                        'default' => $user->payment,
                    ]){{ __('Plat (Kč/h)') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'text', 
                        'name' => 'email',
                        'default' => $user->email,
                    ]){{ __('Email') }}
                    @endcomponent

                    @component('admin.input', [
                        'type' => 'text', 
                        'name' => 'phone',
                        'default' => $user->phone,
                    ]){{ __('Telefon') }}
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