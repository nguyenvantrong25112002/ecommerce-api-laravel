@extends('backend.layout')
@section('admin-layout')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row p-5 ">
                            <div class="col-md-6">
                                <div style="max-width:150px">

                                    <img style="width:100%" src="{{ $logo_web }}">
                                </div>
                            </div>

                            <div class="col-md-6 text-right">
                                <p class="font-weight-bold mb-1">Mã đơn :
                                    <span class="text-muted">#{{ $bills->code_bill }}</span>
                                </p>
                                <p class="font-weight-bold mb-1">Ngày tạo:
                                    <span class="text-muted">
                                        {{ date('d-m-Y', strtotime($bills->created_at)) }}
                                    </span>
                                </p>
                            </div>
                        </div>


                        <hr>
                        <div class="row pb-2 p-5">
                            <div class="col-md-8">
                                <p class="font-weight-bold mb-4">Thông tin khách hàng</p>
                                <p class="mb-1">Họ tên :
                                    <span class="font-weight-bold mb-4">{{ $bills->full_name }}</span>
                                </p>
                                <p class="mb-1">Số điện thoại :
                                    <span class="font-weight-bold mb-4">{{ $bills->phone }}</span>
                                </p>
                                <p class="mb-1">Enail :
                                    <span class="font-weight-bold mb-4">{{ $bills->email }}</span>
                                </p>
                                <p class="mb-1">Địa chỉ :
                                    <span class="font-weight-bold mb-4">
                                        {{ $bills->city_province }}
                                        -
                                        {{ $bills->district }}
                                        -
                                        {{ $bills->commune_ward_town }}
                                    </span>
                                </p>
                                <p class="mb-1">Địa chỉ chi tiết :
                                    <span class="font-weight-bold mb-4">{{ $bills->detailed_address }}</span>
                                </p>

                            </div>

                            <div class="col-md-4">
                                <p class="font-weight-bold mb-4">Chi tiết thanh toán</p>

                                <p class="mb-1">
                                    Phương thức thanh toán:
                                    <span class="font-weight-bold mb-4">
                                        @if ($bills->code_bill = 'off')
                                            Thanh toán khi nhận hàng
                                        @else
                                            Thanh toán onile
                                        @endif
                                    </span>
                                </p>

                            </div>
                        </div>

                        <div class="row p-5">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="border-0 text-uppercase small font-weight-bold">#</th>
                                            <th style="width:15%" class="border-0 text-uppercase small font-weight-bold">Ảnh
                                            </th>

                                            <th style="width: 30%;" class="border-0 text-uppercase small font-weight-bold">
                                                Tên sản phẩm
                                            </th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Kích thước</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Giá</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Số lượng</th>
                                            <th class="border-0 text-uppercase small font-weight-bold">Tổng giá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $stt = 1;
                                        @endphp
                                        @foreach ($detail_bills as $detail_bill)

                                            <tr>
                                                <td>{{ $stt++ }}</td>
                                                <td>
                                                    @foreach ($products as $product)
                                                        @if ($product->id_product == $detail_bill->product_id)
                                                            <img style="width:100%"
                                                                src="{{ asset("$URL_IMG_PRODUCT/$product->img_product") }}"
                                                                alt="">
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>

                                                    {{ $detail_bill->name_product }}
                                                </td>
                                                <td>
                                                    {{ $detail_bill->attribute }}

                                                </td>
                                                <td>

                                                    {{ number_format($detail_bill->price_product, 0, ',', '.') }}
                                                    VND

                                                </td>
                                                <td>{{ $detail_bill->quantily }}</td>
                                                <td>{{ number_format($detail_bill->price, 0, ',', '.') }} VND</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="d-flex flex-row-reverse bg-dark text-white p-4">
                            <div class="py-3 px-5 text-right">
                                <div class="mb-2">Tổng tiền</div>
                                <div class="">
                                    <h2 style="color: #ffff">
                                        {{ number_format($bills->total_money, 0, ',', '.') }} VND
                                    </h2>
                                </div>
                            </div>

                            <div class="py-3 px-5 text-right">
                                <div class="mb-2">Thuế</div>
                                <div class="">
                                    <h2 style="color: #ffff">
                                        {{ number_format($bills->tax_vat, 0, ',', '.') }} VND

                                    </h2>

                                </div>
                            </div>

                            <div class="py-3 px-5 text-right">
                                <div class="mb-2">Tổng chưa thuế</div>
                                <div class="">
                                    <h2 style="color: #ffff">
                                        {{ number_format($bills->subtotal, 0, ',', '.') }} VND

                                    </h2>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-light mt-5 mb-5 text-center small">by : <a class="text-light" target="_blank"
                href="http://totoprayogo.com">totoprayogo.com</a></div>

    </div>
@endsection
