<div class=" d-inline ms-2">
    <span data-key="sort-by" data-key-column="{{ $column }}"
        data-key-sort="{{ request()->has('sort') ? (request('sort') == 'desc' ? 'asc' : 'desc') : 'asc' }}"
        class="sort-by cursor-pointer p-3">
        @if ($typeIcon == 'text')
            @if (request()->has('sort'))
                @if (request('sort') == 'asc')
                    <i class="bi bi-sort-alpha-down-alt"></i>
                @else
                    <i class="bi bi-sort-alpha-down"></i>
                @endif
            @else
                <i class="bi bi-sort-alpha-down"></i>
            @endif
        @elseif ($typeIcon == 'number')
            @if (request()->has('sort'))
                @if (request('sort') == 'asc')
                    <i class="bi bi-sort-numeric-down-alt"></i>
                @else
                    <i class="bi bi-sort-numeric-down"></i>
                @endif
            @else
                <i class="bi bi-sort-numeric-down"></i>
            @endif
        @elseif ($typeIcon == 'other')
            <i class="bi bi-sort-down-alt"></i>
        @endif
    </span>
</div>
