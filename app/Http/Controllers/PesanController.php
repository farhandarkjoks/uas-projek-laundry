<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LayananController extends Controller
{
    /**
     * Menampilkan halaman pesan dengan daftar layanan dari Supabase
     */
    public function order()
    {
        try {
            // Ambil data layanan dari Supabase
            $response = Http::withHeaders([
                'apikey' => env('SUPABASE_KEY'),
                'Authorization' => 'Bearer ' . env('SUPABASE_KEY'),
            ])->get(env('SUPABASE_URL') . '/rest/v1/services?select=*');

            // Cek jika request sukses
            if ($response->successful()) {
                $services = $response->json();
            } else {
                $services = [];
            }

            // Kirim data $services ke view pesan.blade.php
            return view('pesan', compact('services'));

        } catch (\Exception $e) {
            // Jika koneksi internet bermasalah
            return view('pesan', ['services' => [], 'error' => 'Gagal terhubung ke server.']);
        }
    }

    /**
     * Opsional: Fungsi untuk memproses data saat tombol "Lanjutkan ke Checkout" ditekan
     */
    public function checkout(Request $request)
    {
        // Di sini nanti tempat kamu memproses data pesanan yang dipilih user
        // Untuk sekarang, bisa dikosongkan dulu atau buat logika simpan data.
    }
}