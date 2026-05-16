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

        // Dipastikan datanya terlempar rapi dalam bentuk array murni ke view payment
        return view('orders.payment', [
            'items' => $selectedItems,
            'totalPrice' => $totalPrice
        ]);
    }

    /**
     * Menyimpan data transaksi ke database Localhost & mengarahkan ke halaman sukses
     */
    public function store(Request $request)
    {
        // 1. Validasi kiriman form dari blade checkout
        $request->validate([
            'items'           => 'required|string',
            'payment_method'  => 'required|string',
            'delivery_type'   => 'required|string',
            'user_phone'      => 'required|string',
            'delivery_address'=> 'required_if:delivery_type,Antar Jemput|nullable',
        ]);

        $selectedItems = json_decode($request->items, true);
        
        // 2. Hitung total dasar dari item laundry
        $subtotal = 0;
        foreach ($selectedItems as $item) {
            $subtotal += $item['price'] * $item['qty'];
        }

        // Tambah biaya tambahan 10k jika user minta diantar jemput
        $deliveryFee = ($request->delivery_type === 'Antar Jemput') ? 10000 : 0;
        $grandTotal = $subtotal + $deliveryFee;

        $user = Auth::user();
        
        // Buat variabel penampung ID transaksi di luar closure transaction
        $transactionId = null;

        // 3. Proses penyimpanan ganda dengan Database Transaction (Localhost MySQL)
        DB::transaction(function () use ($selectedItems, $grandTotal, $request, $user, &$transactionId) {
            
            // Simpan ke tabel induk: `transactions`
            $transactionId = DB::table('transactions')->insertGetId([
                'user_id'        => $user->id,
                'invoice_code'   => 'INV-' . strtoupper(Str::random(8)),
                'total_price'    => $grandTotal,
                'status'         => 'Diterima', 
                'address'        => $request->delivery_address ?? '-', 
                'phone'          => $request->user_phone,              
                'payment_method' => $request->payment_method,
                'delivery_type'  => $request->delivery_type,           
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);

            // Simpan ke tabel detail: `transaction_details`
            foreach ($selectedItems as $item) {
                DB::table('transaction_details')->insert([
                    'transaction_id' => $transactionId,
                    'service_id'     => $item['id'], 
                    'quantity'       => $item['qty'],
                    'price'          => $item['price'],
                    'subtotal'       => $item['price'] * $item['qty'],
                    'created_at'     => now(),
                    'updated_at'     => now(),
                ]);
            }
        });

        // 4. Ambil data transaksi barusan dari database local
        $transaction = DB::table('transactions')->where('id', $transactionId)->first();

        // 5. Tembak langsung ke view order success kamu dengan membawa data transaksi tunggal!
        return view('order-success', compact('transaction'));
    }
}