<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Halaman Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Halaman Daftar Layanan & Harga (Public)
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');

// Halaman Pesan Sekarang (Public, proteksi login dilakukan di dalam Blade)
Route::get('/pesan', [LayananController::class, 'order'])->name('pesan');

// Halaman Tentang Kami (Public, dipindahkan ke luar middleware auth agar bisa dibaca semua pengunjung)
Route::view('/tentang-kami', 'tentangkami')->name('tentang-kami');


// FITUR YANG MEMERLUKAN LOGIN (AUTH)
Route::middleware('auth')->group(function () {
    
    // Halaman Dashboard Riwayat Transaksi Member
    Route::get('/dashboard', function () {
        return view('dashboard'); // Mengarah ke dashboard utama transaksi lokal kamu
    })->name('dashboard');

    // ==========================================
    // ALUR PEMESANAN LAUNDRY LOKAL (MYSQL)
    // ==========================================
    
    // Menampilkan halaman detail review opsi pengiriman & pembayaran
    Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

    // Menyimpan data final transaksi ke database MySQL lokal
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    
    // ==========================================

    // Fitur Manajemen Profile Akun
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Update Data Profile via AJAX
    Route::post('/profile/update-address', [ProfileController::class, 'updateAddress'])->name('profile.update-address');
    Route::post('/profile/update-info', [ProfileController::class, 'updateInfo'])->name('profile.update-info');
});

require __DIR__.'/auth.php';