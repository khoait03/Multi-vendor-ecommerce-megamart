@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Sản Phẩm</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Sản Phẩm</a></div>
                <div class="breadcrumb-item"><a href="#">Sản Phẩm</a></div>
                <div class="breadcrumb-item"><a href="#">Thư Viện Ảnh</a></div>
            </div>
        </div>

        <div class="section-body">
            <a
                href="{{ $product->vendor_id == Auth::user()->id ? route('admin.products.index') : ($product->id_approved == 1 ? route('admin.seller-products.index') : route('admin.seller-pending-products.index')) }}">
                < Quay lại</a>
                    <h2 class="section-title">Thư viện ảnh của sản phẩm <span
                            class="text-primary h5">{{ $product->name }}</span>
                    </h2>
                    <p class="section-lead">Tuỳ chỉnh các hình ảnh của sản phẩm có trong trang web.</p>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Tải lên hình ảnh sản phẩm <small>(Có thể tải lên nhiều ảnh)</small></h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('admin.product-image-gallery.store') }}"
                                        enctype="multipart/form-data" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <label>Hình ảnh</label>
                                            <input type="file" name="image[]" class="form-control" multiple>
                                            <input type="hidden" name="product" value="{{ $product->id }}">
                                            @if ($errors->has('image'))
                                                <p class="text-danger">{{ $errors->first('image') }}</p>
                                            @endif
                                            @if ($errors->has('image.*'))
                                                <p class="text-danger">{{ $errors->first('image.*') }}</p>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary">Tải lên</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Danh sách hình ảnh</h4>
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
                                                    <th style="text-align: left">Hình ảnh</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($images as $key => $image)
                                                    <tr>
                                                        <td class="text-center font-bold">{{ $key + 1 }}</td>
                                                        <td style="text-align: left">{{ $image->id }}</td>
                                                        <td style="text-align: left">
                                                            <img src=" {{ asset($image->image) }}" width="120px">
                                                        </td>
                                                        <td>
                                                            <div class="d-flex justify-content-start">
                                                                <a href="{{ route('admin.product-image-gallery.destroy', $image->id) }}"
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
                    url: "{{ route('admin.slider.change-status') }}",
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
