<?php

namespace App\Http\Controllers;

use App\Models\PengurusPerpus;
use Illuminate\Http\Request;
use Storage;

class PengurusController extends Controller
{
    public function index()
    {
        $penguruses = PengurusPerpus::all();
        return view('admin.daftar_pengurus', compact('penguruses'));
    }

    public function store(Request $request)
    {
        // Validasi input
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'jabatan' => 'nullable|string|max:255',
                'foto' => 'nullable|image|mimes:jpg,jpeg,png', // Max 2MB
                'instagram' => 'nullable|url|max:255',
                'facebook' => 'nullable|url|max:255',
            ]);

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Simpan di storage/app/public/uploads/foto_pengurus
                $filePath = $file->storeAs('uploads/foto_pengurus', $fileName, 'public');

                // Simpan path yang akan digunakan untuk akses publik
                $validatedData['foto'] = $filePath;  // Contoh: 'uploads/foto_pengurus/nama_foto.jpg'
            }

        // Simpan data ke database
            PengurusPerpus::create($validatedData);
            return redirect()->route('pengurus.daftar')->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'nullable|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png',
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
        ]);

        // Temukan data pengurus berdasarkan ID
        $pengurus = PengurusPerpus::findOrFail($id);

// Cek apakah ada file foto baru yang diunggah
if ($request->hasFile('foto')) {
    // Hapus foto lama jika ada
    if ($pengurus->foto) {
        // Menghapus file foto lama dari storage
        Storage::disk('public')->delete($pengurus->foto);
    }

    // Proses upload foto baru
    $file = $request->file('foto');
    $fileName = time() . '_' . $file->getClientOriginalName();

    // Simpan foto baru di storage/app/public/uploads/foto_pengurus
    $filePath = $file->storeAs('uploads/foto_pengurus', $fileName, 'public');

    // Simpan path foto yang baru untuk akses publik
    $validatedData['foto'] = $filePath;  // Contoh: 'uploads/foto_pengurus/nama_foto.jpg'
}

        // Update data pengurus
        $pengurus->update($validatedData);

        // Redirect ke halaman daftar pengurus dengan pesan sukses
        return redirect()->route('pengurus.daftar')->with('success', 'Pengurus berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Cari data pengurus berdasarkan ID
        $pengurus = PengurusPerpus::findOrFail($id);

        // Jika pengurus memiliki foto, hapus file foto dari storage
        if ($pengurus->foto) {
            $fotoPath = public_path($pengurus->foto);
            if (file_exists($fotoPath)) {
                unlink($fotoPath); // Menghapus file dari folder
            }
        }

        // Hapus data pengurus dari database
        $pengurus->delete();

        // Redirect ke halaman daftar pengurus dengan pesan sukses
        return redirect()->route('pengurus.daftar')->with('success', 'Pengurus berhasil dihapus.');
    }

}
