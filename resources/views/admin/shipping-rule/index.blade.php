@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Bán Hàng</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Bán Hàng</a></div>
                <div class="breadcrumb-item"><a href="#">Thông Tin Vận Chuyển</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Thông Tin Vận Chuyển</h2>
            <p class="section-lead">Tuỳ chỉnh thông tin vận chuyển của hệ thống.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách thông tin vận chuyển</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.shipping-rule.create') }}" class="btn btn-primary mb-3">+ Thêm
                                    mới</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="text-align: left">STT</th>
                                            <th style="text-align: left">Id</th>
                                            <th>Tên vận chuyển</th>
                                            <th>Loại vận chuyển</th>
                                            <th>Giá trị đơn hàng tối thiểu (VNĐ)</th>
                                            <th>Phí vận chuyển</th>
                                            <th>Trạng thái</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shippings as $key => $shipping)
                                            <tr>
                                                <td class="text-center font-bold">{{ $key + 1 }}</td>
                                                <td style="text-align: left">{{ $shipping->id }}</td>
                                                <td>{{ $shipping->name }}</td>
                                                <td>{{ $shipping->type == 'flat_cost' ? 'Giá cố định' : 'Theo giá trị tối thiểu của đơn hàng' }}
                                                </td>
                                                <td>{{ formatMoney($shipping->min_cost) }}</td>
                                                <td>{{ formatMoney($shipping->cost) }}</td>
                                                <td>
                                                    @if ($shipping->status == 1)
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' checked name='custom-switch-checkbox'
                                                                data-id='{{ $shipping->id }}'
                                                                class='custom-switch-input change-status'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @else
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' name='custom-switch-checkbox'
                                                                data-id='{{ $shipping->id }}'
                                                                class='custom-switch-input change-status'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <a href="{{ route('admin.shipping-rule.edit', $shipping->id) }}"
                                                            class='btn btn-primary mr-2'>
                                                            <i class='fas fa-pen'></i>
                                                        </a>
                                                        <a href="{{ route('admin.shipping-rule.destroy', $shipping->id) }}"
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
                    url: "{{ route('admin.shipping-rule.change-status') }}",
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
