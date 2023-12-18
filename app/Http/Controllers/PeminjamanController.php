<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

use App\Models\User;
use App\Models\Komik;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class PeminjamanController extends Controller
{
    public function peminjaman()
    {
        // Mendapatkan id pengguna yang saat ini login
        $userId = Auth::id();
    
        // Mengambil data peminjaman yang terkait dengan pengguna yang login
        $data = Peminjaman::whereHas('peminjam', function ($query) use ($userId) {
            $query->where('id', $userId);
        })->get();
    
        return view('peminjaman', compact('data'));
    }

    public function crpeminjaman()
{
    // Mengambil pengguna yang sedang login
    $loggedInUser = Auth::user();

    // Hanya mengambil data pengguna yang sedang login
    $dataPeminjam = User::where('id', $loggedInUser->id)->get();

    $dataKomik = Komik::all();

    $dataaa = Peminjaman::all();

    // Menampilkan create.blade.php untuk membuat peminjaman baru dan mengirimkan data peminjam ke dalam view
    return view('crpeminjaman', ['dataPeminjam' => $dataPeminjam, 'dataKomik' => $dataKomik, 'dataaa' => $dataaa]);
}


public function crpe(Request $request)
{ 
    $validator = Validator::make($request->all(), [
        'id_peminjam' => 'required',
        'id_komik' => 'required',
        'status' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Simpan data peminjaman setelah validasi berhasil
    $peminjaman = Peminjaman::create([
        'id_peminjam' => $request->input('id_peminjam'),
        'id_komik' => $request->input('id_komik'),
        'status' => $request->input('status'),
    ]);

    // Simpan data ke tabel pengembalian
    Pengembalian::create([
        'id_peminjaman' => $peminjaman->id_peminjaman,
        'status' => $request->input('status'), // Menggunakan status yang sama seperti peminjaman, sesuaikan jika diperlukan
        // Tambahkan kolom-kolom lain sesuai kebutuhan
    ]);

    // Berikan pesan flash untuk memberi informasi ke pengguna
    return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil ditambahkan!');
}


    public function editpemin($id_peminjaman)
    {
        // dd('OKe bisa ga guys');

        $loggedInUser = Auth::user();

        // Mengambil semua pengguna kecuali pengguna yang sedang login
        $dataPeminjam = User::where('id', $loggedInUser->id)->get();

        $dataKomik = Komik::all();

        $dataaa = Peminjaman::all();

        $data = Peminjaman::find($id_peminjaman);

        return view('editpemin', [
            'data' => $data,
            'dataPeminjam' => $dataPeminjam,
            'dataKomik' => $dataKomik,
            'dataaa' => $dataaa,
            'id_peminjaman' => $id_peminjaman,
        ]);
    }
//     public function modifypem(Request $request, $id_peminjaman)
// {
//     // Validate the incoming request
//     $validator = Validator::make($request->all(), [
//         'id_peminjam' => 'required',
//         'id_komik' => 'required',
//         'status' => 'required',
//     ]);

//     if ($validator->fails()) {
//         return redirect()->back()->withErrors($validator)->withInput();
//     }
//     dd($request->all());
//     // Find the Peminjaman record by its ID
//     $peminjaman = Peminjaman::find($id_peminjaman);

//     if (!$peminjaman) {
//         return redirect()->route('index')->with('error', 'Data peminjaman tidak ditemukan!');
//     }

//     // Update the Peminjaman record with the new data
//     $peminjaman->update([
//         'id_peminjam' => $request->input('id_peminjam'),
//         'id_komik' => $request->input('id_komik'),
//         'status' => $request->input('status'),
//     ]);

//     // Redirect with a success message
//     return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui!');
// }

public function modifypem(Request $request, $id_peminjaman)
{
    // Validasi input
    $validator = Validator::make($request->all(), [
        'id_peminjam' => 'required',
        'id_peminjaman' => 'required',
        'id_komik' => 'required',
        'status' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Temukan data komik berdasarkan ID
    $peminjaman = Peminjaman::find($id_peminjaman);

    if (!$peminjaman) {
        return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan!');
    }

    // Perbarui data komik setelah validasi berhasil
    $peminjaman->id_peminjam = $request->input('id_peminjam');
    $peminjaman->id_peminjaman = $request->input('id_peminjaman');
    $peminjaman->id_komik = $request->input('id_komik');
    $peminjaman->status = $request->input('status');

    try {
        // Simpan perubahan data komik
        $peminjaman->save();
    } catch (\Exception $e) {
        // Tangkap dan tangani error database
        return redirect()->back()->with('error', 'Gagal menyimpan perubahan. Pesan kesalahan: ' . $e->getMessage());
    }

    // Berikan pesan flash untuk memberi informasi ke pengguna
    return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui!');
}

public function destroy_pemin($id_peminjaman)
    {
        // dd('pokr');
        $peminjaman = Peminjaman::findOrFail($id_peminjaman);

        // Hapus foto dari storage jika ada
        // if ($user->foto) {
        //     Storage::delete('public/photo-profile/' . $user->foto);
        // }

        // Hapus user dari database
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('sukses', 'Data dihapus');
    }




}
