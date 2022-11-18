@if (count($cateItemParent->children))
    @php
        $dash .= '-- ';
    @endphp

    @foreach ($cateItemParent->children as $cateItemChild)
        <option @disabled($category->id == $cateItemChild->id) @selected($category->parent_id == $cateItemChild->id) @selected(old('parent_id') == $cateItemChild->id)
            value="{{ $cateItemChild->id }}">
            {{ $dash }} {{ $cateItemChild->name }}
        </option>
        @if (count($cateItemChild->children))
            @include('pages.category.include.Edit_cateSelectChildrent', [
                'cateItemParent' => $cateItemChild,
            ])
        @endif
    @endforeach
@endif
