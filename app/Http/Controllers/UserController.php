<?php

namespace App\Http\Controllers;

use App\Models\Buku_Digital;
use App\Models\Buku_Fisik;
use App\Models\Buku_Kontak;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $totalBukuDigital = Buku_Digital::count();
        $totalBukuFisik = Buku_Fisik::count();
        $totalUser = User::count();
        $totalMasukanUser = Buku_Kontak::count();
        return view('admin.dashboard', compact('totalBukuDigital', 'totalBukuFisik', 'totalUser', 'totalMasukanUser'));
    }

    public function kelola_user()
    {
        $users = User::all();
        return view('admin.daftar_user', compact('users'));
    }

    public function error404()
    {
        return view('admin.404');
    }
}
