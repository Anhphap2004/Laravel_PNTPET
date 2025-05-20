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
    Route::delete('/admin/menu/destroy/{id}', [AdminMenuController::class, 'destroy'])->name('admin.menu.destroy');
});

use App\Http\Controllers\LogoutAdminController;

Route::post('/admin/logout', [LogoutAdminController::class, 'logoutAdmin'])->name('admin.logout');




use App\Http\Controllers\AdminUserController;

Route::post('/users/store', [AdminUserController::class, 'store'])->name('admin.users.store');
Route::get('/admin/users', [AdminUserController::class, 'index'])->name('admin.users.index');
Route::get('/users/create', [AdminUserController::class, 'create'])->name('admin.users.create');
// Route xem chi tiết người dùng
Route::get('admin/users/detail/{id}', [AdminUserController::class, 'show'])->name('admin.users.show');
Route::delete('admin/users/destroy/{id}', [AdminUserController::class, 'destroy'])->name('admin.users.destroy');

Route::get('/users/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.users.edit');
Route::put('/users/update/{id}', [AdminUserController::class, 'update'])->name('admin.users.update');

use App\Http\Controllers\AdminAboutController;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/about', [AdminAboutController::class, 'index'])->name('admin.about.index');
    Route::get('about/create', [AdminAboutController::class, 'create'])->name('admin.about.create');
    Route::post('about/store', [AdminAboutController::class, 'store'])->name('admin.about.store');
    Route::put('about/{id}', [AdminAboutController::class, 'update'])->name('admin.about.update');
    // 👉 Route edit và update
    Route::get('/about/{id}/edit', [AdminAboutController::class, 'edit'])->name('admin.about.edit');
});

use App\Http\Controllers\AdminServicesController;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/services', [AdminServicesController::class, 'index'])->name('admin.services.index');
    Route::get('/services/create', [AdminServicesController::class, 'create'])->name('admin.services.create');
    Route::post('/services/store', [AdminServicesController::class, 'store'])->name('admin.services.store');
    // routes/web.php
    Route::get('admin/services/{id}', [AdminServicesController::class, 'show'])->name('admin.services.show');
    // routes/web.php
    Route::delete('admin/services/{id}', [AdminServicesController::class, 'destroy'])->name('admin.services.destroy');

    Route::get('/services/{id}/edit', [AdminServicesController::class, 'edit'])->name('admin.services.edit');
    Route::put('/services/{id}', [AdminServicesController::class, 'update'])->name('admin.services.update');
});

use App\Http\Controllers\AdminAnimalsController;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/animals', [AdminAnimalsController::class, 'index'])->name('admin.animals.index');
    Route::get('/animals/create', [AdminAnimalsController::class, 'create'])->name('admin.animals.create');
    Route::post('/animals/store', [AdminAnimalsController::class, 'store'])->name('admin.animals.store');
    Route::get('/animals/{id}', [AdminAnimalsController::class, 'show'])->name('admin.animals.show');
    Route::delete('/animals/{id}', [AdminAnimalsController::class, 'destroy'])->name('admin.animals.destroy');
    Route::get('/animals/{id}/edit', [AdminAnimalsController::class, 'edit'])->name('admin.animals.edit');
    Route::put('/animals/{id}', [AdminAnimalsController::class, 'update'])->name('admin.animals.update');
});

use App\Http\Controllers\AdminBlogController;

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/blogs', [AdminBlogController::class, 'index'])->name('admin.blogs.index');
    Route::get('/blogs/create', [AdminBlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/blogs/store', [AdminBlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('/blogs/{id}/edit', [AdminBlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::put('/blogs/{id}', [AdminBlogController::class, 'update'])->name('admin.blogs.update');
    Route::delete('/blogs/{id}', [AdminBlogController::class, 'destroy'])->name('admin.blogs.destroy');
    Route::get('/blogs/{id}', [AdminBlogController::class, 'show'])->name('admin.blogs.show');
});

use App\Http\Controllers\AdminContactController;

Route::prefix('admin')->name('admin.')->group(function () {
    // Hiển thị danh sách contact messages
    Route::get('contact', [AdminContactController::class, 'index'])->name('contact.index');
    Route::post('/admin/contact/update-status/{id}', [AdminContactController::class, 'updateStatus'])->name('admin.contact.updateStatus');

    // Hiển thị chi tiết contact message
    Route::get('contact/{id}', [AdminContactController::class, 'show'])->name('contact.show');


    // Xóa contact message
    Route::delete('contact/{id}', [AdminContactController::class, 'destroy'])->name('contact.destroy');
});

use App\Http\Controllers\AdminAnimalCategoryController;

Route::prefix('admin')->middleware('auth')->group(function () {
    // Route để liệt kê danh mục động vật
    Route::get('/animalcategories', [AdminAnimalCategoryController::class, 'index'])->name('admin.animalcategories.index');

    // Route để tạo danh mục động vật mới
    Route::get('/animalcategories/create', [AdminAnimalCategoryController::class, 'create'])->name('admin.animalcategories.create');
    Route::post('/animalcategories/store', [AdminAnimalCategoryController::class, 'store'])->name('admin.animalcategories.store');

    // Route để chỉnh sửa danh mục động vật
    Route::get('/animalcategories/{id}/edit', [AdminAnimalCategoryController::class, 'edit'])->name('admin.animalcategories.edit');

    Route::put('/animalcategories/{id}', [AdminAnimalCategoryController::class, 'update'])->name('admin.animalcategories.update');

    // Route để xóa danh mục động vật
    Route::delete('/animalcategories/{id}', [AdminAnimalCategoryController::class, 'destroy'])->name('admin.animalcategories.destroy');

    // Route để xem chi tiết danh mục động vật
    Route::get('/animalcategories/{id}', [AdminAnimalCategoryController::class, 'show'])->name('admin.animalcategories.show');
});


use App\Http\Controllers\LuckyDrawController;

Route::get('/lucky-draw', [LuckyDrawController::class, 'showDrawPage'])->name('lucky.draw');
Route::post('/spin-wheel', [LuckyDrawController::class, 'spinWheel'])->name('spin.wheel');



use App\Http\Controllers\ChatbotController;

// Route trang chủ, load giao diện index.blade.php
Route::get('/', [HomeController::class, 'index'])->name('home');

// Route API chatbot, nhận message và trả lời, gọi bằng fetch AJAX
Route::post('/chatbot', 'App\Http\Controllers\ChatbotController@handle');
