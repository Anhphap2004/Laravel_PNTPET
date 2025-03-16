@extends('layouts.master')
@section('content')
  <!-- PHẦN GIỚI THIỆU CHÍNH CỦA TRANG WEB -->
    <div class="container-fluid bg-danger py-5 mb-5 hero-header">
    </div>
    <!-- Hero End -->

{{-- Phần nhỏ about --}}
<div class="container-fluid py-5">
    <div class="container">
        <div class="row gx-5">
            <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                   <img class="position-absolute w-100 h-100 rounded"
    src="{{ filter_var($about->image, FILTER_VALIDATE_URL) ? $about->image : asset('img/' . ($about->image ?? 'default.jpg')) }}"
    style="object-fit: cover;">

                </div>
            </div>
            <div class="col-lg-7">
                <div style="border-color: #dc3545;" class="border-start border-5 ps-5 mb-5">
                    <h6 style="color: #dc3545;" class="text-uppercase">Về Chúng Tôi</h6>
                    <h1 style="font-family: Playball, cursive; color: #dc3545" class="display-6 mb-0">
                        {{ $about->title ?? 'Chúng tôi luôn mang lại niềm vui cho thú cưng của bạn' }}
                    </h1>
                </div>
                <h5 style="font-family: Montserrat, sans-serif; font-weight: 400; color:#dc3545" class="mb-4">
                    {{ $about->description ?? 'Chưa có mô tả.' }}
                </h5>
                <div class="bg-light p-4">
                    <ul class="nav nav-pills justify-content-between mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item w-50" role="presentation">
                            <button class="nav-link text-uppercase w-100 active" id="pills-1-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-1" type="button" role="tab" aria-controls="pills-1"
                                aria-selected="true">Sứ mệnh của chúng tôi</button>
                        </li>
                        <li class="nav-item w-50" role="presentation">
                            <button style="color: #dc3545;" class="nav-link text-uppercase w-100" id="pills-2-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-2" type="button" role="tab" aria-controls="pills-2"
                                aria-selected="false">Tầm nhìn của chúng tôi</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                            <p class="mb-0">{{ $about->content ?? 'Chưa có nội dung về sứ mệnh.' }}</p>
                        </div>
                        <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                            <p class="mb-0">Chưa có nội dung về tầm nhìn.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Kết thúc phần nhỏ about --}}

<!-- Services Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div style="border-color: #dc3545;" class="border-start border-5 ps-5 mb-5" style="max-width: 600px;">
            <h6 style="color: #dc3545;" class="text-uppercase">Dịch Vụ</h6>
            <h5 style="color: #dc3545;" class="display-7 text-uppercase mb-0">Dịch Vụ Chăm Sóc Thú Cưng Tốt Nhất</h5>
        </div>
        <div class="row g-5">
            @if($services->isEmpty())
                <p>Không có dịch vụ nào.</p>
            @else
                @foreach($services as $service)
                    <div class="col-md-6">
                        <div class="service-item d-flex p-4">
                            <i style="color: #dc3545;" class="{{ $service->Icon }} display-1 me-4"></i>
                            <div>
                                <h5 style="color: #dc3545;" class="text-uppercase mb-3">{{ $service->service_name }}</h5>
                                <p>{{ $service->description }}</p>
                                <a style="color: #dc3545;" class="text-uppercase" href="#">Xem thêm<i style="color: #dc3545;" class="bi bi-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
<!-- Services End -->

 <div class="container-fluid py-5">
    <div class="container">
        <div style="color: #dc3545;" class="border-start border-5 ps-5 mb-5">
            <h6 style="color: #dc3545;" class="text-uppercase">THÚ CƯNG</h6>
        </div>

        @if($animals->isEmpty())
            <p>Không có ảnh gallery nào cả</p>
        @else
            <div class="d-flex overflow-auto pb-3">
                @foreach($animals as $animal)
                    <div class="me-4" style="min-width: 250px; max-width: 300px;">
                        <div class="product-item position-relative bg-light d-flex flex-column text-center">
                            <div class="image-container">
                                <img class="img-fluid mb-4" src="{{ asset('img/Animal/' . $animal->image) }}" alt="">
                            </div>
                            <a href="{{ url('detail_animal/' . $animal->animal_id) }}" class="text-decoration-none">
                                <h6 style="color: #dc3545;" class="text-uppercase">{{ $animal->name }}</h6>
                                <span style="color:rgb(220, 114, 53); font-family: Montserrat, sans-serif;" class="mb-0">
                                    {{ $animal->description }}
                                </span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>

