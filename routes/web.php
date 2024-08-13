<?php

use Illuminate\Support\Facades\Route;
use App\Models\VegeProduct;
use App\Http\Controllers\VegeUserController;

Route::get('/register', [VegeUserController::class, 'showRegisterForm'])->name('vege_register');
Route::post('/register', [VegeUserController::class, 'register'])->name('vege_register');

Route::get('/vege_verify-otp', [VegeUserController::class, 'showVerifyOtpForm'])->name('verify_otp');
Route::post('/vege_verify-otp', [VegeUserController::class, 'verifyOtp'])->name('verify.otp');

Route::get('/login', [VegeUserController::class, 'showLoginForm'])->name('vege_login');
Route::post('/login', [VegeUserController::class, 'login']);

Route::get('/addproduct/{id}', [VegeUserController::class, 'addProduct'])->name('addproduct'); // Updated

Route::post('/logout', [VegeUserController::class, 'logout'])->name('logout');

Route::get('/products', [VegeUserController::class, 'showProducts'])->name('products');
Route::get('/product/{id}', [VegeUserController::class, 'showProductDetails'])->name('product.details');


Route::get('/vege_home', function () {
    return view('vegetables.home',[
        'products' => VegeProduct::all()
    ]);
})->name('home');
