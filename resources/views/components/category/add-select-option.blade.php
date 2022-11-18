@if (count($cateItemParent->children) > 0)
    @php
        $dash .= '-- ';
    @endphp
    @foreach ($cateItemParent->children as $cateItemChild)
        <option @selected(old('parent_id') == $cateItemChild->id) value="{{ $cateItemChild->id }}">
            {{ $dash }} {{ $cateItemChild->name }}
        </option>
        @if (count($cateItemChild->children))
            @component('components.category.add-select-option',
                [
                    'cateItemParent' => $cateItemChild,
                    'dash' => $dash,
                ])
            @endcomponent
        @endif
    @endforeach
@endif
