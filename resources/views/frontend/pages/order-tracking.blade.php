@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Trạng thái đơn hàng
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Trạng Thái Đơn Hàng</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                            <li><a href="#">Trạng Thái Đơn Hàng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__login_register">
        <div class="container">
            <div class="wsus__track_area">
                <div class="row">
                    <div class="col-xl-5 col-md-10 col-lg-8 m-auto">
                        <form class="tack_form">
                            <h4 class="text-center">Xem trạng thái đơn hàng</h4>
                            <p></p>
                            <div class="wsus__track_input">
                                <label class="d-block mb-2">Mã đơn hàng *</label>
                                <input type="text" placeholder="abcxyz" name="order_id"
                                    value="{{ old('order_id', request()->order_id) }}">
                            </div>
                            <button type="submit" class="common_btn">Kiểm tra</button>
                        </form>
                    </div>
                </div>

                @if ($order)
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="wsus__track_header">
                                <div class="wsus__track_header_text">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="wsus__track_header_single">
                                                <h5>Ngày đặt hàng:</h5>
                                                <p>{{ $order->created_at }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="wsus__track_header_single">
                                                <h5>Tên người mua:</h5>
                                                <p>{{ $order->user->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="wsus__track_header_single">
                                                <h5>Trạng thái:</h5>
                                                <p>
                                                    @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                                        @if ($key == $order->order_status)
                                                            {{ $orderStatus['status'] }}
                                                        @endif
                                                    @endforeach
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-lg-3">
                                            <div class="wsus__track_header_single border_none">
                                                <h5>Mã đơn hàng:</h5>
                                                <p>{{ $order->invoice_id }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <ul class="progtrckr" data-progtrckr-steps="4">

                                <li class="progtrckr_done icon_one check_mark">Đang xử lý</li>

                                @if (@$order->order_status == 'cancelled')
                                    <li class="icon_four red_mark">Đơn hàng đã bị huỷ</li>
                                @else
                                    <li
                                        class="progtrckr_done icon_two
                              @if (
                                  @$order->order_status == 'processed_and_ready_to_ship' ||
                                      @$order->order_status == 'dropped_off' ||
                                      @$order->order_status == 'shipped' ||
                                      @$order->order_status == 'out_for_delivery' ||
                                      @$order->order_status == 'delivered') check_mark @endif">
                                        Đã chuẩn bị xong</li>
                                    <li
                                        class="icon_three
                              @if (
                                  @$order->order_status == 'out_for_delivery' ||
                                      @$order->order_status == 'shipped' ||
                                      @$order->order_status == 'delivered') check_mark @endif
                              ">
                                        Đang vận chuyển</li>
                                    <li
                                        class="icon_four
                              @if (@$order->order_status == 'delivered') check_mark @endif
                              ">
                                        Đã giao thành công</li>
                                @endif

                            </ul>
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
