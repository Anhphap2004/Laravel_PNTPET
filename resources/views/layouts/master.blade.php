<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>PET SHOP - Pet Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playball&display=swap" rel="stylesheet">
    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.leanhduc.pro.vn/utilities/multi-color-star-effects/style.css" rel="stylesheet" />
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Roboto:wght@700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('lib/flaticon/font/flaticon.css') }}">
    <link rel="stylesheet" href="{{ url('lib/owlcarousel/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">

</head>

<body>
    <canvas id="canvas" style="position:fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 9999;"></canvas>
    <!-- PHẦN KHỞI TẠO MENU  Start -->

    {{-- Nhúng Menu navbar vào --}}
    @include('layouts.menu')
  @yield('content')
    <!-- Ưu Đãi Đặc Biệt Bắt Đầu -->
    <div class="container-fluid bg-offer my-5 py-5">
        <div class="container py-5">
            <div class="row gx-5 justify-content-start">
                <div class="col-lg-7">
                    <div class="border-start border-5 border-dark ps-5 mb-5">
                        <h6 class="text-dark text-uppercase">Ưu Đãi Đặc Biệt</h6>
                        <h1 class=" text-uppercase text-white mb-0">Giảm 50% cho tất cả dịch vụ</h1>
                    </div>
                    <p class="text-white mb-4">Nhanh tay đặt lịch ngay để nhận ưu đãi hấp dẫn! Cơ hội có hạn, đừng bỏ lỡ.</p>
                    <a href="" class="btn btn-light py-md-3 px-md-5 me-3">Đặt Ngay</a>
                    <a href="" class="btn btn-outline-light py-md-3 px-md-5">Tìm Hiểu Thêm</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Ưu Đãi Đặc Biệt Kết Thúc -->






    <!-- Bắt Đầu Chân Trang -->
    <div class="container-fluid bg-light mt-5 py-5">
        <div class="container pt-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Liên Hệ</h5>
                    <p class="mb-4">Chúng tôi luôn sẵn sàng hỗ trợ bạn. Liên hệ ngay để được tư vấn tốt nhất!</p>
                    <p class="mb-2"><i class="bi bi-geo-alt text-danger me-2"></i>309 Nguyễn Thiếp, TP VINH, Việt Nam</p>
                    <p class="mb-2"><i class="bi bi-envelope-open text-danger me-2"></i>Pntpet@example.com</p>
                    <p class="mb-0"><i class="bi bi-telephone text-danger me-2"></i>+84 339 573 127</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Liên Kết Nhanh</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Trang Chủ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Về Chúng Tôi</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Dịch Vụ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Đội Ngũ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Blog</a>
                        <a class="text-body" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Liên Hệ</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Liên Kết Phổ Biến</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Trang Chủ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Về Chúng Tôi</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Dịch Vụ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Đội Ngũ</a>
                        <a class="text-body mb-2" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Blog</a>
                        <a class="text-body" href="#"><i class="bi bi-arrow-right text-danger me-2"></i>Liên Hệ</a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-uppercase border-start border-5 border-danger ps-3 mb-4">Bản Tin</h5>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control p-3" placeholder="Nhập Email của bạn">
                            <button class="btn btn-danger">Đăng Ký</button>
                        </div>
                    </form>
                    <h6 class="text-uppercase mt-4 mb-3">Theo Dõi Chúng Tôi</h6>
                    <div class="d-flex">
                        <a class="btn btn-outline-danger btn-square me-2" href="#"><i class="bi bi-twitter"></i></a>
                        <a class="btn btn-outline-danger btn-square me-2" href="#"><i class="bi bi-facebook"></i></a>
                        <a class="btn btn-outline-danger btn-square me-2" href="#"><i class="bi bi-linkedin"></i></a>
                        <a class="btn btn-outline-danger btn-square" href="#"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
                <div class="col-12 text-center text-body">
                    <a class="text-body" href="#">Điều Khoản & Điều Kiện</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Chính Sách Bảo Mật</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Hỗ Trợ Khách Hàng</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Thanh Toán</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Trợ Giúp</a>
                    <span class="mx-1">|</span>
                    <a class="text-body" href="#">Câu Hỏi Thường Gặp</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white-50 py-4">
        <div class="container">
            <div class="row g-5">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-md-0">&copy; <a class="text-white" href="#">PNTPET</a>. Mọi quyền được bảo lưu.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Thiết kế bởi <a class="text-white" href="https://facebook.com/Anhphap2004">AnhhPhapp</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Kết Thúc Chân Trang -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-danger py-3 fs-4 back-to-top"><i class="bi bi-arrow-up"></i></a>

    <script src="https://cdn.leanhduc.pro.vn/jquery/3.6.0.min.js"></script>
    <script src="https://cdn.leanhduc.pro.vn/utilities/multi-color-star-effects/main.js"></script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('lib/easing/easing.min.js') }}"></script>
    <script src="{{ url('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ url('lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <!-- Template Javascript -->
    <script src="{{ url('js/main.js')}}"></script>
</body>

</html>
