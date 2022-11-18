@foreach ($order_bills as $stt => $order_bill)
    <tr>
        <td>{{ $stt++ }}</td>
        <td>{{ $order_bill->full_name }}</td>
        <td>{{ number_format($order_bill->total_money, 0, ',', '.') }} VND</td>
        <td>
            <form class="update_status_bill" action="{{ route('admin.order_bill.update_status_bill') }}" method="post">
                @csrf
                <input hidden name="id_bill" type="text" value="{{ $order_bill->id_bill }}">
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
                <button type="submit" class="btn btn-square btn-success mt-3 mr-5 float-right">
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
                <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown"
                    aria-expanded="false">
                    <i class="icofont-listine-dots"></i>
                </button>
                <div class="dropdown-menu ">
                    <a href="#" class="btn btn-rounded btn-primary mb-2 ml-2">
                        <i class="icofont-ui-edit"></i>
                        Sửa
                    </a>
                    <button type="button" class=" btn btn-rounded btn-danger  mb-2">
                        <i class="icofont-bin"></i>
                        Xóa
                    </button>
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
