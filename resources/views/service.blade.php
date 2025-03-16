@extends('layouts.master')
@section('content')
<!-- Services Start -->
<div class="container-fluid py-5">
    <div class="container">
        <div style="border-color: #dc3545;" class="border-start border-5 ps-5 mb-5" style="max-width: 600px;">
            <h6 style="color: #dc3545;" class="text-uppercase">Dịch Vụ</h6>
            <h5 style="color: #050505;" class="display-6 text-uppercase mb-0">Dịch Vụ Chăm Sóc Thú Cưng Tốt Nhất</h5>
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
@endsection
