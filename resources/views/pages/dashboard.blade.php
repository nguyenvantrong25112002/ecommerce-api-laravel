@extends('layouts.main')

@section('content')
    <h1>Chào mừng Admin</h1>
    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-one card-body">
                    <div class="stat-icon d-inline-block">
                        <i class="ti-money text-success border-success"></i>
                    </div>
                    <div class=" d-inline-block">
                        <div class="stat-text">Profit</div>
                        <div class="stat-digit">1,012</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-one card-body">
                    <div class="stat-icon d-inline-block">
                        <i class="ti-user text-primary border-primary"></i>
                    </div>
                    <div class=" d-inline-block">
                        <div class="stat-text">Quản trị / Người dùng</div>
                        <div class="stat-digit">{{ $countAdmin }} / {{ $countCustomer }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-one card-body">
                    <div class="stat-icon d-inline-block">
                        <i class="ti-layout-grid2 text-pink border-pink"></i>
                    </div>
                    <div class=" d-inline-block">
                        <div class="stat-text">Sản phẩm</div>
                        <div class="stat-digit">{{ $countProduct }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-one card-body">
                    <div class="stat-icon d-inline-block">
                        <i class=" ti-gift text-danger border-danger"></i>
                    </div>
                    <div class=" d-inline-block">
                        <div class="stat-text">Tổng đơn hàng</div>
                        <div class="stat-digit">{{ $countBill }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card">
                <div class="stat-widget-one card-body">
                    <div class="stat-icon d-inline-block">
                        <i class=" ti-view-grid text-danger border-danger"></i>
                    </div>
                    <div class=" d-inline-block">
                        <div class="stat-text">Tổng đơn hàng đã xác nhận</div>
                        <div class="stat-digit">{{ $countBill }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
