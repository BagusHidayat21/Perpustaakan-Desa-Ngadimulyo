<?php

namespace App\Http\Controllers;

use App\Models\Buku_Fisik;
use App\Models\Jenis_Buku;
use App\Models\PengurusPerpus;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Buku_Digital;

class HomeController extends Controller
{
    public function index()
    {
        $bukus = Buku_Digital::select('*')
                            ->selectRaw('jumlah_dibaca + buku_favorit AS popular_score') // Menambahkan bobot favorit ke jumlah dibaca
                            ->orderBy('popular_score', 'desc') // Mengurutkan berdasarkan skor popularitas
                            ->get();
        $jenis_bukus = Jenis_Buku::all();
        $jumlahDigital = Buku_Digital::count();
        $jumlahFisik = Buku_Fisik::count();
        $jumlahJenis = Jenis_Buku::count();
        $jumlahUser = User::count();
        $totalBuku = $jumlahDigital + $jumlahFisik;
        return view('layout.home', compact('bukus','jenis_bukus','totalBuku','jumlahDigital','jumlahFisik','jumlahUser','jumlahJenis'));
    }

    public function about()
    {
        $jenis_bukus = Jenis_Buku::all();
        $jumlahDigital = Buku_Digital::count();
        $jumlahFisik = Buku_Fisik::count();
        $jumlahJenis = Jenis_Buku::count();
        $jumlahUser = User::count();
        $penguruses = PengurusPerpus::all();
        return view('feature.about.about',compact('jenis_bukus','jumlahDigital','jumlahFisik','jumlahUser','jumlahJenis','penguruses'));
    }

    // Admin

    public function kelola_user(){
        return view('admin.daftar_user');
    }


}
