<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id_peminjaman';

    protected $table = 'peminjaman';
    protected $fillable = ['id_komik', 'id_peminjam', 'status'];

    // Relasi dengan tabel Komik
    public function komik()
    {
        return $this->belongsTo(Komik::class, 'id_komik');
    }

    // Relasi dengan tabel User (Peminjam)
    public function peminjam()
    {
        return $this->belongsTo(User::class, 'id_peminjam');
    }
}
