@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Đăng nhập
@endsection

@section('content')
    <!--============================
                                                                                                                                             BREADCRUMB START
                                                                                                                                        ==============================-->
    <section id="wsus__breadcrumb">
        <div class="breadcrumb_overlay"></div>
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Đăng nhập / Đăng ký</h4>
                        <ul>
                            <li><a href="{{ route('home') }}">Trang chủ</a></li>
                            <li><a href="#">Đăng nhập / Đăng ký</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                                                                                                                          BREADCRUMB END
                                                                                                                                        ==============================-->


    <!--============================
                                                                                                                                         LOGIN/REGISTER PAGE START
                                                                                                                                        ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__login_reg_area">
                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active">ĐĂNG NHẬP</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link text-center" href="{{ route('register') }}">ĐĂNG KÝ</a>
                            </li>
                        </ul>
                        <p class="text-center">Đăng nhập ngay để tiến hành mua sắm và tận hưởng
                            những quyền lợi của MegaMart dành cho bạn!</p>
                        <div class="wsus__login">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="wsus__login_input">
                                    <i class="fas fa-envelope"></i>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        placeholder="Email">
                                </div>

                                <div class="wsus__login_input">
                                    <i class="fas fa-key"></i>
                                    <input id="password" type="password" name="password" placeholder="Mật khẩu">
                                </div>

                                <div class="wsus__login_save">
                                    <div class="form-check form-switch">
                                        <input id="remember_me" name="remember" class="form-check-input" type="checkbox"
                                            id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Ghi nhớ
                                            tôi</label>
                                    </div>
                                    <a class="forget_p" href="{{ route('password.request') }}">Quên mật khẩu ?</a>
                                </div>

                                @if ($errors->any())
                                    <div class="mb-3">
                                        <div class="bg-danger p-3 text-white rounded">
                                            Email hoặc mật khẩu không chính xác. <br> Vui lòng thử lại!
                                        </div>
                                    </div>
                                @endif

                                <button class="common_btn" type="submit">Đăng nhập</button>
                                {{-- <p class="social_text">Hoặc qua tài khoản mạng xã hội</p>
                                <ul class="wsus__login_link">
                                    <li><a href="#"><i class="fab fa-google"></i></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                </ul> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
