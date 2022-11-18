@extends('layouts.main')
@section('page-title', 'Quản lý sản phẩm')
@section('title', 'Chi tiết sản phẩm')
@section('content')
    <x-breadcrumb :datas="[
        ['active' => false, 'content' => 'Danh sách sản phẩm', 'route' => route('admin.product.list')],
        ['active' => true, 'content' => 'Chi tiết sản phẩm'],
        [
            'active' => false,
            'content' => $product->name,
            'route' => route('admin.product.detail.index', ['id' => $product->id]),
        ],
    ]" />

    @component('components.card-layout')
        @slot('conten')
            <table class="table table-hover table-responsive-sm">
                <thead class="thead-primary">
                    <tr>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr colspan="2">
                        <td style="width: 20%">
                            <span class="h6">
                                Tổng số bình luận
                            </span>
                        </td>
                        {{-- <td>
                                <div>
                                    <h2>
                                        {{ $comment }}
                                    </h2>
                                    <a href="{{ route('admin.commentProduct.Product', $product->id) }}" class="btn btn-facebook mt-3">
                                        Xem
                                    </a>
                                </div>
                            </td> --}}
                    </tr>
                    <tr colspan="2">
                        <td style="width: 20%">
                            <span class="h6">
                                Tên sản phẩm
                            </span>
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <h3>
                                        {{ $product->name }}
                                    </h3>
                                </div>
                                @if ($properties->count())
                                    <div class="col-6">
                                        <div class=" d-flex justify-content-end align-items-end">
                                            <div class="me-5">
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalAddProperties">
                                                    Thuộc tính
                                                </button>
                                                <div class="modal fade" id="modalAddProperties" tabindex="-1" role="dialog"
                                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                                    <div class="modal-dialog " role="document">
                                                        <div class="modal-content">
                                                            <form id="add-properties" method="post">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalTitleId">Thêm thuộc tính cho
                                                                        sản
                                                                        phẩm
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container-fluid">
                                                                        @foreach ($properties as $propertie)
                                                                            <div class="form-check mt-3 py-1 ">
                                                                                <input @checked(collect($properties_id)->contains($propertie->id)) type="checkbox"
                                                                                    class="properties_checkbox form-check-input"
                                                                                    name="properties[]" id="{{ $propertie->id }}"
                                                                                    value="{{ $propertie->id }}">
                                                                                <label class="form-check-label"
                                                                                    for="{{ $propertie->id }}">{{ $propertie->name }}</label>
                                                                            </div>
                                                                        @endforeach
                                                                        <small class="text-danger properties_error"></small>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Thoát</button>
                                                                    <button id="submit-add-form-properties" type="submit"
                                                                        class="btn btn-primary">Lưu</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <!--  Modal trigger button  -->
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalSpecies">
                                                    Giá trị thuộc tính
                                                </button>

                                                <!-- Modal Body-->
                                                <div class="modal fade" id="modalSpecies" tabindex="-1" role="dialog"
                                                    aria-labelledby="modalTitleId" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <form id="add-species" method="post">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalTitleId">Giá trị thuộc tính
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container-fluid">
                                                                        <div id="conten-species">
                                                                            @foreach ($product->properties as $propertie)
                                                                                <div id="propertie_{{ $propertie->id }}">
                                                                                    <h5 class="">{{ $propertie->name }}</h5>
                                                                                    @foreach ($propertie->species as $species)
                                                                                        <div class="form-check mt-3 py-1 ">
                                                                                            <input @checked(collect($species_id)->contains($species->id))
                                                                                                type="checkbox"
                                                                                                class="form-check-input"
                                                                                                name="species[]"
                                                                                                id="{{ $species->id }}"
                                                                                                value="{{ $species->id }}">
                                                                                            <label class="form-check-label"
                                                                                                for="{{ $species->id }}">{{ $species->name }}</label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                                <hr>
                                                                            @endforeach
                                                                        </div>
                                                                        <small class="text-danger species_error"></small>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Thoát</button>
                                                                    @if ($product->properties->count())
                                                                        <button type="submit" class="btn btn-primary">Lưu</button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                    <tr colspan="2">
                        <td style="width: 20%">
                            <span class="h6">
                                Ảnh sản phẩm
                            </span>
                        </td>
                        <td>
                            <div class=" d-flex">
                                <div class="w-25">
                                    <img style="object-fit: cover" class="w-100 rounded"
                                        src="{{ $product->image ?? 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fvanhoadoanhnghiepvn.vn%2Fban-dan-nguyen-kien-nghi-giai-quyet-khieu-nai-doi-voi-chi-cuc-tha-dan-su-huyen-cu-chi%2F112815953-stock-vector-no-image-available-icon-flat-vector%2F&psig=AOvVaw35Gudh2A2RTdHGyHiGcYQh&ust=1667704831428000&source=images&cd=vfe&ved=0CA0QjRxqFwoTCJjl8uSKlvsCFQAAAAAdAAAAABAD' }}"
                                        alt="">
                                </div>
                                <div class="ms-3 w-75">
                                    <div id="gallerys" style="max-height:360px" class=" overflow-auto pt-5">

                                        @if ($product->gallerys->count())
                                            @foreach ($product->gallerys as $gallery)
                                                <div id="gallery_{{ $gallery->id }}" class=" symbol symbol-75px  me-5 mb-5">
                                                    <div class="symbol-label"
                                                        style="background-image:url({{ $gallery->image }})">
                                                    </div>
                                                    <button data-id="{{ $gallery->id }}"
                                                        class="remove-gallery symbol-badge badge badge-circle bg-danger start-100">
                                                        X
                                                    </button>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="mt-3">
                                        <!--begin::Form-->
                                        <form class="form" action="#" method="post">
                                            <!--begin::Input group-->
                                            <div class="form-group row">
                                                <!--begin::Label-->
                                                {{-- <label class="col-lg-2 col-form-label text-lg-right">Thêm ảnh phụ:</label> --}}
                                                <!--end::Label-->

                                                <!--begin::Col-->
                                                <div class="col-lg-10">
                                                    <!--begin::Dropzone-->
                                                    <div class="dropzone dropzone-queue mb-2" id="kt_dropzonejs_example_2">
                                                        <!--begin::Controls-->
                                                        <div class="dropzone-panel mb-lg-0 mb-2">
                                                            <a class="dropzone-select btn btn btn-primary rounded me-2">
                                                                <i class="bi bi-plus-lg"></i>
                                                            </a>
                                                            <a class="dropzone-upload btn btn-sm btn-light-primary me-2">
                                                                Thêm tất cả
                                                            </a>
                                                            <a class="dropzone-remove-all btn btn-sm btn-light-primary">

                                                                Xóa tất cả</a>
                                                        </div>
                                                        <!--end::Controls-->

                                                        <!--begin::Items-->
                                                        <div class="dropzone-items wm-200px">
                                                            <div class="dropzone-item" style="display:none">
                                                                <!--begin::File-->
                                                                <div class="dropzone-file">
                                                                    <div class="dropzone-filename"
                                                                        title="some_image_file_name.jpg">
                                                                        <span data-dz-name>some_image_file_name.jpg</span>
                                                                        <strong>(<span data-dz-size>340kb</span>)</strong>
                                                                    </div>
                                                                    <div class="dz-image">
                                                                        <img style="max-width: 70px;" data-dz-thumbnail />
                                                                    </div>

                                                                    <div class="dropzone-error" data-dz-errormessage></div>
                                                                </div>
                                                                <!--end::File-->

                                                                <!--begin::Progress-->
                                                                <div class="dropzone-progress">
                                                                    <div class="progress">
                                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                                            aria-valuemin="0" aria-valuemax="100"
                                                                            aria-valuenow="0" data-dz-uploadprogress>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--end::Progress-->

                                                                <!--begin::Toolbar-->
                                                                <div class="dropzone-toolbar">
                                                                    <span class="dropzone-start"><i
                                                                            class="bi bi-play-fill fs-3"></i></span>
                                                                    <span class="dropzone-cancel" data-dz-remove
                                                                        style="display: none;"><i class="bi bi-x fs-3"></i></span>
                                                                    <span class="dropzone-delete" data-dz-remove><i
                                                                            class="bi bi-x fs-1"></i></span>
                                                                </div>
                                                                <!--end::Toolbar-->
                                                            </div>
                                                        </div>
                                                        <!--end::Items-->
                                                    </div>
                                                    <!--end::Dropzone-->

                                                    <!--begin::Hint-->
                                                    <span class="form-text text-muted">Kích thước tệp tối đa là 1MB và số tệp
                                                        tối đa là 2.</span>
                                                    <!--end::Hint-->
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                </div>
                            </div>
                        </td>

                    </tr>
                    <tr colspan="2">
                        <td style="width: 20%">
                            <span class="h6">
                                Thuộc danh mục sản phẩm
                            </span>
                        </td>
                        <td>
                            {{-- @foreach ($category as $cate)
                                    if ($cate['id_category'] == $product['category_id']) {
                                    echo $cate['name_category'];
                                    }
                                @endforeach --}}
                        </td>
                    </tr>
                    <tr colspan="2">
                        <td style="width: 20%">
                            <span class="h6">
                                Giá gốc sản phẩm chưa áp dụng (%) sale off
                            </span>
                        </td>
                        <td>
                            <h4>
                                {{ number_format($product->price) }} (VND)
                            </h4>
                        </td>
                    </tr>
                    <tr colspan="2">
                        <td style="width: 20%">
                            <span class="h6">
                                - (%) sale off
                            </span>
                        </td>
                        <td>
                            <h6>

                                {{ $product->sale_off }} (%)
                            </h6>
                        </td>
                    </tr>
                    <tr colspan="2">
                        <td style="width: 20%">
                            <span class="h6">
                                Giá áp dụng (%) sale off
                            </span>
                        </td>
                        <td>
                            <h4>
                                {{ number_format($product->price_sale) }} (VND)
                            </h4>
                        </td>
                    </tr>
                    <tr colspan="2">
                        <td style="width: 20%">
                            <span class="h6">
                                Sản phẩm còn trong kho
                            </span>
                        </td>
                        <td>
                            {{ $product->quantity }}
                        </td>
                    </tr>
                    <tr colspan="2">
                        <td style="width: 20%">
                            <span class="h6">
                                Trạng thái
                            </span>
                        </td>
                        <td>
                            @if ($product->status == config('util.ACTIVE_STATUS'))
                                Hiện
                            @else
                                Ẩn
                            @endif
                        </td>
                    </tr>

                    <tr colspan="2">
                        <td style="width: 20%">
                            <span class="h6">
                                Ngày sửa
                            </span>
                        </td>
                        <td>
                            {{ $product->updated_at }}
                        </td>
                    </tr>
                    <tr colspan="2">
                        <td style="width: 20%">
                            <span class="h6">
                                Ngày thêm
                            </span>
                        </td>
                        <td>
                            {{ $product->created_at }}
                        </td>
                    </tr>
                    <tr colspan="2">
                        <td style="width: 20%">
                            <span class="h6">
                                Mô tả
                            </span>
                        </td>
                        <td>
                            {!! $product->description !!}
                        </td>
                    </tr>
                    <tr colspan="2">
                        <td style="width: 20%">
                            <span class="h6">
                                Chi tiết
                            </span>
                        </td>
                        <td>
                            {!! $product->details !!}
                        </td>
                    </tr>

                </tbody>
            </table>
        @endslot
    @endcomponent
