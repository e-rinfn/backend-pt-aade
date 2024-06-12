<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjamans'; // Nama tabel yang diinginkan
    protected $fillable = [
        'barang_id', // ID barang yang dipinjam
        'jumlah',    // Jumlah barang yang dipinjam
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
}