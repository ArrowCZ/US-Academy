<div class="modal fade" id="sendMailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="/admin/trainings/{{ $training->id }}/mail" method="POST">
                @method('POST')
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Poslat hromadný email')  }}</h5>

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

                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#mail_text">{{ __('Zpráva') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab"
                                href="#mail_recipients">{{ __('Příjemci') }}</a>
                        </li>
                    </ul>

                    <br>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="mail_text">
                            <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                <label for="subject">{{ __('Předmet mailu') }}</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="subject"
                                    name="subject"
                                    value="{{ old('subject') }}"
                                >
                                @if($errors->has('subject'))
                                    <span class="help-block">{{ $errors->first('subject') }}</span>
                                @endif
                            </div>

                            <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
                                <label for="text">{{ __('Text') }}</label>
                                <textarea
                                    type="text"
                                    class="form-control"
                                    id="text"
                                    name="text"
                                    rows="10"
                                >{{ old('text') }}</textarea>
                                @if($errors->has('text'))
                                    <span class="help-block">{{ $errors->first('text') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane fade" id="mail_recipients">
                            <button type="button" data-state="3" class="btn btn-info">{{ __('Vybrat náhradníky') }}</button>
                            <button type="button" data-state="0" class="btn btn-warning">{{ __('Vybrat nové') }}</button>
                            <button type="button" data-state="1" class="btn btn-success">{{ __('Vybrat zaplacené') }}</button>
                            <button type="button" data-state="2" class="btn btn-danger">{{ __('Vybrat zrušené') }}</button>

                            <br>
                            <br>

                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">{{ __('Jméno') }}</th>
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col">{{ __('Telefon') }}</th>
                                    <th scope="col">{{ __('Stav') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($training->orders as $order)
                                    <tr class="{{ $order->tableColor() }}">
                                        <td>
                                            <div class="form-check form-check-inline">
                                                <label class="form-check-label">
                                                    <input data-state="{{ $order->state }}" name="orders[]" class="form-check-input" type="checkbox" value="{{ $order->id }}">
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->phone }}</td>
                                        <td>{{ $order->_state() }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Zavřít') }}</button>

                    <button type="submit" class="btn btn-primary">{{ __('Poslat') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>