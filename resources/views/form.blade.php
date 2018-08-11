<form action="/detail/{{ $training->id }}" method="POST">
    @csrf
    @method('POST')

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name">{{ __('Jmeno') }}</label>
        <input
            type="text"
            id="name"
            name="name"
            value="{{ old('name') }}"
            required
        >
        @if($errors->has('name'))
            <span class="help-block">{{ $errors->first('name') }}</span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="name">{{ __('email') }}</label>
        <input
            type="email"
            id="email"
            name="email"
            value="{{ old('email') }}"
            required
        >
        @if($errors->has('email'))
            <span class="help-block">{{ $errors->first('email') }}</span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
        <label for="name">{{ __('phone') }}</label>
        <input
            type="tel"
            id="phone"
            name="phone"
            value="{{ old('phone') }}"
            required
        >
        @if($errors->has('phone'))
            <span class="help-block">{{ $errors->first('phone') }}</span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
        <label for="name">{{ __('text') }}</label>
        <input
            type="text"
            id="text"
            name="text"
            value="{{ old('text') }}"
            required
        >
        @if($errors->has('text'))
            <span class="help-block">{{ $errors->first('text') }}</span>
        @endif
    </div>


    <div class="form-group{{ $errors->has('text') ? ' has-error' : '' }}">
        <label for="name">{{ __('gdpr') }}</label>
        <input
            type="checkbox"
            id="gdpr"
            name="gdpr"
            value="{{ old('gdpr') }}"
            required
        >
        @if($errors->has('gdpr'))
            <span class="help-block">{{ $errors->first('gdpr') }}</span>
        @endif
    </div>

    <button type="submit">submit</button>

</form>