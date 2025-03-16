@extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-8">
            <!-- Hiển thị bài viết -->
            <div class="mb-5">
                <img class="img-fluid w-100 rounded mb-5" src="{{ asset('img/Animal/' . $animal->image) }}" alt="">
                <h1 class="text-uppercase mb-4">{{ $animal->name }}</h1>
               <p>{!! $animal->detail !!}</p>
                <small>Ngày đăng: {{ date('d/m/Y', strtotime($animal->created_at)) }}</small>
            </div>

            <!-- Danh sách bình luận -->
            <div class="mb-5">
                <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">
                    {{ count($comments) }} Người bình luận 💭
                </h3>
                @foreach($comments as $comment)
                    <div class="d-flex mb-4">
                        <img src="{{ asset($comment->profile_image ? 'img/Username/' . $comment->profile_image : 'img/Animal/meocon.jpg') }}"
                            class="img-fluid rounded-circle" style="width: 45px; height: 45px; object-fit: cover;">
                        <div class="ps-3">
                            <h6>
                                <a class="text-danger" href="">{{ $comment->name ?? 'Người dùng' }}</a>
                             <small><i>{{ \Carbon\Carbon::parse($comment->created_at)->translatedFormat('d F Y') }}</i></small>



                            </h6>
                            <p>{{ nl2br(e($comment->comment)) }}</p>
                            <button class="btn btn-sm btn-light">Phản Hồi</button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Form bình luận -->
           <div class="bg-light rounded p-4 shadow">
    <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Leave a comment</h3>
    <form action="{{ route('animal.review.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="animal_id" value="{{ $animal->animal_id }}">

        <div class="row g-3">
            @if(auth()->check())
                <!-- Nếu đã đăng nhập, tự động lấy user_id -->
                <input type="hidden" name="user_id" value="{{ auth()->user()->user_id }}">
                <input type="hidden" name="name" value="{{ auth()->user()->username }}">
                <input type="hidden" name="email" value="{{ auth()->user()->email }}">
                <p><strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }})</p>
            @else
                <!-- Nếu chưa đăng nhập, yêu cầu nhập name và email -->
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
                <textarea name="comment" class="form-control bg-white border rounded-3 px-3 py-2"
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
             <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" class="form-control p-3" placeholder="Keyword">
                        <button class="btn btn-danger px-4"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->
            <!-- Danh mục động vật -->
            <div class="mb-5">
                <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">DANH MỤC</h3>
                @if(!empty($category))
                    <a href="#" class="d-flex align-items-center py-2 px-3 bg-light mb-1">
                        <i class="bi bi-arrow-right text-danger me-2"></i>
                        <span class="fw-bold fs-5 text-danger category-highlight">
                            {{ $category->category_name }}
                        </span>
                    </a>
                @else
                    <p class="text-muted px-3">Không có danh mục nào.</p>
                @endif
            </div>

            <!-- Động vật liên quan -->
            <div class="mb-5">
                <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4 text-danger">Động vật liên quan</h3>
                @foreach($relatedAnimals as $related)
                    <div class="d-flex overflow-hidden mb-3 align-items-start">
                        <img class="img-fluid" src="{{ asset('img/Animal/' . $related->image) }}"
                            style="width: 100px; height: 100px; object-fit: cover;" alt="">
                        <div class="ms-2">
                            <a href="{{ url('/animals/' . $related->animal_id) }}" class="animal-name text-danger">
                                {{ $related->name }}
                            </a>
                            <p class="animal-desc">{{ $related->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mb-5">
                <img class="img-fluid rounded" src="{{ asset('img/Animal/' . $animal->image) }}" alt="">
            </div>
             <!-- Bắt đầu Tags -->
                <div class="mb-5">
                    <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Từ khoá phổ biến</h3>
                    <div class="d-flex flex-wrap m-n1"> <a href="" class="btn btn-danger m-1">Thiết kế</a> <a href="" class="btn btn-danger m-1">Phát triển</a> <a href="" class="btn btn-danger m-1">Tiếp thị</a> <a href="" class="btn btn-danger m-1">SEO</a> <a href="" class="btn btn-danger m-1">Viết lách</a> <a href="" class="btn btn-danger m-1">Tư vấn</a> <a href="" class="btn btn-danger m-1">Thiết kế</a> <a href="" class="btn btn-danger m-1">Phát triển</a> <a href="" class="btn btn-danger m-1">Tiếp thị</a> <a href="" class="btn btn-danger m-1">SEO</a> <a href="" class="btn btn-danger m-1">Viết lách</a> <a href="" class="btn btn-danger m-1">Tư vấn</a> </div>
                </div> <!-- Kết thúc Tags -->

                <!-- Bắt đầu Nội dung Văn bản -->
                <div>
                    <h3 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Nội dung Văn bản</h3>
                    <div class="bg-light text-center" style="padding: 30px;">
                        <p>Chào mừng bạn đến với trang của chúng tôi! Hãy khám phá những bài viết mới nhất và những thông tin hữu ích về chủ đề bạn quan tâm.</p>
                        <a href="" class="btn btn-danger py-2 px-4">Đọc thêm</a>
                    </div>
                </div>
                <!-- Kết thúc Nội dung Văn bản -->
        </div>
    </div>
</div>
@endsection
