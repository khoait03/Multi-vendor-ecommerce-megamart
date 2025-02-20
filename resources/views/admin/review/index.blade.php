@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Đánh Giá</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Đánh Giá</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Quản Lý Đánh Giá</h2>
            <p class="section-lead">Danh sách đánh giá của khách hàng cho các sản phẩm.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách đánh giá</h4>
                            {{-- <div class="card-header-action">
                                <a href="{{ route('admin.child-category.create') }}" class="btn btn-primary mb-3">+ Thêm
                                    mới</a>
                            </div> --}}
                        </div>
                        <div class="card-body">
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reviews as $key => $review)
                                            <tr>
                                                <td class="text-center font-bold">{{ $key + 1 }}</td>
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
                                                <td>
                                                    @if ($review->status == 1)
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' checked name='custom-switch-checkbox'
                                                                data-id='{{ $review->id }}'
                                                                class='custom-switch-input change-status'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @else
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' name='custom-switch-checkbox'
                                                                data-id='{{ $review->id }}'
                                                                class='custom-switch-input change-status'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <a href="{{ route('admin.reviews.destroy', $review->id) }}"
                                                            class='btn btn-danger mr-2 delete-item'>
                                                            <i class='fas fa-trash'></i>
                                                        </a>


                                                    </div>
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
        </div>
    </section>
@endsection

@push('scripts')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}

    <script>
        $(document).ready(function() {
            $("body").on('click', ".change-status", function() {
                let isChecked = $(this).is(":checked")
                let id = $(this).data('id')

                $.ajax({
                    url: "{{ route('admin.reviews.change-status') }}",
                    method: "PUT",
                    data: {
                        id: id,
                        status: isChecked
                    },
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })
        })
    </script>
@endpush
