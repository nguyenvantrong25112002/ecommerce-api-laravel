@if (count($cateItemParent->children))
    @php
        $dash .= '-- ';
    @endphp
    @foreach ($cateItemParent->children as $cateItemChild)
        <tr>

            <td>{{ $dash . $cateItemChild->name }} </td>
            <td>{{ $cateItemChild->products_count }}</td>
            <td>{{ $cateItemChild->order }} </td>
            <td> {{ $cateItemChild->status === config('util.ACTIVE_STATUS') ? 'Hiện' : 'Ẩn' }} </td>
            <td>{{ $cateItemChild->created_at }} </td>
            <td>{{ $cateItemChild->updated_at }} </td>
            <td>
                @component('components.actions-list')
                    @slot('conten')
                        <a href=" {{ route('admin.category.delete', ['id' => $cateItemChild->id]) }} "class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                            Xóa
                        </a>
                        <a href="{{ route('admin.category.edit.form', ['id' => $cateItemChild->id]) }} " class="btn btn-info">
                            <i class="bi bi-pencil"></i>
                            Sửa
                        </a>
                    @endslot
                @endcomponent
            </td>
        </tr>
        @if (count($cateItemChild->children))
            @include('pages.category.include.List_cateSelectChildrent', [
                'cateItemParent' => $cateItemChild,
            ])
        @endif
    @endforeach
@endif
