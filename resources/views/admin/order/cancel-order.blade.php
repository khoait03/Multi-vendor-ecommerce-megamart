@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Đơn Hàng</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Đơn Hàng</a></div>
                <div class="breadcrumb-item"><a href="#">Tất Cả Đơn Hàng Đã Huỷ</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tất Cả Đơn Hàng Đã Huỷ</h2>
            <p class="section-lead">Danh sách tất cả đơn hàng đã huỷ có trong hệ thống.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header row">
                            <h4 class="col-12 col-md-8">Danh sách tất cả đơn hàng đã huỷ</h4>
                            {{-- <div class="card-header-action">
                                <a href="{{ route('admin.child-category.create') }}" class="btn btn-primary mb-3">+ Thêm
                                    mới</a>
                            </div> --}}
                            <div class="col-12 col-md-4 card-header-action">
                                <form class="d-flex">
                                    <select class="form-control" name="order_filter" id="">
                                        <option {{ request()->order_filter == '' ? 'selected' : '' }} value="">Tất cả
                                            đơn
                                            hàng</option>
                                        <option {{ request()->order_filter == 'not-refund' ? 'selected' : '' }}
                                            value="not-refund">Đơn
                                            hàng chưa hoàn tiền</option>
                                        <option {{ request()->order_filter == 'refunded' ? 'selected' : '' }}
                                            value="refunded">Đơn hàng đã hoàn tiền
                                        </option>

                                    </select>
                                    <button class="btn btn-primary w-25 ml-3">Lọc</button>
                                </form>
                            </div>
                        </div>

                        <div class="card-body">

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
                                            <th>Tổng tiền thanh toán</th>
                                            <th>Phương thức thanh toán</th>
                                            <th>Trạng thái thanh toán</th>
                                            <th>Trạng thái đơn hàng</th>
                                            <th>Trạng thái hoàn tiền</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $key => $order)
                                            <tr>
                                                <td class="text-center font-bold">{{ $key + 1 }}</td>
                                                <td>{{ $order->id }}</td>
                                                <td style="text-align: left">{{ $order->invoice_id }}</td>
                                                <td style="text-align: center">{{ $order->user->name }}</td>
                                                <td style="text-align: center">{{ $order->created_at }}</td>
                                                <td style="text-align: center">{{ $order->product_quantity }}</td>
                                                <td style="text-align: center">{{ formatMoney($order->sub_total) }}</td>
                                                <td style="text-align: center">{{ formatMoney($order->amount) }}</td>
                                                <td style="text-align: center">{{ $order->payment_method }} </td>
                                                <td style="text-align: center">
                                                    {{ $order->payment_status == 1 ? 'Thành công' : 'Chưa thanh toán' }}
                                                </td>
                                                <td style="text-align: center">
                                                    @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                        @if ($key == $order->order_status)
                                                            {{ $orderStatus['status'] }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td>{{ $order->refund_status }}</td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <a href="{{ route('admin.order.cancel-orders-show', $order->id) }}"
                                                            class='btn btn-primary mr-2'>
                                                            <i class='far fa-eye'></i>
                                                        </a>
                                                        {{-- <a href="{{ route('admin.order.destroy', $order->id) }}"
                                                            class='btn btn-warning mr-2 delete-item'>
                                                            <i class='fas fa-truck'></i>
                                                        </a>
                                                        <a href="{{ route('admin.order.destroy', $order->id) }}"
                                                            class='btn btn-danger mr-2 delete-item'>
                                                            <i class='fas fa-trash'></i>
                                                        </a> --}}

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
    </section>
@endsection
