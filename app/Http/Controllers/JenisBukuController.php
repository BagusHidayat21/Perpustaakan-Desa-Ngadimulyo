<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jenis_Buku;

class JenisBukuController extends Controller
{

    public function daftar_jenis_buku()
    {
        $bukus = Jenis_Buku::all();
        return view('admin.daftar_jenis_buku', compact('bukus'));
    }

    public function tambah_jenis_buku(Request $request)
    {
        $request->validate([
            'jenis_buku' => 'required'
        ]);
        $buku = new Jenis_Buku();
        $buku->jenis_buku = $request->input('jenis_buku');

        // Simpan data ke database
        $buku->save();

        return redirect()->back()->with('success', 'Data jenis buku berhasil disimpan!');
    }

    public function edit_jenis_buku(Request $request, $id)
    {
        // Temukan buku berdasarkan ID dan hapus
        $request->validate([
            'jenis_buku' => 'required'
        ]);
        $buku = Jenis_Buku::findOrFail($id);
        $buku->jenis_buku = $request->input('jenis_buku');

        // Simpan data ke database
        $buku->save();

        return redirect()->back()->with('success', 'Data buku berhasil diupdate!');
    }
    public function hapus_jenis_buku($id)
    {
        // Temukan buku berdasarkan ID dan hapus
        $buku = Jenis_Buku::findOrFail($id);
        $buku->delete();

        return redirect()->back()->with('success', 'Data buku berhasil dihapus!');
    }
}
