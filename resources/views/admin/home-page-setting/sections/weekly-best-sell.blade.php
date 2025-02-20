@php
    $weeklyBestSell = json_decode($weeklyBestSell->value);
@endphp

<div class="tab-pane fade" id="list-weekly-best-sell" role="tabpanel" aria-labelledby="list-weekly-best-sell-list">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.weekly-best-sell') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Danh mục cấp 1</label>
                            <select name="category_slider_1" id="" class="form-control main-category">
                                <option value="">- - Chọn danh mục - -</option>

                                @foreach ($categories as $category)
                                    <option {{ $weeklyBestSell->category == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('category_slider_1'))
                                <p class="text-danger">{{ $errors->first('category_slider_1') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $subCategories0 = \App\Models\SubCategory::where(
                                    'category_id',
                                    $weeklyBestSell->category,
                                )->get();
                            @endphp
                            <label>Danh mục cấp 2</label>
                            <select name="sub_category_slider_1" id="" class="form-control sub-category">
                                <option value="">- - Chọn danh mục - -</option>

                                @foreach ($subCategories0 as $subCategory)
                                    <option {{ $weeklyBestSell->sub_category == $subCategory->id ? 'selected' : '' }}
                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('sub_category_slider_1'))
                                <p class="text-danger">{{ $errors->first('sub_category_slider_1') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories0 = \App\Models\ChildCategory::where(
                                    'sub_category_id',
                                    $weeklyBestSell->sub_category,
                                )->get();
                            @endphp
                            <label>Danh mục cấp 3</label>
                            <select name="child_category_slider_1" id="" class="form-control child-category">
                                <option value="">- - Chọn danh mục - -</option>

                                @foreach ($childCategories0 as $childCategory)
                                    <option
                                        {{ $weeklyBestSell->child_category == $childCategory->id ? 'selected' : '' }}
                                        value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('child_category_slider_1'))
                                <p class="text-danger">{{ $errors->first('child_category_slider_1') }}</p>
                            @endif
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary">Xác nhận</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            $("body").on('change', ".main-category", function(e) {
                let id = $(this).val()
                let row = $(this).closest(".row")
                $.ajax({
                    url: "{{ route('admin.get-subcategories') }}",
                    method: "GET",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let selector = row.find(".sub-category")
                        selector.html(
                            '<option value="">- - Chọn danh mục - -</option>')

                        $.each(data, function(i, item) {
                            selector.append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })

            $("body").on('change', ".sub-category", function(e) {
                let id = $(this).val()
                let row = $(this).closest(".row")
                $.ajax({
                    url: "{{ route('admin.products.get-childcategories') }}",
                    method: "GET",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        let selector = row.find(".child-category")
                        selector.html('<option value="">- - Chọn danh mục - -</option>')

                        $.each(data, function(i, item) {
                            selector.append(
                                `<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
