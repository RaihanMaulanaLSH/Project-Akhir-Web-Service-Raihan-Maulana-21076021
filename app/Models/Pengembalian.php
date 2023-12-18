<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    protected $table = 'pengembalian';
    protected $primaryKey = 'id_pengembalian';

    // Tambahkan kolom id_peminjaman ke dalam properti $fillable
    protected $fillable = ['id_peminjaman', 'status', /* tambahkan kolom-kolom lain jika ada */];

    // Definisikan hubungan dengan tabel peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }
    
    // Definisikan hubungan dengan tabel status (jika diperlukan)
    public function status()
    {
        return $this->belongsTo(Status::class, 'status');
    }
}
