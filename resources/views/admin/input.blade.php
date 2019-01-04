@switch($type)
    @case('text')
    @case('number')
        <div class="form-group{{ $errors->has($name) ? ' has-error' : '' }}">
            <label for="{{ $name }}">{{ $slot }}</label>
            <input
                type="{{ $type }}"
                class="form-control"
                id="{{ $name }}"
                name="{{ $name }}"
                value="{{ old($name, $default ?? '') }}"
                @if(!empty($placeholder)) placeholder="{{ $placeholder }}"@endif
                @isset($min) min="{{ $min }}" @endisset
                @isset($max) max="{{ $max }}" @endisset
                @if(!empty($required)) required @endif
            >
            @if($errors->has($name))
                <span class="help-block">{{ $errors->first($name) }}</span>
            @endif
        </div>
    @break

    @case('checkbox')
    
     <div class="form-check form-check-inline">
        <label class="form-check-label" style="margin: 5px 0">
            <input 
                name="{{ $name }}" 
                class="form-check-input" 
                type="checkbox"
                value="{{ $value ?? true }}"
                @if(!empty($checked)) checked @endif
                @if(!empty($required)) required @endif
            >
            {{ $slot }}
        </label>
    </div>
    
    @break
    
    @case('file')

        <div class="form-group">
            <label for="{{ $name }}">{{ $slot }}</label>
            <input type="file" name="{{ $name }}" class="form-control-file" id="{{ $name }}">
        </div>

    @break
@endswitch


