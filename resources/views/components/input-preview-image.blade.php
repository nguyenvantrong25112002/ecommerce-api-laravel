<div class="form-group mb-5 ">
    <label class=" @isset($required){{ $required ? 'required' : '' }}@endisset  form-label"
        for="">{{ $lable }}</label>

    <div class=" position-relative ">
        <input class=" opacity-0 position-absolute " value="{{ old($name, $value) }}" type="file"
            name="{{ $name }}" id="file-image" accept="image/gif, image/jpeg, image/png, image/webp,image/jfif">
        <div class=" ">

            <label style="cursor: pointer" for="file-image">
                @if (isset($value))
                    <img class=" w-100 z-index-n1" id="preview-image" src="{{ $value }} " />
                @else
                    <img class=" w-100 z-index-n1" id="preview-image"
                        src="{{ 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1665px-No-Image-Placeholder.svg.png' }} " />
                @endif
            </label>
        </div>
        @error($name)
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
