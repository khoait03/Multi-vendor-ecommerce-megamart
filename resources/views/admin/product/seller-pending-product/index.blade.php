@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Sản Phẩm</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Sản Phẩm</a></div>
                <div class="breadcrumb-item"><a href="#">Sản Phẩm Đang Chờ Duyệt</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Sản Phẩm Đang Chờ Duyệt</h2>
            <p class="section-lead">Tuỳ chỉnh các sản phẩm có trong trang web.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách sản phẩm</h4>
                            {{-- <div class="card-header-action">
                                <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td class="text-center font-bold">STT</td>
                                            <th style="text-align: left">Id</th>
                                            <th style="text-align: left">Hình ảnh</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Giá gốc của sản phẩm</th>
                                            <th>Giá bán thực tế của sản phẩm</th>
                                            <th style="text-align: left">Ngày bắt đầu giảm</th>
                                            <th style="text-align: left">Ngày kết thúc giảm</th>
                                            <th>Gian hàng</th>
                                            <th>Trạng thái</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td class="text-center">{{ $key + 1 }}</td>
                                                <td style="text-align: left">{{ $product->id }}</td>
                                                <td style="text-align: left">
                                                    <img src=" {{ asset($product->thumb_image) }}" width="70px">
                                                </td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ formatMoney($product->price) }}</td>
                                                <td>{{ formatMoney($product->offer_price) }}</td>
                                                <td style="text-align: left">
                                                    {{ $product->offer_start_date !== $product->offer_end_date ? $product->offer_start_date : '' }}
                                                </td>
                                                <td style="text-align: left">
                                                    {{ $product->offer_start_date !== $product->offer_end_date ? $product->offer_end_date : '' }}
                                                </td>
                                                <td>
                                                    {{ $product->vendor->name }}
                                                </td>
                                                <td>
                                                    <select class="form-control is_approved" name="is_approved"
                                                        id="" data-id="{{ $product->id }}">
                                                        <option value="0">Đang chờ duyệt</option>
                                                        <option value="1">Xác nhận duyệt</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <a href="{{ route('admin.products.edit', $product->id) }}"
                                                            class='btn btn-primary mr-2'>
                                                            <i class='fas fa-pen'></i>
                                                        </a>
                                                        <a href="{{ route('admin.products.destroy', $product->id) }}"
                                                            class='btn btn-danger mr-2 delete-item'>
                                                            <i class='fas fa-trash'></i>
                                                        </a>
                                                        <div class="dropdown dropleft d-inline">
                                                            <button class="btn btn-primary dropdown-toggle" type="button"
                                                                id="dropdownMenuButton2" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-cog"></i>
                                                            </button>
                                                            <div class="dropdown-menu" x-placement="bottom-start"
                                                                style="position: absolute; transform: translate3d(0px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                                <a class="dropdown-item has-icon"
                                                                    href="{{ route('admin.product-image-gallery.index', ['product' => $product->id]) }}"><i
                                                                        class="far fa-image"></i> Thư viện ảnh</a>
                                                                <a class="dropdown-item has-icon"
                                                                    href="{{ route('admin.product-variant.index', ['product' => $product->id]) }}"><i
                                                                        class="fas fa-list"></i> Biến thể của sản
                                                                    phẩm</a>
                                                            </div>
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
                    url: "{{ route('admin.products.change-status') }}",
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

            $("body").on("change", ".is_approved", function() {
                let value = $(this).val()
                let id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.change-approve-status') }}",
                    method: "PUT",
                    data: {
                        id: id,
                        value: value
                    },
                    success: function(data) {
                        toastr.success(data.message)
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
