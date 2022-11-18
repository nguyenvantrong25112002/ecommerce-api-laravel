@if ($cateItemParent->children->count())
    @php
        $dash .= '-- ';
    @endphp
    @foreach ($cateItemParent->children as $cateItemChild)
        <option value="{{ $cateItemChild->id }}">
            {{ $dash }} {{ $cateItemChild->name }}
        </option>
        @if ($cateItemChild->children->count())
            @include('pages.category.include.Add_cateSelectChildrent', [
                'cateItemParent' => $cateItemChild,
            ])
        @endif
    @endforeach
@endif
