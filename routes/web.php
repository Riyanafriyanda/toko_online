<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransaksiController;

// Route publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/add-to-cart', [TransaksiController::class, 'create'])->name('addTocart');
Route::post('/cart/remove/{id}', [TransaksiController::class, 'remove'])->name('cart.remove');

Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
Route::get('/newProduct', [HomeController::class, 'newProduct'])->name('newProduct');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/checkOut', [HomeController::class, 'checkOut'])->name('checkOut');
Route::post('/checkout/proses', [TransaksiController::class, 'prosesCheckout'])->name('prosesCheckout');

// Route login admin
Route::get('/admin', [HomeController::class, 'login'])->name('login');
Route::post('/admin/loginProses', [HomeController::class, 'loginProses'])->name('loginProses');

// Route admin yang dilindungi middleware
Route::middleware('admin.auth')->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/logout', [HomeController::class, 'logout'])->name('logout');
    Route::get('/admin/product', [ProductController::class, 'index'])->name('product');
    Route::get('/admin/report', [HomeController::class, 'report'])->name('report');

    Route::get('/admin/user_management', [UserController::class, 'index'])->name('userManagement');
    Route::get('/admin/modalUser', [UserController::class, 'addModalUser'])->name('modalUser');
    Route::post('/admin/addUser', [UserController::class, 'store'])->name('addUser');
    Route::get('/admin/editUser/{id}', [UserController::class, 'edit'])->name('editUser');
    Route::put('/admin/updateDataUser/{id}', [UserController::class, 'update'])->name('updateDataUser');
    Route::delete('/admin/deleteUser/{id}', [UserController::class, 'destroy'])->name('deleteDataUser');

    Route::get('/admin/addModal', [ProductController::class, 'addModal'])->name('addModal');
    Route::post('/admin/addData', [ProductController::class, 'store'])->name('addData');
    Route::get('/admin/editModal/{id}', [ProductController::class, 'edit'])->name('editModal');
    Route::put('/admin/updateData/{id}', [ProductController::class, 'update'])->name('updateData');
    Route::delete('/admin/deleteData/{id}', [ProductController::class, 'destroy'])->name('deleteData');
});
