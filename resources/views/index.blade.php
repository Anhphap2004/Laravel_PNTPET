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
                            <a href="{{ url('animals/' . $animal->animal_id) }}" class="text-decoration-none">
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

                                    <a href="{{ url('blog/' . $blog->post_id) }}"
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
<div class="lucky-draw-container">
    <a href="{{ url('/lucky-draw') }}" class="lucky-draw-link">
        <div class="lucky-draw-icon">
            <div class="lucky-wheel">
                <div class="wheel-center"></div>
                <div class="wheel-section section1"></div>
                <div class="wheel-section section2"></div>
                <div class="wheel-section section3"></div>
                <div class="wheel-section section4"></div>
                <div class="wheel-section section5"></div>
                <div class="wheel-section section6"></div>
                <div class="lucky-star">
                    <i class="fas fa-star"></i>
                </div>
            </div>
            <div class="lucky-text">Bốc Thăm May Mắn</div>
        </div>
    </a>
</div>

<!-- Add this CSS to your stylesheet or in a style tag in the head section -->
<style>
    .lucky-draw-container {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 999;
    }

    .lucky-draw-link {
        text-decoration: none;
    }

    .lucky-draw-icon {
        width: 120px;
        height: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .lucky-draw-icon:hover {
        transform: scale(1.1);
    }

    .lucky-wheel {
        position: relative;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #fff;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        animation: rotate 20s linear infinite;
        transition: all 0.3s ease;
    }

    .lucky-draw-icon:hover .lucky-wheel {
        animation: rotate 5s linear infinite;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .wheel-center {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
        background: #dc3545;
        border-radius: 50%;
        z-index: 2;
    }

    .wheel-section {
        position: absolute;
        width: 50%;
        height: 50%;
        transform-origin: bottom right;
    }

    .section1 {
        top: 0;
        left: 0;
        background: #dc3545;
        border-radius: 80px 0 0 0;
    }

    .section2 {
        top: 0;
        right: 0;
        background: #ffc107;
        border-radius: 0 80px 0 0;
    }

    .section3 {
        bottom: 0;
        right: 0;
        background: #28a745;
        border-radius: 0 0 80px 0;
    }

    .section4 {
        bottom: 0;
        left: 0;
        background: #17a2b8;
        border-radius: 0 0 0 80px;
    }

    .section5 {
        top: 25%;
        left: 25%;
        width: 25%;
        height: 25%;
        background: #f7f7f7;
        border-radius: 50%;
        z-index: 1;
    }

    .section6 {
        top: 35%;
        left: 35%;
        width: 15%;
        height: 15%;
        background: #ffed4a;
        border-radius: 50%;
        z-index: 1;
        animation: pulse 2s infinite;
    }

    .lucky-star {
        position: absolute;
        top: -10px;
        right: -10px;
        color: #ffc107;
        font-size: 24px;
        animation: twinkle 1.5s infinite alternate;
        z-index: 3;
    }

    @keyframes twinkle {
        0% { transform: scale(1); opacity: 0.7; }
        100% { transform: scale(1.3); opacity: 1; }
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }

    .lucky-text {
        margin-top: 10px;
        color: #dc3545;
        font-weight: bold;
        text-transform: uppercase;
        font-size: 14px;
        text-align: center;
        text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        animation: glow 2s infinite alternate;
    }

    @keyframes glow {
        0% { text-shadow: 0 0 5px rgba(220, 53, 69, 0.5); }
        100% { text-shadow: 0 0 15px rgba(220, 53, 69, 0.8), 0 0 20px rgba(220, 53, 69, 0.5); }
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .lucky-draw-container {
            bottom: 20px;
            right: 20px;
        }

        .lucky-draw-icon {
            width: 100px;
            height: 100px;
        }

        .lucky-wheel {
            width: 70px;
            height: 70px;
        }

        .lucky-text {
            font-size: 12px;
        }
    }



    body {
            font-family: 'Nunito', 'Arial', sans-serif;
            background: #fef9f9;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #ff69b4;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
            font-size: 2.2em;
            margin-bottom: 30px;
        }
        #chat-toggle {
            position: fixed;
            bottom: 20px;
            left: 20px; /* Changed from right to left */
            background: linear-gradient(145deg, #ff69b4, #ff8dc7);
            color: white;
            border: none;
            border-radius: 50%;
            width: 65px;
            height: 65px;
            font-size: 28px;
            box-shadow: 0 4px 15px rgba(255, 105, 180, 0.5);
            cursor: pointer;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #chat-toggle:hover {
            transform: scale(1.1) rotate(10deg);
            box-shadow: 0 6px 20px rgba(255, 105, 180, 0.6);
        }
        #chatbox-container {
            position: fixed;
            bottom: 90px;
            left: 20px; /* Changed from right to left */
            width: 320px;
            background: white;
            border: none;
            border-radius: 18px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            display: none;
            flex-direction: column;
            overflow: hidden;
            z-index: 999;
            animation: pop-in 0.5s cubic-bezier(0.26, 1.36, 0.44, 0.95) forwards;
        }
        #chatbox-header {
            background: linear-gradient(to right, #ff69b4, #ff8dc7);
            color: white;
            padding: 15px;
            font-weight: bold;
            display: flex;
            align-items: center;
            border-radius: 16px 16px 0 0;
        }
        #chatbox-header img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
            border-radius: 50%;
        }
        #chatbox {
            padding: 15px;
            height: 300px;
            overflow-y: auto;
            background-color: #f9f2f6;
            scroll-behavior: smooth;
        }
        .message {
            margin-bottom: 12px;
            max-width: 85%;
            padding: 10px 15px;
            border-radius: 18px;
            position: relative;
            animation: message-pop 0.3s ease forwards;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            word-break: break-word;
        }
        .user {
            background-color: #e2f8ff;
            color: #0a5e7d;
            margin-left: auto;
            border-radius: 18px 18px 0 18px;
        }
        .bot {
            background-color: #ffe6f2;
            color: #d4427e;
            margin-right: auto;
            border-radius: 18px 18px 18px 0;
        }
        .message:before {
            content: '';
            position: absolute;
            bottom: 0;
            width: 20px;
            height: 20px;
        }
        .user:before {
            right: -10px;
            border-bottom-left-radius: 16px;
            box-shadow: -10px 0 0 0 #e2f8ff;
        }
        .bot:before {
            left: -10px;
            border-bottom-right-radius: 16px;
            box-shadow: 10px 0 0 0 #ffe6f2;
        }
        #chat-input {
            display: flex;
            background-color: white;
            padding: 10px;
            border-top: 1px solid #f0f0f0;
        }
        #chat-input input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 25px;
            outline: none;
            font-size: 0.95em;
            transition: border 0.3s ease;
        }
        #chat-input input:focus {
            border-color: #ff69b4;
            box-shadow: 0 0 0 2px rgba(255, 105, 180, 0.2);
        }
        #chat-input button {
            padding: 10px 20px;
            margin-left: 8px;
            background: linear-gradient(145deg, #ff69b4, #ff8dc7);
            border: none;
            border-radius: 25px;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }
        #chat-input button:hover {
            background: linear-gradient(145deg, #ff8dc7, #ff69b4);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 105, 180, 0.3);
        }
        .typing-indicator {
            display: inline-block;
            padding: 10px 15px;
            background-color: #ffe6f2;
            border-radius: 18px;
            margin-bottom: 10px;
        }
        .typing-indicator span {
            height: 8px;
            width: 8px;
            float: left;
            margin: 0 1px;
            background-color: #ff69b4;
            display: block;
            border-radius: 50%;
            opacity: 0.4;
        }
        .typing-indicator span:nth-child(1) {
            animation: typing 1s infinite 0s;
        }
        .typing-indicator span:nth-child(2) {
            animation: typing 1s infinite 0.2s;
        }
        .typing-indicator span:nth-child(3) {
            animation: typing 1s infinite 0.4s;
        }
        @keyframes typing {
            0% { transform: translateY(0px); opacity: 0.4; }
            50% { transform: translateY(-5px); opacity: 0.8; }
            100% { transform: translateY(0px); opacity: 0.4; }
        }
        @keyframes message-pop {
            0% { transform: scale(0.8); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        @keyframes pop-in {
            0% { transform: scale(0.9); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
        #pet-animation {
            position: absolute;
            left: 390px;
            bottom: 10px;
            font-size: 60px;
            transition: all 0.5s ease;
            transform-origin: bottom;
            cursor: pointer;
            text-shadow: 0 3px 5px rgba(0,0,0,0.1);
        }
        #pet-animation:hover {
            transform: scale(1.2) rotate(5deg);
        }

        @media (max-width: 768px) {
            #chatbox-container {
                width: 80%;
                max-width: 320px;
            }
            #pet-animation {
                display: none;
            }
        }
