@extends('layouts.main')
@section('page-title', 'Quản lý thuộc tính sản phẩm')
@section('title', 'Danh sách thuộc tính sản phẩm')
@section('content')



    @component('components.card-layout')
        @slot('conten')
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <div>
                            <button id="reset-page" type="button" class="btn btn-info btn-sm">
                                <i class="bi bi-arrow-clockwise"></i>
                                Tải lại trang
                            </button>
                        </div>
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.properties.list') }}" role="button">
                            <i class="bi bi-plus-lg"></i>
                            Thêm mới
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-lg-4">
                    {{-- thêm --}}
                    @if (!request()->has('type') || (request('type') == 'properties' && !request()->has('properties')))
                        <div>
                            <div class="mb-4">

                                <span class="h2 ">Thêm mới thuộc tính sản phẩm</span>
                            </div>
                            <form action="{{ route('admin.properties.add.save') }}" method="POST">
                                @csrf
                                @method('POST')
                                @component('components.input-form',
                                    [
                                        'lable' => 'Tên thuộc tính',
                                        'name' => 'name',
                                        'value' => null,
                                        'type' => 'text',
                                        'required' => true,
                                    ])
                                @endcomponent
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Lưu</button>
                            </form>
                        </div>
                    @endif
                    {{-- edit --}}
                    @if (request()->has('type') && request()->has('properties') && request('type') == 'properties')
                        <div>
                            <div class="mb-4">

                                <span class="h2 ">Chỉnh thuộc tính sản phẩm :</span><br>
                                <span class="h6 ">{{ $propertiesGetRquest->name }} </span>
                            </div>
                            <form action="{{ route('admin.properties.edit.save', ['id' => $propertiesGetRquest->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                @component('components.input-form',
                                    [
                                        'lable' => 'Tên thuộc tính',
                                        'name' => 'name',
                                        'value' => $propertiesGetRquest->name,
                                        'type' => 'text',
                                        'required' => true,
                                    ])
                                @endcomponent
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Lưu</button>
                            </form>
                        </div>
                    @endif

                    {{-- thêm  species --}}
                    @if (request()->has('type') && request('type') == 'species')
                        <div>
                            <div class="mb-4">
                                <span class="h2">Thêm mới giá trị thuộc tính sản phẩm</span>
                            </div>
                            <form
                                action="{{ route('admin.species.add.save', ['type' => request('type'), 'properties' => request('properties')]) }}"
                                method="POST">
                                @csrf
                                @method('POST')
                                @component('components.input-form',
                                    [
                                        'lable' => 'Thuộc tính',
                                        'value' => $propertiesGetRquest->name,
                                        'name' => 'name_properties',
                                        'type' => 'text',
                                        'required' => true,
                                        'attrs' => ['readonly="true"'],
                                    ])
                                @endcomponent
                                @component('components.input-form',
                                    [
                                        'lable' => 'Giá trị thuộc tính',
                                        'name' => 'name',
                                        'value' => null,
                                        'type' => 'text',
                                        'required' => true,
                                    ])
                                @endcomponent
                                <div class="mb-3">
                                    <label for="" class="form-label">Mô tả</label>
                                    <textarea class="form-control required" name="describe" id="" rows="3"></textarea>
                                    @error('describe')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm btn-block">Lưu</button>
                            </form>
                        </div>
                    @endif
                </div>
                <div class="col-lg-8">
                    <div class="table-responsive">
                        <table class=" table table-hover table-striped gy-5 gs-5">
                            <thead class="thead-primary">
                                <tr>
                                    <th scope="col">
                                        Tên thuộc tính
                                        @component('components.filter.sort-by', ['column' => 'name', 'typeIcon' => 'text'])
                                        @endcomponent
                                    </th>
                                    <th scope="col">Giá trị thuộc tính</th>
                                    <th style="width:10%">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($properties as $data)
                                    <tr id="properties_{{ $data->id }}">
                                        <td>{{ $data->name }}
                                        </td>
                                        <td>
                                            @if ($data->species->count())
                                                @foreach ($data->species as $species)
                                                    <div id="species_{{ $species->id }}"
                                                        class="  position-relative d-inline-block me-6 mb-6 ">
                                                        <button data-id="{{ $species->id }}" type="button" data-bs-toggle="modal"
                                                            data-bs-target="#kt_modal_1" class="btn btn-info editSpecies  ">
                                                            {{ $species->name }}
                                                        </button>
                                                        <span data-id="{{ $species->id }}"
                                                            class="deleteSpecies cursor-pointer position-absolute top-0 start-100 translate-middle badge rounded-pill bg-primary  fs-5  ">
                                                            x
                                                        </span>
                                                    </div>
                                                @endforeach
                                            @endif
                                            <a href="{{ route('admin.properties.list', ['type' => 'species', 'properties' => $data->slug]) }}"
                                                type="button" class="rounded-pill btn btn-primary ">
                                                <i class="bi bi-plus-lg"></i>
                                            </a>
                                        </td>
                                        <td>
                                            @component('components.actions-list')
                                                @slot('conten')
                                                    <a href="{{ route('admin.properties.list', ['type' => 'properties', 'properties' => $data->slug]) }}"
                                                        class="btn btn-rounded btn-primary mb-2 ml-2">
                                                        <i class="icofont-ui-edit"></i>
                                                        Sửa
                                                    </a>

                                                    <button data-id="{{ $data->id }}" type="button"
                                                        class="deleteProperties btn btn-rounded btn-danger  mb-2">
                                                        Xóa
                                                        <i class="icofont-bin"></i>
                                                    </button>
                                                @endslot
                                            @endcomponent
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        @endslot
    @endcomponent

    <div class="modal fade " tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog">
            <form id="form_species_edit" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Giá trị thuộc tính</h5>
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="bi bi-x-lg"></i>
                        </div>
                    </div>
                    <div class="modal-body">
                        <input hidden type="text" id="id_species">
                        @component('components.input-form',
                            [
                                'lable' => 'Giá trị thuộc tính',
                                'name' => 'name',
                                'value' => null,
                                'type' => 'text',
                                'required' => true,
                                'attrs' => ['id=name_species'],
                            ])
                        @endcomponent
                        <small class="text-danger name_error"></small>
                        <div class="mb-3">
                            <label for="" class="form-label">Mô tả</label>
                            <textarea class="form-control required" name="describe" id="describe_species" rows="3"></textarea>
                            <small class="text-danger describe_error"></small>
                            @error('describe')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Thoát</button>
                        <button type="submit" class="btn btn-primary btn-sm">
                            Lưu
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{ asset('js/system/list-data/list-data.js') }}"></script>
    <script src="{{ asset('js/system/properties/properties.js') }}"></script>
    <script>
        properties.deleteProperties('button.deleteProperties', '{{ route('admin.properties.delete') }}')
        properties.deleteSpecies('span.deleteSpecies', '{{ route('admin.species.delete') }}')
        properties.editSpecies('button.editSpecies', '{{ route('admin.species.show') }}',
            '{{ route('admin.species.update') }}');
    </script>
@endsection
