<div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
    <label for="x">{{ $slot }}</label>
    <input
        type="{{ $type }}"
        class="form-control"
        id="{{ $name }}"
        name="{{ $name }}"
        @isset($min) min="{{ $min }}" @endisset
        @isset($max) max="{{ $max }}" @endisset
        placeholder="{{ $placeholder ?? '' }}"
        value="{{ old($name, $default ?? '') }}"
    >
    @if($errors->has($name))
        <span class="help-block">{{ $errors->first($name) }}</span>
    @endif
</div>
