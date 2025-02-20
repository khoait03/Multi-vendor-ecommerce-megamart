@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Bán Hàng</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Bán Hàng</a></div>
                <div class="breadcrumb-item"><a href="#">Thông Tin Vận Chuyển</a></div>
            </div>
        </div>

        <div class="section-body">
            <a href="{{ route('admin.shipping-rule.index') }}">
                < Quay lại</a>
                    <h2 class="section-title">Thông Tin Vận Chuyển</h2>
                    <p class="section-lead">Tuỳ chỉnh thông tin vận chuyển của hệ thống.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Tạo mới thông tin vận chuyển</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.shipping-rule.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label>Tên vận chuyển</label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Ví dụ: Vận chuyển thường, Vận chuyển hoả tốc,..."
                                                value="{{ old('name') }}">
                                            @if ($errors->has('name'))
                                                <p class="text-danger">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Loại vận chuyển</label>
                                            <select name="type" id="" class="form-control shipping-type">
                                                <option value="flat_cost">Giá cố định</option>
                                                <option value="min_cost">Theo giá trị tối thiểu của đơn hàng</option>
                                            </select>
                                            @if ($errors->has('type'))
                                                <p class="text-danger">{{ $errors->first('type') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group min_cost d-none">
                                            <label>Giá trị đơn hàng tối thiểu (VNĐ)</label>
                                            <input type="number" class="form-control" name="min_cost"
                                                placeholder="Ví dụ: 0, 100.000,..." value="{{ old('min_cost') }}">
                                            @if ($errors->has('min_cost'))
                                                <p class="text-danger">{{ $errors->first('min_cost') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Phí vận chuyển</label>
                                            <input type="number" class="form-control" name="cost"
                                                placeholder="Ví dụ: 0, 50.000,..." value="{{ old('cost') }}">
                                            @if ($errors->has('cost'))
                                                <p class="text-danger">{{ $errors->first('cost') }}</p>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label>Trạng thái</label>
                                            <select name="status" id="" class="form-control">
                                                <option value="1">Hiển thị</option>
                                                <option value="0">Không hiển thị</option>
                                            </select>
                                            @if ($errors->has('status'))
                                                <p class="text-danger">{{ $errors->first('status') }}</p>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $("body").on("change", ".shipping-type", function() {
                let value = $(this).val();

                if (value !== "min_cost") {
                    $(".min_cost").addClass("d-none");
                } else {
                    $(".min_cost").removeClass("d-none");
                }
            })
        })
    </script>
@endpush
