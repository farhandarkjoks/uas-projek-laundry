<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Menggunakan DB Facade untuk MySQL lokal

class LayananController extends Controller
{
    /**
     * Menampilkan halaman pesan dengan daftar layanan dari MySQL Lokal (Laragon)
     */
    public function order()
    {
        try {
            // Ambil data layanan langsung dari tabel 'services' di localhost
            $services = DB::table('services')->get();

            // Konversi dari format Object Collection ke Array murni 
            // agar kompatibel dengan perulangan ($item['name']) di view pesan.blade.php kamu
            $services = json_decode(json_encode($services), true);

            // Kirim data $services ke view pesan.blade.php
            return view('pesan', compact('services'));

        } catch (\Exception $e) {
            // Jika ada masalah dengan database lokal (misal tabel belum di-migrate)
            return view('pesan', [
                'services' => [], 
                'error' => 'Gagal terhubung ke database lokal: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Opsional: Fungsi untuk memproses data saat tombol "Lanjutkan ke Checkout" ditekan
     */
    public function checkout(Request $request)
    {
        // Karena proses checkout dan store sudah kamu handle dengan mantap di OrderController,
        // fungsi checkout di sini bisa kamu biarkan kosong atau hapus jika tidak dipakai di route.
    }
}