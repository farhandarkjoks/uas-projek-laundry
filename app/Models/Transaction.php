<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Mengarahkan model agar membaca tabel 'transactions' di database
    protected $table = 'transactions';

    // Mengizinkan kolom-kolom ini diisi secara massal jika nanti pakai Eloquent
    protected $fillable = [
        'user_id',
        'invoice_code',
        'total_price',
        'status',
        'address',
        'phone',
        'payment_method',
        'delivery_type',
    ];

    /**
     * Relasi ke data User / Pelanggan yang memesan (Many-to-One)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke detail transaksi (One-to-Many)
     * Menghubungkan ke banyak item baju/sepatu yang dicuci di transaction_details
     */
    public function details()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id');
    }
}