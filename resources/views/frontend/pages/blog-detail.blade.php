@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} | {{ $blog->title }}
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
                            <li><a href="#">Nội Dung</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="wsus__blog_details">
        <div class="container">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-8">
                    <div class="wsus__main_blog">
                        <div class="wsus__main_blog_img">
                            <img src="{{ asset($blog->image) }}" alt="blog" class="img-fluid w-100">
                        </div>
                        <p class="wsus__main_blog_header">
                            <span><i class="fas fa-user-tie"></i> by MegaMart</span>
                            <span><i class="fal fa-calendar-alt"></i> {{ $blog->created_at }}</span>
                            {{-- <span><i class="fal fa-comment-alt-smile"></i> 0 Comment</span> --}}
                            <span><i class="far fa-list"></i> {{ $blog->category }}</span>
                        </p>
                        <div class="wsus__description_area">
                            <h1>{{ $blog->title }}</h1>
                            {!! $blog->description !!}
                        </div>
                        {{-- <div class="wsus__share_blog">
                            <p>share:</p>
                            <ul>
                                <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                                <li><a class="linkedin" href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                <li><a class="pinterest" href="#"><i class="fab fa-pinterest-p"></i></a></li>
                            </ul>
                        </div> --}}
                        <div class="wsus__related_post mt-5">
                            <div class="row">
                                <div class="col-xl-12">
                                    <h5>Bài viết tương tự</h5>
                                </div>
                            </div>
                            <div class="row blog_det_slider">
                                @foreach ($relatedBlogs as $relatedBlog)
                                    @if ($relatedBlog->title !== $blog->title)
                                        <div class="col-xl-3">
                                            <div class="wsus__single_blog wsus__single_blog_2">
                                                <a class="wsus__blog_img"
                                                    href="{{ route('blog-detail', $relatedBlog->slug) }}">
                                                    <img src="{{ asset($relatedBlog->image) }}" alt="blog"
                                                        class="img-fluid w-100">
                                                </a>
                                                <div class="wsus__blog_text">
                                                    <p class="blog_top red">{{ limitText($relatedBlog->category, 10) }}</p>
                                                    <div class="wsus__blog_text_center">
                                                        <a
                                                            href="{{ route('blog-detail', $relatedBlog->slug) }}">{{ limitText($relatedBlog->title, 50) }}</a>
                                                        <p class="date">{{ $relatedBlog->created_at }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        {{-- <div class="wsus__comment_area">
                            <h4>comment <span>03</span></h4>
                            <div class="wsus__main_comment">
                                <div class="wsus__comment_img">
                                    <img src="images/client_img_1.jpg" alt="user" class="img-fluid w-100">
                                </div>
                                <div class="wsus__comment_text replay">
                                    <h6>Shopnil mahadi <span>09 Jul 2021</span></h6>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate sint
                                        molestiae eos? Officia, fuga eaque.</p>
                                    <a href="#" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapsetwo3">replay</a>
                                    <div class="accordion accordion-flush" id="accordionFlushExample3">
                                        <div class="accordion-item">
                                            <div id="flush-collapsetwo3" class="accordion-collapse collapse"
                                                aria-labelledby="flush-collapsetwo" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form>
                                                        <div class="wsus__riv_edit_single text_area">
                                                            <i class="far fa-edit"></i>
                                                            <textarea cols="3" rows="1" placeholder="Your Text"></textarea>
                                                        </div>
                                                        <button type="submit" class="common_btn">submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wsus__main_comment wsus__com_replay">
                                <div class="wsus__comment_img">
                                    <img src="images/client_img_3.jpg" alt="user" class="img-fluid w-100">
                                </div>
                                <div class="wsus__comment_text replay">
                                    <h6>Smith jhon <span>09 Jul 2021</span></h6>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate sint
                                        molestiae eos? Officia, fuga eaque.</p>
                                    <a href="#" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapsetwo2">replay</a>
                                    <div class="accordion accordion-flush" id="accordionFlushExample2">
                                        <div class="accordion-item">
                                            <div id="flush-collapsetwo2" class="accordion-collapse collapse"
                                                aria-labelledby="flush-collapsetwo" data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form>
                                                        <div class="wsus__riv_edit_single text_area">
                                                            <i class="far fa-edit"></i>
                                                            <textarea cols="3" rows="1" placeholder="Your Text"></textarea>
                                                        </div>
                                                        <button type="submit" class="common_btn">submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="wsus__main_comment">
                                <div class="wsus__comment_img">
                                    <img src="images/client_img_1.jpg" alt="user" class="img-fluid w-100">
                                </div>
                                <div class="wsus__comment_text replay">
                                    <h6>Smith jhon <span>09 Jul 2021</span></h6>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate sint
                                        molestiae eos? Officia, fuga eaque.</p>
                                    <a href="#" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapsetwo">replay</a>
                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                        <div class="accordion-item">
                                            <div id="flush-collapsetwo" class="accordion-collapse collapse"
                                                aria-labelledby="flush-collapsetwo"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <form>
                                                        <div class="wsus__riv_edit_single text_area">
                                                            <i class="far fa-edit"></i>
                                                            <textarea cols="3" rows="1" placeholder="Your Text"></textarea>
                                                        </div>
                                                        <button type="submit" class="common_btn">submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="pagination">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Previous">
                                                <i class="fas fa-chevron-left"></i>
                                            </a>
                                        </li>
                                        <li class="page-item"><a class="page-link page_active" href="#">1</a></li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#" aria-label="Next">
                                                <i class="fas fa-chevron-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="wsus__post_comment">
                            <h4>post a comment</h4>
                            <form action="#">
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="wsus__single_com">
                                            <input type="text" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="wsus__single_com">
                                            <input type="email" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <div class="wsus__single_com">
                                            <textarea rows="5" placeholder="Your Comment"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button class="common_btn" type="submit">post comment</button>
                            </form>
                        </div> --}}
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-4">
                    <div class="wsus__blog_sidebar" id="sticky_sidebar">
                        {{-- <div class="wsus__blog_search">
                            <h4>search</h4>
                            <form>
                                <input type="text" placeholder="Search">
                                <button type="submit" class="common_btn"><i class="far fa-search"></i></button>
                            </form>
                        </div> --}}
                        {{-- <div class="wsus__blog_category">
                            <h4>Categories</h4>
                            <ul>
                                <li><a href="#">Clothes</a></li>
                                <li><a href="#">Entertainment</a></li>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Lifestyle</a></li>
                                <li><a href="#">Technology</a></li>
                                <li><a href="#">Shoes</a></li>
                                <li><a href="#">electronic</a></li>
                                <li><a href="#">Others</a></li>
                            </ul>
                        </div> --}}
                        <div class="wsus__blog_post">
                            <h4>Bài viết mới nhất</h4>

                            @foreach ($latestBlogs as $item)
                                <div class="wsus__blog_post_single">
                                    <a href="{{ route('blog-detail', $item->slug) }}" class="wsus__blog_post_img">
                                        <img src="{{ asset($item->image) }}" alt="blog" class="imgofluid w-100">
                                    </a>
                                    <div class="wsus__blog_post_text">
                                        <a
                                            href="{{ route('blog-detail', $item->slug) }}">{{ limitText($item->title, 40) }}</a>
                                        <p> <span>{{ $item->created_at }} </span> </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        {{-- <div class="wsus__popular_tag">
                            <h4>popular tags</h4>
                            <ul>
                                <li><a href="#">Fashion</a></li>
                                <li><a href="#">Style</a></li>
                                <li><a href="#">Travel</a></li>
                                <li><a href="#">Women</a></li>
                                <li><a href="#">Men</a></li>
                                <li><a href="#">Hobbies</a></li>
                                <li><a href="#">Shopping</a></li>
                                <li><a href="#">Photography</a></li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
