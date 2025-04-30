<?php

namespace App\Http\Controllers;

use App\Exports\BukuDigitalExport;
use App\Imports\BukuDigitalImport;
use Illuminate\Http\Request;
use App\Models\Buku_Digital;
use App\Models\Buku_Favorit;
use App\Models\Jenis_Buku;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;


class DigitalBookController extends Controller
{
    public function index(Request $request)
    {
        // Ambil opsi sort dari request
        $sort = $request->input('sort');

        // Query untuk mengambil data buku dengan urutan berdasarkan pilihan
        if ($sort == '1') {
            // Paling Banyak Dibaca
            $bukus = Buku_Digital::orderBy('jumlah_dibaca', 'desc')->paginate(9);
        } elseif ($sort == '2') {
            // Baru Ditambahkan
            $bukus = Buku_Digital::orderBy('created_at', 'desc')->paginate(9);
        } else {
            // Default (semua buku tanpa urutan tertentu)
            $bukus = Buku_Digital::paginate(10);
        }
        $jumlahBuku = Buku_Digital::count();
        $jenis_bukus = Jenis_Buku::all();
        return view('feature.buku.buku-digital', compact('bukus', 'jumlahBuku', 'jenis_bukus'));
    }

    public function detail($id)
    {
        $buku = Buku_Digital::findOrFail($id);
        $jenis_bukus = Jenis_Buku::all();

        $isFavorited = Buku_Favorit::where('id_user', Auth::id())
            ->where('id_buku', $buku->id)
            ->exists();

        return view('feature.buku.buku-detail', compact('buku', 'jenis_bukus', 'isFavorited'));
    }

    public function search(Request $request)
    {
        $request->validate([
            'keyword' => 'required|string|max:255',
        ]);

        // Mengambil keyword dari form pencarian
        $keyword = $request->input('keyword');

        // Melakukan pencarian buku berdasarkan judul atau jenis buku
        $bukus = Buku_Digital::where('judul_buku', 'LIKE', "%{$keyword}%")->get();

        // Menghitung jumlah buku yang ditemukan
        $jumlahBuku = $bukus->count();
        $jenis_bukus = Jenis_Buku::all();

        // Mengirim data ke view
        return view('feature.buku.buku-search', compact('bukus', 'jumlahBuku','jenis_bukus'));
    }


    // Halaman Admin
    public function daftar_buku_digital()
    {
        $bukus = Buku_Digital::all();
        $jenis = Jenis_Buku::all();
        return view('admin.daftar_buku_digital', compact('bukus', 'jenis'));
    }

    public function tambah_buku_digital()
    {
        $bukus = Jenis_Buku::all();
        return view('admin.tambah_buku_digital', compact('bukus'));
    }

    public function daftar_buku_terfavorit()
    {
        $terfavorit = Buku_Favorit::join('users', 'buku__favorits.id_user', '=', 'users.id')
            ->join('buku__digitals', 'buku__favorits.id_buku', '=', 'buku__digitals.id')
            ->select('users.nama_lengkap', 'buku__digitals.judul_buku')
            ->distinct()
            ->get();

        return view('admin.daftar_buku_terfavorit', compact('terfavorit'));
    }


