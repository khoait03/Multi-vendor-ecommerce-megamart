@extends('frontend.dashboard.layouts.master')

@section('title')
    {{ $settings->site_name }} | Khách hàng | Tài khoản
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="far fa-user"></i> Thông tin tài khoản</h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">

                        <div class="row">
                            <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <h5 class="text-primary fw-bold mb-3">Thông tin cơ bản</h5>

                                <div class="col-xl-9">
                                    <div class="row">
                                        <div class="col-xl-6 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-group mb-3">
                                                    <label class="mb-2 fw-bold h6">Tên người dùng</label>
                                                    <input name="name" class="form-control" type="text"
                                                        placeholder="Họ và tên"
                                                        value="{{ old('name', Auth::user()->name) }}">
                                                </div>
                                                @if ($errors->has('name'))
                                                    <p class="text-danger d-flex justify-content-end mt-1">
                                                        {{ $errors->first('name') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-group mb-3">
                                                    <label class="mb-2 fw-bold h6">Điện thoại</label>
                                                    <input name="phone" class="form-control" type="text"
                                                        placeholder="Số điện thoại"
                                                        value="{{ old('phone', Auth::user()->phone) }}">
                                                </div>
                                                @if ($errors->has('phone'))
                                                    <p class="text-danger d-flex justify-content-end mt-1">
                                                        {{ $errors->first('phone') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-group mb-3">
                                                    <label class="mb-2 fw-bold h6">Email</label>
                                                    <input name="email" class="form-control" type="email"
                                                        placeholder="Email" value="{{ old('email', Auth::user()->email) }}">
                                                </div>
                                                @if ($errors->has('email'))
                                                    <p class="text-danger d-flex justify-content-end mt-1">
                                                        {{ $errors->first('email') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-2 col-sm-6 col-md-6">
                                        <div class="wsus__dash_pro_img">
                                            <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('user-default.jpg') }}"
                                                alt="img" class="img-fluid w-100">
                                            <input type="file" name="image">
                                        </div>
                                        @if ($errors->has('image'))
                                            <p class="text-danger d-flex justify-content-end mt-1">
                                                {{ $errors->first('image') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    <button class="common_btn mb-4 mt-4 flex justify-end" type="submit">Lưu thay
                                        đổi</button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('user.profile.update.password') }}">
                                @csrf

                                <h5 class="text-primary fw-bold my-3">Thay đổi mật khẩu</h5>

                                <div class="wsus__dash_pass_change mt-2">
                                    <div class="row">
                                        <div class="col-xl-4 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-group mb-3">
                                                    <label class="mb-2 fw-bold h6">Mật khẩu hiện tại</label>
                                                    <input name="current_password" class="form-control" type="password"
                                                        placeholder="********">
                                                </div>
                                                @if ($errors->has('current_password'))
                                                    <p class="text-danger d-flex justify-content-end mt-1">
                                                        {{ $errors->first('current_password') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-group mb-3">
                                                    <label class="mb-2 fw-bold h6">Mật khẩu mới</label>
                                                    <input name="password" class="form-control" type="password"
                                                        placeholder="********">
                                                </div>
                                                @if ($errors->has('password'))
                                                    <p class="text-danger d-flex justify-content-end mt-1">
                                                        {{ $errors->first('password') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-4">
                                            <div class="mb-3">
                                                <div class="form-group mb-3">
                                                    <label class="mb-2 fw-bold h6">Xác nhận mật khẩu mới</label>
                                                    <input name="password_confirmation" class="form-control" type="password"
                                                        placeholder="********">
                                                </div>
                                                @if ($errors->has('password_confirmation'))
                                                    <p class="text-danger d-flex justify-content-end mt-1">
                                                        {{ $errors->first('password_confirmation') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-xl-12">
                                            <button class="common_btn mt-4" type="submit">Lưu thay
                                                đổi</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
