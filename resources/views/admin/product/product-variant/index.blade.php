@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Sản Phẩm</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Sản Phẩm</a></div>
                <div class="breadcrumb-item"><a href="#">Sản Phẩm</a></div>
                <div class="breadcrumb-item"><a href="#">Thư Viện Biến Thể</a></div>
            </div>
        </div>

        <div class="section-body">
            <a
                href="{{ $product->vendor_id == Auth::user()->id ? route('admin.products.index') : ($product->id_approved == 1 ? route('admin.seller-products.index') : route('admin.seller-pending-products.index')) }}">
                < Quay lại</a>
                    <h2 class="section-title">Thư Viện Biến Thể Của Sản Phẩm <span
                            class="text-primary h5">{{ $product->name }}</span>
                    </h2>
                    <p class="section-lead">Tuỳ chỉnh các biến thể của sản phẩm có trong trang web.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Danh sách biến thể</h4>
                                    <div class="card-header-action">
                                        <a href="{{ route('admin.product-variant.create', ['product' => $product->id]) }}"
                                            class="btn btn-primary mb-3">+
                                            Thêm mới</a>
                                    </div>
                                </div>
                                {{-- <div class="card-body">
                            <div class="table-responsive">
                                {{ $dataTable->table(['class' => 'table nowrap', 'style' => 'width: 100%;']) }}
                            </div>
                        </div> --}}
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th style="text-align: left">STT</th>
                                                    <th style="text-align: left">Id</th>
                                                    <th style="text-align: left">Tên biến thể</th>
                                                    <th>Trạng thái</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($variants as $key => $variant)
                                                    <tr>
                                                        <td class="text-center font-bold">{{ $key + 1 }}</td>
                                                        <td style="text-align: left">{{ $variant->id }}</td>
                                                        <td style="text-align: left">
                                                            {{ $variant->name }}
                                                        </td>
                                                        <td>
                                                            @if ($variant->status == 1)
                                                                <label class='custom-switch mt-2'>
                                                                    <input type='checkbox' checked
                                                                        name='custom-switch-checkbox'
                                                                        data-id='{{ $variant->id }}'
                                                                        class='custom-switch-input change-status'>
                                                                    <span class='custom-switch-indicator'></span>
                                                                </label>
                                                            @else
                                                                <label class='custom-switch mt-2'>
                                                                    <input type='checkbox' name='custom-switch-checkbox'
                                                                        data-id='{{ $variant->id }}'
                                                                        class='custom-switch-input change-status'>
                                                                    <span class='custom-switch-indicator'></span>
                                                                </label>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <a href="{{ route('admin.product-variant-item.index', ['product' => $product->id, 'variant' => $variant->id]) }}"
                                                                    class='btn btn-info mr-2'>
                                                                    <i class='fas fa-cog'></i>
                                                                    Thành phần biến thể
                                                                </a>
                                                                <a href="{{ route('admin.product-variant.edit', $variant->id) }}"
                                                                    class='btn btn-primary mr-2'>
                                                                    <i class='fas fa-pen'></i>
                                                                </a>
                                                                <a href="{{ route('admin.product-variant.destroy', $variant->id) }}"
                                                                    class='btn btn-danger mr-2 delete-item'>
                                                                    <i class='fas fa-trash'></i>
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
                    url: "{{ route('admin.product-variant.change-status') }}",
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
