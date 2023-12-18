<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     echo'Hallo dunia';
// });

; 

Route::get('/', [LoginController::class, 'index'])->name('login');

Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::middleware('auth')->group(
//     function () {
// // Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin'], function(){
//     // Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
//     // Route::get('/user', [HomeController::class, 'index'])->name('user.index');
//     // Route::get('/create', [HomeController::class, 'create'])->name('user.create');
//     // Route::post('/dbs', [HomeController::class, 'dbs'])->name('user.dbs');
//     // Route::post('/dbk', [HomeController::class, 'dbk'])->name('komik.dbk');
//     // Route::get('/komik', [HomeController::class, 'komik'])->name('index');
//     // Route::get('/createkom', [HomeController::class, 'createkom'])->name('komik.createkom');
//     // Route::get('/editkom/{id_komik}', [HomeController::class, 'editkom'])->name('edit.komik');
//     // Route::patch('/modify/{id_komik}', [HomeController::class, 'modifykom'])->name('modify.komik');
// // });
//     }

Route::middleware('auth')->group(
    function () {
        Route::get('/register', [LoginController::class, 'register'])->name('register');
        Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/user', [HomeController::class, 'index'])->name('user.index');
    Route::get('/create', [HomeController::class, 'create'])->name('user.create');
    Route::post('/dbs', [HomeController::class, 'dbs'])->name('user.dbs');
    Route::get('/editus/{id}', [HomeController::class, 'editus'])->name('edit.user');
    Route::patch('/modifyus/{id}', [HomeController::class, 'modifyus'])->name('modify.user');
    Route::get('/user-destroy/{id}', [HomeController::class, 'destroy'])->name('destroy.user');


    Route::post('/dbk', [HomeController::class, 'dbk'])->name('komik.dbk');
    Route::get('/komik', [HomeController::class, 'komik'])->name('index');
    Route::get('/createkom', [HomeController::class, 'createkom'])->name('komik.createkom');
    Route::get('/editkom/{id_komik}', [HomeController::class, 'editkom'])->name('edit.komik');
    Route::patch('/modify/{id_komik}', [HomeController::class, 'modifykom'])->name('modify.komik');
    Route::get('/komik-destroy/{id_komik}', [HomeController::class, 'destroy_komik'])->name('destroy.komik');

    Route::get('/peminjaman', [PeminjamanController::class, 'peminjaman'])->name('peminjaman.index');
    Route::get('/crpeminjaman', [PeminjamanController::class, 'crpeminjaman'])->name('peminjaman.crpeminjaman');
    Route::post('/crpe', [PeminjamanController::class, 'crpe'])->name('peminjaman.crpe');
    Route::get('/editpemin/{id_peminjaman}', [PeminjamanController::class, 'editpemin'])->name('edit.peminjaman');
    Route::patch('/modifypem/{id_peminjaman}', [PeminjamanController::class, 'modifypem'])->name('modify.peminjaman');
    Route::get('/pemin-destroy/{id_pemin}', [PeminjamanController::class, 'destroy_pemin'])->name('destroy.pemin');

    Route::get('/pengembalian', [PengembalianController::class, 'pengembalian'])->name('pengembalian.index');

}
);