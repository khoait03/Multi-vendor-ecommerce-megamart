@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian hàng | Sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <a href="{{ route('vendor.products.index') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-caret-left"></i> Quay lại</a>
                <h3><i class="far fa-list"></i> Thư viện biến thể của sản phẩm <u
                        style="margin: 0 10px; color: green">{{ $product->name }}</u></h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <p class="h5 fw-bold text-primary">Danh Sách Biến Thể</p>
                            <a href="{{ route('vendor.product-variant.create', ['product' => $product->id]) }}"
                                class="btn btn-primary">+ Thêm Mới</a>
                        </div>

                        <div class="table-responsive">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <td class="text-center font-bold">STT</td>
                                        <th style="text-align: left">Id</th>
                                        <th style="text-align: left">Tên biến thể</th>
                                        <th>Trạng thái</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($variants as $key => $variant)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td style="text-align: left">{{ $variant->id }}</td>
                                            <td style="text-align: left">
                                                {{ $variant->name }}
                                            </td>
                                            <td>
                                                @if ($variant->status == 1)
                                                    <label class='form-check form-switch mt-4'>
                                                        <input type='checkbox' checked name='custom-switch-checkbox'
                                                            data-id='{{ $variant->id }}'
                                                            class='form-check-input mx-auto change-status'>
                                                    </label>
                                                @else
                                                    <label class='form-check form-switch mt-4'>
                                                        <input type='checkbox' name='custom-switch-checkbox'
                                                            data-id='{{ $variant->id }}'
                                                            class='form-check-input mx-auto change-status'>
                                                    </label>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ route('vendor.product-variant.edit', $variant->id) }}"
                                                        class='btn btn-primary mr-2'>
                                                        <i class='fas fa-pen'></i>
                                                    </a>
                                                    <a href="{{ route('vendor.product-variant.destroy', $variant->id) }}"
                                                        class='btn btn-danger mr-2 delete-item'>
                                                        <i class='fas fa-trash'></i>
                                                    </a>
                                                    <a href="{{ route('vendor.product-variant-item.index', ['product' => $product->id, 'variant' => $variant->id]) }}"
                                                        class='btn btn-secondary mr-2'>
                                                        <i class='fas fa-cog'></i>
                                                        Thành phần biến thể
                                                    </a>

                                                </div>
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

@push('scripts')
    <script>
        $(document).ready(function() {
            $("body").on('click', ".change-status", function() {
                let isChecked = $(this).is(":checked")
                let id = $(this).data('id')

                $.ajax({
                    url: "{{ route('vendor.product-variant.change-status') }}",
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
