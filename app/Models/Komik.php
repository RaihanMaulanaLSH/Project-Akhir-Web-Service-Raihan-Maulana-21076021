<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Import the Str class

class Komik extends Model
{
    protected $table = 'komik'; // Sesuaikan dengan nama tabel komik Anda
    protected $fillable = ['judul_comic', 'pengarang', 'gambar_komik', 'pemilik', 'sinopsis']; // Kolom-kolom yang dapat diisi
    protected $primaryKey = 'id_komik'; // Kolom primary key


    public static function boot()
    {
        parent::boot();

        // Memotong sinopsis jika panjangnya lebih dari 255 karakter
        static::saving(function ($komik) {
            $komik->sinopsis = Str::limit($komik->sinopsis, 255);
        });
    }

    // Pada model Komik
public function pemilikModel()
{
    return $this->belongsTo(User::class, 'pemilik', 'id');
}

}
