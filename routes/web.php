<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\JenisBukuController;
use App\Http\Controllers\PengurusController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\PhysicBookController;
use App\Http\Controllers\DigitalBookController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Http\Request;

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

// ---------------------- USER ROUTES (No Login Required) ----------------------

Route::get('/api/check-login', function (Request $request) {
    return response()->json(['isLoggedIn' => auth()->check()]);
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [ContactUsController::class, 'contact'])->name('contact');
Route::post('/kirim', [ContactUsController::class, 'store'])->name('masukan.store');
Route::get('/404', [UserController::class, 'error404'])->name('error404');

// Agenda (User)
Route::prefix('agenda')->group(function () {
Route::get('/', [AgendaController::class, 'index'])->name('agenda');
Route::get('/detail/{id}', [AgendaController::class, 'agenda_detail'])->name('agenda.detail');
});

// Buku Digital (User)
Route::prefix('buku-digital')->group(function () {
    Route::get('/', [DigitalBookController::class, 'index'])->name('buku.digital');
    Route::middleware('auth')->group(function () {
        Route::get('/detail/{id}', [DigitalBookController::class, 'detail'])->name('buku.digital.detail');
        Route::post('/store', [DigitalBookController::class, 'store_favorit'])->name('buku-digital.store');
    });
    Route::get('/jenis/{id}', [DigitalBookController::class, 'filterByJenis'])->name('buku.digital.jenis');
    Route::get('/baca/{id}', [DigitalBookController::class, 'bacaBuku'])->name('buku.baca');
    Route::post('/search-buku', [DigitalBookController::class, 'search'])->name('search.buku');
});

// Buku Fisik (User)
Route::prefix('buku-fisik')->group(function () {
    Route::get('/', [PhysicBookController::class, 'index'])->name('buku.fisik');
    Route::get('/detail', [PhysicBookController::class, 'detail'])->name('buku.fisik.detail');
    Route::get('/search', [PhysicBookController::class, 'ajaxSearch'])->name('buku.ajaxSearch');
});

//User
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ---------------------- ADMIN ROUTES (Protected by Middleware) ----------------------

Route::middleware(['admin'])->group(function () {

    // Dashboard & User Management
    Route::get('/admin', [UserController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/kelola-user', [UserController::class, 'kelola_user'])->name('admin.kelola.user');

    Route::put('admin/{id}', [UserController::class, 'update'])->name('admin.kelola.user.edit');
    Route::delete('admin/{id}}', [UserController::class, 'destroy'])->name('admin.kelola.user.destroy');

    // Buku Digital (Admin)
    Route::prefix('admin/buku-digital')->group(function () {
        Route::get('/daftar', [DigitalBookController::class, 'daftar_buku_digital'])->name('buku.digital.daftar');
        Route::get('/tambah', [DigitalBookController::class, 'tambah_buku_digital'])->name('buku.digital.tambah');
        Route::post('/store', [DigitalBookController::class, 'store'])->name('buku.digital.store');
        Route::get('/export', [DigitalBookController::class, 'export'])->name('buku.digital.export');
        Route::post('/import', [DigitalBookController::class, 'import'])->name('buku.digital.import');
        // Route::get('/dibaca', [DigitalBookController::class, 'daftar_buku_dibaca'])->name('buku.digital.dibaca');
        Route::get('/terfavorit', [DigitalBookController::class, 'daftar_buku_terfavorit'])->name('buku.digital.terfavorit');
        Route::put('/{id}', [DigitalBookController::class, 'update'])->name('buku.digital.update');
        Route::delete('/{id}', [DigitalBookController::class, 'destroy'])->name('buku.digital.hapus');
    });

    // Buku Fisik (Admin)
    Route::prefix('admin/buku-fisik')->group(function () {
        Route::get('/daftar', [PhysicBookController::class, 'daftar_buku_fisik'])->name('buku.fisik.daftar');
        Route::get('/tambah', [PhysicBookController::class, 'tambah_buku_fisik'])->name('buku.fisik.tambah');
        Route::post('/store', [PhysicBookController::class, 'store'])->name('buku.fisik.store');
        Route::get('/export', [PhysicBookController::class, 'export'])->name('buku.fisik.export');
        Route::post('/import', [PhysicBookController::class, 'import'])->name('buku.fisik.import');
        Route::put('/{id}', [PhysicBookController::class, 'update_fisik'])->name('buku.fisik.update');
        Route::delete('/{id}', [PhysicBookController::class, 'destroy'])->name('buku.fisik.hapus');
    });

    // Jenis Buku (Admin)
    Route::prefix('admin/jenis-buku')->group(function () {
        Route::get('/', [JenisBukuController::class, 'daftar_jenis_buku'])->name('jenis.buku.daftar');
        Route::post('/store', [JenisBukuController::class, 'tambah_jenis_buku'])->name('jenis.buku.store');
        Route::put('/{id}', [JenisBukuController::class, 'edit_jenis_buku'])->name('jenis.buku.edit');
        Route::delete('/{id}', [JenisBukuController::class, 'hapus_jenis_buku'])->name('jenis.buku.hapus');
    });

    // Agenda (Admin)
    Route::prefix('admin/agenda')->group(function () {
        Route::get('/tambah', [AgendaController::class, 'tambah_agenda'])->name('agenda.tambah');
        Route::post('/store', [AgendaController::class, 'tambah_agenda_store'])->name('agenda.store');
        Route::get('/daftar', [AgendaController::class, 'daftar_agenda'])->name('agenda.daftar');
        Route::put('/{id}', [AgendaController::class, 'update_agenda'])->name('agenda.update');
        Route::delete('/{id}', [AgendaController::class, 'destroy'])->name('agenda.hapus');
    });

    // Masukan (Feedback)
    Route::prefix('admin/masukan')->group(function () {
        Route::get('/daftar', [ContactUsController::class, 'kontak_us'])->name('masukan.daftar');
        Route::delete('/{id}', [ContactUsController::class, 'destroy'])->name('masukan.hapus');
    });

    // Pengurus
    Route::prefix('admin/pengurus')->group(function () {
        Route::get('/daftar', action: [PengurusController::class, 'index'])->name('pengurus.daftar');
        Route::post('/tambah', [PengurusController::class, 'store'])->name('pengurus.tambah');
        Route::put('/{id}', [PengurusController::class, 'update'])->name('pengurus.edit');
        Route::delete('/{id}', [PengurusController::class, 'destroy'])->name('pengurus.hapus');
    });
});

// ---------------------- AUTH ROUTES ----------------------
require __DIR__ . '/auth.php';
