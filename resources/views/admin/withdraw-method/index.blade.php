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
            <h2 class="section-title">Phương Thức Rút Tiền</h2>
            <p class="section-lead">Quản lý danh sách phương thức rút tiền trong hệ thống.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách phương thức rút tiền</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.withdraw-method.create') }}" class="btn btn-primary mb-3">+ Thêm
                                    mới</a>
                            </div>
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
                                            <th style="text-align: left">STT</th>
                                            <th style="text-align: left">Id</th>
                                            <th style="text-align: left">Tên phương thức</th>
                                            <th style="text-align: left">Số tiền tối thiểu</th>
                                            <th style="text-align: left">Số tiền tối đa</th>
                                            <th style="text-align: left">Phí rút tiền</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($withdrawMethods as $key => $withdrawMethod)
                                            <tr>
                                                <td class="text-center font-bold">{{ $key + 1 }}</td>
                                                <td style="text-align: left">{{ $withdrawMethod->id }}</td>
                                                <td style="text-align: left">{{ $withdrawMethod->name }}</td>
                                                <td style="text-align: left">
                                                    {{ formatMoney($withdrawMethod->minimum_amount) }}</td>
                                                <td style="text-align: left">
                                                    {{ formatMoney($withdrawMethod->maximum_amount) }}</td>
                                                <td style="text-align: left">{{ $withdrawMethod->withdraw_charge }}%</td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <a href="{{ route('admin.withdraw-method.edit', $withdrawMethod->id) }}"
                                                            class='btn btn-primary mr-2'>
                                                            <i class='fas fa-pen'></i>
                                                        </a>
                                                        <a href="{{ route('admin.withdraw-method.destroy', $withdrawMethod->id) }}"
                                                            class='btn btn-danger mr-2 delete-item'>
                                                            <i class='fas fa-trash'></i>
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
