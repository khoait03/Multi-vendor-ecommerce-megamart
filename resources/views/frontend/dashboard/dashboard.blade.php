@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $settings->site_name }} | Khách hàng | Thống kê
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content">
                <div class="wsus__dashboard">
                    <div class="row">
                        <div class="col-xl-3 col-6 col-md-4">
                            <a class="wsus__dashboard_item green" href="dsahboard_order.html">
                                <i class="far fa-scroll"></i>
                                <p>Tổng Đơn Hàng</p>
                                <h4 style="color: #fff">{{ $totalOrders }}</h4>
                            </a>
                        </div>
                        {{-- <div class="col-xl-2 col-6 col-md-4">
                            <a class="wsus__dashboard_item green" href="dsahboard_download.html">
                                <i class="fal fa-cloud-download"></i>
                                <p>download</p>
                            </a>
                        </div> --}}
                        <div class="col-xl-3 col-6 col-md-4">
                            <a class="wsus__dashboard_item orange" href="dsahboard_order.html">
                                <i class="far fa-truck"></i>
                                <p>Đơn Hàng Đang Giao</p>
                                <h4 style="color: #fff">{{ $totalPendingOrder }}</h4>
                            </a>
                        </div>
                        <div class="col-xl-3 col-6 col-md-4">
                            <a class="wsus__dashboard_item green" href="dsahboard_order.html">
                                <i class="far fa-check"></i>
                                <p>Đơn Hàng Thành Công</p>
                                <h4 style="color: #fff">{{ $totalDeliveredOrder }}</h4>
                            </a>
                        </div>
                        <div class="col-xl-3 col-6 col-md-4">
                            <a class="wsus__dashboard_item red" href="dsahboard_order.html">
                                <i class="far fa-times"></i>
                                <p>Đơn Hàng Đã Huỷ</p>
                                <h4 style="color: #fff">{{ $totalCancelOrder }}</h4>
                            </a>
                        </div>
                        <div class="col-xl-4 col-6 col-md-4">
                            <a class="wsus__dashboard_item green" href="dsahboard_profile.html">
                                <i class="far fa-money-bill"></i>
                                <p>Số Tiền Mua Hàng</p>
                                <h4 style="color: #fff">{{ formatMoney($totalAmount) }}</h4>
                            </a>
                        </div>
                        <div class="col-xl-2 col-6 col-md-4">
                            <a class="wsus__dashboard_item blue" href="dsahboard_wishlist.html">
                                <i class="far fa-heart"></i>
                                <p>Yêu Thích</p>
                                <h4 style="color: #fff">{{ $totalWishlists }}</h4>
                            </a>
                        </div>
                        <div class="col-xl-2 col-6 col-md-4">
                            <a class="wsus__dashboard_item sky" href="dsahboard_review.html">
                                <i class="far fa-star"></i>
                                <p>Đánh Giá</p>
                                <h4 style="color: #fff">{{ $totalReviews }}</h4>
                            </a>
                        </div>
                        <div class="col-xl-2 col-6 col-md-4">
                            <a class="wsus__dashboard_item purple" href="dsahboard_address.html">
                                <i class="fal fa-map-marker-alt"></i>
                                <p>Địa chỉ</p>
                                <h4 style="color: #fff">{{ $totalAddress }}</h4>
                            </a>
                        </div>
                    </div>

                    <div class="row">

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
