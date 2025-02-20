@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Khuyến Mãi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Khuyến Mãi</a></div>
                <div class="breadcrumb-item"><a href="#">Danh Mục Cấp 3</a></div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.coupons.index') }}">
                < Quay lại</a>
                    <h2 class="section-title">Mã Giảm Giá</h2>
                    <p class="section-lead">Tuỳ chỉnh mã giảm giá dùng cho đơn hàng.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Cập nhật mã giảm giá</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label>Tên mã giảm giá</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Ví dụ: Giảm giá 50%,..."
                                                value="{{ old('name', $coupon->name) }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Mã giảm giá</label>
                                            <input type="text" class="form-control" name="code"
                                                placeholder="Ví dụ: SALE50,..." value="{{ old('code', $coupon->code) }}">
                                            @if ($errors->has('code'))
                                                <p class="text-danger">{{ $errors->first('code') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Số lượng</label>
                                            <input type="number" class="form-control" name="quantity"
                                                placeholder="Ví dụ: 100,200,..."
                                                value="{{ old('quantity', $coupon->quantity) }}">
                                            @if ($errors->has('quantity'))
                                                <p class="text-danger">{{ $errors->first('quantity') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Số lượt dùng tối đa cho 1 người dùng</label>
                                            <input type="number" class="form-control" name="max_use"
                                                placeholder="Ví dụ: 1,2,..." value="{{ old('max_use', $coupon->max_use) }}">
                                            @if ($errors->has('max_use'))
                                                <p class="text-danger">{{ $errors->first('max_use') }}</p>
                                            @endif
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Thời gian bắt đầu</label>
                                                    <input type="text" name="start_date" class="form-control datepicker"
                                                        value="{{ old('start_date', $coupon->start_date) }}">
                                                    @if ($errors->has('start_date'))
                                                        <p class="text-danger">{{ $errors->first('start_date') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Thời gian kết thúc</label>
                                                    <input type="text" name="end_date" class="form-control datepicker"
                                                        value="{{ old('end_date', $coupon->end_date) }}">
                                                    @if ($errors->has('end_date'))
                                                        <p class="text-danger">{{ $errors->first('end_date') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Loại giảm giá</label>
                                                    <select name="discount_type" id="" class="form-control">
                                                        <option value="">- - Chọn - -</option>
                                                        <option {{ $coupon->discount_type == 'percent' ? 'selected' : '' }}
                                                            value="percent">Giảm theo phần trăm (%)</option>
                                                        <option {{ $coupon->discount_type == 'amount' ? 'selected' : '' }}
                                                            value="amount">Giảm theo số tiền (VNĐ)</option>
                                                    </select>
                                                    @if ($errors->has('discount_type'))
                                                        <p class="text-danger">{{ $errors->first('discount_type') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="form-group">
                                                    <label>Giá trị giảm</label>
                                                    <input type="number" class="form-control" name="discount"
                                                        placeholder="Ví dụ: 100,200,..."
                                                        value="{{ old('discount', $coupon->discount) }}">
                                                    @if ($errors->has('discount'))
                                                        <p class="text-danger">{{ $errors->first('discount') }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select name="status" id="" class="form-control">
                                                <option {{ $coupon->status == 1 ? 'selected' : '' }} value="1">Kích
                                                    hoạt</option>
                                                <option {{ $coupon->status == 0 ? 'selected' : '' }} value="0">Không
                                                    kích hoạt</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <p class="text-danger">{{ $errors->first('status') }}</p>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('input[name="start_date"]').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                locale: {
                    format: 'YYYY-MM-DD HH:mm'
                }
            });
            $('input[name="end_date"]').daterangepicker({
                singleDatePicker: true,
                timePicker: true,
                timePicker24Hour: true,
                locale: {
                    format: 'YYYY-MM-DD HH:mm'
                }
            });
        });
    </script>
@endpush
