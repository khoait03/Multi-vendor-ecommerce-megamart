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
                <h3><i class="far fa-image"></i> Thư viện ảnh của sản phẩm {{ $product->name }}</h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">


                        <div class="row">
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label class="mb-2 fw-bold">Tải lên hình ảnh sản phẩm <small>(Có thể tải lên nhiều
                                            ảnh)</small></label>

                                    <form action="{{ route('vendor.product-image-gallery.store') }}"
                                        enctype="multipart/form-data" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <input type="file" name="image[]" class="form-control" multiple>
                                            <input type="hidden" name="product" value="{{ $product->id }}">
                                            @if ($errors->has('image'))
                                                <p class="text-danger">{{ $errors->first('image') }}</p>
                                            @endif
                                            @if ($errors->has('image.*'))
                                                <p class="text-danger">{{ $errors->first('image.*') }}</p>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Tải lên</button>
                                    </form>

                                    @if ($errors->has('thumb_image'))
                                        <p class="text-danger">{{ $errors->first('thumb_image') }}</p>
                                    @endif
                                </div>


                            </div>

                        </div>

                        <div class="table-responsive">
                            <h4 class="fw-bold text-primary">Danh sách hình ảnh</h4>
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="text-align: center">Hình ảnh</th>
                                        <th style="text-align: left">Id</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($images as $image)
                                        <tr>
                                            <td style="text-align: center">
                                                <img src=" {{ asset($image->image) }}" width="150px">
                                            </td>
                                            <td style="text-align: left">{{ $image->id }}</td>
                                            <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ route('vendor.product-image-gallery.destroy', $image->id) }}"
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
@endsection