    public function store_favorit(Request $request)
    {
        $request->validate([
            'id_buku' => 'required|exists:buku__digitals,id',
        ]);

        $userId = Auth::id();
        $bukuId = $request->id_buku;

        $existingFavorit = Buku_Favorit::where('id_user', $userId)
            ->where('id_buku', $bukuId)
            ->first();

        if ($existingFavorit) {
            // Jika buku sudah ada di favorit
            return back()->with('info', 'Buku ini sudah ada di favorit Anda!');
        }

        // Simpan data ke tabel buku__favorits
        Buku_Favorit::create([
            'id_user' => $userId,
            'id_buku' => $bukuId,
        ]);

        // Update kolom buku_favorit di tabel buku__digitals
        Buku_Digital::where('id', $bukuId)->increment('buku_favorit');

        return back()->with('success', 'Buku berhasil ditambahkan ke favorit!');
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
            'file_buku' => 'required|file|mimes:pdf',
            'cover_buku' => 'required|file|mimes:jpeg,png,jpg',
        ]);

        // Simpan file buku
        $fileBukuPath = $request->file('file_buku')->store('uploads/buku', 'google');
        $id=Storage::disk('google')->getAdapter()->getMetadata($fileBukuPath)->extraMetadata()['id'];

        // Simpan cover buku
        $coverBukuPath = $request->file('cover_buku')->store('uploads/covers', 'public');

        // Simpan data lainnya ke database
        $buku = new Buku_Digital();
        $buku->judul_buku = $request->input('judul_buku');
        $buku->jenis_buku = $request->input('jenis_buku');
        $buku->penulis = $request->input('penulis_buku');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun_terbit = $request->input('tahun_terbit');
        $buku->sinopsis = $request->input('sinopsis_buku');
        $buku->file_buku = $id;
        $buku->cover_buku = $coverBukuPath;

        // Simpan data ke database
        $buku->save();

        return redirect()->to(route('buku.digital.daftar'))->with('success', 'Data buku berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul_buku' => 'required',
            'jenis_buku' => 'required',
            'penulis_buku' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|numeric|digits:4',
            'sinopsis_buku' => 'required',
            'file_buku' => 'nullable|file|mimes:pdf',
            'cover_buku' => 'nullable|file|mimes:jpeg,png,jpg',
        ]);

        // Temukan buku berdasarkan ID dan perbarui datanya
        $buku = Buku_Digital::findOrFail($id);
        $buku->judul_buku = $request->input('judul_buku');
        $buku->jenis_buku = $request->input('jenis_buku');
        $buku->penulis = $request->input('penulis_buku');
        $buku->penerbit = $request->input('penerbit');
        $buku->tahun_terbit = $request->input('tahun_terbit');
        $buku->sinopsis = $request->input('sinopsis_buku');

        // Update file buku jika ada yang baru
        if ($request->hasFile('file_buku')) {
            // Hapus file lama
            Storage::disk('public')->delete($buku->file_buku);
            Storage::disk('google')->delete($buku->file_buku);

            // Simpan file baru
            // Upload Buku ke Goole Drive
            $fileBukuPath = $request->file('file_buku')->store('uploads/buku', 'google');

            $buku->file_buku = $id;
        }

        // Update cover buku jika ada yang baru
        if ($request->hasFile('cover_buku')) {
            // Hapus file lama
            Storage::disk('public')->delete($buku->cover_buku);

            // Simpan cover baru
            $coverBukuPath = $request->file('cover_buku')->store('uploads/covers', 'public');
            $buku->cover_buku = $coverBukuPath;
        }

        $buku->save();

        return redirect()->back()->with('success', 'Data buku berhasil diperbarui!');
    }


    public function destroy($id)
    {
        // Temukan buku berdasarkan ID dan hapus
        $buku = Buku_Digital::findOrFail($id);
        $buku->delete();

        Storage::disk('google')->delete($buku->file_buku);

        return redirect()->back()->with('success', 'Data buku berhasil dihapus!');
    }

    public function bacaBuku($id)
    {
        // Temukan buku berdasarkan ID
        $buku = Buku_Digital::findOrFail($id);

        // Tambahkan 1 ke jumlah dibaca
        $buku->increment('jumlah_dibaca');

        // Kembalikan response yang mengandung URL file buku
        return response()->json([
            'file_url' => "https://drive.google.com/file/d/{$buku->file_buku}/preview"
        ]);
    }

    public function filterByJenis(Request $request, $id)
    {
        // Ambil opsi sort dari request
        $sort = $request->input('sort');

        // Query dasar untuk mengambil data buku digital berdasarkan jenis_buku
        $query = Buku_Digital::join('jenis__bukus', 'buku__digitals.jenis_buku', '=', 'jenis__bukus.jenis_buku')
            ->select('buku__digitals.*') // Select all columns from buku_digital
            ->where('jenis__bukus.id', $id); // Filter by jenis_buku id

        // Tambahkan sorting berdasarkan pilihan pengguna
        if ($sort == '1') {
            // Paling Banyak Dibaca
            $query->orderBy('buku__digitals.jumlah_dibaca', 'desc');
        } elseif ($sort == '2') {
            // Baru Ditambahkan
            $query->orderBy('buku__digitals.created_at', 'desc');
        }

        // Paginate the filtered and sorted results
        $bukus = $query->paginate(9);

        // Hitung jumlah buku berdasarkan jenis_buku
        $jumlahBuku = $query->count();
        $jenis_bukus = Jenis_Buku::all();

        return view('feature.buku.buku-digital', compact('bukus', 'jumlahBuku', 'jenis_bukus'));
    }

    public function export()
    {
        return Excel::download(new BukuDigitalExport, 'BukuDigital.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new BukuDigitalImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data Berhasil Diimport.');
    }
}
