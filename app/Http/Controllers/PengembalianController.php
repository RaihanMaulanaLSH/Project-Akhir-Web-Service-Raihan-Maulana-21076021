<?php

namespace App\Http\Controllers;

use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function pengembalian()
    {
        $data = Pengembalian::get();
        $imgPath = Pengembalian::get();
        return view('pengembalian', compact('data'));
    }

    
}
