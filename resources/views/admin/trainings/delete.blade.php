<div class="modal fade" id="deleteTrainingModal_{{ $training->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Opravdu smazat kroužek') }} {{ $training->day  }} {{ __('se všemi lidmi?') }}</h5>

                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-footer">
                <form action="/admin/trainings/{{ $training->id  }}" method="POST" class="d-inline-block mb-0">
                    @method('DELETE')
                    @csrf

                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">{{ __('Zavřít') }}</button>

                    <button type="submit" class="btn btn-danger">{{ __('Smazat') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>