@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Khuyến Mãi</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Khuyến Mãi</a></div>
                <div class="breadcrumb-item"><a href="#">Mã Giảm Giá</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Mã Giảm Giá</h2>
            <p class="section-lead">Tuỳ chỉnh mã giảm giá dùng cho đơn hàng.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách mã giảm giá</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary mb-3">+ Thêm
                                    mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td class="text-center font-bold">STT</td>
                                            <th style="text-align: left">Id</th>
                                            <th>Tên mã giảm</th>
                                            <th>Mã giảm giá</th>
                                            <th>Số lượng</th>
                                            <th>Số lượng tối đa/1 người dùng</th>
                                            <th style="text-align: left">Ngày bắt đầu</th>
                                            <th style="text-align: left">Ngày kết thúc</th>
                                            <th>Loại giảm giá</th>
                                            <th>Giá trị giảm</th>
                                            <th>Trạng thái</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($coupons as $key => $coupon)
                                            <tr>
                                                <td class="text-center font-bold">{{ $key + 1 }}</td>
                                                <td style="text-align: left">{{ $coupon->id }}</td>
                                                <td>{{ $coupon->name }}</td>
                                                <td>{{ $coupon->code }}</td>
                                                <td style="text-align: center">{{ $coupon->quantity }}</td>
                                                <td style="text-align: center">{{ $coupon->max_use }}</td>
                                                <td style="text-align: left">{{ $coupon->start_date }}</td>
                                                <td style="text-align: left">{{ $coupon->end_date }}</td>
                                                <td style="text-align: left">
                                                    {{ $coupon->discount_type == 'percent' ? 'Phần trăm' : 'Theo số tiền' }}
                                                </td>
                                                <td style="text-align: center">
                                                    {{ $coupon->discount_type == 'percent' ? number_format($coupon->discount) . '%' : formatMoney($coupon->discount) }}
                                                </td>
                                                <td>
                                                    @if ($coupon->status == 1)
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' checked name='custom-switch-checkbox'
                                                                data-id='{{ $coupon->id }}'
                                                                class='custom-switch-input change-status'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @else
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' name='custom-switch-checkbox'
                                                                data-id='{{ $coupon->id }}'
                                                                class='custom-switch-input change-status'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}"
                                                            class='btn btn-primary mr-2'>
                                                            <i class='fas fa-pen'></i>
                                                        </a>
                                                        <a href="{{ route('admin.coupons.destroy', $coupon->id) }}"
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

@push('scripts')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}

    <script>
        $(document).ready(function() {
            $("body").on('click', ".change-status", function() {
                let isChecked = $(this).is(":checked")
                let id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.coupons.change-status') }}",
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
