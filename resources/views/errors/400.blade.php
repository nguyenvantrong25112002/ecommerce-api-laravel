@extends('layouts.error')
@section('page-error-conten')
    <div class="mb-5">
        <a class="btn btn-primary" href="{{ route('admin.dashboard') }}">Trở về trang chủ</a>
    </div>
    <h1 class="error-text font-weight-bold">400</h1>
    <h4 class="mt-4"><i class="fa fa-thumbs-down text-danger"></i> Yêu cầu không hợp lệ !</h4>
    <p>Yêu cầu của bạn dẫn đến lỗi.</p>
@endsection
