<div class="modal-body">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="far fa-times"></i></button>
    <div class="row">
        <div class="col-xl-6 col-12 col-sm-10 col-md-8 col-lg-6 m-auto display">
            <div class="wsus__quick_view_img">
                @if ($product->video_link)
                    <a class="venobox wsus__pro_det_video" data-autoplay="true" data-vbtype="video"
                        href="{{ $product->video_link }}">
                        <i class="fas fa-play"></i>
                    </a>
                @endif
                <div class="row modal_slider">
                    <div class="col-xl-12">
                        <div class="modal_slider_img">
                            <img src="{{ asset($product->thumb_image) }}" alt="product" class="img-fluid w-100">
                        </div>
                    </div>

                    {{-- @if (count($product->productImageGalleries) > 0)
                        @foreach ($product->productImageGalleries as $image)
                            <div class="col-xl-12">
                                <div class="modal_slider_img">
                                    <img src="{{ asset($image->image) }}" alt="product" class="img-fluid w-100">
                                </div>
                            </div>
                        @endforeach
                    @endif --}}

                </div>
            </div>
        </div>
        <div class="col-xl-6 col-12 col-sm-12 col-md-12 col-lg-6">
            <div class="wsus__pro_details_text">
                <p class="title">{{ $product->name }}</p>
                <p class="wsus__stock_area">
                    @if ($product->quantity > 0)
                        <span class="text-success fw-bold">Còn hàng</span>
                    @else
                        <span class="text-danger fw-bold">Hết hàng</span>
                    @endif
                    ({{ $product->quantity }} sản phẩm)
                </p>
                @if (checkDiscount($product))
                    <h4>{{ formatMoney($product->offer_price) }}
                        <del>{{ formatMoney($product->price) }}
                        </del>
                    </h4>
                @else
                    <h4>{{ formatMoney($product->price) }} </h4>
                @endif
                <p class="review">
                    @php
                        $avgRating = round($product->reviews->avg('rating'));
                    @endphp

                    @for ($i = 0; $i < 5; $i++)
                        @if ($i < $avgRating)
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                    <span>{{ count($product->reviews) }} đánh giá</span>
                </p>
                <p class="description"><strong>Mô tả ngắn:</strong>
                    {{ $product->short_description }}</p>

                {{-- @if (checkDiscount($product))
                    <div class="wsus_pro_hot_deals">
                        <h5>Giảm giá kết thúc sau : </h5>
                        <div class="simply-countdown simply-countdown-mini"></div>
                    </div>
                @endif --}}
                <form class="shopping-cart-form" action="">

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="d-flex gap-3 mt-3 align-items-center">
                        {{-- <div class="wsus__quentity"> --}}
                        <h5><strong>Số lượng mua :</strong></h5>
                        {{-- <form class="select_number"> --}}
                        <input class="form-control w-25" name="quantity" type="number" min="1" max="100"
                            value="1" />
                        {{-- </form> --}}
                        {{-- </div> --}}
                    </div>
                    <div class="wsus__selectbox">
                        <div class="row">

                            @foreach ($product->variants as $variant)
                                @if ($variant->status !== 0)
                                    <div class="col-xl-6 col-sm-6">
                                        <h5 class="mb-2"><strong>{{ $variant->name }}</strong>:
                                        </h5>
                                        <select class="form-select" name="variants_items[]">

                                            @foreach ($variant->productVariantItems as $item)
                                                @if ($item->status !== 0)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->is_default == 1 ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                        {{ $item->price > 0 ? '(+' . formatMoney($item->price) . ')' : '' }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endforeach

                        </div>
                    </div>
                    <ul class="wsus__button_area">
                        <li><button type="submit" class="add_cart" href="#">Thêm vào giỏ
                                hàng</button>
                        </li>
                        {{-- <li><a class="buy_now" href="#">Mua ngay</a></li> --}}
                        <li><a href="#" class="wishlist-btn btn btn-info text-light rounded-circle"
                                data-id="{{ $product->id }}"><i class="far fa-heart"></i></a></li>
                        </li>
                        {{-- <li><a href="#"><i class="far fa-random"></i></a></li> --}}
                    </ul>

                </form>
                <p class="brand_model"><span>Mã Sản Phẩm :</span> {{ $product->sku }}</p>
                <p class="brand_model"><span>Thương Hiệu :</span> {{ $product->brand->name }}</p>
            </div>
        </div>
    </div>
</div>
