@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-8">
            <!-- Hiển thị bài viết -->
            <div class="mb-5">
                <img class="img-fluid w-100 rounded mb-5" src="{{ asset('img/Blog/' . $post->featured_image) }}" alt="{{ $post->title }}">
                <h1 class="text-uppercase mb-4">{{ $post->title }}</h1>
                <small class="text-muted">Ngày đăng: {{ date('d/m/Y', strtotime($post->created_at)) }}</small>
                <p class="mt-3">{!! $post->content !!}</p>
            </div>

            <!-- Danh sách bình luận -->
            <div class="mb-5">
                <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">
                    {{ count($comments) }} Bình luận 💭
                </h3>
                @foreach($comments as $comment)
                    <div class="d-flex mb-4">
                           <img src="{{ asset($comment->profile_image ? 'img/Username/' . $comment->profile_image : 'img/Animal/meocon.jpg') }}"
                            class="img-fluid rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
                        <div class="ps-3">
                            <h6>
                                <a class="text-danger" href="">{{ $comment->author_name ?? 'Ẩn danh' }}</a>
                                <small><i>{{ date('d M Y', strtotime($comment->created_at)) }}</i></small>
                            </h6>
                            <p>{{ nl2br(e($comment->content)) }}</p>
                            <button class="btn btn-sm btn-light">Phản Hồi</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Form bình luận -->
         <div class="bg-light rounded p-4 shadow">
    <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Leave a comment</h3>
    <form action="{{ route('blogcomment.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->post_id }}">

        <div class="row g-3">
            @if(auth()->check())
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="name" value="{{ auth()->user()->username }}">
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <p><strong>{{ auth()->user()->username }}</strong> ({{ auth()->user()->email }})</p>
            @else
                <div class="col-12 col-sm-6">
                    <input type="text" name="name" class="form-control bg-white border rounded-pill px-3"
                        placeholder="Your Name" required style="height: 50px;">
                </div>
                <div class="col-12 col-sm-6">
                    <input type="email" name="email" class="form-control bg-white border rounded-pill px-3"
                        placeholder="Your Email" required style="height: 50px;">
                </div>
            @endif
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <textarea name="content" class="form-control bg-white border rounded-3 px-3 py-2"
                    rows="5" placeholder="Write your comment..." required></textarea>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <button class="btn btn-danger w-100 py-3 rounded-pill fw-bold" type="submit">
                    🚀 Leave Your Comment
                </button>
            </div>
        </div>
    </form>
</div>

        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Tìm kiếm -->
            <div class="mb-5">
                <div class="input-group">
                    <input type="text" class="form-control p-3" placeholder="Tìm kiếm...">
                    <button class="btn btn-danger px-4"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <!-- Danh mục bài viết -->
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


            <!-- Bài viết liên quan -->
            <div class="mb-5">
                <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4 text-danger">Bài viết liên quan</h3>
                @foreach($recentPosts as $related)
                    <div class="d-flex overflow-hidden mb-3 align-items-start">
                        <img class="img-fluid" src="{{ asset('img/Blog/' . $related->featured_image) }}"
                            style="width: 100px; height: 100px; object-fit: cover;" alt="{{ $related->title }}">
                        <div class="ms-2">
                            <a href="{{ url('/blog/' . $related->post_id) }}" class="text-danger">
                                {{ $related->title }}
                            </a>
                          <p>{{ Str::limit(strip_tags($related->content), 50) }}</p>

                        </div>
                    </div>
                @endforeach
            </div>
 <div class="mb-5">
                <img class="img-fluid rounded" src="{{ asset('img/Blog/' . $post->featured_image) }}" alt="">
            </div>
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
    </div>
</div>
@endsection
