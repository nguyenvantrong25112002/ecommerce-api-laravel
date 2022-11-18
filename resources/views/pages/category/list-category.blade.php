@extends('layouts.main')
@section('page-title', 'Quản lý danh mục')
@section('content')

    <x-breadcrumb :datas="[['active' => true, 'content' => 'Danh sách danh mục']]" />
    @component('components.list-data', ['route_add' => route('admin.category.add.form'), 'pagination' => $categoryParent])
        @slot('header')
            <tr>
                <th>Tên danh mục</th>
                <th>Số sản phẩm</th>
                <th>Thứ tự hiển thị</th>
                <th>Trạng thái</th>
                <th>Ngày thêm</th>
                <th>Ngày sửa</th>
                <th>Thao tác</th>
            </tr>
        @endslot
        @slot('body')
            @foreach ($categoryParent as $cateItemParent)
                @php
                    $dash = '';
                @endphp
                <tr>
                    <td>{{ $cateItemParent->name }} </td>
                    <td>{{ $cateItemParent->products_count }}</td>
                    <td>{{ $cateItemParent->order }} </td>
                    <td>
                        {{ $cateItemParent->status === config('util.ACTIVE_STATUS') ? 'Hiện' : 'Ẩn' }}
                    </td>
                    <td>{{ $cateItemParent->created_at }} </td>
                    <td>{{ $cateItemParent->updated_at }} </td>
                    <td>
                        @component('components.actions-list')
                            @slot('conten')
                                <a href=" {{ route('admin.category.delete', ['id' => $cateItemParent->id]) }} "class="btn btn-danger">
                                    <i class="bi bi-trash"></i>
                                    Xóa
                                </a>
                                <a href="{{ route('admin.category.edit.form', ['id' => $cateItemParent->id]) }} " class="btn btn-info">
                                    <i class="bi bi-pencil"></i>
                                    Sửa
                                </a>
                            @endslot
                        @endcomponent
                    </td>
                </tr>
                @include('pages.category.include.List_cateSelectChildrent', [
                    'cateItemParent' => $cateItemParent,
                ])
            @endforeach
        @endslot
    @endcomponent
@endsection
@section('page-script')
    <script></script>
@endsection
