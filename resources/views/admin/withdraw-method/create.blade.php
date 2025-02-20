@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Rút Tiền</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Rút Tiền</a></div>
                <div class="breadcrumb-item"><a href="#">Phương Thức Rút Tiền</a></div>

            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.withdraw-method.index') }}">
                < Quay lại</a>
                    <h2 class="section-title">Phương Thức Rút Tiền</h2>
                    <p class="section-lead">Quản lý danh sách phương thức rút tiền trong hệ thống.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Tạo mới phương thức rút tiền</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.withdraw-method.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label>Tên phương thức</label>
                                            <input type="text" class="form-control" name="name" placeholder=""
                                                value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Số tiền tối thiểu (VNĐ)</label>
                                            <input type="number" class="form-control" name="minimum_amount" placeholder=""
                                                value="{{ old('minimum_amount') }}">
                                            @if ($errors->has('minimum_amount'))
                                                <p class="text-danger">{{ $errors->first('minimum_amount') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Số tiền tối đa (VNĐ)</label>
                                            <input type="number" class="form-control" name="maximum_amount" placeholder=""
                                                value="{{ old('maximum_amount') }}">
                                            @if ($errors->has('maximum_amount'))
                                                <p class="text-danger">{{ $errors->first('maximum_amount') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Phí rút tiền (%)</label>
                                            <input type="number" class="form-control" name="withdraw_charge" placeholder=""
                                                value="{{ old('withdraw_charge') }}">
                                            @if ($errors->has('withdraw_charge'))
                                                <p class="text-danger">{{ $errors->first('withdraw_charge') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả</label>
                                            <textarea name="description" class="editor"></textarea>
                                            @if ($errors->has('description'))
                                                <p class="text-danger">{{ $errors->first('description') }}</p>
                                            @endif
                                        </div>

                                        <button type="submit" class="btn btn-primary">Tạo mới</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>

        </div>
    </section>
@endsection
