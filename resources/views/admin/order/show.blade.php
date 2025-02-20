@php
    $address = json_decode($order->order_address);
    $shipping = json_decode($order->shipping_method);
    $coupon = json_decode($order->coupon);
@endphp

@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Đơn Hàng</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Đơn Hàng</a></div>
                <div class="breadcrumb-item"><a href="#">Tất Cả Đơn Hàng</a></div>
                <div class="breadcrumb-item"><a href="#">Đơn Hàng #{{ $order->invoice_id }}</a></div>
            </div>
        </div>

        <a href="{{ route('admin.order.index') }}">
            < Quay lại</a>
                <div class="section-body">
                    <h2 class="section-title">Thông tin đơn hàng <span class=" p-2">#{{ $order->invoice_id }}</span>
                    </h2>
                    <div class="row mt-3">

                        <div class="col-12">
                            <div class="card">
                                <section class="section">
                                    <div class="section-body">
                                        <div class="invoice">
                                            <div class="invoice-print">

                                                <div class="row">
                                                    <div class="col-lg-12">

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <address>
                                                                    <div class="section-title">Khách hàng:</div>
                                                                    Tên khách hàng: {{ $address->name }}<br>
                                                                    Email: {{ $address->email }}<br>
                                                                    Số điện thoại: {{ $address->phone }}<br>

                                                                </address>
                                                            </div>
                                                            <div class="col-md-6 ">
                                                                <address>
                                                                    <div class="section-title">Địa chỉ:</div>
                                                                    Số nhà/Căn hộ: {{ $address->address }}<br>
                                                                    Xã/Phường: {{ $address->commune_ward }}<br>
                                                                    Quận/Huyện: {{ $address->district }}<br>
                                                                    Tỉnh/Thành phố: {{ $address->province_city }}<br>
                                                                    Lưu ý:
                                                                    {{ $address->other ? $address->other : 'Không có' }}<br>

                                                                </address>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <address>
                                                                    <div class="section-title">Thanh toán:</div>
                                                                    Thanh toán qua: {{ $order->payment_method }}<br>
                                                                    Mã thanh toán:
                                                                    {{ $order->transaction->transaction_id }}<br>
                                                                    Số tiền thanh toán:
                                                                    @if ($order->payment_method == 'Stripe' || $order->payment_method == 'Paypal')
                                                                        ${{ $order->transaction->amount_real_currency }}
                                                                    @else
                                                                        {{ formatMoney($order->transaction->amount_real_currency) }}
                                                                    @endif
                                                                    <br>
                                                                    Trạng thái thanh toán:
                                                                    {{ $order->payment_status == 1 ? 'Thành công' : 'Không thành công' }}<br>

                                                                </address>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <address>
                                                                    <div class="section-title">Ngày đặt hàng:</div>
                                                                    {{ $order->created_at }}<br><br>
                                                                </address>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-4">
                                                    <div class="col-md-12">
                                                        <div class="section-title">Thông tin sản phẩm</div>
                                                        <p class="section-lead">Tất cả sản phẩm thuộc đơn hàng.</p>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-hover table-md">
                                                                <tr>
                                                                    <th data-width="40">#</th>
                                                                    <th>Tên sản phẩm</th>
                                                                    <th>Gian hàng</th>
                                                                    <th class="text-center">Đơn giá</th>
                                                                    <th class="text-center">Số lượng</th>
                                                                    <th class="text-center">Phiên bản</th>
                                                                    <th class="text-center">Tổng tiền phiên bản</th>
                                                                    <th class="text-right">Thành tiền</th>
                                                                </tr>

                                                                @foreach ($order->orderProducts as $index => $product)
                                                                    @php
                                                                        $variants = json_decode($product->variants);
                                                                    @endphp
                                                                    <tr>
                                                                        <td>{{ $index + 1 }}</td>
                                                                        <td>
                                                                            <a target="blank"
                                                                                href="{{ route('product-detail', $product->product->slug) }}">{{ $product->product_name }}</a>
                                                                        </td>
                                                                        <td>{{ $product->vendor->name }}</td>
                                                                        <td class="text-center">
                                                                            {{ formatMoney($product->unit_price) }}</td>
                                                                        <td class="text-center">{{ $product->quantity }}
                                                                        </td>
                                                                        <td>
                                                                            @foreach ($variants as $key => $variant)
                                                                                <span>{{ $key }}:
                                                                                    {{ $variant->name }}
                                                                                    {{ $variant->price > 0 ? '(+' . formatMoney($variant->price) . ')' : '' }}
                                                                                </span>
                                                                                <br>
                                                                            @endforeach
                                                                        </td>
                                                                        <td class="text-center">
                                                                            {{ formatMoney($product->variant_total * $product->quantity) }}
                                                                        </td>
                                                                        <td class="text-right">
                                                                            {{ formatMoney(($product->unit_price + $product->variant_total) * $product->quantity) }}
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                            </table>
                                                        </div>
                                                        <div class="row mt-4">
                                                            <div class="col-lg-4">
                                                                <div class="pb-5">
                                                                    <div class="section-title">Trạng thái nhà cung cấp</div>
                                                                    @php
                                                                        $printedVendors = collect();
                                                                        $allProcessed = true;
                                                                        $checkArr = [];
                                                                    @endphp
                                                                    @foreach ($order->orderProducts as $item)
                                                                        @if (!$printedVendors->contains($item->vendor->name))
                                                                            @php
                                                                                $vendorProducts = $order->orderProducts->where(
                                                                                    'vendor_id',
                                                                                    $item->vendor_id,
                                                                                );
                                                                                $allProcessed = $vendorProducts->every(
                                                                                    function ($product) use (
                                                                                        &$checkArr,
                                                                                    ) {
                                                                                        if (
                                                                                            $product->status ==
                                                                                            'processed_and_ready_to_ship'
                                                                                        ) {
                                                                                            $checkArr[] = true;
                                                                                            return true;
                                                                                        } else {
                                                                                            $checkArr[] = false;
                                                                                            return false;
                                                                                        }
                                                                                    },
                                                                                );
                                                                            @endphp
                                                                            <h6><span
                                                                                    class="text-primary">{{ $item->vendor->name }}:</span>
                                                                                @if ($order->order_status == 'cancelled')
                                                                                    Đơn hàng đã huỷ
                                                                                @else
                                                                                    @if ($allProcessed)
                                                                                        Đơn hàng sẵn sàng được vận chuyển
                                                                                    @else
                                                                                        Đơn hàng đang được xử lý
                                                                                    @endif
                                                                                @endif
                                                                            </h6>
                                                                            @php
                                                                                $printedVendors->push(
                                                                                    $item->vendor->name,
                                                                                );
                                                                            @endphp
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                                {{-- <div class="pt-3 border-top">
                                                                    <div class="section-title">Trạng thái đơn hàng</div>
                                                                    @if (!in_array(false, $checkArr, true))
                                                                        <select name="order_status" id="order_status"
                                                                            data-id="{{ $order->id }}"
                                                                            class="form-control mb-5 order-product-status">
                                                                            @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                                                <option
                                                                                    {{ $order->order_status == $key ? 'selected' : '' }}
                                                                                    value="{{ $key }}">
                                                                                    {{ $orderStatus['status'] }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    @else
                                                                        @if ($order->order_status == 'cancelled')
                                                                            <input id="order_status_text"
                                                                                class="form-control mb-5"
                                                                                value="Đơn hàng đã huỷ" readonly>
                                                                        @else
                                                                            <input id="order_status_text"
                                                                                class="form-control mb-5" value="Đang xử lý"
                                                                                readonly>
                                                                        @endif
                                                                    @endif
                                                                </div> --}}

                                                                <div>
                                                                    <div class="section-title">Trạng thái đơn hàng</div>

                                                                    <input type="hidden" id="order_id"
                                                                        value="{{ $order->id }}">

                                                                    @if (!in_array(false, $checkArr, true))
                                                                        <div class="d-flex flex-column">
                                                                            <div class="mb-3">
                                                                                <button class="btn btn-secondary"
                                                                                    disabled>Quá
                                                                                    trình
                                                                                    xử
                                                                                    lý</button>
                                                                            </div>
                                                                            @if ($order->order_status == 'cancelled')
                                                                                <div class="mb-3 d-flex align-items-center">
                                                                                    <div>
                                                                                        <button class="btn btn-danger"
                                                                                            disabled>Đơn hàng
                                                                                            đã bị huỷ</button>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                            @if ($order->order_status == 'pending')
                                                                                <div class="mb-3 d-flex align-items-center">
                                                                                    <div class="mr-3">
                                                                                        <button
                                                                                            class="btn btn-primary btn-status"
                                                                                            data-status="dropped_off">Đã đến
                                                                                            kho
                                                                                            vận chuyển</button>
                                                                                    </div>
                                                                                    <div>
                                                                                        <button
                                                                                            class="btn btn-danger btn-cancel"
                                                                                            data-status="cancelled">Đơn hàng
                                                                                            bị
                                                                                            huỷ</button>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                            @if ($order->order_status == 'dropped_off')
                                                                                <div class="mb-3">
                                                                                    <button class="btn btn-secondary"
                                                                                        disabled>Đã
                                                                                        đến kho
                                                                                        vận chuyển</button>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <button
                                                                                        class="btn btn-primary btn-status"
                                                                                        data-status="shipped">Đã
                                                                                        được vận
                                                                                        chuyển đi</button>
                                                                                </div>
                                                                            @endif
                                                                            @if ($order->order_status == 'shipped')
                                                                                <div class="mb-3">
                                                                                    <button class="btn btn-secondary"
                                                                                        disabled>Đã
                                                                                        đến kho
                                                                                        vận chuyển</button>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <button class="btn btn-secondary"
                                                                                        disabled>Đã
                                                                                        được vận
                                                                                        chuyển đi</button>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <button
                                                                                        class="btn btn-primary btn-status"
                                                                                        data-status="out_for_delivery">Đang
                                                                                        giao
                                                                                        đến khách hàng</button>
                                                                                </div>
                                                                            @endif
                                                                            @if ($order->order_status == 'out_for_delivery')
                                                                                <div class="mb-3">
                                                                                    <button class="btn btn-secondary"
                                                                                        disabled>Đã
                                                                                        đến kho
                                                                                        vận chuyển</button>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <button class="btn btn-secondary"
                                                                                        disabled>Đã
                                                                                        được vận
                                                                                        chuyển đi</button>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <button class="btn btn-secondary"
                                                                                        disabled>Đang giao
                                                                                        đến khách hàng</button>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <button
                                                                                        class="btn btn-primary btn-status"
                                                                                        data-status="delivered">Đã
                                                                                        được giao cho khách hàng</button>
                                                                                </div>
                                                                            @endif
                                                                            @if ($order->order_status == 'delivered')
                                                                                <div class="mb-3">
                                                                                    <button class="btn btn-secondary"
                                                                                        disabled>Đã
                                                                                        đến kho
                                                                                        vận chuyển</button>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <button class="btn btn-secondary"
                                                                                        disabled>Đã
                                                                                        được vận
                                                                                        chuyển đi</button>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <button class="btn btn-secondary"
                                                                                        disabled>Đang giao
                                                                                        đến khách hàng</button>
                                                                                </div>
                                                                                <div class="mb-3">
                                                                                    <button class="btn btn-secondary"
                                                                                        disabled>Đã
                                                                                        được giao cho khách hàng</button>
                                                                                </div>
                                                                            @endif

                                                                        </div>
                                                                    @else
                                                                        <div class="mb-3">
                                                                            <button class="btn btn-secondary" disabled>Quá
                                                                                trình
                                                                                xử
                                                                                lý</button>
                                                                        </div>
                                                                    @endif
                                                                </div>


                                                                @if ($order->payment_method == 'COD')
                                                                    <div>
                                                                        <div class="section-title">Trạng thái thanh toán
                                                                            (Đơn
                                                                            hàng COD)</div>
                                                                        <select name="payment_status" id="payment_status"
                                                                            data-id="{{ $order->id }}"
                                                                            class="form-control mb-5">

                                                                            <option
                                                                                {{ $order->payment_status == 0 ? 'selected' : '' }}
                                                                                value="0">Chưa thanh toán</option>
                                                                            <option
                                                                                {{ $order->payment_status == 1 ? 'selected' : '' }}
                                                                                value="1">Đã thanh toán</option>

                                                                        </select>
                                                                    </div>
                                                                @endif
                                                            </div>

                                                            <div class="col-lg-8 text-right">
                                                                <div class="invoice-detail-item">
                                                                    <div class="invoice-detail-name">Tổng tiền sản phẩm
                                                                    </div>
                                                                    <div class="invoice-detail-value">
                                                                        {{ formatMoney($order->sub_total) }}</div>
                                                                </div>
                                                                <div class="invoice-detail-item">
                                                                    <div class="invoice-detail-name">Phí vận chuyển</div>
                                                                    <div class="invoice-detail-value">
                                                                        + {{ formatMoney($shipping->cost) }}</div>
                                                                </div>
                                                                <div class="invoice-detail-item">
                                                                    <div class="invoice-detail-name">Giảm giá</div>
                                                                    <div class="invoice-detail-value">
                                                                        @if ($coupon && $coupon->discount_type == 'amount')
                                                                            - {{ formatMoney($coupon->discount) }}
                                                                        @elseif ($coupon && $coupon->discount_type == 'percent')
                                                                            -
                                                                            {{ formatMoney(($order->sub_total * $coupon->discount) / 100) }}
                                                                            ({{ $coupon->discount }}%)
                                                                        @else
                                                                            - {{ formatMoney(0) }}
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <hr class="mt-2 mb-2">
                                                                <div class="invoice-detail-item">
                                                                    <div class="invoice-detail-name">Tổng tiền đơn hàng
                                                                    </div>
                                                                    <div
                                                                        class="invoice-detail-value invoice-detail-value-lg">
                                                                        {{ formatMoney($order->amount) }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="text-md-right">
                                                {{-- <div class="float-lg-left mb-lg-0 mb-3">
                                                    <button class="btn btn-primary btn-icon icon-left"><i
                                                            class="fas fa-credit-card"></i> Process Payment</button>
                                                    <button class="btn btn-danger btn-icon icon-left"><i
                                                            class="fas fa-times"></i>
                                                        Cancel</button>
                                                </div> --}}
                                                <button class="btn btn-warning btn-icon icon-left print-invoice"><i
                                                        class="fas fa-print"></i>
                                                    Print</button>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $("body").on('click', ".btn-status", function() {
                let order_status = $(this).data("status")
                let order_id = $("#order_id").val()
                $.ajax({
                    url: "{{ route('admin.order.status') }}",
                    method: "PUT",
                    data: {
                        order_status: order_status,
                        order_id: order_id,
                    },
                    success: function(data) {
                        if (data.status == "success") {
                            toastr.success(data.message)
                            location.reload()
                        }
                    },
                    error: function(data) {
                        console.log(data)
                    }
                })
            })

            $("body").on('change', "#payment_status", function() {
                let payment_status = $(this).val()
                let order_id = $(this).data("id")
                $.ajax({
                    url: "{{ route('admin.order.payment-status') }}",
                    method: "PUT",
                    data: {
                        payment_status: payment_status,
                        order_id: order_id,
                    },
                    success: function(data) {
                        if (data.status == "success") {
                            toastr.success(data.message)
                        }
                    },
                    error: function(data) {
                        console.log(data)
                    }
                })
            })

            $(".print-invoice").on("click", function() {
                let printBody = $(".section-body")
                let originalContents = $("body").html()

                $("body").html(printBody.html())
                window.print()
                $("body").html(originalContents)
            })

            $('body').on('click', '.btn-cancel', function(event) {
                event.preventDefault();

                let order_status = $(this).data("status")
                let order_id = $("#order_id").val()

                Swal.fire({
                    title: 'Bạn có chắc chắn muốn huỷ đơn hàng này?',
                    text: "Dữ liệu không thể khôi phục sau khi thực hiện",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: 'PUT',
                            url: "{{ route('admin.order.status') }}",
                            data: {
                                order_status: order_status,
                                order_id: order_id,
                            },
                            success: function(data) {

                                if (data.status == 'success') {
                                    Swal.fire({
                                        title: 'Thành công!',
                                        text: data.message,
                                        icon: 'success',
                                        willClose: () => {
                                            location
                                                .reload(); // Load lại trang sau khi đóng thông báo
                                        }
                                    });
                                } else if (data.status == 'error') {
                                    Swal.fire(
                                        'Không thành công',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })
                    }
                })
            })
        })
    </script>

    <script>
        new DataTable('#example', {
            "order": [
                [0, "desc"]
            ]
        });
    </script>
@endpush
