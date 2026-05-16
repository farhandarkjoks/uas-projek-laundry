<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\OrderController; // Tambahan Controller Baru
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

// Halaman Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Halaman Daftar Layanan & Harga (Public)
Route::get('/layanan', [LayananController::class, 'index'])->name('layanan');

// Halaman Pesan Sekarang (Public agar bisa dibuka, tapi nanti dikunci di Blade)
Route::get('/pesan', [LayananController::class, 'order'])->name('pesan');

// Route Testing Supabase
Route::get('/test-supabase', function () {
    $response = Http::withHeaders([
        'apikey' => env('SUPABASE_KEY'),
        'Authorization' => 'Bearer ' . env('SUPABASE_KEY'),
    ])->get(env('SUPABASE_URL') . '/rest/v1/services?select=*');

    return $response->json();
});

// Fitur yang MEMERLUKAN LOGIN
Route::middleware('auth')->group(function () {
    
    // Halaman Dashboard
    Route::get('/welcome', function () {
        return view('welcome');
    })->middleware(['verified'])->name('dashboard');

    // ==========================================
    // ALUR PEMESANAN LAUNDRY BARU (SUPABASE)
    // ==========================================
    // Mengirim item pilihan dari halaman utama ke halaman opsi pembayaran
    Route::post('/order/checkout', [OrderController::class, 'checkout'])->name('order.checkout');

    // Menyimpan final transaksi ke tabel transactions & transaction_details di Supabase
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    // ==========================================

Route::view('/tentang-kami', 'tentangkami')->name('tentang-kami');

    // Fitur Profile 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Update Profile AJAX
    Route::post('/profile/update-address', [ProfileController::class, 'updateAddress'])->name('profile.update-address');
    Route::post('/profile/update-info', [ProfileController::class, 'updateInfo'])->name('profile.update-info');
});

require __DIR__.'/auth.php';