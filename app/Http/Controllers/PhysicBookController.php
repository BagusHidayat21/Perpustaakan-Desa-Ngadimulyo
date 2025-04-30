<?php

namespace App\Http\Controllers;

use App\Exports\BukuFisikExport;
use App\Imports\BukuFisikImport;
use App\Models\Buku_Fisik;
use App\Models\Jenis_Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class PhysicBookController extends Controller
{
    public function index()
    {
        $books = Buku_Fisik::paginate(10);
        $jenis_bukus = Jenis_Buku::all();
        return view('feature.buku.buku-fisik', compact('books','jenis_bukus'));
    }

    public function detail()
    {
        return view('feature.buku.buku-detail');
    }

    public function ajaxSearch(Request $request)
    {
        $search = $request->input('search');

        $books = Buku_Fisik::when($search, function ($query) use ($search) {
            return $query->where('judul_buku', 'like', '%' . $search . '%');
        })->get();

        return response()->json($books);
    }



    // Halaman Admin
    public function daftar_buku_fisik(){
        $bukus = Buku_Fisik::all();
        $jenisBuku = Jenis_Buku::all();
        return view('admin.daftar_buku_fisik', compact('bukus', 'jenisBuku'));
    }

    public function tambah_buku_fisik(){
        $jenisBuku = Jenis_Buku::all();
        return view('admin.tambah_buku_fisik', compact('jenisBuku'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul_buku' => 'required',
            'jenis_buku' => 'required',
            'penulis_buku' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric|digits:4',
            'nomor_buku' => 'required',
            'status' => 'required',
            'cover_buku' => 'required|file|mimes:jpeg,png,jpg',
        ]);

        // Simpan cover buku
        $coverBukuPath = $request->file('cover_buku')->store('uploads/covers_fisik', 'public');

        // Simpan data lainnya ke database
        $buku = new Buku_Fisik();
        $buku->judul_buku = $request->input('judul_buku');
        $buku->jenis_buku = $request->input('jenis_buku');
        $buku->penulis = $request->input('penulis_buku');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun_terbit = $request->input('tahun_terbit');
        $buku->nomor_buku = $request->input('nomor_buku');
        $buku->status = $request->input('status');
        $buku->cover_buku = $coverBukuPath;

        // Simpan data ke database
        $buku->save();

        return redirect()->route('buku.fisik.daftar')->with('success', 'Data buku berhasil ditambahkan');
    }

    public function update_fisik(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul_buku' => 'required',
            'jenis_buku' => 'required',
            'penulis_buku' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric|digits:4',
            'nomor_buku' => 'required',
            'status' => 'required',
            'cover_buku' => 'nullable|mimes:jpeg,png,jpg',
        ]);

        // Temukan buku berdasarkan ID dan perbarui datanya
        $buku = Buku_Fisik::findOrFail($id);
        $buku->judul_buku = $request->input('judul_buku');
        $buku->jenis_buku = $request->input('jenis_buku');
        $buku->penulis = $request->input('penulis_buku');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun_terbit = $request->input('tahun_terbit');
        $buku->nomor_buku = $request->input('nomor_buku');
        $buku->status = $request->input('status');

        // Update cover buku jika ada yang baru
        if ($request->hasFile('cover_buku')) {
            // Hapus file lama
            Storage::disk('public')->delete($buku->cover_buku);

            // Simpan cover baru
            $coverBukuPath = $request->file('cover_buku')->store('uploads/covers_fisik', 'public');
            $buku->cover_buku = $coverBukuPath;
        }

        $buku->save();

        return redirect()->back()->with('success', 'Data buku berhasil diperbarui');
    }


    public function destroy($id)
    {
        // Temukan buku berdasarkan ID dan hapus
        $buku = Buku_Fisik::findOrFail($id);
        $buku->delete();

        return redirect()->back()->with('success', 'Data buku berhasil dihapus');
    }

    public function export()
    {
        return Excel::download(new BukuFisikExport, 'BukuFisik.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new BukuFisikImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data Berhasil Diimpor.');
    }
}
