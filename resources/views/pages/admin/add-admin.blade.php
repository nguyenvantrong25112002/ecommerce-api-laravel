@extends('layouts.main')
@section('page-title', 'Quản lý nhân sự')
@section('title', 'Thêm mới nhân sự')
@section('content')

    <x-breadcrumb :datas="[
        ['active' => false, 'content' => 'Danh sách nhân sự', 'route' => route('admin.personnel.list')],
        ['active' => true, 'content' => 'Thêm mới nhân sự'],
    ]" />

    @component('components.card-layout')
        @slot('conten')
            <form action="{{ route('admin.personnel.add.role.admin.save') }}" method="post">
                @csrf
                @method('post')
               
                <div class="row">
                    <div class="col-lg-12">

                        <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                            <li class="nav-item">
                                <a @class([
                                    'nav-link',
                                    'active' => (old('user') == 'new'
                                            ? true
                                            : empty(old('user')))
                                        ? true
                                        : false,
                                ]) data-bs-toggle="tab" href="#kt_tab_pane_1">Nhân
                                    viên chưa từng tham gia hệ
                                    thống</a>
                            </li>
                            <li class="nav-item">
                                <a @class(['nav-link', 'active' => old('user') == 'old' ? true : false]) data-bs-toggle="tab" href="#kt_tab_pane_2">Nhân viên đã tham gia hệ
                                    thống</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <input type="text" hidden name="user" id="" value="{{ old('user') }}">
                            <div @class([
                                'tab-pane',
                                'fade',
                                'show' => (old('user') == 'new' ? true : empty(old('user'))) ? true : false,
                                'active' => (old('user') == 'new'
                                        ? true
                                        : empty(old('user')))
                                    ? true
                                    : false,
                            ]) id="kt_tab_pane_1" role="tabpanel">
                                <div class="row mt-5">
                                    <div class="col-lg-6">
                                        @component('components.input-form',
                                            [
                                                'lable' => 'Họ và tên',
                                                'value' => '',
                                                'name' => 'name',
                                                'type' => 'text',
                                                'required' => true,
                                            ])
                                        @endcomponent
                                        @component('components.input-form',
                                            [
                                                'lable' => 'Email',
                                                'value' => '',
                                                'name' => 'email',
                                                'type' => 'email',
                                                'required' => true,
                                            ])
                                        @endcomponent

                                    </div>
                                    <div class="col-lg-6">
                                        @component('components.input-form',
                                            [
                                                'lable' => 'Số điện thoại',
                                                'value' => '',
                                                'name' => 'phone_number',
                                                'type' => 'number',
                                            ])
                                        @endcomponent

                                        @component('components.input-form',
                                            [
                                                'lable' => 'Ngày sinh',
                                                'value' => '',
                                                'name' => 'birthday',
                                                'type' => 'date',
                                            ])
                                        @endcomponent
                                    </div>
                                </div>
                            </div>
                            <div @class([
                                'tab-pane',
                                'fade',
                                'show' => old('user') == 'old' ? true : false,
                                'active' => old('user') == 'old' ? true : false,
                            ]) id="kt_tab_pane_2" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="information">
                                            @component('components.input-form',
                                                [
                                                    'lable' => 'Nhập (email / số điện thoại)',
                                                    'value' => '',
                                                    'name' => 'information',
                                                    'type' => 'text',
                                                    // 'attrs' => ['id=information'],
                                                    'required' => true,
                                                ])
                                            @endcomponent
                                            <small class="text-danger"></small>
                                        </div>

                                        <div class="modal fade" id="modalInformation" tabindex="-1" role="dialog"
                                            aria-labelledby="modalTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalTitleId">Modal title</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <div id='userInformation'>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="my-5">
                            <label class="form-label me-5" for="">Chọn quyền cho nhân viên :</label>
                            @foreach ($roles as $role)
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label" for="{{ $role->name }}">
                                        <input @checked($role->name == config('util.ROLE_SUPER_ADMIN')) class="form-check-input" type="radio" name="role"
                                            id="{{ $role->name }}" value=" {{ $role->name }}">
                                        {{ $role->name }}
                                    </label>
                                </div>
                            @endforeach

                        </div>

                        <x-select-status></x-select-status>
                    </div>
                </div>
                <div class="mt-5">
                    <x-button-form route_back="{{ route('admin.personnel.list') }} "></x-button-form>
                </div>
            </form>
        @endslot
    @endcomponent


@endsection
@section('page-script')
    <script src="{{ asset('js/system/admin/admin.js') }}"></script>
    <script>
            var url_search_user = "{{ route('admin.personnel.search') }}"
            main.resetForm();
            admin.searchUsersAddAdmin(
                '#kt_tab_pane_2 input#information',
                '#kt_tab_pane_2  #modalInformation',
                url_search_user,
                '#kt_tab_pane_2  #modalInformation #userInformation',
            );
            admin.checkOldNewUser();
    </script>
@endsection
