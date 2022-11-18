@extends('layouts.main')
@section('page-title', 'Quản lý nhân sự')
@section('title', 'Danh sách nhân sự')
@section('content')
    <x-breadcrumb :datas="[['active' => true, 'content' => 'Danh sách nhân sự']]" />
    @component('components.list-data',
        ['route_add' => route('admin.personnel.add'), 'route_add_text' => 'Thêm người quản trị', 'pagination' => $datas])
        @slot('filter')
            <div class="row py-4">

                <div class="col-lg-2 ">
                    @component('components.filter.limit')
                    @endcomponent
                </div>
                <div class="col-lg-4 ">
                    @component('components.filter.search', ['lable' => 'Tìm kiếm (họ tên, email, số điện thoại)'])
                    @endcomponent
                </div>
            </div>
        @endslot
        @slot('header')
            <tr>
                <th>
                    Họ và tên
                </th>
                <th>
                    Email
                </th>
                <th>
                    Số điện thoại
                </th>
                <th>
                    Trạng thái
                </th>
                <th style="width:30%">
                    Quyền hạn
                </th>
            </tr>
        @endslot
        @slot('body')
            @foreach ($datas as $data)
                <tr>
                    <td>
                        {{ $data->name }}
                    </td>
                    <td>
                        {{ $data->email }}
                    </td>
                    <td>
                        {{ $data->phone_number }}
                    </td>
                    <td>
                        {{ $data->status }}
                    </td>
                    <td>
                        <div class="">
                            <select class="select_roles form-select form-select-sm" data-user_id="{{ $data->id }}"
                                data-control="select2" data-hide-search="true" data-placeholder="">
                                @foreach ($roles as $role)
                                    <option
                                        @foreach ($data->roles as $roleUser)
                                        {{ $roleUser->name === $role->name ? 'selected' : '' }} @endforeach
                                        value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent
@endsection
@section('page-script')
    <script src="{{ asset('js/system/list-data/list-data.js') }}"></script>
    <script src="{{ asset('js/system/admin/admin.js') }}"></script>
    <script>
        admin.selectRoles('select.select_roles');
    </script>
@endsection
