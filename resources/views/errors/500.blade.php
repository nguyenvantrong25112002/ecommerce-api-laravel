@extends('layouts.error')
@section('page-error-conten')
    <div class="mb-5">
        <a class="btn btn-primary" href="{{ route('admin.dashboard') }}">Trở về trang chủ</a>
    </div>
    <h1 class="error-text font-weight-bold">500</h1>
    <h4 class="mt-4"><i class="fa fa-times-circle text-danger"></i> Lỗi máy chủ nội bộ</h4>
    <p>Bạn không có quyền xem tài nguyên này.</p>
@endsection
