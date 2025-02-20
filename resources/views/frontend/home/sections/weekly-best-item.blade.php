@php
    $weeklyBestRated = json_decode($weeklyBestRated->value);
    $lastKey = [];

    foreach ($weeklyBestRated as $key => $category) {
        if ($category == null) {
            break;
        }
        $lastKey = [$key => $category];
    }

    if (array_keys($lastKey)[0] == 'category') {
        $categoryItem = \App\Models\Category::find($lastKey['category']);
        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->where('category_id', $categoryItem->id)
            ->take(12)
            ->orderBy('created_at', 'desc')
            ->get();
    } elseif (array_keys($lastKey)[0] == 'sub_category') {
        $categoryItem = \App\Models\SubCategory::find($lastKey['sub_category']);
        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->where('sub_category_id', $categoryItem->id)
            ->take(12)
            ->orderBy('created_at', 'desc')
            ->get();
    } else {
        $categoryItem = \App\Models\ChildCategory::find($lastKey['child_category']);
        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->where('child_category_id', $categoryItem->id)
            ->take(12)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    $weeklyBestSell = json_decode($weeklyBestSell->value);
    $lastKey1 = [];

    foreach ($weeklyBestSell as $key => $category) {
        if ($category == null) {
            break;
        }
        $lastKey1 = [$key => $category];
    }

    if (array_keys($lastKey1)[0] == 'category') {
        $categoryItem1 = \App\Models\Category::find($lastKey1['category']);
        $products1 = \App\Models\Product::withAvg('reviews', 'rating')
            ->where('category_id', $categoryItem1->id)
            ->take(12)
            ->orderBy('created_at', 'desc')
            ->get();
    } elseif (array_keys($lastKey1)[0] == 'sub_category') {
        $categoryItem1 = \App\Models\SubCategory::find($lastKey1['sub_category']);
        $products1 = \App\Models\Product::withAvg('reviews', 'rating')
            ->where('sub_category_id', $categoryItem1->id)
            ->take(12)
            ->orderBy('created_at', 'desc')
            ->get();
    } else {
        $categoryItem1 = \App\Models\ChildCategory::find($lastKey1['child_category']);
        $products1 = \App\Models\Product::withAvg('reviews', 'rating')
            ->where('child_category_id', $categoryItem1->id)
            ->take(12)
            ->orderBy('created_at', 'desc')
            ->get();
    }
@endphp

<section id="wsus__weekly_best" class="home2_wsus__weekly_best_2 ">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-sm-6">
                <div class="wsus__section_header">
                    <h3>Danh mục được đánh giá cao trong tuần</h3>
                </div>
                <div class="row weekly_best2">

                    @foreach ($products as $item)
                        <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3  category-{{ $key }}">
                            <a class="wsus__hot_deals__single" href="{{ route('product-detail', $item->slug) }}">
                                <div class="wsus__hot_deals__single_img d-flex justify-content-center mb-3">
                                    <img src="{{ asset($item->thumb_image) }}" alt="bag" class="img-fluid w-50">
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


                </div>
            </div>
            <div class="col-xl-6 col-sm-6">
                <div class="wsus__section_header">
                    <h3>Danh mục bán chạy trong tuần</h3>
                </div>
                <div class="row weekly_best2">
                    @foreach ($products1 as $item)
                        <div class="col-xl-2 col-6 col-sm-6 col-md-4 col-lg-3  category-{{ $key }}">
                            <a class="wsus__hot_deals__single" href="{{ route('product-detail', $item->slug) }}">
                                <div class="wsus__hot_deals__single_img d-flex justify-content-center mb-3">
                                    <img src="{{ asset($item->thumb_image) }}" alt="bag" class="img-fluid w-50">
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
                                        <p class="wsus__tk"><del>{{ formatMoney($item->price) }} đ</del></br>
                                            {{ formatMoney($item->offer_price) }} đ
                                        </p>
                                    @else
                                        <p class="wsus__tk">{{ formatMoney($item->price) }} đ</p>
                                    @endif
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
