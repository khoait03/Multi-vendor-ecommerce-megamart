@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian hàng | Đơn hàng
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="far fa-layer-group"></i> Quản lý đơn hàng</h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <p class="h5 fw-bold text-primary">Danh Sách Đơn Hàng</p>
                        </div>

                        <div class="table-responsive">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <td class="text-center font-bold">STT</td>
                                        <th>Id</th>
                                        <th style="text-align: left">Mã đơn hàng</th>
                                        <th style="text-align: center">Khách hàng</th>
                                        <th style="text-align: center">Ngày đặt hàng</th>
                                        <th style="text-align: center">Số sản phẩm</th>
                                        <th>Tổng tiền đơn hàng</th>
                                        <th>Phương thức thanh toán</th>
                                        <th>Trạng thái thanh toán</th>
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
                                            <td style="text-align: center">{{ $order->user->name }}</td>
                                            <td style="text-align: center">{{ $order->created_at }}</td>
                                            <td style="text-align: center">{{ $order->product_quantity }}</td>
                                            <td style="text-align: center">
                                                @php
                                                    $total = 0;
                                                @endphp
                                                @foreach ($order->orderProducts as $product)
                                                    @if ($product->vendor_id == Auth::user()->id)
                                                        @php
                                                            $total +=
                                                                ($product->unit_price + $product->variant_total) *
                                                                $product->quantity;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                {{ formatMoney($total) }}
                                            </td>
                                            <td style="text-align: center">{{ $order->payment_method }} </td>
                                            <td style="text-align: center">
                                                {{ $order->payment_status == 1 ? 'Thành công' : 'Chưa thanh toán' }}
                                            </td>
                                            <td style="text-align: center">
                                                @php
                                                    $orderStatus = config('order_status.order_status_admin')[
                                                        $order->order_status
                                                    ];
                                                    $orderItem = $order
                                                        ->orderProducts()
                                                        ->where('vendor_id', Auth::user()->id)
                                                        ->first();
                                                    $statusText =
                                                        $orderItem &&
                                                        $orderItem->status == 'processed_and_ready_to_ship'
                                                            ? 'Đơn hàng sẵn sàng để vận chuyển'
                                                            : ($orderItem->status == 'cancelled'
                                                                ? 'Đơn hàng đã huỷ'
                                                                : 'Đang xử lý');
                                                    if ($order->order_status == 'delivered') {
                                                        $statusText = 'Đơn hàng thành công';
                                                    }
                                                @endphp
                                                {{ $statusText }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ route('vendor.orders.show', $order->id) }}"
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
