@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Thanh toán
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Thanh toán</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                            <li><a href="#">Giỏ hàng</a></li>
                            <li><a href="#">Thanh toán</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__cart_view">
        <div class="container">
            <div class="d-flex flex-column align-items-center">
                <img src="https://cdn1.iconfinder.com/data/icons/basic-ui-elements-color-round/3/15-512.png" width="150px"
                    alt="">
                <h3 class="mt-5 mb-3">Thanh toán thành công!</h3>
                <p>Cảm ơn bạn đã mua hàng tại MegaMart! Chúc bạn một ngày vui vẻ!</p>
                <a href="{{ route('home') }}" class="common_btn mt-3">Quay về trang chủ</a>
            </div>
        </div>
    </section>
@endsection
