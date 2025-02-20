@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Flash Sale
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Flash Sale</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang chủ</a></li>
                            <li><a href="#">Flash Sale</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__daily_deals">
        <div class="container">

            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__section_header rounded-0">
                        <h3>flash sale</h3>
                        <div class="wsus__offer_countdown">
                            <span class="end_text">Giảm giá kết thúc sau :</span>
                            <div class="simply-countdown simply-countdown-example"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @php
                    $products = \App\Models\Product::withAvg('reviews', 'rating')
                        ->withCount('reviews')
                        ->with(['variants', 'category', 'productImageGalleries'])
                        ->whereIn('id', $flashSaleItems)
                        ->get();
                @endphp
                @foreach ($products as $product)
                    @if (checkDiscount($product))
                        <div class="col-xl-3 col-sm-6 col-lg-4">
                            <div class="wsus__product_item">
                                <span class="wsus__new">{{ productType($product) }}</span>
                                @if (checkDiscount($product))
                                    <span class="wsus__minus">-{{ calculateDiscountPercent($product) }}%</span>
                                @endif
                                <a class="wsus__pro_link" href="{{ route('product-detail', $product->slug) }}">
                                    <img src="{{ asset($product->thumb_image) }}" alt="product"
                                        class="img-fluid w-100 img_1 p-4" />
                                    <img src="
                                    @if (isset($product->productImageGalleries[0]->image)) {{ asset($product->productImageGalleries[0]->image) }}
                                    @else
                                    {{ asset($product->thumb_image) }} @endif
                                    "
                                        alt="product" class="img-fluid w-100 img_2 p-4" />
                                </a>
                                <ul class="wsus__single_pro_icon">
                                    <li><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                            class="show-product-modal" data-id="{{ $product->id }}"><i
                                                class="far fa-eye"></i></a></li>
                                    <li><a href="#" class="wishlist-btn" data-id="{{ $product->id }}"><i
                                                class="far fa-heart"></i></a></li>
                                </ul>
                                <div class="wsus__product_details">
                                    <a class="wsus__category" href="">{{ $product->category->name }}</a>
                                    <p class="wsus__pro_rating">
                                        @for ($i = 0; $i < 5; $i++)
                                            @if ($i < $product->reviews_avg_rating)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                        <span>({{ $product->reviews_count }} đánh giá)</span>
                                    </p>
                                    <a class="wsus__pro_name"
                                        href="{{ route('product-detail', $product->slug) }}">{{ limitText($product->name, 30) }}</a>
                                    @if (checkDiscount($product))
                                        <p class="wsus__price mt-2">{{ formatMoney($product->offer_price) }}
                                            <del>{{ formatMoney($product->price) }} </del>
                                        </p>
                                    @else
                                        <p class="wsus__price mt-2">{{ formatMoney($product->price) }} </p>
                                    @endif
                                    <form class="shopping-cart-form">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        @foreach ($product->variants as $variant)
                                            @if ($variant->status !== 0)
                                                <select class="form-select d-none" name="variants_items[]">
                                                    @foreach ($variant->productVariantItems as $item)
                                                        @if ($item->status !== 0)
                                                            <option value="{{ $item->id }}"
                                                                {{ $item->is_default == 1 ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                                {{ $item->price > 0 ? '(+' . formatMoney($item->price) . ' )' : '' }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @endif
                                        @endforeach
                                        <input class="form-control w-25" name="quantity" type="hidden" min="1"
                                            max="100" value="1" />
                                        <button type="submit" class="add_cart border-0">Thêm vào giỏ hàng</button>
                                    </form>
                                </div>
                                @if (checkDiscount($product))
                                    <div class="mb-3" style="margin-left: 15px">
                                        <h6 class="text-danger mb-2">Giảm giá kết thúc sau :</h6>
                                        <div class="simply-countdown-mini-1 simply-countdown-mini-1-{{ $product->id }}"
                                            style="display: flex; gap: 10px">
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            {{-- @if ($flashSaleItems->hasPages())
                    <div class="mt-5 d-flex justify-content-center">{{ $flashSaleItems->links() }}</div>
                @endif --}}

        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            simplyCountdown(".simply-countdown-example", {
                year: {{ date('Y', strtotime($flashSaleDate->end_date)) }},
                month: {{ date('m', strtotime($flashSaleDate->end_date)) }},
                day: {{ date('d', strtotime($flashSaleDate->end_date)) }},
                hours: {{ date('H', strtotime($flashSaleDate->end_date)) }},
                minutes: {{ date('i', strtotime($flashSaleDate->end_date)) }},
                enableUtc: false,
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            @foreach ($products as $product)
                simplyCountdown(".simply-countdown-mini-1-{{ $product->id }}", {
                    year: {{ date('Y', strtotime($product->offer_end_date)) }},
                    month: {{ date('m', strtotime($product->offer_end_date)) }},
                    day: {{ date('d', strtotime($product->offer_end_date)) }},
                    hours: {{ date('H', strtotime($product->offer_end_date)) }},
                    minutes: {{ date('i', strtotime($product->offer_end_date)) }},
                    enableUtc: false,
                });
            @endforeach
        });
    </script>
@endpush
