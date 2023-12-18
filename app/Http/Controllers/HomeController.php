<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Komik;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function index()
    {
        $data = User::get();
        return view('index', compact('data'));
    }

    public function komik()
    {
        $data = Komik::get();
        $imgPath = Komik::get();
        return view('komik', compact('data'));
    }

    public function createkom(Request $request)
    {
        $id_komik = $request->input('id_komik', 0);
        $data = User::all();
        return view('createkom', compact('data'));
    }

    public function create()
    {
        return view('create');
    }

    public function dbs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        // Simpan data user setelah validasi berhasil
        User::create([
            'email' => $request->input('email'),
            'name' => $request->input('nama'),
            'password' => bcrypt($request->input('password')),
            'role' => $request->input('role', 'admin'),
            // Jangan lupa sesuaikan dengan kolom lainnya
        ]);

        // Berikan pesan flash untuk memberi informasi ke pengguna
        return redirect()->route('user.index')->with('success', 'User berhasil ditambahkan!');
    }

    public function dbk(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul_comic' => 'required',
            'pengarang' => 'required',
            'pemilik' => 'required',
            'sinopsis' => 'required',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Mendapatkan file gambar dari request
        $imgFile = $request->file('img');

        // Membuat nama file gambar menggunakan judul komik (slug)
        $filename = Str::slug($request->input('judul_comic')) . '_' . time() . '.' . $imgFile->getClientOriginalExtension();

        // Mengunggah gambar dan mendapatkan path penyimpanan
        $imgPath = $imgFile->move(public_path('skydash/images'), $filename);

        // Simpan data komik setelah validasi berhasil
        Komik::create([
            'judul_comic' => $request->input('judul_comic'),
            'pengarang' => $request->input('pengarang'),
            'pemilik' => $request->input('pemilik'),
            'sinopsis' => $request->input('sinopsis'),
            'gambar_komik' => $imgPath,
            // Sesuaikan dengan kolom lainnya
        ]);

        // Berikan pesan flash untuk memberi informasi ke pengguna
        return redirect()->route('index')->with('success', 'Data komik berhasil ditambahkan!');
    }

    public function modifykom(Request $request, $id_komik)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'judul_comic' => 'required',
            'pengarang' => 'required',
            'pemilik' => 'required',
            'sinopsis' => 'required',
            'img' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Biarkan tidak wajib diisi untuk memungkinkan pembaruan tanpa mengganti gambar
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan data komik berdasarkan ID
        $komik = Komik::find($id_komik);

        if (!$komik) {
            return redirect()->back()->with('error', 'Data komik tidak ditemukan!');
        }

        // Perbarui data komik setelah validasi berhasil
        $komik->judul_comic = $request->input('judul_comic');
        $komik->pengarang = $request->input('pengarang');
        $komik->pemilik = $request->input('pemilik');
        $komik->sinopsis = $request->input('sinopsis');

        // Cek apakah ada file gambar yang diunggah
        if ($request->hasFile('img')) {
            // Hapus gambar lama sebelum mengunggah yang baru
            Storage::delete($komik->gambar_komik);

            // Mendapatkan file gambar dari request
            $imgFile = $request->file('img');

            // Membuat nama file gambar menggunakan judul komik (slug)
            $filename = Str::slug($request->input('judul_comic')) . '_' . time() . '.' . $imgFile->getClientOriginalExtension();

            // Mengunggah gambar dan mendapatkan path penyimpanan
            $imgPath = $imgFile->move(public_path('skydash/images'), $filename);

            // Simpan path gambar yang baru
            $komik->gambar_komik = $imgPath;
        }

        // Simpan perubahan data komik
        $komik->save();

        // Berikan pesan flash untuk memberi informasi ke pengguna
        return redirect()->route('index')->with('success', 'Data komik berhasil diperbarui!');
    }

    public function editkom($id_komik)
    {
        // dd('OKe bisa ga guys');

        $data = Komik::find($id_komik);

        return view('editkom', compact('data'));
    }

    public function editus($id)
    {
        // dd('OKe bisa ga guys');

        $data = User::find($id);

        return view('editus', compact('data'));
    }

    public function modifyus(Request $request, $id)
    { //dd($request->all());
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Temukan data user berdasarkan ID
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Data user tidak ditemukan!');
        }

        // Perbarui data user setelah validasi berhasil
        $user->email = $request->input('email');
        $user->name = $request->input('nama');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role', 'admin'); // Jangan lupa sesuaikan dengan kolom lainnya

        // Simpan perubahan data user
        $user->save();

        // Berikan pesan flash untuk memberi informasi ke pengguna
        return redirect()->route('user.index')->with('success', 'Data user berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // dd('pokr');
        $user = User::findOrFail($id);

        // Hapus foto dari storage jika ada
        // if ($user->foto) {
        //     Storage::delete('public/photo-profile/' . $user->foto);
        // }

        // Hapus user dari database
        $user->delete();

        return redirect()->route('user.index')->with('sukses', 'Data dihapus');
    }

    public function destroy_komik($id_komik)
    {
        // dd('pokr');
        $komik = Komik::findOrFail($id_komik);

        // Hapus foto dari storage jika ada
        // if ($user->foto) {
        //     Storage::delete('public/photo-profile/' . $user->foto);
        // }

        // Hapus user dari database
        $komik->delete();

        return redirect()->route('index')->with('sukses', 'Data dihapus');
    }


}