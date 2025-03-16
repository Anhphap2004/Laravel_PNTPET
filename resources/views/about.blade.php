@extends('layouts.master')
@section('content')
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


<!-- Phần "Những Nhà Sáng Lập" -->
<div class="container-fluid py-5">
    <div class="container">
        <div class="border-start border-5 border-danger ps-5 mb-5" style="max-width: 600px;">
            <h6 class="text-danger text-uppercase">Những Nhà Sáng Lập</h6>
            <h1 class="display-5 text-uppercase mb-0">Chuyên Gia Chăm Sóc Thú Cưng</h1>
        </div>

        <div class="owl-carousel team-carousel position-relative" style="padding-right: 25px;">
            @foreach ($owners as $owner)
                <div class="team-item">
                    <div class="position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="{{ asset('img/Owners/' . $owner->image) }}" alt="{{ $owner->name }}">
                        <div class="team-overlay">
                            <div class="d-flex align-items-center justify-content-start">
                                @if (!empty($owner->zalo))
                                    <a class="btn btn-light btn-square mx-1" href="{{ $owner->zalo }}" target="_blank">
                                        <i class="bi bi-twitter"></i>
                                    </a>
                                @endif
                                @if (!empty($owner->facebook))
                                    <a class="btn btn-light btn-square mx-1" href="{{ $owner->facebook }}" target="_blank">
                                        <i class="bi bi-facebook"></i>
                                    </a>
                                @endif
                                @if (!empty($owner->tiktok))
                                    <a class="btn btn-light btn-square mx-1" href="{{ $owner->tiktok }}" target="_blank">
                                        <i class="bi bi-linkedin"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="bg-light text-center p-4">
                        <h5 class="text-uppercase">{{ $owner->name }}</h5>
                        <p class="m-0">{{ $owner->position }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
