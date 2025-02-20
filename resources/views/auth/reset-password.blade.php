@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Đặt lại mật khẩu
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
                        <h4>Đặt lại mật khẩu</h4>
                        <ul>
                            <li><a href="#">Đăng ký / Đăng Nhập</a></li>
                            <li><a href="#">Đặt lại mật khẩu</a></li>
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
                              CHANGE PASSWORD START
                            ==============================-->
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-md-10 col-lg-7 m-auto">
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="wsus__change_password">
                            <h4>Đặt lại mật khẩu</h4>
                            <div class="wsus__single_pass">
                                <label>Email</label>
                                <input id="email" type="email" name="email"
                                    value="{{ old('email', $request->email) }}" placeholder="Nhập email">
                                @if ($errors->has('email'))
                                    <p class="text-danger d-flex justify-content-end mt-1">
                                        {{ $errors->first('email') }}
                                    </p>
                                @endif
                            </div>

                            <div class="wsus__single_pass">
                                <label>Mật khẩu mới</label>
                                <input id="password" type="password" name="password" placeholder="Nhập mật khẩu mới">
                                @if ($errors->has('password'))
                                    <p class="text-danger d-flex justify-content-end mt-1">
                                        {{ $errors->first('password') }}
                                    </p>
                                @endif
                            </div>

                            <div class="wsus__single_pass">
                                <label>Xác nhận mật khẩu</label>
                                <input id="password_confirmation" type="password" name="password_confirmation"
                                    placeholder="Nhập lại mật khẩu">
                                @if ($errors->has('password_confirmation'))
                                    <p class="text-danger d-flex justify-content-end mt-1">
                                        {{ $errors->first('password_confirmation') }}
                                    </p>
                                @endif
                            </div>

                            {{-- @if ($errors->any())
                                <div class="mb-3">
                                    <div class="bg-danger p-3 text-white rounded">
                                        Email hoặc mật khẩu không chính xác. <br> Vui lòng thử lại!
                                    </div>
                                </div>
                            @endif --}}

                            <button class="common_btn" type="submit">Xác nhận</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--============================
                              CHANGE PASSWORD END
                            ==============================-->
@endsection
