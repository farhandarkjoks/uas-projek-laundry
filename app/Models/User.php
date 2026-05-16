<?php

namespace App\Empty; // Sesuaikan dengan namespace project kamu, biasanya: namespace App\Models;

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Atribut yang dapat diisi secara massal (Mass Assignable)
     * Sudah disesuaikan untuk kebutuhan database MySQL lokal Laragon
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',     // Untuk membedakan Admin / Pelanggan
        'phone',    // Nomor HP lokal user
        'address',  // Alamat utama user
    ];

    /**
     * Atribut yang harus disembunyikan saat data di-render (di-convert ke Array/JSON)
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Mengubah tipe data kolom secara otomatis (Casting)
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // Password otomatis di-hash saat disimpan via Eloquent
        ];
    }

    /**
     * Relasi ke tabel Transactions (One-to-Many)
     * Satu user bisa memiliki banyak riwayat transaksi laundry
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }
}