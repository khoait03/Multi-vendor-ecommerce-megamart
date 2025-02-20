@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian hàng | Thanh toán
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <a href="{{ route('vendor.withdraw.index') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-caret-left"></i> Quay lại</a>
                <h3><i class="far fa-plus"></i> Tạo yêu cầu thanh toán</h3>
                <div class="wsus__dashboard_profile">
                    <div class="row gap-3">
                        <div class="wsus__dash_pro_area col-md-7">
                            <div class="row">
                                <div class="card-body">
                                    <form action="{{ route('vendor.withdraw.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold">Phương thức thanh toán</label>
                                            <input type="text" disabled class="form-control" name="method"
                                                value="{{ $method->name }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold">Tên ngân hàng</label>
                                            <input type="text" disabled class="form-control" name="bank_name"
                                                value="{{ $withdrawInfo->bank_name }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold">Số tài khoản ngân hàng</label>
                                            <input type="text" disabled class="form-control" name="account_number"
                                                value="{{ $withdrawInfo->account_number }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold">Tên chủ tài khoản ngân hàng</label>
                                            <input type="text" disabled class="form-control" name="account_name"
                                                value="{{ $withdrawInfo->account_name }}">
                                        </div>
                                        {{-- <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold">Phương thức rút tiền</label>
                                            <select name="method" id="method" class="form-control">
                                                <option value="">- - Chọn phương thức - -</option>

                                                @foreach ($methods as $method)
                                                    <option {{ old('method') == $method->id ? 'selected' : '' }}
                                                        value="{{ $method->id }}">{{ $method->name }}</option>
                                                @endforeach

                                            </select>
                                            @if ($errors->has('method'))
                                                <p class="text-danger">{{ $errors->first('method') }}</p>
                                            @endif
                                        </div> --}}

                                        <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold">Số tiền muốn rút</label>
                                            <input type="number" class="form-control" name="amount"
                                                value="{{ old('amount') }}">
                                            @if ($errors->has('amount'))
                                                <p class="text-danger">{{ $errors->first('amount') }}</p>
                                            @endif
                                        </div>

                                        {{-- <div class="form-group mb-3">
                                            <label class="mb-2 fw-bold">Ghi chú (Nếu có)</label>
                                            <textarea name="account_info" class="summernote">{{ old('account_info') }}</textarea>
                                            @if ($errors->has('account_info'))
                                                <p class="text-danger">{{ $errors->first('account_info') }}</p>
                                            @endif
                                        </div> --}}

                                        <input type="hidden" class="form-control" name="bank_name"
                                            value="{{ $withdrawInfo->bank_name }}">
                                        <input type="hidden" class="form-control" name="account_number"
                                            value="{{ $withdrawInfo->account_number }}">
                                        <input type="hidden" class="form-control" name="account_name"
                                            value="{{ $withdrawInfo->account_name }}">
                                        <input type="hidden" class="form-control" name="method"
                                            value="{{ $method->id }}">

                                        <button type="submit" class="btn btn-primary">Tạo mới</button>
                                    </form>
                                </div>

                            </div>

                        </div>
                        <div class="wsus__dash_pro_area col-md-4 account-info d-flex flex-column gap-3">
                            <h5 class="">
                                <div class="text-primary fw-bold">Số tiền tối thiểu có thể rút:</div>
                                <span class="fw-bold">{{ formatMoney($withdrawMethod->minimum_amount) }}</span>
                            </h5>
                            <h5 class="">
                                <div class="text-primary fw-bold">Số tiền tối đa có thể rút:</div>
                                <span
                                    class="fw-bold">{{ $withdrawBalance <= $withdrawMethod->maximum_amount ? formatMoney($withdrawBalance) : formatMoney($withdrawMethod->maximum_amount) }}</span>
                            </h5>
                            <h5 class="d-flex gap-2 pb-3 border-bottom">
                                <div class="text-primary fw-bold">Phí rút tiền:</div>
                                <span class="fw-bold">{{ $withdrawMethod->withdraw_charge }}%</span>
                            </h5>
                            <div class="pt-3">{!! $withdrawMethod->description !!}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @push('scripts')
    <script>
        $(document).ready(function() {
            function customFormatNumber(number) {
                return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",").replace(".", ",");
            }

            $("#method").on("change", function() {
                let method_id = $(this).val()
                $.ajax({
                    url: "{{ route('vendor.withdraw.show', ':id') }}".replace(":id", method_id),
                    method: "GET",
                    success: function(data) {
                        $(".account-info").html(`
                      <h4 class="d-flex gap-2">
                          <div class="text-primary fw-bold">Số tiền tối thiểu có thể rút:</div> ${customFormatNumber(data.minimum_amount)}đ
                      </h4>
                      <h4 class="d-flex gap-2">
                          <div class="text-primary fw-bold">Số tiền tối đa có thể rút:</div> ${customFormatNumber(data.maximum_amount)}đ
                      </h4>
                      <h4 class="d-flex gap-2 pb-3 border-bottom">
                          <div class="text-primary fw-bold">Phí rút tiền:</div> ${data.withdraw_charge}%
                      </h4>
                      <div class="pt-3">${data.description}</div>
                      `)
                    },
                    error: function(data) {}
                })
            })
        })
    </script>
@endpush --}}
