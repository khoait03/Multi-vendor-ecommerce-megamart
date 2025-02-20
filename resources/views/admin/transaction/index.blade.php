@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Đơn Hàng</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Đơn Hàng</a></div>
                <div class="breadcrumb-item"><a href="#">Tất Cả Thanh Toán</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tất Cả Thanh Toán</h2>
            <p class="section-lead">Danh sách tất cả thanh toán đã thực hiện với hệ thống.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách tất cả thanh toán</h4>
                            {{-- <div class="card-header-action">
                                <a href="{{ route('admin.child-category.create') }}" class="btn btn-primary mb-3">+ Thêm
                                    mới</a>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td class="text-center font-bold">STT</td>
                                            <th style="text-align: left">Id</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Mã thanh toán</th>
                                            <th style="text-align: center">Phương thức thanh toán</th>
                                            <th style="text-align: center">Tổng tiền đơn hàng</th>
                                            <th style="text-align: center">Tổng tiền đã thanh toán</th>
                                            <th style="text-align: center">Trạng thái</th>
                                            <th style="text-align: center">Thời gian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $key => $transaction)
                                            <tr>
                                                <td class="text-center font-bold">{{ $key + 1 }}</td>
                                                <td style="text-align: left">{{ $transaction->id }}</td>
                                                <td>{{ $transaction->order->invoice_id }}</td>
                                                <td>{{ $transaction->transaction_id }}</td>
                                                <td style="text-align: center">{{ $transaction->payment_method }}</td>
                                                <td style="text-align: center">{{ formatMoney($transaction->amount) }}
                                                </td>
                                                <td style="text-align: center">
                                                    @if ($transaction->payment_method == 'COD' || $transaction->payment_method == 'VNPay')
                                                        {{ formatMoney($transaction->amount_real_currency) }}
                                                    @else
                                                        ${{ $transaction->amount_real_currency }}
                                                    @endif
                                                </td>
                                                <td style="text-align: center">
                                                    {{ $transaction->order->payment_status == 1 ? 'Thành công' : 'Không thành công' }}
                                                </td>
                                                <td style="text-align: center">{{ $transaction->created_at }}</td>
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
