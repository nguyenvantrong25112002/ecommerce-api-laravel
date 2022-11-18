@if ($cateItemParent->children->count())
    @php
        $dash .= '-- ';
    @endphp
    @foreach ($cateItemParent->children as $cateItemChild)
        <div class="form-check  py-1">
            <input data-parent="{{ $cateItemChild->parent_id }}" @checked(collect(old('category_id'))->contains($cateItemParent->id)) type="checkbox"
                name="category_id[]" class="form-check-input" id="{{ $cateItemChild->id }}"
                value="{{ $cateItemChild->id }}">
            <label class="form-check-label" for="{{ $cateItemChild->id }}">
                {{ $dash }}
                {{ $cateItemChild->name }}</label>
        </div>

        @if ($cateItemChild->children->count())
            @include('pages.product.include.Add_cateSelectChildrent', ['cateItemParent' => $cateItemChild])
        @endif
    @endforeach
@endif
