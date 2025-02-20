@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Đăng ký
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
                                <a class="nav-link text-center" href="{{ route('login') }}">ĐĂNG NHẬP</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active">ĐĂNG KÝ</button>
                            </li>
                        </ul>
                        <div>
                            <p class="text-center">Đăng ký tài khoản ngay để có thể tiến hành mua sắm và tận hưởng tất cả
                                những quyền lợi của
                                MegaMart nhé!</p>
                        </div>
                        <div class="wsus__login">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div>
                                    <div class="wsus__login_input">
                                        <i class="fas fa-user-tie"></i>
                                        <input id="name" type="text" name="name" placeholder="Họ và tên"
                                            value="{{ old('name') }}">
                                        <br>
                                    </div>
                                    @if ($errors->has('name'))
                                        <p class="text-danger d-flex justify-content-end mt-1">{{ $errors->first('name') }}
                                        </p>
                                    @endif
                                </div>

                                <div>
                                    <div class="wsus__login_input">
                                        <i class="far fa-envelope"></i>
                                        <input id="email" type="text" name="email" placeholder="Email"
                                            value="{{ old('email') }}">
                                    </div>
                                    @if ($errors->has('email'))
                                        <p class="text-danger d-flex justify-content-end mt-1">{{ $errors->first('email') }}
                                        </p>
                                    @endif
                                </div>

                                <div>
                                    <div class="wsus__login_input">
                                        <i class="fas fa-key"></i>
                                        <input id="password" type="password" name="password" placeholder="Mật khẩu">
                                    </div>
                                    @if ($errors->has('password'))
                                        <p class="text-danger d-flex justify-content-end mt-1">
                                            {{ $errors->first('password') }}
                                        </p>
                                    @endif
                                </div>

                                <div>
                                    <div class="wsus__login_input">
                                        <i class="fas fa-key"></i>
                                        <input id="password_confirmation" type="password" name="password_confirmation"
                                            placeholder="Nhập lại mật khẩu">
                                    </div>
                                    @if ($errors->has('password_confirmation'))
                                        <p class="text-danger d-flex justify-content-end mt-1">
                                            {{ $errors->first('password_confirmation') }}
                                        </p>
                                    @endif
                                </div>

                                <div>
                                    <div class="wsus__login_input d-flex align-items-center">
                                        <input class="form-check-input mr-3" id="password_confirmation" type="checkbox"
                                            style="width: 20px; height: 20px;" checked required>
                                        <p style="margin-left: 20px; font-size: 14px">Bằng việc đăng kí, bạn đã đồng ý với
                                            MegaMart về <a href="#" style="text-decoration: underline"
                                                class="text-primary">
                                                Điều
                                                khoản dịch
                                                vụ
                                            </a> & <a href="#" style="text-decoration: underline"
                                                class="text-primary">Chính sách bảo
                                                mật</a> </p>
                                    </div>
                                </div>

                                <button class="common_btn mt-4" type="submit">Đăng ký</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
