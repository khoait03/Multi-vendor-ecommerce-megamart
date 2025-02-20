@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Quản Lý Chân Trang</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Quản Lý Chân Trang</a></div>
                <div class="breadcrumb-item"><a href="#">Nội Dung Chân Trang</a></div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Nội Dung Chân Trang</h2>
            <p class="section-lead">Tuỳ chỉnh nội dung hiển thị trên chân trang.</p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Danh sách nội dung</h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.footer-grid-two.create') }}" class="btn btn-primary mb-3">+ Thêm
                                    mới</a>
                            </div>
                        </div>
                        {{-- <div class="card-body">
                            <div class="table-responsive">
                                {{ $dataTable->table(['class' => 'table nowrap', 'style' => 'width: 100%;']) }}</div>
                        </div> --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <td class="text-center font-bold">STT</td>
                                            <th style="text-align: left">Id</th>
                                            <th style="text-align: center">Hiển thị ở cột</th>
                                            <th>Tiêu đề hiển thị</th>
                                            <th>Đường dẫn</th>
                                            <th>Trạng thái</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($footerContents as $key => $content)
                                            <tr>
                                                <td class="text-center font-bold">{{ $key + 1 }}</td>
                                                <td style="text-align: left">{{ $content->id }}</td>
                                                <td style="text-align: center">{{ $content->column }}</td>
                                                <td>{{ $content->name }}</td>
                                                <td>{{ $content->url }}</td>
                                                <td>
                                                    @if ($content->status == 1)
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' checked name='custom-switch-checkbox'
                                                                data-id='{{ $content->id }}'
                                                                class='custom-switch-input change-status'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @else
                                                        <label class='custom-switch mt-2'>
                                                            <input type='checkbox' name='custom-switch-checkbox'
                                                                data-id='{{ $content->id }}'
                                                                class='custom-switch-input change-status'>
                                                            <span class='custom-switch-indicator'></span>
                                                        </label>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-start">
                                                        <a href="{{ route('admin.footer-grid-two.edit', $content->id) }}"
                                                            class='btn btn-primary mr-2'>
                                                            <i class='fas fa-pen'></i>
                                                        </a>
                                                        <a href="{{ route('admin.footer-grid-two.destroy', $content->id) }}"
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
                    url: "{{ route('admin.footer-grid-two.change-status') }}",
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
