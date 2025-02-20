@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian hàng | Thanh toán
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="far fa-coins"></i> Quản lý thanh toán</h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area wsus__dashboard">
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <p class="h5 fw-bold text-primary">Thống kê</p>
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-6 col-md-4">
                                <div class="wsus__dashboard_item blue" href="dsahboard_profile.html">
                                    <i class="far fa-money-bill"></i>
                                    <p>Số tiền có thể rút</p>
                                    <h4 style="color: #fff">{{ formatMoney($withdrawBalance) }}</h4>
                                </div>
                            </div>
                            <div class="col-xl-4 col-6 col-md-4">
                                <div class="wsus__dashboard_item orange" href="dsahboard_profile.html">
                                    <i class="far fa-money-bill"></i>
                                    <p>Số tiền đang xử lý</p>
                                    <h4 style="color: #fff">{{ formatMoney($pendingAmount) }}</h4>
                                </div>
                            </div>
                            <div class="col-xl-4 col-6 col-md-4">
                                <div class="wsus__dashboard_item green" href="dsahboard_profile.html">
                                    <i class="far fa-money-bill"></i>
                                    <p>Số tiền rút thành công</p>
                                    <h4 style="color: #fff">{{ formatMoney($paidAmount) }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wsus__dash_pro_area mt-3">
                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <p class="h5 fw-bold text-primary">Thông tin thanh toán</p>
                        </div>
                        <form action="{{ route('vendor.withdraw.add-info') }}" method="POST">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="mb-2 fw-bold">Tên ngân hàng</label>
                                <select class="form-control" name="bank_name" id="">
                                    <option value="">- - Chọn tên ngân hàng - -</option>
                                    <option {{ @$withdrawInfo->bank_name == 'Sacombank' ? 'selected' : '' }}
                                        value="Sacombank">
                                        Sacombank</option>
                                    <option {{ @$withdrawInfo->bank_name == 'Agribank' ? 'selected' : '' }}
                                        value="Agribank">
                                        Agribank</option>
                                    <option {{ @$withdrawInfo->bank_name == 'TPBank' ? 'selected' : '' }} value="TPBank">
                                        TPBank
                                    </option>
                                    <option {{ @$withdrawInfo->bank_name == 'ViettinBank' ? 'selected' : '' }}
                                        value="ViettinBank">
                                        ViettinBank</option>
                                    <option {{ @$withdrawInfo->bank_name == 'MBBank' ? 'selected' : '' }} value="MBBank">
                                        MBBank
                                    </option>
                                    <option {{ @$withdrawInfo->bank_name == 'Techcombank' ? 'selected' : '' }}
                                        value="Techcombank">TechcomBank</option>
                                    <option {{ @$withdrawInfo->bank_name == 'ACB' ? 'selected' : '' }} value="ACB">ACB
                                    </option>
                                </select>
                                @if ($errors->has('bank_name'))
                                    <p class="text-danger">{{ $errors->first('bank_name') }}</p>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2 fw-bold">Số tài khoản ngân hàng</label>
                                <input type="text" class="form-control" name="account_number"
                                    value="{{ old('account_number', @$withdrawInfo->account_number) }}">
                                @if ($errors->has('account_number'))
                                    <p class="text-danger">{{ $errors->first('account_number') }}</p>
                                @endif
                            </div>
                            <div class="form-group mb-3">
                                <label class="mb-2 fw-bold">Tên chủ tài khoản ngân hàng</label>
                                <input type="text" class="form-control" name="account_name"
                                    value="{{ old('account_name', @$withdrawInfo->account_name) }}">
                                @if ($errors->has('account_name'))
                                    <p class="text-danger">{{ $errors->first('account_name') }}</p>
                                @endif
                            </div>
                            <button class="btn btn-primary">Lưu lại</button>
                        </form>
                    </div>
                    <div class="wsus__dash_pro_area mt-3">

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <p class="h5 fw-bold text-primary">Danh sách yêu cầu thanh toán</p>
                            @if ($withdrawInfo)
                                <a href="{{ route('vendor.withdraw.create') }}" class="btn btn-primary">+ Tạo yêu cầu thanh
                                    toán</a>
                            @endif
                        </div>

                        <div class="table-responsive">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <td class="text-center font-bold">STT</td>
                                        <th style="text-align: left">Id</th>
                                        <th style="text-align: left">Mã giao dịch</th>
                                        <th style="text-align: left">Phương thức rút tiền</th>
                                        <th style="text-align: left">Số tiền yêu cầu rút</th>
                                        <th style="text-align: left">Số tiền thực nhận</th>
                                        <th style="text-align: left">Số tiền phí của hệ thống</th>
                                        <th>Trạng thái</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($withdraws as $key => $withdraw)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td style="text-align: left">{{ $withdraw->id }}</td>
                                            <td style="text-align: left">{{ $withdraw->request_id }}</td>
                                            <td style="text-align: left">{{ $withdraw->method }}</td>
                                            <td style="text-align: left">{{ formatMoney($withdraw->total_amount) }}</td>
                                            <td style="text-align: left">{{ formatMoney($withdraw->withdraw_amount) }}
                                            </td>
                                            <td style="text-align: left">{{ formatMoney($withdraw->withdraw_charge) }}
                                            </td>
                                            <td>{{ $withdraw->status == 'pending' ? 'Đang xử lý' : ($withdraw->status == 'paid' ? 'Đã thanh toán' : 'Bị huỷ') }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ route('vendor.withdraw.detail', $withdraw->id) }}"
                                                        class='btn btn-primary mr-2'>
                                                        <i class='far fa-eye'></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
