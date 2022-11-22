@extends('layouts.main')
@section('page-title', 'Quản lý nhân sự')
@section('title', 'Danh sách nhân sự')
@section('content')
    <x-breadcrumb :datas="[['active' => true, 'content' => 'Danh sách nhân sự']]" />
    <div class="card mb-4 p-4">

        @auth()
            <div class="h4">
                <span class=" border-end pe-3 ">
                    {{ auth()->user()->name }}
                </span>
                <span class=" border-end ps-4 pe-3">
                    {{ auth()->user()->email }}
                </span>
                <span class="ps-4">
                    {{ auth()->user()->roles[0]->name }}
                </span>
            </div>
        @endauth
    </div>
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
                <tr id="user_id_{{ $data->id }}">
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
                        <div class="roles-group">
                            <select @disabled($data->id == auth()->user()->id) class="select_roles form-select form-select-sm"
                                data-user_id="{{ $data->id }}" data-control="select2" data-hide-search="true"
                                data-placeholder="">
                                @foreach ($roles as $role)
                                    <option
                                        @foreach ($data->roles as $roleUser)
                                        {{ $roleUser->name === $role->name ? 'selected' : '' }} @endforeach
                                        value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                                <option value="0">Hủy quyền</option>
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
        admin.selectRoles(
            '.roles-group',
            'select.select_roles',
            "{{ auth()->user()->id }}",
            "{{ route('admin.personnel.list.edit.role') }}"
        );
    </script>
@endsection
