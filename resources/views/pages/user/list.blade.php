@extends('layouts.main')
@section('page-title', 'Quản lý khách hàng')
@section('title', 'Danh sách khách hàng')
@section('content')
    <x-breadcrumb :datas="[['active' => true, 'content' => 'Danh sách khách hàng']]" />
    @component('components.list-data', ['route_add' => null, 'pagination' => $datas])
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
                <th>
                    Ngày đăng kí hệ thống
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
                        {{ $data->updated_at }}
                    </td>
                </tr>
            @endforeach
        @endslot
    @endcomponent
@endsection
@section('page-script')
    <script src="{{ asset('js/system/list-data/list-data.js') }}"></script>
@endsection