<!-- Pricing Plan Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="border-start border-5 ps-5 mb-5" style="border-color:#DC3545; max-width: 600px;">
            <h5 style="color: #DC3545;" class="text-uppercase">Bảng Giá Dịch Vụ</h5>
        </div>
        <div class="row g-5">
            @foreach ($prices as $price)
                <div class="col-lg-4">
                    <div class="bg-light text-center pt-5">
                        <h2 class="text-uppercase">{{ $price->title }}</h2>
                        <br><br>
                        <div class="text-center p-4 mb-2" style="background-color: #DC3545;">
                            <h1 class="display-6 text-white mb-0">
                                <small class="align-top" style="font-size: 18px; line-height: 35px;">₫</small>
                                {{ number_format($price->Price, 0, ',', '.') }}
                                <small class="align-bottom" style="font-size: 14px; line-height: 30px;">/ Tháng</small>
                            </h1>
                        </div>
                        <div class="text-center p-4">
                            <span>{{ $price->Content }}</span>
                            <a href="#" class="btn btn-danger text-uppercase py-2 px-4 my-3">Order Now</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Pricing Plan End -->


<!-- Gallery Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="border-start border-5 ps-5 mb-5" style="border-color:#DC3545; max-width: 600px;">
            <h5 style="color: #DC3545;" class="text-uppercase">Thư Viện Ảnh</h5>
        </div>

        @if ($gallery->isEmpty())
            <p class="text-center">Chưa có hình ảnh nào trong thư viện.</p>
        @else
            <div class="position-relative">
                <!-- Left navigation button -->
                <button id="gallery-prev" class="position-absolute start-0 top-50 translate-middle-y btn btn-danger rounded-circle z-index-1" style="width: 40px; height: 40px; left: -20px;">
                    <i class="fas fa-chevron-left"></i>
                </button>

                <!-- Gallery container with horizontal scroll -->
                <div class="gallery-container overflow-hidden">
                    <div class="gallery-scroll d-flex" style="transition: transform 0.5s ease;">
                        @foreach ($gallery as $image)
                            <div class="gallery-item px-2" style="min-width: 350px;">
                                <div class="team-item">
                                    <div class="position-relative overflow-hidden">

                                        <img class="img-fluid w-100" src="{{ asset('img/Gallery/' . $image->image_path) }}" alt="">
                                        <div class="team-overlay"></div>
                                    </div>
                                    <div class="bg-light text-center p-4">
                                        <h5 class="text-danger text-uppercase">{{ $image->title }}</h5>
                                        <p class="m-0">{{ $image->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right navigation button -->
                <button id="gallery-next" class="position-absolute end-0 top-50 translate-middle-y btn btn-danger rounded-circle z-index-1" style="width: 40px; height: 40px; right: -20px;">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <!-- Add this JavaScript to handle the left/right navigation -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const container = document.querySelector('.gallery-scroll');
                    const items = document.querySelectorAll('.gallery-item');
                    const prevBtn = document.getElementById('gallery-prev');
                    const nextBtn = document.getElementById('gallery-next');

                    let currentIndex = 0;
                    const itemWidth = items[0].offsetWidth;
                    const visibleItems = Math.floor(container.parentElement.offsetWidth / itemWidth);
                    const maxIndex = items.length - visibleItems;

                    // Hide prev button initially
                    prevBtn.style.opacity = '0.5';

                    // Function to update button states
                    function updateButtonStates() {
                        prevBtn.style.opacity = currentIndex <= 0 ? '0.5' : '1';
                        nextBtn.style.opacity = currentIndex >= maxIndex ? '0.5' : '1';
                    }

                    // Function to scroll to a specific index
                    function scrollToIndex(index) {
                        currentIndex = Math.max(0, Math.min(index, maxIndex));
                        container.style.transform = `translateX(-${currentIndex * itemWidth}px)`;
                        updateButtonStates();
                    }

                    // Event listeners for buttons
                    prevBtn.addEventListener('click', () => {
                        scrollToIndex(currentIndex - 1);
                    });

                    nextBtn.addEventListener('click', () => {
                        scrollToIndex(currentIndex + 1);
                    });

                    // Update button states on window resize
                    window.addEventListener('resize', () => {
                        const newItemWidth = items[0].offsetWidth;
                        const newVisibleItems = Math.floor(container.parentElement.offsetWidth / newItemWidth);
                        const newMaxIndex = items.length - newVisibleItems;

                        if (currentIndex > newMaxIndex) {
                            scrollToIndex(newMaxIndex);
                        } else {
                            updateButtonStates();
                        }
                    });
                });
            </script>
        @endif
    </div>
