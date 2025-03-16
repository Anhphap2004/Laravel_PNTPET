<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabaseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
// Kiểm tra kết nối database
Route::get('/check-db', [DatabaseController::class, 'checkConnection'])->name('check.db');
Route::get('/service', [ServiceController::class, 'index'])->name('service');

Route::get('/animals', [AnimalController::class, 'index'])->name('animals.index'); // Danh sách thú cưng
Route::get('/animals/{animal_id}', [AnimalController::class, 'detail'])->name('animals.show');
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog/{post_id}', [BlogController::class, 'show'])->name('blog.detail');;

// Route hiển thị form đăng nhập
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route xử lý đăng nhập (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Route đăng xuất (POST)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.submit');
// Route trang liên hệ
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/animal/review', [AnimalController::class, 'submitReview'])->name('animal.review.submit');
Route::post('/blog/comment', [BlogController::class, 'blogcomment'])->name('blogcomment.submit');
Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/orders', function () {
    return view('orders');
})->name('orders');


