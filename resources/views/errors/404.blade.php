@extends('layouts.error')
@section('page-error-conten')
    <div class="mb-5">
        <a class="btn btn-primary" href="{{ route('admin.dashboard') }}">Trở về trang chủ</a>
    </div>
    <h1 class="error-text font-weight-bold">404</h1>
    <h4 class="mt-4">
        <i class="fa fa-exclamation-triangle text-warning"> </i>
        Không tìm thấy trang bạn đang tìm!
    </h4>
    <p>Bạn có thể đã nhập sai địa chỉ hoặc trang có thể đã bị di chuyển.</p>
@endsection
