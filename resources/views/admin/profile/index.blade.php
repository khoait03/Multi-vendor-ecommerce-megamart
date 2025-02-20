@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Tài khoản</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản trị</a></div>
                <div class="breadcrumb-item">Tài khoản</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Xin chào, Admin</h2>
            <p class="section-lead">
                Bạn có thể cập nhật thông tin tài khoản tại đây.
            </p>

            <div class="row mt-sm-4">
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form action="{{ route('admin.profile.update') }}" method="post" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @csrf

                            <div class="card-header">
                                <h4>Cập nhật tài khoản</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Ảnh đại diện</label>
                                        <br>
                                        <img src="{{ asset(Auth::user()->image) }}" width="100px"
                                            class="p-2 border rounded" alt="">
                                        <input type="file" class="form-control mt-2" name="image">
                                        @error('image')
                                            <p class="text-danger">{{ $errors->first('image') }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Tên người dùng</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name', Auth::user()->name) }}">
                                        @error('name')
                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                        @enderror
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email"
                                            value="{{ old('email', Auth::user()->email) }}">
                                        @if ($errors->has('email'))
                                            <p class="text-danger">{{ $errors->first('email') }}</p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary"
                                    onclick="event.preventDefault();
                                this.closest('form').submit();">Lưu
                                    thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="card">
                        <form action="{{ route('admin.password.update') }}" method="post" class="needs-validation"
                            novalidate="">
                            @csrf

                            <div class="card-header">
                                <h4>Cập nhật mật khẩu</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Nhập mật khẩu hiện tại</label>
                                        <input type="password" class="form-control" name="current_password"
                                            placeholder="********">
                                        @error('current_password')
                                            <p class="text-danger">{{ $errors->first('current_password') }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Nhập mật khẩu mới</label>
                                        <input type="password" class="form-control" name="password" placeholder="********">
                                        @if ($errors->has('password'))
                                            <p class="text-danger">{{ $errors->first('password') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label>Xác nhận mật khẩu mới</label>
                                        <input type="password" class="form-control" name="password_confirmation"
                                            placeholder="********">
                                        @if ($errors->has('password_confirmation'))
                                            <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary"
                                    onclick="event.preventDefault();
                                this.closest('form').submit();">Lưu
                                    thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
