@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $settings->site_name }} | Khách hàng | Đơn hàng
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="far fa-layer-group"></i> Quản lý đơn hàng</h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">

                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-4 d-flex justify-content-between align-items-center">
                                    <p class="h5 fw-bold text-primary">
                                        @if (request()->status && request()->status != 'all')
                                            @foreach (config('order_status.order_status_admin') as $key => $item)
                                                @if ($key == request()->status)
                                                    {{ $item['detail'] }}
                                                @endif
                                            @endforeach
                                        @elseif (request()->status == 'all')
                                            Tất cả đơn hàng
                                        @else
                                            Đơn hàng đang được xử lý
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <form action="{{ route('user.orders.index') }}" method="GET"
                                    class="mb-4 d-flex justify-content-between align-items-center gap-2">
                                    <select class="form-control" name="status" id="">
                                        <option {{ request()->status == 'pending' ? 'selected' : '' }} value="pending">Đơn
                                            hàng đang xử lý</option>
                                        <option {{ request()->status == 'dropped_off' ? 'selected' : '' }}
                                            value="dropped_off">Đơn hàng đã đến kho vận chuyển</option>
                                        <option {{ request()->status == 'shipped' ? 'selected' : '' }} value="shipped">Đơn
                                            hàng đã được vận chuyển đi</option>
                                        <option {{ request()->status == 'out_for_delivery' ? 'selected' : '' }}
                                            value="out_for_delivery">Đơn hàng đang giao đến</option>
                                        <option {{ request()->status == 'delivered' ? 'selected' : '' }} value="delivered">
                                            Đơn hàng đã được giao</option>
                                        <option {{ request()->status == 'cancelled' ? 'selected' : '' }} value="cancelled">
                                            Đơn hàng đã được huỷ</option>
                                        <option {{ request()->status == 'all' ? 'selected' : '' }} value="all">Tất cả đơn
                                            hàng</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary">Xem</button>
                                </form>

                            </div>

                        </div>

                        <div class="table-responsive">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <td class="text-center font-bold">STT</td>
                                        <th>Id</th>
                                        <th style="text-align: left">Mã đơn hàng</th>
                                        {{-- <th style="text-align: center">Khách hàng</th> --}}
                                        {{-- <th style="text-align: center">Ngày đặt hàng</th> --}}
                                        <th style="text-align: center">Số sản phẩm</th>
                                        <th>Tổng tiền đơn hàng</th>
                                        {{-- <th>Phương thức thanh toán</th> --}}
                                        {{-- <th>Trạng thái thanh toán</th> --}}
                                        <th>Trạng thái đơn hàng</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $key => $order)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $order->id }}</td>
                                            <td style="text-align: left">{{ $order->invoice_id }}</td>
                                            {{-- <td style="text-align: center">{{ $order->user->name }}</td> --}}
                                            {{-- <td style="text-align: center">{{ $order->created_at }}</td> --}}
                                            <td style="text-align: center">{{ $order->product_quantity }}</td>
                                            <td style="text-align: center">
                                                {{ formatMoney($order->amount) }}
                                            </td>
                                            {{-- <td style="text-align: center">{{ $order->payment_method }} </td> --}}
                                            {{-- <td style="text-align: center">
                                                {{ $order->payment_status == 1 ? 'Thành công' : 'Chưa thanh toán' }}
                                            </td> --}}
                                            <td style="text-align: center">
                                                @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                    @if ($key == $order->order_status)
                                                        {{ $orderStatus['status'] }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ route('user.orders.show', $order->id) }}"
                                                        class='btn btn-primary mr-2'>
                                                        <i class='far fa-eye'></i>
                                                    </a>
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
    </div>
@endsection
