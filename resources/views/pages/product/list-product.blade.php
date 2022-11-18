@extends('layouts.main')
@section('page-title', 'Quản lý sản phẩm')
@section('title', 'Danh sách sản phẩm')
@section('content')

    <x-breadcrumb :datas="[['active' => true, 'content' => 'Danh sách sản phẩm']]" />
    @component('components.list-data', ['route_add' => route('admin.product.add.form'), 'pagination' => $products])

        @slot('filter')
            <div class="row">

                <div class="col-lg-2 ">
                    @component('components.filter.limit')
                    @endcomponent
                </div>
                <div class="col-lg-2 ">
                    @component('components.filter.search', ['lable' => 'Tìm kiếm (tên sản phẩm)'])
                    @endcomponent
                </div>
            </div>
        @endslot
        @slot('header')
            <tr>
                <th style="width:15%" scope="col">
                    Tên
                    @component('components.filter.sort-by', ['column' => 'name', 'typeIcon' => 'text'])
                    @endcomponent
                </th>
                <th scope="col">Giá gốc (VND)
                    @component('components.filter.sort-by', ['column' => 'price', 'typeIcon' => 'number'])
                    @endcomponent
                </th>
                <th scope="col">Giá sale off (VND)

                    @component('components.filter.sort-by', ['column' => 'price_sale', 'typeIcon' => 'number'])
                    @endcomponent
                </th>
                <th scope="col">Trạng thái</th>
                <th scope="col">
                    Ngày cập nhập
                    @component('components.filter.sort-by', ['column' => 'updated_at', 'typeIcon' => 'other'])
                    @endcomponent
                </th>
                <th>Thao tác</th>
            </tr>
        @endslot
        @slot('body')
            @foreach ($products as $key => $data)
                <tr>
                    <td>
                        <a href="{{ route('admin.product.detail.index', ['id' => $data->id]) }}">
                            {{ $data->name }}
                        </a>
                    </td>
                    <td style=" text-decoration: line-through;">
                        {{ number_format($data->price, 0, ',', '.') }}đ
                    </td>
                    <td>
                        {{ number_format($data->price_sale, 0, ',', '.') }}đ
                    </td>
                    <td>
                        @if ($data->status_product == 0)
                            <button data-text_namePro="{{ $data->name_product }}" data-status="{{ $data->status_product }}"
                                data-id_pro="{{ $data->id_product }}" type="button"
                                class="status_product btn btn-rounded btn-primary">
                                <i class="icofont-eye"></i>
                                Hiện
                            </button>
                        @else
                            <button data-text_namePro="{{ $data->name_product }}" data-status="{{ $data->status_product }}"
                                data-id_pro="{{ $data->id_product }}" type="button"
                                class="status_product btn btn-rounded btn-outline-danger">
                                <i class="icofont-eye-blocked"></i>
                                Ẩn
                            </button>
                        @endif
                    </td>

                    <td>

                        {{ $data->updated_at }}
                    </td>
                    <td>
                        @component('components.actions-list')
                            @slot('conten')
                                <a href="{{ route('admin.product.edit.form', ['id' => $data->id]) }}"
                                    class="btn btn-rounded btn-primary mb-2 ml-2">
                                    <i class="icofont-ui-edit"></i>
                                    Sửa
                                </a>

                                <button type="button" data-img_pro="{{ $data->img }}" data-text_namePro="{{ $data->name }}"
                                    data-id_pro="{{ $data->id }}" class="deleteProduct btn btn-rounded btn-danger  mb-2">
                                    Xóa
                                    <i class="icofont-bin"></i>
                                </button>


                                <button type="button" class="add_attr btn btn-primary ml-2" data-toggle="modal" data-target="#exampleModal"
                                    data-id_pro="{{ $data->id }}" data-text_namePro="{{ $data->name }}">
                                    <i class="icofont-options"></i>
                                    Thuộc tính
                                </button>
                            @endslot
                        @endcomponent
                    </td>

                </tr>
            @endforeach
        @endslot
    @endcomponent




@endsection
@section('page-script')
    <script src="{{ asset('js/system/list-data/list-data.js') }}"></script>
@endsection
