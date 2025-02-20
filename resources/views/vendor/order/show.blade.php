@php
    $address = json_decode($order->order_address);
    $total = 0;
@endphp

@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian hàng | Đơn hàng
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <a href="{{ route('vendor.orders.index') }}" class="btn btn-primary mb-3">
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
                                            Thanh toán qua: {{ $order->payment_method }}<br>
                                            Mã thanh toán:
                                            {{ $order->transaction->transaction_id }}<br>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-md-3">
                                        <div class="wsus__invoice_single text-md-center">
                                            <h5>Ngày đặt hàng</h5>
                                            {{ $order->created_at }}<br><br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive my-5">
                                <table class="table table-striped table-hover table-md">
                                    <tr>
                                        {{-- <td class="text-center font-bold">STT</td> --}}
                                        <th>
                                            Ảnh sản phẩm
                                        </th>
                                        <th>Tên sản phẩm</th>
                                        <th>Gian hàng</th>
                                        <th class="text-center">Đơn giá</th>
                                        <th class="text-center">Số lượng</th>
                                        <th class="text-center">Phiên bản</th>
                                        <th class="text-center">Tổng tiền phiên bản</th>
                                        <th class="text-right">Thành tiền</th>
                                    </tr>

                                    @foreach ($order->orderProducts as $key => $product)
                                        @if ($product->vendor_id == Auth::user()->id)
                                            @php
                                                $variants = json_decode($product->variants);
                                                $total +=
                                                    ($product->unit_price + $product->variant_total) *
                                                    $product->quantity;
                                            @endphp
                                            <tr>
                                                {{-- <td class="text-center">{{ $key + 1 }}</td> --}}
                                                <td><img src="{{ asset($product->product->thumb_image) }}" width="80px">
                                                </td>
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
                                        @endif
                                    @endforeach

                                </table>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <h5 class="mb-3 "><strong>Tổng tiền đơn hàng:</strong>
                                {{ formatMoney($total) }} </h5>
                        </div>

                        <div class="row pt-5 border-top">
                            @if ($order->order_status == 'cancelled')
                                <div class="col-md-4">
                                    <label for="" class="mb-2 fw-bold">Trạng thái đơn hàng</label>
                                    <input id="order_status_text" class="form-control mb-5" value="Đơn hàng đã huỷ"
                                        readonly>
                                </div>
                            @else
                                <form action="{{ route('vendor.orders.change-status', $order->id) }}" class="col-md-4"
                                    method="POST">
                                    @csrf
                                    @method('PUT')

                                    @php
                                        $orderItem = \App\Models\OrderProduct::where('order_id', $order->id)
                                            ->where('vendor_id', Auth::user()->id)
                                            ->first();
                                    @endphp
                                    <input type="hidden" name="vendor_id" value="{{ Auth::user()->id }}">
                                    <label for="" class="mb-2 fw-bold">Trạng thái đơn hàng</label>
                                    <select name="status" id="" class="form-control"
                                        {{ $orderItem->status !== 'processed_and_ready_to_ship' ? '' : 'disabled' }}>
                                        @foreach (config('order_status.order_status_vendor') as $key => $option)
                                            <option value="{{ $key }}"
                                                {{ $orderItem && $orderItem->status == $key ? 'selected' : '' }}>
                                                {{ $option['status'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit"
                                        class="btn btn-primary mt-3 {{ $orderItem->status !== 'processed_and_ready_to_ship' ? '' : 'd-none' }}">Xác
                                        nhận</button>
                                </form>
                            @endif
                            {{-- <div class="col-md-8 h-25 d-flex justify-content-end">
                                <button class="btn btn-warning print-invoice">Print</button>
                            </div> --}}
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
