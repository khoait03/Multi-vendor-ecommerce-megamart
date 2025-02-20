@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Người Dùng</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Người Dùng</a></div>
                <div class="breadcrumb-item"><a href="#">Gian Hàng Đang Chờ Duyệt</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Gian Hàng Đang Chờ Duyệt</h2>
            <p class="section-lead">Quản lý những gian hàng đã đăng ký và đang chờ duyệt.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách gian hàng</h4>
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
                                            <th>Tên người dùng</th>
                                            <th>Tên gian hàng</th>
                                            <th>Email gian hàng</th>
                                            <th style="text-align: left">Điện thoại gian hàng</th>
                                            <th>Địa chỉ gian hàng</th>
                                            <th>Trạng thái</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendors as $key => $vendor)
                                            <tr>
                                                <td class="text-center font-bold">{{ $key + 1 }}</td>
                                                <td style="text-align: left">{{ $vendor->id }}</td>
                                                <td>{{ $vendor->user->name }}</td>
                                                <td>{{ $vendor->name }}</td>
                                                <td>{{ $vendor->email }}</td>
                                                <td style="text-align: left">{{ $vendor->phone }}</td>
                                                <td>{{ $vendor->address }}</td>
                                                <td>
                                                    {{ $vendor->status == 0 ? 'Đang chờ duyệt' : 'Đã duyệt' }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <a href="{{ route('admin.vendor-requests.show', $vendor->id) }}"
                                                            class='btn btn-primary mr-2'>
                                                            <i class='fas fa-eye'></i>
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
