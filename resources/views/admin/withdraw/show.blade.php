@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Rút Tiền</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Rút Tiền</a></div>
                <div class="breadcrumb-item"><a href="#">Yêu Cầu Rút Tiền</a></div>
            </div>
        </div>

        <a href="{{ route('admin.withdraw-list.index') }}">
            < Quay lại</a>
                <div class="section-body">
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-9">
                                            <table class="table">
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
                                                        <td>{{ ($request->withdraw_charge / $request->total_amount) * 100 }}%
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Hoa hồng của hệ thống thành tiền:</b></td>
                                                        <td>{{ formatMoney($request->withdraw_charge) }}</td>
                                                    </tr>
                                                    <tr style="background-color: #dcdada">
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
                                                    <tr style="background-color: #dcdada">
                                                        <td><b>Trạng thái giao dịch:</b></td>
                                                        <td>{{ $request->status == 'pending' ? 'Đang xử lý' : ($request->status == 'paid' ? 'Đã thanh toán' : 'Bị huỷ') }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-md-3">

                                            <h6 class="text-primary mb-3">Tuỳ chỉnh</h6>
                                            <form action="{{ route('admin.withdraw.update', $request->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label>Trạng thái giao dịch</label>
                                                    <select name="status" id="" class="form-control">
                                                        <option {{ $request->status == 'pending' ? 'selected' : '' }}
                                                            value="pending">Đang xử lý</option>
                                                        <option {{ $request->status == 'paid' ? 'selected' : '' }}
                                                            value="paid">Đã
                                                            thanh toán</option>
                                                        <option {{ $request->status == 'deny' ? 'selected' : '' }}
                                                            value="deny">Từ
                                                            chối</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Hình ảnh giao dịch</label>
                                                    <br>
                                                    @if ($request->status == 'paid' && $request->image)
                                                        <img src="{{ asset($request->image) }}" alt=""
                                                            width="300px">
                                                    @endif
                                                    <input type="file" class="form-control mt-3" name="image">
                                                    @if ($errors->has('image'))
                                                        <p class="text-danger">{{ $errors->first('image') }}</p>
                                                    @endif
                                                </div>

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