@endsection
@section('page-script')


    <script>
        var _token = "{{ csrf_token() }}";
        var product_id = "{{ $product->id }}";
        var url_list_gallery = "{{ route('admin.product.detail.list.gallery', ['id' => $product->id]) }}";
        var url_add_gallery = "{{ route('admin.product.detail.add.gallery', ['id' => $product->id]) }}";
        var url_remove_gallery = "{{ route('admin.product.detail.remove.gallery', ['id' => $product->id]) }}";
        var url_add_properties = "{{ route('admin.product.detail.add.properties', ['id' => $product->id]) }}";
        var url_add_species = "{{ route('admin.product.detail.add.species', ['id' => $product->id]) }}";
        var url_list_species = "{{ route('admin.product.detail.list.species', ['id' => $product->id]) }}";
    </script>
    <script src="{{ asset('js/system/product/detail-product.js') }}"></script>
    <script>
        var properties_id = @json($properties_id ?? []);
        product.addGallery(url_add_gallery, url_list_gallery);
        product.removeGallery('button.remove-gallery', url_remove_gallery);
        product.addProperties(
            'form#add-properties',
            url_add_properties,
            'form#add-species',
            url_list_species,
            properties_id
        )
        product.addSpecies('form#add-species', url_add_species)
    </script>
@endsection
