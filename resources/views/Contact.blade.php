@extends('layouts.master')
@section('content')
<!-- Contact Start -->
<div class="container-fluid pt-5">
    <div class="container">
        <div class="border-start border-5 border-danger ps-5 mb-5" style="max-width: 600px;">
            <h6 class="text-danger text-uppercase">Liên lạc</h6>
            <h1 class="display-5 text-uppercase mb-0">Xin vui lòng liên hệ với chúng tôi</h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-7">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-12">
                            <input type="text" name="name" class="form-control bg-light border-0 px-4" placeholder="Your Name" style="height: 55px;" required>
                        </div>
                        <div class="col-12">
                            <input type="email" name="email" class="form-control bg-light border-0 px-4" placeholder="Your Email" style="height: 55px;" required>
                        </div>
                        <div class="col-12">
                            <input type="text" name="subject" class="form-control bg-light border-0 px-4" placeholder="Subject" style="height: 55px;" required>
                        </div>
                        <div class="col-12">
                            <textarea name="message" class="form-control bg-light border-0 px-4 py-3" rows="8" placeholder="Message" required></textarea>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-danger w-100 py-3" type="submit">Gửi Tin Nhắn</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-lg-5">
                <div class="bg-light mb-5 p-5">
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-geo-alt fs-1 text-danger me-3"></i>
                        <div class="text-start">
                            <h6 class="text-uppercase mb-1">Văn Phòng Chúng Tôi</h6>
                            <span>309, Nguyễn Thiếp, Phường Trung Đô, Thành Phố Vinh</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <i class="bi bi-envelope-open fs-1 text-danger me-3"></i>
                        <div class="text-start">
                            <h6 class="text-uppercase mb-1">Địa Chỉ Email </h6>
                            <span>PNTP_ET@example.com</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-4">
                        <i class="bi bi-phone-vibrate fs-1 text-danger me-3"></i>
                        <div class="text-start">
                            <h6 class="text-uppercase mb-1">Liên Hệ</h6>
                            <span>+84 339 573 127</span>
                        </div>
                    </div>
                    <div>
                        <iframe class="position-relative w-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                            frameborder="0" style="height: 205px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
@endsection
