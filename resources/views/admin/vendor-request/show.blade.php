@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Người Dùng</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Người Dùng</a></div>
                <div class="breadcrumb-item"><a href="#">Gian Hàng Đang Chờ Duyệt</a></div>
            </div>
        </div>

        <a href="{{ route('admin.vendor-requests.index') }}">
            < Quay lại</a>
                <div class="section-body">
                    <h2 class="section-title">Gian Hàng Đang Chờ Duyệt: {{ $vendor->name }}</span>
                    </h2>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <h6 class="text-primary">Hình ảnh đại diện của gian hàng:</h6>
                                        <img src="{{ asset($vendor->banner) }}" alt="" width="200px">
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div>
                                                <h6 class="text-primary">Tên chủ gian hàng:</h6>
                                                <p>{{ $vendor->user->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div>
                                                <h6 class="text-primary">Tên gian hàng:</h6>
                                                <p>{{ $vendor->name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div>
                                                <h6 class="text-primary">Số điện thoại gian hàng:</h6>
                                                <p>{{ $vendor->phone }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-md-4">
                                            <div>
                                                <h6 class="text-primary">Email gian hàng:</h6>
                                                <p>{{ $vendor->user->email }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div>
                                                <h6 class="text-primary">Địa chỉ gian hàng:</h6>
                                                <p>{{ $vendor->address }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-12">

                                            <div>
                                                <h6 class="text-primary">Mô tả gian hàng:</h6>
                                                <p>{!! $vendor->description !!}</p>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row mt-3">
                                        <div class="col-4">
                                            <h6 class="text-primary">Lựa chọn xét duyệt</h6>
                                            <form action="{{ route('admin.vendor-requests.change-status', $vendor->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')

                                                <select name="status" id="" class="form-control">
                                                    <option {{ $vendor->status == 0 ? 'selected' : '' }} value="0">Đang
                                                        chờ
                                                        xét
                                                        duyệt</option>
                                                    <option {{ $vendor->status == 1 ? 'selected' : '' }} value="1">Xác
                                                        nhận
                                                        xét
                                                        duyệt</option>
                                                </select>

                                                <button type="submit" class="btn btn-primary mt-3">Xác nhận</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                </div>
    </section>
@endsection
