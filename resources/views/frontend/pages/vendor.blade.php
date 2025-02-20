@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian Hàng
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Gian Hàng</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                            <li><a href="#">Gian Hàng</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__product_page" class="wsus__vendors">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-8">
                    <div class="row">
                        <div class="col-xl-12 d-none d-lg-block">
                            <div class="wsus__product_topbar">
                                {{-- <div class="wsus__topbar_select">
                                    <select class="select_2" name="state">
                                        <option>default shorting</option>
                                        <option>short by rating</option>
                                        <option>short by latest</option>
                                        <option>low to high </option>
                                        <option>high to low</option>
                                    </select>
                                </div>
                                <div class="wsus__topbar_select wsus__topbar_select2">
                                    <select class="select_2" name="state">
                                        <option>show 12</option>
                                        <option>show 15</option>
                                        <option>show 18</option>
                                        <option>show 21</option>
                                    </select>
                                </div> --}}
                            </div>
                        </div>

                        @foreach ($vendors as $vendor)
                            <div class="col-xl-6 col-md-6">
                                <div class="wsus__vendor_single">
                                    <img src="{{ asset($vendor->banner) }}" alt="vendor" class="img-fluid w-100">
                                    <div class="wsus__vendor_text">
                                        <div class="wsus__vendor_text_center">
                                            <h4>{{ $vendor->name }}</h4>
                                            {{-- <p class="wsus__vendor_rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </p> --}}
                                            <a href="callto:+6955548721111"><i class="far fa-phone-alt"></i>
                                                {{ $vendor->phone }}</a>
                                            <a href="mailto:example@gmail.com"><i class="fal fa-envelope"></i>
                                                {{ $vendor->email }}</a>
                                            <a href="{{ route('vendor.show', $vendor->id) }}" class="common_btn">Đi đến gian
                                                hàng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-xl-12">
                    @if ($vendors->hasPages())
                        <div class="mt-5 d-flex justify-content-center">{{ $vendors->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
