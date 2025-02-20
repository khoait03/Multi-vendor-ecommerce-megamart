@php
    $popularCategories = json_decode($popularCategories->value);
@endphp

<div class="tab-pane fade show active" id="list-popular-categories" role="tabpanel"
    aria-labelledby="list-popular-categories-list">
    <div class="card">
        <div class="card-body border">
            <form action="{{ route('admin.popular-category-section') }}" method="POST">
                @csrf
                @method('PUT')


                <h6>Danh mục 1</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Danh mục cấp 1</label>
                            <select name="category_1" id="" class="form-control main-category">
                                <option value="">- - Chọn danh mục - -</option>
                                @foreach ($categories as $category)
                                    <option {{ $popularCategories[0]->category == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('category_1'))
                                <p class="text-danger">{{ $errors->first('category_1') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $subCategories0 = \App\Models\SubCategory::where(
                                    'category_id',
                                    $popularCategories[0]->category,
                                )->get();
                            @endphp
                            <label>Danh mục cấp 2</label>
                            <select name="sub_category_1" id="" class="form-control sub-category">
                                <option value="">- - Chọn danh mục - -</option>

                                @foreach ($subCategories0 as $subCategory)
                                    <option
                                        {{ $popularCategories[0]->sub_category == $subCategory->id ? 'selected' : '' }}
                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('sub_category_1'))
                                <p class="text-danger">{{ $errors->first('sub_category_1') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories0 = \App\Models\ChildCategory::where(
                                    'sub_category_id',
                                    $popularCategories[0]->sub_category,
                                )->get();
                            @endphp
                            <label>Danh mục cấp 3</label>
                            <select name="child_category_1" id="" class="form-control child-category">
                                <option value="">- - Chọn danh mục - -</option>

                                @foreach ($childCategories0 as $childCategory)
                                    <option
                                        {{ $popularCategories[0]->child_category == $childCategory->id ? 'selected' : '' }}
                                        value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('child_category_1'))
                                <p class="text-danger">{{ $errors->first('child_category_1') }}</p>
                            @endif
                        </div>
                    </div>

                </div>

                <h6>Danh mục 2</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Danh mục cấp 1</label>
                            <select name="category_2" id="" class="form-control main-category">
                                <option value="">- - Chọn danh mục - -</option>
                                @foreach ($categories as $category)
                                    <option {{ $popularCategories[1]->category == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('category_2'))
                                <p class="text-danger">{{ $errors->first('category_2') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $subCategories1 = \App\Models\SubCategory::where(
                                    'category_id',
                                    $popularCategories[1]->category,
                                )->get();
                            @endphp
                            <label>Danh mục cấp 2</label>
                            <select name="sub_category_2" id="" class="form-control sub-category">
                                <option value="">- - Chọn danh mục - -</option>

                                @foreach ($subCategories1 as $subCategory)
                                    <option
                                        {{ $popularCategories[1]->sub_category == $subCategory->id ? 'selected' : '' }}
                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('sub_category_2'))
                                <p class="text-danger">{{ $errors->first('sub_category_2') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories1 = \App\Models\ChildCategory::where(
                                    'sub_category_id',
                                    $popularCategories[1]->sub_category,
                                )->get();
                            @endphp
                            <label>Danh mục cấp 3</label>
                            <select name="child_category_2" id="" class="form-control child-category">
                                <option value="">- - Chọn danh mục - -</option>

                                @foreach ($childCategories1 as $childCategory)
                                    <option
                                        {{ $popularCategories[1]->child_category == $childCategory->id ? 'selected' : '' }}
                                        value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('child_category_2'))
                                <p class="text-danger">{{ $errors->first('child_category_2') }}</p>
                            @endif
                        </div>
                    </div>

                </div>

                <h6>Danh mục 3</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Danh mục cấp 1</label>
                            <select name="category_3" id="" class="form-control main-category">
                                <option value="">- - Chọn danh mục - -</option>
                                @foreach ($categories as $category)
                                    <option {{ $popularCategories[2]->category == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('category_3'))
                                <p class="text-danger">{{ $errors->first('category_3') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $subCategories2 = \App\Models\SubCategory::where(
                                    'category_id',
                                    $popularCategories[2]->category,
                                )->get();
                            @endphp
                            <label>Danh mục cấp 2</label>
                            <select name="sub_category_3" id="" class="form-control sub-category">
                                <option value="">- - Chọn danh mục - -</option>

                                @foreach ($subCategories2 as $subCategory)
                                    <option
                                        {{ $popularCategories[2]->sub_category == $subCategory->id ? 'selected' : '' }}
                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('sub_category_3'))
                                <p class="text-danger">{{ $errors->first('sub_category_3') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories2 = \App\Models\ChildCategory::where(
                                    'sub_category_id',
                                    $popularCategories[2]->sub_category,
                                )->get();
                            @endphp
                            <label>Danh mục cấp 3</label>
                            <select name="child_category_3" id="" class="form-control child-category">
                                <option value="">- - Chọn danh mục - -</option>

                                @foreach ($childCategories2 as $childCategory)
                                    <option
                                        {{ $popularCategories[2]->child_category == $childCategory->id ? 'selected' : '' }}
                                        value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('child_category_3'))
                                <p class="text-danger">{{ $errors->first('child_category_3') }}</p>
                            @endif
                        </div>
                    </div>

                </div>

                <h6>Danh mục 4</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Danh mục cấp 1</label>
                            <select name="category_4" id="" class="form-control main-category">
                                <option value="">- - Chọn danh mục - -</option>
                                @foreach ($categories as $category)
                                    <option {{ $popularCategories[3]->category == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('category_4'))
                                <p class="text-danger">{{ $errors->first('category_4') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $subCategories3 = \App\Models\SubCategory::where(
                                    'category_id',
                                    $popularCategories[3]->category,
                                )->get();
                            @endphp
                            <label>Danh mục cấp 2</label>
                            <select name="sub_category_4" id="" class="form-control sub-category">
                                <option value="">- - Chọn danh mục - -</option>

                                @foreach ($subCategories3 as $subCategory)
                                    <option
                                        {{ $popularCategories[3]->sub_category == $subCategory->id ? 'selected' : '' }}
                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('sub_category_4'))
                                <p class="text-danger">{{ $errors->first('sub_category_4') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories3 = \App\Models\ChildCategory::where(
                                    'sub_category_id',
                                    $popularCategories[3]->sub_category,
                                )->get();
                            @endphp
                            <label>Danh mục cấp 3</label>
                            <select name="child_category_4" id="" class="form-control child-category">
                                <option value="">- - Chọn danh mục - -</option>

                                @foreach ($childCategories3 as $childCategory)
                                    <option
                                        {{ $popularCategories[3]->child_category == $childCategory->id ? 'selected' : '' }}
                                        value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('child_category_4'))
                                <p class="text-danger">{{ $errors->first('child_category_4') }}</p>
                            @endif
                        </div>
                    </div>

                </div>

                <h6>Danh mục 5</h6>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Danh mục cấp 1</label>
                            <select name="category_5" id="" class="form-control main-category">
                                <option value="">- - Chọn danh mục - -</option>
                                @foreach ($categories as $category)
                                    <option {{ $popularCategories[4]->category == $category->id ? 'selected' : '' }}
                                        value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('category_5'))
                                <p class="text-danger">{{ $errors->first('category_5') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $subCategories4 = \App\Models\SubCategory::where(
                                    'category_id',
                                    $popularCategories[4]->category,
                                )->get();
                            @endphp
                            <label>Danh mục cấp 2</label>
                            <select name="sub_category_5" id="" class="form-control sub-category">
                                <option value="">- - Chọn danh mục - -</option>

                                @foreach ($subCategories4 as $subCategory)
                                    <option
                                        {{ $popularCategories[4]->sub_category == $subCategory->id ? 'selected' : '' }}
                                        value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('sub_category_5'))
                                <p class="text-danger">{{ $errors->first('sub_category_5') }}</p>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            @php
                                $childCategories4 = \App\Models\ChildCategory::where(
                                    'sub_category_id',
                                    $popularCategories[4]->sub_category,
                                )->get();
                            @endphp
                            <label>Danh mục cấp 3</label>
                            <select name="child_category_5" id="" class="form-control child-category">
                                <option value="">- - Chọn danh mục - -</option>

                                @foreach ($childCategories4 as $childCategory)
                                    <option
                                        {{ $popularCategories[4]->child_category == $childCategory->id ? 'selected' : '' }}
                                        value="{{ $childCategory->id }}">{{ $childCategory->name }}</option>
                                @endforeach

                            </select>
                            @if ($errors->has('child_category_5'))
                                <p class="text-danger">{{ $errors->first('child_category_5') }}</p>
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
