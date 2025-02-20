@php
    $categories = \App\Models\Suggestion::where('user_id', auth()->user()->id)
        ->pluck('category_id')
        ->toArray();

    if (count($categories) > 0) {
        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['variants', 'category', 'productImageGalleries'])
            ->where(['status' => 1, 'is_approved' => 1])
            ->whereIn('category_id', $categories)
            ->inRandomOrder()
            ->limit(20)
            ->get();
    } else {
        $products = \App\Models\Product::withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->with(['variants', 'category', 'productImageGalleries'])
            ->where(['status' => 1, 'is_approved' => 1])
            ->inRandomOrder()
            ->limit(20)
            ->get();
    }
@endphp

<section id="wsus__electronic">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="wsus__section_header">
                    <h3>Gợi Ý Dành Riêng Cho Bạn</h3>
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
