<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Kiểm tra kết nối database
Route::get('/check-db', [DatabaseController::class, 'checkConnection'])->name('check.db');
Route::get('/service', [ServiceController::class, 'index'])->name('service');

Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index'); // Danh sách thú cưng
Route::get('/animals/{animal_id}', [AnimalController::class, 'detail'])->name('animals.show');
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{post_id}', [BlogController::class, 'show'])->name('blog.detail');

// Route hiển thị form đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route xử lý đăng nhập (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route đăng xuất (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route hiển thị form đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.submit');

// Route trang liên hệ
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::post('/animal/review', [AnimalController::class, 'submitReview'])->name('animal.review.submit');
Route::post('/blog/comment', [BlogController::class, 'blogcomment'])->name('blogcomment.submit');

// Trang cá nhân và đơn hàng
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/orders', function () {
    return view('orders');
})->name('orders');


// Trang admin (có kiểm tra quyền)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

use App\Http\Controllers\AdminMenuController;

Route::prefix('admin')->group(function () {
    Route::get('/menu', [AdminMenuController::class, 'index'])->name('admin.menu.index');
    Route::get('/menu/create', [AdminMenuController::class, 'create'])->name('admin.menu.create');
    Route::post('/menu/store', [AdminMenuController::class, 'store'])->name('admin.menu.store');
    Route::get('/menu/edit/{id}', [AdminMenuController::class, 'edit'])->name('admin.menu.edit');
    Route::post('/menu/update/{id}', [AdminMenuController::class, 'update'])->name('admin.menu.update');
    Route::post('/menu/destroy/{id}', [AdminMenuController::class, 'destroy'])->name('admin.menu.destroy');
});

use App\Http\Controllers\LogoutAdminController;

Route::post('/admin/logout', [LogoutAdminController::class, 'logoutAdmin'])->name('admin.logout');
