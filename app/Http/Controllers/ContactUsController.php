<?php

namespace App\Http\Controllers;

use App\Models\Buku_Kontak;
use App\Models\Jenis_Buku;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    //
    public function contact()
    {
        $jenis_bukus = Jenis_Buku::all();
        return view('feature.contact.contact', compact('jenis_bukus'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:buku__kontaks,email',
            'pesan' => 'required',
        ], [
            'email.unique' => 'Email sudah digunakan oleh user lain.',
        ]);

        // Simpan data lainnya ke database
        $buku = new Buku_Kontak();
        $buku->nama = $request->input('nama');
        $buku->email = $request->input('email');
        $buku->pesan = $request->input('pesan');

        // Simpan data ke database
        $buku->save();

        // Jika berhasil, tampilkan SweetAlert untuk pesan sukses
        return redirect()->back()->with('success', 'Pesan Berhasil Dikirim');
    }

    public function kontak_us(){
        $pesans = Buku_Kontak::all();
        return view('admin.kontak_us', compact('pesans'));
    }

    public function destroy($id)
    {
        // Temukan buku berdasarkan ID dan hapus
        $buku = Buku_Kontak::findOrFail($id);
        $buku->delete();

        return redirect()->back()->with('success', 'Data pesan berhasil dihapus');
    }

}
