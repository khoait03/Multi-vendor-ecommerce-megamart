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

        <div class="section-body">
            <h2 class="section-title">Yêu Cầu Rút Tiền</h2>
            <p class="section-lead">Quản lý những yêu cầu rút tiền đang chờ duyệt của các gian hàng.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách yêu cầu rút tiền</h4>
                            {{-- <div class="card-header-action">
                                <a href="{{ route('admin.child-category.create') }}" class="btn btn-primary mb-3">+ Thêm
                                    mới</a>
                            </div> --}}
                        </div>
                        {{-- <div class="card-body">
                            <div class="table-responsive">
                                {{ $dataTable->table(['class' => 'table nowrap', 'style' => 'width: 100%;']) }}</div>
                        </div> --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td class="text-center font-bold">STT</td>
                                            <th style="text-align: left">Id</th>
                                            <th>Mã giao dịch</th>
                                            <th>Tên gian hàng</th>
                                            <th>Phương thức rút tiền</th>
                                            <th>Số tiền yêu cầu rút</th>
                                            <th style="text-align: left">Số tiền thực nhận</th>
                                            <th>Số tiền phí hệ thống</th>
                                            <th>Trạng thái</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdraws as $key => $withdraw)
                                            <tr>
                                                <td class="text-center font-bold">{{ $key + 1 }}</td>
                                                <td style="text-align: left">{{ $withdraw->id }}</td>
                                                <td style="text-align: left">{{ $withdraw->request_id }}</td>
                                                <td style="text-align: left">{{ $withdraw->vendor->name }}</td>
                                                <td style="text-align: left">{{ $withdraw->method }}</td>
                                                <td style="text-align: left">{{ formatMoney($withdraw->total_amount) }}
                                                </td>
                                                <td style="text-align: left">
                                                    {{ formatMoney($withdraw->withdraw_amount) }}
                                                </td>
                                                <td style="text-align: left">
                                                    {{ formatMoney($withdraw->withdraw_charge) }}
                                                </td>
                                                <td>{{ $withdraw->status == 'pending' ? 'Đang xử lý' : ($withdraw->status == 'paid' ? 'Đã thanh toán' : 'Bị huỷ') }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <a href="{{ route('admin.withdraw.show', $withdraw->id) }}"
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
    </section>
@endsection
