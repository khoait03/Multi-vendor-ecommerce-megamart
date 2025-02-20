@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian hàng | Sản phẩm
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="far fa-layer-group"></i> Quản lý sản phẩm</h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <p class="h5 fw-bold text-primary">Danh Sách Sản Phẩm</p>
                            <a href="{{ route('vendor.products.create') }}" class="btn btn-primary">+ Thêm Mới</a>
                        </div>

                        <div class="table-responsive">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <td class="text-center font-bold">STT</td>
                                        <th style="text-align: left">Id</th>
                                        <th style="text-align: left">Hình ảnh</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Giá gốc</th>
                                        <th>Giá bán thực tế</th>
                                        <th style="text-align: left">Ngày bắt đầu</th>
                                        <th style="text-align: left">Ngày kết thúc</th>
                                        <th>Trạng thái duyệt</th>
                                        <th style="text-align: center">Trạng thái</th>
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
                                                @switch($product->is_approved)
                                                    @case(0)
                                                        <span class="badge bg-warning">Đang chờ duyệt</span>
                                                    @break

                                                    @case(1)
                                                        <span class="badge bg-success">Đã được duyệt</span>
                                                    @break

                                                    @default
                                                        <span class="badge bg-danger">Đã bị khoá</span>
                                                @endswitch
                                            </td>
                                            <td>
                                                @if ($product->status == 1)
                                                    <label class='form-check form-switch mt-4'>
                                                        <input type='checkbox' checked name='custom-switch-checkbox'
                                                            data-id='{{ $product->id }}'
                                                            class='form-check-input mx-auto change-status'>
                                                    </label>
                                                @else
                                                    <label class='form-check form-switch mt-4'>
                                                        <input type='checkbox' name='custom-switch-checkbox'
                                                            data-id='{{ $product->id }}'
                                                            class='form-check-input mx-auto change-status'>
                                                    </label>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ route('vendor.products.edit', $product->id) }}"
                                                        class='btn btn-primary mr-1'>
                                                        <i class='fas fa-pen'></i>
                                                    </a>
                                                    <a href="{{ route('vendor.products.destroy', $product->id) }}"
                                                        class='btn btn-danger mr-2 delete-item'>
                                                        <i class='fas fa-trash'></i>
                                                    </a>
                                                    <div class="btn-group dropdown">
                                                        <button type="button" class="btn btn-secondary dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-cog"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <a class="dropdown-item has-icon"
                                                                href="{{ route('vendor.product-image-gallery.index', ['product' => $product->id]) }}"><i
                                                                    class="far fa-image"></i> Thư viện ảnh</a>
                                                            <a class="dropdown-item has-icon"
                                                                href="{{ route('vendor.product-variant.index', ['product' => $product->id]) }}"><i
                                                                    class="fas fa-list"></i> Biến thể của sản
                                                                phẩm</a>
                                                        </ul>
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
                    url: "{{ route('vendor.products.change-status') }}",
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
