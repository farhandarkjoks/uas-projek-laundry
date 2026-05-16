<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Menampilkan halaman pilihan pembayaran & konfirmasi akhir
     */
    public function checkout(Request $request)
    {
        $request->validate([
            'items' => 'required|string', 
        ]);

        $selectedItems = json_decode($request->items, true);

        if (empty($selectedItems)) {
            return redirect()->back()->with('error', 'Silakan pilih layanan terlebih dahulu.');
        }

        $totalPrice = 0;
        foreach ($selectedItems as $item) {
            $totalPrice += $item['price'] * $item['qty'];
        }

        return view('orders.payment', [
            'items' => $selectedItems,
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * Menyimpan data transaksi ke database Supabase (Tabel transactions & transaction_details)
     */
    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        $selectedItems = json_decode($request->items, true);
        
        $totalPrice = 0;
        foreach ($selectedItems as $item) {
            $totalPrice += $item['price'] * $item['qty'];
        }

        // Ambil data user yang sedang login untuk mengisi alamat & hp otomatis jika ada
        $user = Auth::user();

        // Menggunakan Database Transaction agar jika salah satu tabel gagal, semua dibatalkan (aman)
        DB::transaction(function () use ($selectedItems, $totalPrice, $request, $user) {
            
            // 1. Simpan ke tabel induk: `transactions`
            $transactionId = DB::table('transactions')->insertGetId([
                'user_id'        => $user->id,
                'invoice_code'   => 'INV-' . strtoupper(Str::random(8)),
                'total_price'    => $totalPrice,
                'status'         => 'Diterima', // Status awal tracking laundry
                'address'        => $user->address ?? '-', 
                'phone'          => $user->phone ?? '-',
                'payment_method' => $request->payment_method,
                'delivery_type'  => 'Standard', // Default delivery
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            // 2. Simpan ke tabel detail: `transaction_details`
            foreach ($selectedItems as $item) {
                DB::table('transaction_details')->insert([
                    'transaction_id' => $transactionId,
                    'service_id'     => $item['id'], // ID dari layanan (kiloan/selimut/sepatu)
                    'quantity'       => $item['qty'],
                    'price'          => $item['price'],
                    'subtotal'       => $item['price'] * $item['qty'],
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
            }
        });

        return redirect()->route('dashboard')->with('status', 'Pesanan laundry berhasil dibuat! Silakan pantau status di dashboard.');
    }
}