</div>
<!-- Gallery End -->

<!-- Testimonial Start -->
<div class="container-fluid py-5" style="margin: 45px 0;">
    <div class="container py-5">
        <div class="row align-items-center">
            <!-- Cột chứa ảnh nền -->
            <div class="col-lg-5 d-none d-lg-block bg-testimonial"></div>

            <!-- Cột chứa nội dung testimonial -->
            <div class="col-lg-7">
                <div class="owl-carousel testimonial-carousel bg-white p-5 custom-border">
                    @foreach ($testimonial as $testimonial)
                        <div class="testimonial-item text-center">
                            <div class="position-relative mb-4">
                                <img class="img-fluid mx-auto" src="{{ asset('img/Testimonial/' . $testimonial->image) }}" alt="Ảnh khách hàng">
                                <div class="position-absolute top-100 start-50 translate-middle d-flex align-items-center justify-content-center bg-white border rounded-circle shadow-sm" style="width: 45px; height: 45px;">
                                    <i class="bi bi-chat-square-quote text-danger"></i>
                                </div>
                            </div>
                            <p>{{ $testimonial->review_text }}</p>
                            <hr class="w-25 mx-auto">
                            <h5 class="text-uppercase text-danger">{{ $testimonial->client_name }}</h5>
                            <span>{{ $testimonial->profession }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial End -->


<div class="container-fluid py-5">
    <div class="container">
        <div class="border-start border-5 border-danger ps-5 mb-5" style="max-width: 600px;">
            <h5 class="text-danger text-uppercase">Bài Viết</h5>
        </div>

        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-lg-6 mb-4">
                    <div class="card shadow-sm border-0">
                        <div class="row g-0">
                            <!-- Hình ảnh -->
                            <div class="col-12 col-sm-5">
                                <img class="img-fluid w-100 h-100" src="{{ asset('img/blog/' . $blog->featured_image) }}"
                                     style="object-fit: cover; max-height: 200px;" alt="Blog Image">
                            </div>

                            <!-- Nội dung -->
                            <div class="col-12 col-sm-7 d-flex flex-column">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between mb-2">
                                        <small class="text-muted"><i class="bi bi-bookmarks"></i> {{ $blog->category }}</small>
                                        <small class="text-muted"><i class="bi bi-calendar-date text-danger"></i> {{ date('d M, Y', strtotime($blog->created_at)) }}</small>
                                    </div>

                                    <h5 class="text-danger text-uppercase mb-2">{{ $blog->title }}</h5>
                                    <p class="text-muted mb-3">{{ Str::limit($blog->excerpt, 100, '...') }}</p>

                                    <a href="{{ url('blog-detail/' . $blog->post_id) }}"
                                       class="btn btn-outline-danger btn-sm text-uppercase">Read More <i class="bi bi-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>



@endsection
