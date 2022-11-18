@extends('layouts.main')
@section('page-title', 'Quản lý danh mục')
@section('content')

    <x-breadcrumb :datas="[
        ['active' => false, 'content' => 'Danh sách danh mục', 'route' => route('admin.category.list')],
        ['active' => true, 'content' => 'Thêm mới danh mục'],
    ]" />

    @component('components.card-layout')
        @slot('conten')
            <form id="add_category" action="{{ route('admin.category.add.save') }}" method="POST">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col-6">

                        @component('components.input-form',
                            [
                                'lable' => 'Tên danh mục',
                                'value' => '',
                                'name' => 'name',
                                'type' => 'text',
                                'required' => true,
                            ])
                        @endcomponent

                        @component('components.input-form',
                            [
                                'lable' => 'Slug danh mục',
                                'value' => '',
                                'name' => 'slug',
                                'type' => 'text',
                                'attrs' => ['readonly="true"'],
                                'required' => true,
                            ])
                        @endcomponent

                        @component('components.input-form',
                            [
                                'lable' => 'Thứ tự danh mục (lớn đến bé)',
                                'value' => '',
                                'name' => 'order',
                                'type' => 'number',
                            ])
                        @endcomponent

                        <x-button-form route_back="{{ route('admin.category.list') }} "></x-button-form>
                    </div>
                    <div class="col-6">
                        <div class="mb-5">
                            <label>Thuộc danh mục</label>
                            <select name="parent_id" class="form-select " data-control="select2" data-hide-search="true"
                                data-placeholder="Chọn danh mục">
                                <option value="">Không thuộc danh mục</option>
                                @foreach ($categoryParent as $cateItemParent)
                                    @php
                                        $dash = '';
                                    @endphp
                                    <option @selected(old('parent_id') == $cateItemParent->id) value="{{ $cateItemParent->id }}">
                                        {{ $cateItemParent->name }}
                                    </option>
                                    @include('pages.category.include.Add_cateSelectChildrent', [
                                        'cateItemParent' => $cateItemParent,
                                    ])
                                @endforeach
                            </select>
                        </div>
                        <x-select-status></x-select-status>
                    </div>
                </div>
            </form>
        @endslot
    @endcomponent


@endsection
@section('page-script')
    <script>
        main.slug("input[name='name']", "input[name='slug']");
        main.resetForm();
    </script>
@endsection
