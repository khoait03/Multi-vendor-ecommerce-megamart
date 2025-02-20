@php
    $categorySliderSectionOne = json_decode($categorySliderSectionOne->value);
    $lastKey = [];

    foreach ($categorySliderSectionOne as $key => $category) {
        if ($category == null) {
            break;
        }
        $lastKey = [$key => $category];
    }

    if (array_keys($lastKey)[0] == 'category') {
        $categoryItem = \App\Models\Category::find($lastKey['category']);
        if (!$categoryItem) {
            return;
        }
        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['variants', 'category', 'productImageGalleries'])
            ->where('category_id', $categoryItem->id)
            ->take(12)
            ->orderBy('created_at', 'desc')
            ->get();
    } elseif (array_keys($lastKey)[0] == 'sub_category') {
        $categoryItem = \App\Models\SubCategory::find($lastKey['sub_category']);
        if (!$categoryItem) {
            return;
        }
        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['variants', 'category', 'productImageGalleries'])
            ->where('sub_category_id', $categoryItem->id)
            ->take(12)
            ->orderBy('created_at', 'desc')
            ->get();
    } else {
        $categoryItem = \App\Models\ChildCategory::find($lastKey['child_category']);
        if (!$categoryItem) {
            return;
        }
        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['variants', 'category', 'productImageGalleries'])
            ->where('child_category_id', $categoryItem->id)
            ->take(12)
            ->orderBy('created_at', 'desc')
            ->get();
    }
@endphp

<section id="wsus__electronic">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>{{ $categoryItem->name }}</h3>
                    <a class="see_btn" href="{{ route('product.index', ['category' => $categoryItem->slug]) }}">Xem thêm
                        <i class="fas fa-caret-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row flash_sell_slider">

            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach

        </div>
    </div>
</section>
