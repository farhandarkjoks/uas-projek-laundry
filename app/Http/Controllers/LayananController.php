<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Menggunakan DB Facade untuk koneksi lokal

class LayananController extends Controller
{
    /**
     * Menampilkan halaman daftar layanan (mengambil dari MySQL lokal)
     */
    public function index()
    {
        // Mengambil seluruh data dari tabel 'services' di localhost Laragon
        $services = DB::table('services')->get();

        // Jika data di view dikirim sebagai array biasa (karena bawaan json Supabase),
        // kita transform object hasil query builder menjadi array agar view-mu tidak error.
        $services = json_decode(json_encode($services), true);

        return view('layanan', compact('services'));
    }

    /**
     * Menampilkan halaman form pemesanan / kasir dengan data layanan lokal
     */
    public function order()
    {
        // Mengambil seluruh data dari tabel 'services' di localhost Laragon
        $services = DB::table('services')->get();

        // Konversi ke array untuk menjaga kecocokan struktur data sebelumnya di file blade
        $services = json_decode(json_encode($services), true);

        return view('pesan', compact('services'));
    }
}