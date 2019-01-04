<div class="modal fade" id="deleteCityModal_{{ $city->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __("Opravdu smazat město {$city->name} se všemi kroužky a lidmi?") }}</h5>

                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-footer">
                <form action="/admin/cities/{{ $city->id  }}" method="POST" class="d-inline-block mb-0">
                    @method('DELETE')
                    @csrf

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Zavřít') }}</button>

                    <button class="btn btn-danger" type="submit">{{ __('Smazat') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
