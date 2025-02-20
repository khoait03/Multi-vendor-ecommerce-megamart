@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Yêu thích
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Yêu Thích</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                            <li><a href="#">Yêu Thích</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__cart_view">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wsus__cart_list wishlist">
                        <div class="table-responsive">
                            <table>
                                <tbody>
                                    <tr class="d-flex">
                                        <th class="wsus__pro_img">
                                            Hình ảnh
                                        </th>

                                        <th class="wsus__pro_name" style="width: 500px">
                                            Tên sản phẩm
                                        </th>

                                        <th class="wsus__pro_status" style="width: 230px">
                                            Trạng thái
                                        </th>

                                        <th class="wsus__pro_tk">
                                            Đơn giá
                                        </th>

                                        <th class="wsus__pro_icon">
                                            Hành động
                                        </th>
                                    </tr>

                                    @foreach ($wishlistProducts as $item)
                                        <tr class="d-flex">
                                            <td class="wsus__pro_img"><img src="{{ $item->product->thumb_image }}"
                                                    alt="product" class="img-fluid w-75">
                                                <a href="{{ route('wishlist.destroy', $item->id) }}"><i
                                                        class="far fa-times"></i></a>
                                            </td>

                                            <td class="wsus__pro_name" style="width: 500px">
                                                <p>{{ $item->product->name }}</p>
                                            </td>

                                            <td class="wsus__pro_status" style="width: 230px">
                                                <p>{{ $item->product->quantity > 0 ? 'Còn hàng' : 'Hết hàng' }}
                                                    ({{ $item->product->quantity }})
                                                </p>
                                            </td>

                                            <td class="wsus__pro_tk">
                                                @if (checkDiscount($item->product))
                                                    <p class="wsus__tk text-primary fw-bold"><del
                                                            class="text-danger">{{ formatMoney($item->product->price) }}
                                                        </del>
                                                        {{ formatMoney($item->product->offer_price) }}
                                                    </p>
                                                @else
                                                    <p class="wsus__tk text-primary fw-bold">
                                                        {{ formatMoney($item->product->price) }} </p>
                                                @endif
                                            </td>

                                            <td class="wsus__pro_icon">
                                                <a class="common_btn"
                                                    href="{{ route('product-detail', $item->product->slug) }}">Xem sản
                                                    phẩm
                                                </a>
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
    </section>
@endsection
