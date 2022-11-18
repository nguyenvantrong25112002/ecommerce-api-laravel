<div class="form-group mb-5">
    <label class=" @isset($required){{ $required ? 'required' : '' }}@endisset  form-label"
        for="">{{ $lable }}</label>
    <input
        @isset($attrs)
                @foreach ($attrs as $attr)
                    {{ $attr }}
                @endforeach
            @endisset
        @if (!empty($value)) value="{{ old($name, $value) }}" @endif name="{{ $name ?? '' }}"
        type="{{ $type }}" class="form-control">
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
