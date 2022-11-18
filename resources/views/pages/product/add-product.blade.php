@extends('layouts.main')
@section('page-title', 'Quản lý sản phẩm')
@section('title', 'Thêm mới sản phẩm')
@section('content')
    <x-breadcrumb :datas="[
        ['active' => false, 'content' => 'Danh sách sản phẩm', 'route' => route('admin.product.list')],
        ['active' => true, 'content' => 'Thêm mới sản phẩm'],
    ]" />
    @component('components.card-layout')
        @slot('conten')
            <form id="add_product" action="{{ route('admin.product.add.save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('post')
                <div class="row">
                    <div class="col-9">
                        @component('components.input-form',
                            [
                                'lable' => 'Tên sản phẩm',
                                'value' => '',
                                'name' => 'name',
                                'type' => 'text',
                                'required' => true,
                            ])
                        @endcomponent

                        @component('components.input-form',
                            [
                                'lable' => 'Slug',
                                'value' => '',
                                'name' => 'slug',
                                'type' => 'text',
                                'required' => true,
                                'attrs' => ['readonly="true"'],
                            ])
                        @endcomponent

                        <div class="form-group mb-5">
                            <label for="">Mô tả ngắn</label>
                            <textarea class="form-control " name="description" id="kt_docs_ckeditor_classic" rows="2"></textarea>
                        </div>
                        <div class="form-group mb-5">
                            <label for="">Chi tiết</label>
                            <textarea class="form-control " name="details" id="kt_docs_ckeditor_classic_2" rows="7"></textarea>
                        </div>


                        {{-- <div class=" border-top border-bottom  border-light py-5 my-3">

                            <div id="kt_docs_repeater_basic">
                                <!--begin::Form group-->
                                <div class="form-group">
                                    <div class=" d-flex justify-content-start align-items-baseline">
                                        <label class="form-label ">Ảnh phụ sản phẩm</label>
                                        <div class="form-group ms-5 mt-5">
                                            <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
                                                <i class="la la-plus"></i>Thêm
                                            </a>
                                        </div>
                                    </div>
                                    <div data-repeater-list="gallerys">
                                        @for ($i = 0; $i < 1; $i++)
                                            <div data-repeater-item>
                                                <div class="form-group row mt-4">
                                                    <div class="col-md-4">
                                                        <label class="form-label">Ảnh:</label>
                                                        <input type="file" name="image"
                                                            class="form-control form-control-sm mb-2 mb-md-0" />
                                                        @if ($errors->has("gallerys.$i.image"))
                                                            <p class="text-danger">
                                                                {{ $errors->first("gallerys.$i.image") }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="form-label">Thứ tự hiển thị:</label>
                                                        <input type="number" name="order"
                                                            class="form-control form-control-sm mb-2 mb-md-0"
                                                            placeholder="Enter contact number" />
                                                        @if ($errors->has("gallerys.$i.order"))
                                                            <p class="text-danger">
                                                                {{ $errors->first("gallerys.$i.order") }}
                                                            </p>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-4">
                                                        <a href="javascript:;" data-repeater-delete
                                                            class="btn btn-sm btn-light-danger mt-3 mt-md-6">
                                                            <i class="la la-trash-o"></i>Xóa
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                                <!--end::Form group-->

                                <!--begin::Form group-->

                                <!--end::Form group-->
                            </div>
                            <!--end::Repeater-->
                        </div> --}}

                        <div class="row mb-5">
                            <div class="col-3">
                                <x-select-status></x-select-status>
                            </div>
                            <div class="col-3">
                                @component('components.input-form',
                                    [
                                        'lable' => 'Số lượng',
                                        'value' => '',
                                        'name' => 'quantity',
                                        'type' => 'number',
                                        'required' => true,
                                    ])
                                @endcomponent
                            </div>
                        </div>
                        <x-button-form route_back="{{ route('admin.product.list') }} "></x-button-form>

                    </div>
                    <div class="col-3">
                        <x-button-form route_back="{{ route('admin.product.list') }} "></x-button-form>
                        <div class="form-group mb-5 mt-4 ">
                            <label class="required" for="">Thuộc danh mục</label>
                            <div class="overflow-auto h-250px">
                                @foreach ($categoryParent as $cateItemParent)
                                    @php
                                        $dash = '';
                                    @endphp
                                    <div class="form-check mt-3 py-1 ">
                                        <input data-parent="{{ $cateItemParent->parent_id ?? 'null' }}" @checked(collect(old('category_id'))->contains($cateItemParent->id))
                                            type="checkbox" class="form-check-input" name="category_id[]"
                                            id="{{ $cateItemParent->id }}" value="{{ $cateItemParent->id }}">
                                        <label class="form-check-label"
                                            for="{{ $cateItemParent->id }}">{{ $cateItemParent->name }}</label>
                                    </div>
                                    @include('pages.product.include.Add_cateSelectChildrent', [
                                        'cateItemParent' => $cateItemParent,
                                    ])
                                    <hr>
                                @endforeach
                            </div>

                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        @component('components.input-preview-image',
                            ['lable' => 'Ảnh sản phẩm', 'name' => 'image', 'required' => true, 'value' => null])
                        @endcomponent

                        @component('components.input-form',
                            [
                                'lable' => 'Giá gốc sản phẩm',
                                'value' => '',
                                'name' => 'price',
                                'type' => 'number',
                                'required' => true,
                            ])
                        @endcomponent

                        @component('components.input-form',
                            [
                                'lable' => 'Giảm theo (%)',
                                'value' => '',
                                'name' => 'sale_off',
                                'type' => 'number',
                                'required' => true,
                            ])
                        @endcomponent

                        @component('components.input-form',
                            [
                                'lable' => 'Sản phẩm sẽ được giảm (so với giá gốc)',
                                'value' => '',
                                'name' => 'end_price_sale',
                                'type' => 'number',
                                'required' => true,
                                'attrs' => ['readonly="true"'],
                            ])
                        @endcomponent

                        @component('components.input-form',
                            [
                                'lable' => 'Giá cuối cùng',
                                'value' => '',
                                'name' => 'price_sale',
                                'type' => 'number',
                                'required' => true,
                                'attrs' => ['readonly="true"'],
                            ])
                        @endcomponent

                    </div>
                </div>
            </form>
        @endslot
    @endcomponent
@endsection

@section('page-script')
    <script src="assets/plugins/custom/formrepeater/formrepeater.bundle.js"></script>
    <script src="{{ asset('js/system/product/form-product.js') }}"></script>
    <script src="{{ asset('js/system/formrepeater/basic.js') }}"></script>

    {{-- <script src="assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js"></script>
    <script src="https://ckeditor.com/apps/ckfinder/3.5.0/ckfinder.js"></script>
    <script src="{{ asset('js/system/ckeditor/ckeditor.js') }}"></script> --}}

    <script>
        // pageCkeditor.classicCk_2();

        main.slug("input[name='name']", "input[name='slug']");
        main.resetForm();
        main.previewImage("input[name='image']", '#preview-image');

        product.saleOFFPRICE(
            "input[name='price']",
            "input[name='sale_off']",
            "input[name='price_sale']",
            "input[name='end_price_sale']"
        );
    </script>
@endsection
