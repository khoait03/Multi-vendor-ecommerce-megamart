@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Quên mật khẩu
@endsection

@section('content')
    <!--============================
                                                                BREADCRUMB START
                                                            ==============================-->
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Quên mật khẩu</h4>
                        <ul>
                            <li><a href="#">Đăng ký / Đăng nhập</a></li>
                            <li><a href="#">Quên mật khẩu</a></li>
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
                                                              FORGET PASSWORD START
                                                            ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__forget_area">
                        <span class="qiestion_icon"><i class="fal fa-question-circle"></i></span>
                        <h4>Quên mật khẩu ?</h4>
                        <p>Vui lòng nhập email đã đăng ký tài khoản tại <span>MegaMart</span></p>
                        <div class="wsus__login">
                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="wsus__login_input">
                                    <i class="fal fa-envelope"></i>
                                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                                        placeholder="Email của bạn">
                                </div>

                                @if ($errors->any())
                                    <div class="mb-3">
                                        <div class="bg-danger p-3 text-white rounded">
                                            Email không chính xác hoặc không tồn tại. <br> Vui lòng thử lại!
                                        </div>
                                    </div>
                                @endif

                                @if (session('status'))
                                    <div class="mb-3">
                                        <div class="bg-success p-3 text-white rounded">
                                            Chúng tôi đã gửi email đường link khôi phục mật khẩu. <br> Vui lòng kiểm tra
                                            Email!
                                        </div>
                                    </div>
                                @endif

                                <button class="common_btn" type="submit">Xác nhận</button>
                            </form>
                        </div>
                        <a class="see_btn mt-4" href="{{ route('login') }}">Quay về đăng nhập</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                                                              FORGET PASSWORD END
                                                            ==============================-->
@endsection
