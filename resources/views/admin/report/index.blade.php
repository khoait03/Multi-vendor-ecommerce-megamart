@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Báo Cáo Tổng Hợp</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Báo Cáo Tổng Hợp</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Báo Cáo Tổng Hợp</h2>
            <p class="section-lead">Tổng hợp các loại báo cáo về doanh thu, đơn hàng,.... của toàn bộ hệ thống theo từng mốc
                thời gian.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="px-5 py-4">
                            <form class="d-flex align-items-center">
                                <div class="form-group mr-3">
                                    <label for="">Loại báo cáo</label>
                                    <select class="form-control" name="report_type" id="">
                                        <option {{ request()->report_type == '' ? 'selected' : '' }} value="">-- Chọn
                                            loại báo cáo --</option>
                                        <option {{ request()->report_type == 'revenue' ? 'selected' : '' }} value="revenue">
                                            Báo
                                            cáo doanh thu</option>
                                        <option {{ request()->report_type == 'order' ? 'selected' : '' }} value="order">Báo
                                            cáo
                                            đơn hàng
                                        </option>
                                        <option {{ request()->report_type == 'coupon' ? 'selected' : '' }} value="coupon">
                                            Báo
                                            cáo mã giảm giá</option>
                                    </select>
                                    @if ($errors->has('report_type'))
                                        <p class="text-danger">{{ $errors->first('report_type') }}</p>
                                    @endif
                                </div>
                                <div class="form-group mr-3">
                                    <label for="">Ngày bắt đầu</label>
                                    <input type="text" name="report_start_date" class="form-control datepicker"
                                        value="{{ old('report_start_date', request()->report_start_date) }}">
                                    @if ($errors->has('report_start_date'))
                                        <p class="text-danger">{{ $errors->first('offer_start_date') }}</p>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="">Ngày kết thúc</label>
                                    <input type="text" name="report_end_date" class="form-control datepicker"
                                        value="{{ old('report_start_date', request()->report_end_date) }}">
                                    @if ($errors->has('report_start_date'))
                                        <p class="text-danger">{{ $errors->first('offer_start_date') }}</p>
                                    @endif
                                </div>
                                <button class="btn btn-primary w-25 ml-3" style="height: 40px">Báo cáo</button>
                            </form>
                        </div>
                        <div class="card-body">

                            @if (request()->report_type == 'revenue')
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-warning">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Tổng doanh thu từ tất cả đơn hàng đã giao</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ formatMoney($subTotals) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-info">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Tổng doanh thu từ các sản phẩm của MegaMart</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ formatMoney($totalEarningsAdminVendor) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-info">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Tổng doanh thu của các gian hàng</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ formatMoney($totalEarningsVendor) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-info">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Tổng doanh thu từ hoa hồng của các gian hàng</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ formatMoney($totalEarningsOtherVendors) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-success">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Tổng doanh thu MegaMart nhận được</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ formatMoney($finalTotalEarnings - $amountSale) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (request()->report_type == 'order')
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-primary">
                                                <i class="fas fa-scroll"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Tổng đơn hàng</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $orders }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-primary">
                                                <i class="fas fa-spinner"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Đơn hàng đang xử lý</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $pending_orders }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-primary">
                                                <i class="fas fa-luggage-cart"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Đơn hàng sẵn sàng ược vận chuyển</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $processed_and_ready_to_ship_orders }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-primary">
                                                <i class="fas fa-people-carry"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Đơn hàng đã đến kho vận chuyển</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $dropped_off_orders }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-primary">
                                                <i class="fas fa-truck"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Đơn hàng đã được vận chuyển i</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $shipped_orders }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-primary">
                                                <i class="fas fa-clock"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Đơn hàng đang giao đến khách hàng</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $out_for_delivery_orders }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-primary">
                                                <i class="fas fa-check"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Đơn hàng đã được giao</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $delivered_orders }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-primary">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Đơn hàng đã bị hủy</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $cancelled_orders }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-primary">
                                                <i class="fas fa-undo-alt"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Đơn hàng hoàn trả</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $refunded_orders }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (request()->report_type == 'coupon')
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-success">
                                                <i class="fas fa-ticket-alt"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Số lượng mã giảm giá đã sử dụng</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ $couponUsedCount }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon bg-warning">
                                                <i class="fas fa-money-bill-wave"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="card-header">
                                                    <h4>Số tiền giảm thông qua mã giảm giá</h4>
                                                </div>
                                                <div class="card-body">
                                                    {{ formatMoney($amountSale) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if (request()->report_type == 'order' || request()->report_type == 'coupon')
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orderList as $key => $order)
                                                <tr>
                                                    <td class="text-center font-bold">{{ $key + 1 }}</td>
                                                    <td>{{ $order->id }}</td>
                                                    <td style="text-align: left">{{ $order->invoice_id }}</td>
                                                    <td style="text-align: center">{{ $order->user->name }}</td>
                                                    <td style="text-align: center">{{ $order->created_at }}</td>
                                                    <td style="text-align: center">{{ $order->product_quantity }}</td>
                                                    <td style="text-align: center">{{ formatMoney($order->sub_total) }}
                                                    </td>
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
                                                    <td>
                                                        <div class="d-flex justify-content-start">
                                                            <a href="{{ route('admin.order.show', $order->id) }}"
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
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}

    <script>
        $(document).ready(function() {
            $("body").on('click', ".change-status", function() {
                let isChecked = $(this).is(":checked")
                let id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.reviews.change-status') }}",
                    method: "PUT",
                    data: {
                        id: id,
                        status: isChecked
                    },
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
