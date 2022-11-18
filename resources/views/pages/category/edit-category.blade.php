@extends('layouts.main')
@section('page-title', 'Quản lý danh mục')
@section('content')
    <x-breadcrumb :datas="[
        ['active' => false, 'content' => 'Danh sách danh mục', 'route' => route('admin.category.list')],
        ['active' => true, 'content' => 'Sửa danh mục'],
    ]" />
    @component('components.card-layout')
        @slot('conten')
            <form id="category_form" action="{{ route('admin.category.edit.save', $category->id) }}" method="POST">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-6">

                        @component('components.input-form',
                            [
                                'lable' => 'Tên danh mục',
                                'value' => $category->name,
                                'name' => 'name',
                                'type' => 'text',
                            ])
                        @endcomponent

                        @component('components.input-form',
                            [
                                'lable' => 'Slug danh mục',
                                'value' => $category->slug,
                                'name' => 'slug',
                                'type' => 'text',
                                'attrs' => ['readonly="true"'],
                            ])
                        @endcomponent

                        @component('components.input-form',
                            [
                                'lable' => 'Thứ tự danh mục (lớn đến bé)',
                                'value' => $category->order,
                                'name' => 'order',
                                'type' => 'number',
                            ])
                        @endcomponent

                        <x-button-form route_back="{{ route('admin.category.list') }} "></x-button-form>

                    </div>
                    <div class="col-6">
                        <div class="form-group mb-5">
                            <label>Thuộc danh mục</label>
                            <select name="parent_id" class="form-select " data-control="select2" data-hide-search="true"
                                data-placeholder="Chọn danh mục">
                                <option @selected($category->parent_id == null) value="">
                                    Không thuộc danh mục
                                </option>
                                @foreach ($categoryParent as $cateItemParent)
                                    @php
                                        $dash = '';
                                    @endphp
                                    <option @disabled($category->id == $cateItemParent->id) @selected(old('parent_id') == $cateItemParent->id || $category->parent_id == $cateItemParent->id)
                                        value="{{ $cateItemParent->id }}">
                                        {{ $cateItemParent->name }}
                                    </option>
                                    @include('pages.category.include.Edit_cateSelectChildrent', [
                                        'cateItemParent' => $cateItemParent,
                                    ])
                                @endforeach
                            </select>
                            <x-text-error key="parent_id"></x-text-error>
                        </div>
                        <x-select-status :data="$category->status"></x-select-status>
                    </div>
                </div>
            </form>
        @endslot
    @endcomponent
@endsection
@section('page-script')
    <script src="{{ asset('js/system/category/index.js') }}"></script>
    <script>
        main.slug("input[name='name']", "input[name='slug']");
        main.resetForm();
    </script>
@endsection
