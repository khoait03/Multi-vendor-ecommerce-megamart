@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian hàng | Sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <a href="{{ route('vendor.withdraw.index') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-caret-left"></i> Quay lại</a>
                <h3><i class="far fa-plus"></i> Thông tin giao dịch thanh toán</h3>
                <div class="wsus__dashboard_profile">
                    <div class="row gap-3">
                        <div class="wsus__dash_pro_area ">
                            <div class="row">
                                <div class="card-body">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td><b>Mã giao dịch:</b></td>
                                                <td>{{ $request->request_id }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Thời gian tạo yêu cầu:</b></td>
                                                <td>{{ $request->created_at }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Phương thức rút tiền:</b></td>
                                                <td>{{ $request->method }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Số tiền yêu cầu rút:</b></td>
                                                <td>{{ formatMoney($request->total_amount) }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Hoa hồng của hệ thống:</b></td>
                                                <td>{{ ($request->withdraw_charge / $request->total_amount) * 100 }}%</td>
                                            </tr>
                                            <tr>
                                                <td><b>Hoa hồng của hệ thống thành tiền:</b></td>
                                                <td>{{ formatMoney($request->withdraw_charge) }}</td>
                                            </tr>
                                            <tr style="background-color: #ccc">
                                                <td><b>Số tiền thực nhận:</b></td>
                                                <td>{{ formatMoney($request->withdraw_amount) }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Tên ngân hàng thanh toán:</b></td>
                                                <td>{{ $request->bank_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Số tài khoản ngân hàng:</b></td>
                                                <td>{{ $request->account_number }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Tên chủ tài khoản ngân hàng:</b></td>
                                                <td>{{ $request->account_name }}</td>
                                            </tr>
                                            <tr style="background-color: #ccc">
                                                <td><b>Trạng thái giao dịch:</b></td>
                                                <td>{{ $request->status == 'pending' ? 'Đang xử lý' : ($request->status == 'paid' ? 'Đã thanh toán' : 'Bị huỷ') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <h5 class="text-primary fw-bold mt-5 mb-3">Hình ảnh giao dịch</h5>
                                    @if ($request->status == 'paid' && $request->image)
                                        <img src="{{ asset($request->image) }}" alt="" width="300px">
                                    @endif
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