</style>

<!-- Add this JavaScript to make the icon more interactive -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const luckyIcon = document.querySelector('.lucky-draw-icon');

    // Add confetti effect when hovering over the lucky draw icon
    luckyIcon.addEventListener('mouseover', function() {
        // Bounce effect
        this.style.animation = 'bounce 0.5s ease';

        // Reset animation
        setTimeout(() => {
            this.style.animation = '';
        }, 500);
    });

    // Add keyframe animation for bounce effect
    const style = document.createElement('style');
    style.innerHTML = `
        @keyframes bounce {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }
    `;
    document.head.appendChild(style);
});
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">

 <!-- Nút mở chatbot -->
 <button id="chat-toggle">🐾</button>
 <div id="pet-animation">🐱</div>

 <!-- Hộp chatbot -->
 <div id="chatbox-container">
     <div id="chatbox-header">
         <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA1MTIgNTEyIiBmaWxsPSJ3aGl0ZSI+PHBhdGggZD0iTTI1NiA0NEMxNDEuMSA0NCA0OCAxMzcuMSA0OCAyNTJjMCA0OC42IDE2LjcgOTMuMiA0NC42IDEyOC42bC0zMS42IDk1YTEyIDEyIDAgMCAwIDE1IDE1bDk1LTMxLjZDMTU4LjggNDkxLjMgMjAzLjQgNTA4IDI1NiA1MDhjMTE0LjkgMCAyMDgtOTMuMSAyMDgtMjA4UzM3MC45IDQ0IDI1NiA0NHpNMTc2IDI4MGMtMTcuNyAwLTMyLTE0LjMtMzItMzJzMTQuMy0zMiAzMi0zMiAzMiAxNC4zIDMyIDMyLTE0LjMgMzItMzIgMzJ6bTgwIDBjLTE3LjcgMC0zMi0xNC4zLTMyLTMyczE0LjMtMzIgMzItMzIgMzIgMTQuMyAzMiAzMi0xNC4zIDMyLTMyIDMyem04MCAwYy0xNy43IDAtMzItMTQuMy0zMi0zMnMxNC4zLTMyIDMyLTMyIDMyIDE0LjMgMzIgMzItMTQuMyAzMi0zMiAzMnoiLz48L3N2Zz4=" alt="Pet Chat">
         <span>Pet Chat Trợ Giúp</span>
     </div>
     <div id="chatbox">
         <div class="message bot">Xin chào bạn! 🐱 Mình là trợ lý thú cưng. Bạn có thể hỏi mình về giá dịch vụ, cách đăng ký, thú cưng có sẵn, giờ làm việc hoặc khuyến mãi nhé!</div>
     </div>
     <div id="chat-input">
         <input type="text" id="userInput" placeholder="Nhập câu hỏi về thú cưng...">
         <button onclick="sendMessage()">Gửi</button>
     </div>
 </div>

 <script>
     const toggleBtn = document.getElementById('chat-toggle');
     const chatBox = document.getElementById('chatbox-container');
     const petAnimation = document.getElementById('pet-animation');
     let petEmojis = ['🐱', '🐶', '🐰', '🐹'];
     let currentEmoji = 0;

     toggleBtn.addEventListener('click', () => {
         chatBox.style.display = chatBox.style.display === 'flex' ? 'none' : 'flex';
         if (chatBox.style.display === 'flex') {
             document.getElementById('userInput').focus();
         }
     });

     petAnimation.addEventListener('click', () => {
         currentEmoji = (currentEmoji + 1) % petEmojis.length;
         petAnimation.textContent = petEmojis[currentEmoji];
         petAnimation.style.transform = 'scale(1.3) rotate(' + (Math.random() * 20 - 10) + 'deg)';
         setTimeout(() => {
             petAnimation.style.transform = 'scale(1) rotate(0deg)';
         }, 500);

         if (chatBox.style.display !== 'flex') {
             chatBox.style.display = 'flex';
             document.getElementById('userInput').focus();
         }
     });

     // Cho phép nhấn Enter để gửi tin nhắn
     document.getElementById('userInput').addEventListener('keypress', function(event) {
         if (event.key === 'Enter') {
             sendMessage();
         }
     });

     function sendMessage() {
         const input = document.getElementById('userInput');
         const message = input.value.trim();
         if (!message) return;

         const chatDisplay = document.getElementById('chatbox');
         chatDisplay.innerHTML += `<div class="message user">${message}</div>`;
         input.value = "";

         // Hiển thị hiệu ứng đang nhập
         const typingIndicator = document.createElement('div');
         typingIndicator.className = 'typing-indicator';
         typingIndicator.innerHTML = '<span></span><span></span><span></span>';
         chatDisplay.appendChild(typingIndicator);
         chatDisplay.scrollTop = chatDisplay.scrollHeight;

         // Giả lập thời gian phản hồi
         setTimeout(() => {
             chatDisplay.removeChild(typingIndicator);

             // Gửi dữ liệu đến server
             fetch("/chatbot", {
                 method: "POST",
                 headers: {
                     "Content-Type": "application/json",
                     "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                 },
                 body: JSON.stringify({ message: message })
             })
             .then(res => res.json())
             .then(data => {
                 console.log("Received response:", data); // Ghi log kiểm tra phản hồi
                 chatDisplay.innerHTML += `<div class="message bot">${data.reply}</div>`;
                 chatDisplay.scrollTop = chatDisplay.scrollHeight;

                 // Animate the pet emoji
                 petAnimation.style.transform = 'scale(1.2) rotate(' + (Math.random() * 10 - 5) + 'deg)';
                 setTimeout(() => {
                     petAnimation.style.transform = 'scale(1) rotate(0deg)';
                 }, 300);
             })
             .catch(error => {
                 console.error("Error:", error); // Ghi log lỗi
                 chatDisplay.innerHTML += `<div class="message bot">Oops, có lỗi xảy ra rồi nè! 😿 Bạn vui lòng thử lại sau nhé.</div>`;
                 chatDisplay.scrollTop = chatDisplay.scrollHeight;
             });
         }, 1000);
     }

     // Animation loop for the pet
     setInterval(() => {
         if (Math.random() > 0.7) {
             petAnimation.style.transform = 'scale(' + (1 + Math.random() * 0.1) + ') rotate(' + (Math.random() * 6 - 3) + 'deg)';
             setTimeout(() => {
                 petAnimation.style.transform = 'scale(1) rotate(0deg)';
             }, 300);
         }
     }, 3000);
 </script>
