@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        <!-- Blog list Start -->
        <div class="col-lg-8">
            @foreach ($posts as $post)
                <div class="blog-item mb-5">
                    <div class="row g-0 bg-light overflow-hidden">
                        <div class="col-12 col-sm-5 h-100">
                            <img class="img-fluid h-100" src="{{ asset('img/blog/' . $post->featured_image) }}" style="object-fit: cover;">
                        </div>
                        <div class="col-12 col-sm-7 h-100 d-flex flex-column justify-content-center">
                            <div class="p-4">
                                <div class="d-flex mb-3">
                                    <small class="me-3"><i class="bi bi-bookmarks me-2"></i> {{ $post->category }}</small>
                                    <small><i class="bi bi-calendar-date me-2"></i> {{ date('d M, Y', strtotime($post->date)) }}</small>
                                </div>
                                <h5 class="text-uppercase mb-3">{{ $post->title }}</h5>
                                <p>{{ Str::limit($post->excerpt, 100) }}</p>
                                <a class="text-danger text-uppercase" href="{{ url('blog/' . $post->post_id) }}">Read More <i class="bi bi-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="col-12">
                <nav aria-label="Page navigation">
                    <ul class="pagination pagination-lg m-0">
                        <li class="page-item {{ $page <= 1 ? 'disabled' : '' }}">
                            <a class="page-link rounded-0" href="?page={{ $page - 1 }}" aria-label="Previous">
                                <span aria-hidden="true"><i class="bi bi-arrow-left"></i></span>
                            </a>
                        </li>
                        @for ($i = 1; $i <= $totalPages; $i++)
                            <li class="page-item {{ $i == $page ? 'active' : '' }}">
                                <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item {{ $page >= $totalPages ? 'disabled' : '' }}">
                            <a class="page-link rounded-0" href="?page={{ $page + 1 }}" aria-label="Next">
                                <span aria-hidden="true"><i class="bi bi-arrow-right"></i></span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- Blog list End -->

        <!-- Sidebar Start -->
        <div class="col-lg-4">
            <!-- Search Form -->
            <div class="mb-5">
                <div class="input-group">
                    <input type="text" class="form-control p-3" placeholder="Keyword">
                    <button class="btn btn-danger px-4"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <!-- Category Start -->
            <div class="mb-5">
                <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Danh mục bài viết</h3>
                <ul class="list-group">
                    @foreach ($categories as $category)
                        <li class="list-group-item">
                            <a href="{{ url('blog?category=' . urlencode($category)) }}" class="text-dark">
                                {{ $category }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <!-- Category End -->

            <!-- Recent Post Start -->
            <div class="mb-5">
                <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Bài viết gần nhất</h3>
                @foreach ($recentPosts as $post)
                    <div class="d-flex mb-3">
                        <img class="img-fluid" src="{{ asset('img/blog/' . $post->featured_image) }}" style="width: 80px; height: 80px; object-fit: cover;">
                        <div class="ps-3">
                            <h6 class="text-uppercase mb-2"><a href="{{ url('blog/' . $post->post_id) }}" class="text-dark">{{ $post->title }}</a></h6>
                            <small class="text-muted"><i class="bi bi-calendar-date me-1"></i> {{ date('d M, Y', strtotime($post->date)) }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Recent Post End -->

            <!-- Tags -->
            <div class="mb-5">
                <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Từ khoá phổ biến</h3>
                <div class="d-flex flex-wrap m-n1">
                    @foreach (['Thiết kế', 'Phát triển', 'Tiếp thị', 'SEO', 'Viết lách', 'Tư vấn'] as $tag)
                        <a href="" class="btn btn-danger m-1">{{ $tag }}</a>
                    @endforeach
                </div>
            </div>

            <!-- Text Content -->
            <div>
                <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Nội dung Văn bản</h3>
                <div class="bg-light text-center p-4">
                    <p>Chào mừng bạn đến với trang của chúng tôi! Hãy khám phá những bài viết mới nhất và những thông tin hữu ích về chủ đề bạn quan tâm.</p>
                    <a href="" class="btn btn-danger py-2 px-4">Đọc thêm</a>
                </div>
            </div>
        </div>
        <!-- Sidebar End -->
    </div>
</div>
@endsection
