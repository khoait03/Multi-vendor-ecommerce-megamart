@extends('vendor.layouts.master')

@section('title')
    {{ $settings->site_name }} | Gian hàng | Đánh giá
@endsection

@section('content')
    <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
            <div class="dashboard_content mt-2 mt-md-0">
                <h3><i class="far fa-star"></i> Đánh giá sản phẩm</h3>
                <div class="wsus__dashboard_profile">
                    <div class="wsus__dash_pro_area">

                        <div class="mb-4 d-flex justify-content-between align-items-center">
                            <p class="h5 fw-bold text-primary">Danh sách đánh giá</p>
                            {{-- <a href="{{ route('vendor.products.create') }}" class="btn btn-primary">+ Thêm Mới</a> --}}
                        </div>

                        <div class="table-responsive">
                            <table id="example" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <td class="text-center font-bold">STT</td>
                                        <th style="text-align: left">Id</th>
                                        <th style="text-align: left">Tên sản phẩm</th>
                                        <th style="text-align: left">Số sao đánh giá</th>
                                        <th>Nội dung đánh giá</th>
                                        <th>Trạng thái</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $key => $review)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td style="text-align: left">{{ $review->id }}</td>
                                            <td><a target="blank"
                                                    href="{{ route('product-detail', $review->product->slug) }}">{{ $review->product->name }}</a>
                                            </td>
                                            <td style="text-align: left">
                                                @for ($i = 0; $i < $review->rating; $i++)
                                                    <i class="fas fa-star" style="color:#ff9f00"></i>
                                                @endfor
                                            </td>
                                            <td>{{ $review->review }}</td>
                                            <td>{{ $review->status == 1 ? 'Hiển thị' : 'Bị ẩn' }}</td>
                                            {{-- <td>
                                                <div class="d-flex justify-content-start">
                                                    <a href="{{ route('vendor.products.destroy', $review->id) }}"
                                                        class='btn btn-danger mr-2 delete-item'>
                                                        <i class='fas fa-trash'></i>
                                                    </a>


                                                </div>
                                            </td> --}}
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
