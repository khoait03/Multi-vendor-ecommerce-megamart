@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Người Dùng</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Người Dùng</a></div>
                <div class="breadcrumb-item"><a href="#">Danh Sách Gian Hàng</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Danh Sách Gian Hàng</h2>
            <p class="section-lead">Quản lý danh sách gian hàng trong hệ thống.</p>

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
                                            <td class="text-center font-bold"></td>
                                            <th style="text-align: left">Id</th>
                                            <th style="text-align: left">Ảnh đại diện</th>
                                            <th>Tên chủ gian hàng</th>
                                            <th>Tên gian hàng</th>
                                            <th>Email gian hàng</th>
                                            <th style="text-align: left">Điện thoại gian hàng</th>
                                            <th style="text-align: left">Địa chỉ</th>
                                            <th>Trạng thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($vendors as $key => $vendor)
                                            <tr>
                                                <td class="text-center font-bold"></td>
                                                <td style="text-align: left">{{ $vendor->id }}</td>
                                                <td style="text-align: left">
                                                    <img src="{{ $vendor->vendor->banner ? asset($vendor->vendor->banner) : 'https://static.vecteezy.com/system/resources/previews/019/879/186/non_2x/user-icon-on-transparent-background-free-png.png' }}"
                                                        alt="" width="100px">
                                                </td>
                                                <td>{{ $vendor->name }}</td>
                                                <td>{{ $vendor->vendor->name }}</td>
                                                <td>{{ $vendor->vendor->email }}</td>
                                                <td style="text-align: left">{{ $vendor->vendor->phone }}</td>
                                                <td style="text-align: left">{{ $vendor->vendor->address }}</td>
                                                <td>
                                                    @if ($vendor->role != 'admin')
                                                        @if ($vendor->status == 'active')
                                                            <label class='custom-switch mt-2'>
                                                                <input type='checkbox' checked name='custom-switch-checkbox'
                                                                    data-id='{{ $vendor->id }}'
                                                                    class='custom-switch-input change-status'>
                                                                <span class='custom-switch-indicator'></span>
                                                            </label>
                                                        @else
                                                            <label class='custom-switch mt-2'>
                                                                <input type='checkbox' name='custom-switch-checkbox'
                                                                    data-id='{{ $vendor->id }}'
                                                                    class='custom-switch-input change-status'>
                                                                <span class='custom-switch-indicator'></span>
                                                            </label>
                                                        @endif
                                                    @endif
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

@push('scripts')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}
    <script>
        $(document).ready(function() {
            $("body").on('click', ".change-status", function() {
                let isChecked = $(this).is(":checked")
                let id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.vendor-list.change-status') }}",
                    method: "PUT",
                    data: {
                        id: id,
                        status: isChecked
                    },
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
