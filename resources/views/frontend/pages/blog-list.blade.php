@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | Bài viết
@endsection

@section('content')
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>Bài Viết</h4>
                        <ul>
                            <li><a href="{{ url('/') }}">Trang Chủ</a></li>
                            <li><a href="#">Bài Viết</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__blogs">
        <div class="container">
            <div class="row">

                @foreach ($blogs as $blog)
                    <div class="col-xl-4 col-sm-6 col-lg-4 col-xxl-3">
                        <div class="wsus__single_blog wsus__single_blog_2">
                            <a class="wsus__blog_img" href="{{ route('blog-detail', $blog->slug) }}">
                                <img src="{{ asset($blog->image) }}" alt="blog" class="img-fluid w-100">
                            </a>
                            <div class="wsus__blog_text">
                                <p class="blog_top red">{{ limitText($blog->category, 10) }}</p>
                                <div class="wsus__blog_text_center">
                                    <a href="{{ route('blog-detail', $blog->slug) }}">{{ limitText($blog->title, 50) }}</a>
                                    <p class="date">{{ $blog->created_at }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-xl-12">
                @if ($blogs->hasPages())
                    <div class="mt-5 d-flex justify-content-center">{{ $blogs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
