@php
    $address = json_decode($order->order_address);
    $shipping = json_decode($order->shipping_method);
    $coupon = json_decode($order->coupon);
@endphp

@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $settings->site_name }} | Khách hàng | Đơn hàng
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <a href="{{ route('user.orders.index') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-caret-left"></i> Quay lại</a>
                <h3><i class="far fa-layer-group"></i> Quản lý đơn hàng</h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area section-body">

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <p class="h5 fw-bold text-primary">Chi tiết đơn hàng #{{ $order->invoice_id }}</p>
                        </div>

                        <div class="wsus__invoice_header">
                            <div class="wsus__invoice_content">
                                <div class="row">
                                    <div class="col-xl-3 col-md-3 mb-5 mb-md-0">
                                        <div class="wsus__invoice_single">
                                            <h5>Khách hàng</h5>
                                            Tên khách hàng: {{ $address->name }}<br>
                                            Email: {{ $address->email }}<br>
                                            Số điện thoại: {{ $address->phone }}<br>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-3 mb-5 mb-md-0">
                                        <div class="wsus__invoice_single text-md-start">
                                            <h5>Địa chỉ</h5>
                                            Số nhà/Căn hộ: {{ $address->address }}<br>
                                            Xã/Phường: {{ $address->commune_ward }}<br>
                                            Quận/Huyện: {{ $address->district }}<br>
                                            Tỉnh/Thành phố: {{ $address->province_city }}<br>
                                            Lưu ý:
                                            {{ $address->other ? $address->other : 'Không có' }}<br>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-3">
                                        <div class="wsus__invoice_single text-md-start">
                                            <h5>Thông tin đơn hàng</h5>
                                            Đã thanh toán qua: {{ $order->payment_method }}<br>
                                            Mã thanh toán:
                                            {{ $order->transaction->transaction_id }}<br><br>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-3">
                                        <div class="wsus__invoice_single text-md-center">
                                            <h5>Ngày đặt hàng</h5>
                                            {{ $order->created_at }}<br><br>
                                            <h5>Trạng thái đơn hàng</h5>
                                            @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                @if ($key == $order->order_status)
                                                    {{ $orderStatus['status'] }}
                                                @endif
                                            @endforeach
                                            <br><br>
                                            @if ($order->order_status == 'cancelled')
                                                <span
                                                    class="{{ @$order->refund_status == 'Đã hoàn tiền' ? 'text-success' : 'text-danger' }} fw-bold">{{ @$order->refund_status }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <ul class="progtrckr" data-progtrckr-steps="4">

                                    <li class="progtrckr_done icon_one check_mark" style="width: 200px">Đang xử lý</li>

                                    @if (@$order->order_status == 'cancelled')
                                        <li class="icon_four red_mark" style="width: 200px">Đơn hàng đã bị huỷ</li>
                                    @else
                                        <li class="progtrckr_done icon_two
                                @if (
                                    @$order->order_status == 'processed_and_ready_to_ship' ||
                                        @$order->order_status == 'dropped_off' ||
                                        @$order->order_status == 'shipped' ||
                                        @$order->order_status == 'out_for_delivery' ||
                                        @$order->order_status == 'delivered') check_mark @endif"
                                            style="width: 200px">
                                            Đã chuẩn bị xong</li>
                                        <li class="icon_three
                                @if (
                                    @$order->order_status == 'out_for_delivery' ||
                                        @$order->order_status == 'shipped' ||
                                        @$order->order_status == 'delivered') check_mark @endif
                                "
                                            style="width: 200px">
                                            Đang vận chuyển</li>
                                        <li class="icon_three
                                @if (
                                    @$order->order_status == 'out_for_delivery' ||
                                        @$order->order_status == 'shipped' ||
                                        @$order->order_status == 'delivered') check_mark @endif
                                "
                                            style="width: 200px">
                                            Đang giao đến bạn</li>
                                        <li class="icon_four
                                @if (@$order->order_status == 'delivered') check_mark @endif
                                "
                                            style="width: 200px">
                                            Đã giao thành công</li>
                                    @endif

                                </ul>
                            </div>

                            <div class="table-responsive my-5">
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
                                                + {{ formatMoney($product->variant_total * $product->quantity) }}
                                            </td>
                                            <td class="text-right">
                                                {{ formatMoney(($product->unit_price + $product->variant_total) * $product->quantity) }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="d-flex flex-column">
                                <h6 class="mb-3 "><strong>Tổng tiền sản phẩm:</strong>
                                    {{ formatMoney($order->sub_total) }} </h6>
                                <h6 class="mb-3 "><strong>Phí vận chuyển:</strong>
                                    + {{ formatMoney($shipping->cost) }} </h6>
                                <h6 class="mb-3 "><strong>Giảm giá:</strong>
                                    @if ($coupon && $coupon->discount_type == 'amount')
                                        - {{ formatMoney($coupon->discount) }}
                                    @elseif ($coupon && $coupon->discount_type == 'percent')
                                        -
                                        {{ formatMoney(($order->sub_total * $coupon->discount) / 100) }}đ
                                        ({{ $coupon->discount }}%)
                                    @else
                                        - {{ formatMoney(0) }}
                                    @endif
                                </h6>
                                <h5 class="mb-3 pt-3 border-top"><strong>Tổng tiền đơn hàng:</strong>
                                    {{ formatMoney($order->amount) }} </h5>
                            </div>
                        </div>

                        <div class="row pt-5">
                            {{-- <div class="">
                                <button class="btn btn-warning print-invoice">Print</button>
                            </div> --}}
                            @if ($order->order_status == 'pending')
                                <div class="row pb-5">
                                    <h5 class="mt-5 mb-3 text-danger fw-bold">Huỷ đơn hàng</h5>

                                    <form action="{{ route('user.orders.cancel') }}" class="d-flex gap-2" method="POST">
                                        @csrf

                                        <select name="cancel_reason" class="form-control w-25" id="">
                                            <option value="">- - Chọn lý do huỷ đơn hàng - -</option>
                                            <option value="Sản phẩm không còn cần thiết">Sản phẩm không còn cần thiết
                                            </option>
                                            <option value="Thay đổi địa chỉ giao hàng">Thay đổi địa chỉ giao hàng</option>
                                            <option value="Thay đổi mã khuyến mãi">Thay đổi mã khuyến mãi</option>
                                            <option value="Dịch vụ khách hàng không tốt">Dịch vụ khách hàng không tốt
                                            </option>
                                            <option value="Thay đổi quyết định mua hàng">Thay đổi quyết định mua hàng
                                            </option>
                                            <option value="Tìm thấy sản phẩm thay thế tốt hơn">Tìm thấy sản phẩm thay thế
                                                tốt
                                                hơn</option>
                                            <option value="Lý do khác...">Lý do khác...</option>
                                        </select>
                                        @if ($errors->has('cancel_reason'))
                                            <p class="text-danger">{{ $errors->first('cancel_reason') }}</p>
                                        @endif
                                        <input type="hidden" name="order_id" value="{{ $order->id }}">
                                        <button class="btn btn-danger">Xác nhận huỷ</button>
                                    </form>
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $('#example').DataTable({
            "order": [
                [0, "desc"]
            ]
        });

        $(".print-invoice").on("click", function() {
            let printBody = $(".section-body")
            let originalContents = $("body").html()

            $("body").html(printBody.html())
            window.print()
            $("body").html(originalContents)
        })
    </script>
@endpush
