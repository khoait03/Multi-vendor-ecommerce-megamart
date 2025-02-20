@php
    $popularCategories = json_decode($popularCategories->value, true);
@endphp

<section id="wsus__monthly_top" class="wsus__monthly_top_2">
    <div class="container">
        <div class="row">
            @if ($homePageBannerOne->banner_one->status == 1)
                <div class="col-xl-12 col-lg-12">
                    <div class="wsus__monthly_top_banner">
                        <div class="wsus__monthly_top_banner_img">
                            <img src="{{ asset($homePageBannerOne->banner_one->banner_image) }}" alt="img"
                                class="img-fluid w-100">
                            <span></span>
                        </div>
                        <div class="wsus__monthly_top_banner_text">
                            {{-- <h4>Black Friday Sale</h4>
                      <h3>Up To <span>70% Off</span></h3>
                      <H6>Everything</H6> --}}
                            <a class="shop_btn" href="{{ $homePageBannerOne->banner_one->banner_url }}">Mua sắm ngay</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header for_md">
                    <h3>Danh mục phổ biến của tháng</h3>
                    <div class="monthly_top_filter">
                        <button class=" active" data-filter="*">Tất cả</button>

                        @php
                            $products = [];
                        @endphp

                        @foreach ($popularCategories as $key => $popularCategory)
                            @php
                                $lastKey = [];
                                // Kiểm tra nếu $popularCategory không phải là mảng rỗng
                                if (!empty($popularCategory)) {
                                    foreach ($popularCategory as $key => $category) {
                                        if ($category == null) {
                                            break;
                                        }
                                        $lastKey = [$key => $category];
                                    }

                                    // Kiểm tra nếu $lastKey không rỗng
                                    if (!empty($lastKey)) {
                                        if (array_keys($lastKey)[0] == 'category') {
                                            $categoryItem = \App\Models\Category::find($lastKey['category']);
                                            $products[] = \App\Models\Product::withAvg('reviews', 'rating')
                                                ->where('category_id', $categoryItem->id)
                                                ->take(12)
                                                ->orderBy('created_at', 'desc')
                                                ->get();
                                        } elseif (array_keys($lastKey)[0] == 'sub_category') {
                                            $categoryItem = \App\Models\SubCategory::find($lastKey['sub_category']);
                                            $products[] = \App\Models\Product::withAvg('reviews', 'rating')
                                                ->where('sub_category_id', $categoryItem->id)
                                                ->take(12)
                                                ->orderBy('created_at', 'desc')
                                                ->get();
                                        } else {
                                            $categoryItem = \App\Models\ChildCategory::find($lastKey['child_category']);
                                            $products[] = \App\Models\Product::withAvg('reviews', 'rating')
                                                ->where('child_category_id', $categoryItem->id)
                                                ->take(12)
                                                ->orderBy('created_at', 'desc')
                                                ->get();
                                        }
                                    } else {
                                        $categoryItem = null;
                                    }
                                } else {
                                    $categoryItem = null;
                                }
                            @endphp

                            @if ($categoryItem)
                                <button data-filter=".category-{{ $loop->index }}">{{ $categoryItem->name }}</button>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="row grid">

                    @foreach ($products as $key => $product)
                        @foreach ($product as $item)
                            <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3  category-{{ $key }}">
                                <a class="wsus__hot_deals__single" href="{{ route('product-detail', $item->slug) }}"
                                    style="height: 280px">
                                    <div class="wsus__hot_deals__single_img d-flex justify-content-center mb-3">
                                        <img src="{{ asset($item->thumb_image) }}" alt="bag"
                                            class="img-fluid w-75">
                                    </div>
                                    <div class="wsus__hot_deals__single_text text-center">
                                        <h5>{{ limitText($item->name, 20) }}</h5>
                                        <p class="wsus__rating">
                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $item->reviews_avg_rating)
                                                    <i class="fas fa-star"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                        </p>
                                        @if (checkDiscount($item))
                                            <p class="wsus__tk"><del>{{ formatMoney($item->price) }} </del></br>
                                                {{ formatMoney($item->offer_price) }}
                                            </p>
                                        @else
                                            <p class="wsus__tk">{{ formatMoney($item->price) }} </p>
                                        @endif
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
