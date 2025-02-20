<section id="wsus__brand_sleder" class="brand_slider_2" style="padding: 15px 0">
    <div class="container">
        <div class="brand_border">
            <div class="row brand_slider">

                @foreach ($brands as $brand)
                    <div class="col-xl-2 brand-item hidden">
                        <div class="wsus__brand_logo">
                            <img src="{{ asset($brand->logo) }}" alt="brand" class="img-fluid w-100">
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

@push('scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".brand-item").removeClass('hidden'); // Hiển thị slider sau khi exzoom được khởi tạo
            }, 10); // Delay 1 giây (1000 milliseconds)
        });
    </script>
@endpush
