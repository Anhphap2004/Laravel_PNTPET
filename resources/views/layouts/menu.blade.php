@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

    $menuItems = DB::table('menu_items')->where('status', 'active')->orderBy('order_index')->get();
    $isLoggedIn = Auth::check();
    $username = $isLoggedIn ? Auth::user()->name : null;
@endphp


<nav class="navbar navbar-expand-lg sticky-top py-3" style="background-color: #ffffff; box-shadow: 0 5px 15px rgba(220, 53, 69, 0.08);">
    <div class="container">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center"
            style="text-decoration: none; transition: transform 0.3s ease-in-out;"
            onmouseover="this.style.transform='scale(1.1)'"
            onmouseout="this.style.transform='scale(1)'">

            <div class="d-flex align-items-center">
                <i class="fa-solid fa-paw fs-1 me-2" style="color: #dc3545;"></i>
                <h1 class="m-0 text-uppercase fw-bold" style="font-size: 32px; font-weight: bold; letter-spacing: 2px;">
                    <span class="brand-title" style="color: #dc3545;">PNT</span> <span>PET</span>
                </h1>
            </div>
        </a>

        <!-- Toggle button -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                @foreach ($menuItems as $menu)
                    <a style="color: #b31818" href="{{ url($menu->url) }}" class="nav-item fw-bolder text-uppercase nav-link fw-medium mx-2 {{ request()->is(trim($menu->url, '/')) ? 'active' : '' }}">
                        {{ $menu->title }}
                    </a>
                @endforeach
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="nav-item mx-2" style="position: relative;"
                    onmouseover="document.getElementById('accountDropdown').style.display='block';"
                    onmouseout="document.getElementById('accountDropdown').style.display='none';">

                    <a href="#" class="nav-link fw-medium" style="color: #b31818;">
                        @if ($isLoggedIn)
                            Tài khoản <i class="bi bi-person-circle"></i>
                        @else
                            Đăng nhập <i class="bi bi-person"></i>
                        @endif
                    </a>

                    <!-- Dropdown content -->
                    <div id="accountDropdown" style="display: none; position: absolute; top: 100%; right: 0; min-width: 220px; background-color: white; border-radius: 10px; padding: 15px; box-shadow: 0 15px 35px rgba(220, 53, 69, 0.2);">
                        <div class="text-center mb-3">
                            <div style="width: 60px; height: 60px; margin: 0 auto; background: linear-gradient(45deg, #dc3545, #ff6b81); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="bi bi-person-fill" style="font-size: 30px; color: white;"></i>
                            </div>
                          @if (Auth::check())
    <p>Xin chào, <strong>{{ Auth::user()->username }}</strong></p>
@else
    <p>Chưa đăng nhập</p>
@endif


                        </div>

                        @if ($isLoggedIn)
                            <a href="{{ route('profile') }}" class="btn w-100 mb-2 btn-outline-danger">
                                <i class="bi bi-person-circle me-2"></i> Hồ sơ
                            </a>
                            <a href="{{ route('orders') }}" class="btn w-100 mb-2 btn-outline-danger">
                                <i class="bi bi-bag-check me-2"></i> Đơn hàng
                            </a>
<form action="{{ route('logout') }}" method="POST" class="w-100">
    @csrf
    <button type="submit" class="btn w-100 btn-danger">
        <i class="bi bi-box-arrow-right me-2"></i> Đăng xuất
    </button>
</form>
                        @else
                           <!-- Nếu chưa đăng nhập -->
                            <a href="{{ route('login') }}" class="btn w-100 mb-2"
                                style="background: white; color: #dc3545; border: 2px solid #dc3545; border-radius: 30px; padding: 8px 15px; transition: all 0.3s ease; font-weight: 500;">
                                <i class="bi bi-box-arrow-in-right me-2"></i> Đăng nhập
                            </a>
                            <a href="{{ route('register') }}" class="btn w-100"
                                style="background: linear-gradient(45deg, #dc3545, #ff6b81); color: white; border: none; border-radius: 30px; padding: 10px 15px; transition: all 0.3s ease; font-weight: 500; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);">
                                <i class="bi bi-person-plus me-2"></i> Đăng ký
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact button -->
             <div>
                <a href="{{ route('contact.show') }}" class="btn px-4 py-2"
                    style="background: linear-gradient(45deg, #dc3545, #ff6b81); color: white; border-radius: 30px; box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3); transition: all 0.3s ease; font-weight: 500;">
                    Liên hệ <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</nav>

