@extends('backend.layout')
@section('admin-layout'),
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <div class="card-header">
                            <h2>Danh sách Đơn hàng</h2>
                        </div>
                    </div>


                </div>
                {{-- <div style="padding: 0 20px" class="row">
                    <div class="col-2">
                        <a href="#" id="deleteAllCateSelect" class='badge badge-rounded badge-danger'>Xóa nhiều</a>
                    </div>
                </div> --}}
                <div class=" card-body">
                    <div class="table-responsive">
                        <table id="tableData" class="table table-hover table-responsive-sm">
                            <thead class="thead-primary">
                                <tr>
                                    {{-- <th><input type="checkbox" name="" id="checkAllCate"></th> --}}
                                    <th scope="col">#</th>
                                    <th scope="col">Tên người đặt</th>
                                    <th scope="col">Số sản phẩm</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Thời gian đặt</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="conten_bill">
                                @foreach ($order_bills as $stt => $order_bill)
                                    <tr>
                                        <td>{{ $stt++ }}</td>
                                        <td>{{ $order_bill->full_name }}</td>
                                        <td>
                                            {{ $order_bill->qty_product }}
                                        </td>
                                        <td>{{ number_format($order_bill->total_money, 0, ',', '.') }} VND</td>
                                        <td>
                                            <form class="update_status_bill"
                                                action="{{ route('admin.order_bill.update_status_bill') }}" method="post">
                                                @csrf
                                                <input hidden name="id_bill" type="text"
                                                    value="{{ $order_bill->id_bill }}">
                                                <select name="status_bill" class="selectpicker" data-style="btn-info">
                                                    <option {{ $order_bill->status_bill == 0 ? 'selected' : '' }}
                                                        {{ $order_bill->status_bill >= 0 ? 'disabled' : '' }} value="0">
                                                        Chưa kích hoạt đơn
                                                    </option>
                                                    <option {{ $order_bill->status_bill == 1 ? 'selected' : '' }}
                                                        {{ $order_bill->status_bill >= 1 ? 'disabled' : '' }} value="1">
                                                        Khách hàng đã kích hoạt đơn
                                                    </option>
                                                    <option {{ $order_bill->status_bill == 2 ? 'selected' : '' }}
                                                        {{ $order_bill->status_bill >= 2 ? 'disabled' : '' }} value="2">
                                                        Xác nhận đơn hàng
                                                    </option>
                                                    <option {{ $order_bill->status_bill == 3 ? 'selected' : '' }}
                                                        {{ $order_bill->status_bill >= 3 ? 'disabled' : '' }} value="3">
                                                        Đang chuẩn bị đơn hàng
                                                    </option>
                                                    <option {{ $order_bill->status_bill == 4 ? 'selected' : '' }}
                                                        {{ $order_bill->status_bill >= 4 ? 'disabled' : '' }} value="4">
                                                        Đơn hàng đã được đóng gói
                                                    </option>
                                                    <option {{ $order_bill->status_bill == 5 ? 'selected' : '' }}
                                                        {{ $order_bill->status_bill >= 5 ? 'disabled' : '' }} value="5">
                                                        Đơn hàng đã được vận chuyển
                                                    </option>
                                                    <option {{ $order_bill->status_bill == 6 ? 'selected' : '' }}
                                                        {{ $order_bill->status_bill >= 6 ? 'disabled' : '' }} value="6">
                                                        Đơn hàng đã được nhận</option>
                                                    <option {{ $order_bill->status_bill == 7 ? 'selected' : '' }}
                                                        {{ $order_bill->status_bill >= 7 ? 'disabled' : '' }} value="7">
                                                        Đơn hàng hoàn thiện
                                                    </option>
                                                    <option {{ $order_bill->status_bill == 8 ? 'selected' : '' }}
                                                        {{ $order_bill->status_bill >= 8 ? 'disabled' : '' }} value="8">
                                                        Đơn hàng hủy
                                                    </option>
                                                </select>
                                                <button type="submit"
                                                    class="btn btn-square btn-success mt-3 mr-5 float-right">
                                                    Cập nhập trạng thái đơn
                                                </button>
                                            </form>
                                        </td>
                                        <td>
                                            {{ date('d-m-Y H:i', strtotime($order_bill->created_at)) }}
                                            <br>
                                            {{ $order_bill->created_at->diffforHumans() }}
                                        </td>
                                        <td>

                                            <div class="btn-group dropleft">
                                                <button type="button" class="btn btn-secondary dropdown-toggle"
                                                    data-toggle="dropdown" aria-expanded="false">
                                                    <i class="icofont-listine-dots"></i>
                                                </button>
                                                <div class="dropdown-menu ">
                                                    <a href="#" class="btn btn-rounded btn-primary mb-2 ml-2">
                                                        <i class="icofont-ui-edit"></i>
                                                        Sửa
                                                    </a>
                                                    {{-- <button type="button" data-id_bill="{{ $order_bill->id_bill }}"
                                                        class="delete_bill btn btn-rounded btn-danger  mb-2">
                                                        <i class="icofont-bin"></i>
                                                        Xóa
                                                    </button> --}}
                                                    <a href="{{ route('admin.order_bill.destroy', ['id_bill' => $order_bill->id_bill]) }}"
                                                        class=" btn btn-danger btn-rounded">Xóa</a>
                                                    <a href="{{ route('admin.order_bill.view_detail_bill', ['id_bill_order' => $order_bill->id_bill]) }}"
                                                        class=" btn btn-primary ml-2">
                                                        <i class="icofont-clip-board"></i>
                                                        Xem đơn
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascrip')
    <script>
        // alert('aaaa');
        $(document).ready(function() {

            // $('.delete_bill').on('click', function(e) {
            //     e.preventDefault();
            //     var id_bill = $(this).data('id_bill');
            //     // console.log(id_bill);
            //     $.ajax({
            //         type: "get",
            //         url: "{{ route('admin.order_bill.destroy') }}",
            //         data: {
            //             id_bill: id_bill,
            //         },
            //         success: function(response) {
            //             window.location.reload();
            //         }
            //     });

            // });
            $(document).on('submit', '.update_status_bill', function(e) {
                e.preventDefault();
                var form = $(this);
                var data = $(this).serialize();
                $.ajax({
                    method: $(form).attr('method'),
                    url: $(form).attr('action'),
                    data: data,
                    success: function(response) {
                        if (response.code == 1) {
                            toastr.warning(response.warning, "Cảnh báo");
                        } else if (response.code == 2) {
                            toastr.success('Cập nhập trạng thái thành công !', "Thành công");
                            $('.selectpicker').selectpicker('refresh');
                        }
                        // console.log(response);
                        // table.ajax.reload();
                        // $('#conten_bill').empty();
                        // $('#conten_bill').html(response);
                    }
                });
            });
        });
    </script>
@endsection
