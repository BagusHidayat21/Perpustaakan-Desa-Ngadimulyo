<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Jenis_Buku;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AgendaController extends Controller
{

    public function index(){
        $agendas = Agenda::all();

        $jenis_bukus = Jenis_Buku::all();

        foreach ($agendas as $agenda) {
            $agenda->formatted_date = Carbon::parse($agenda->created_at)->translatedFormat('d F Y');
        }

        return view('feature.agenda.agenda', compact('agendas', 'jenis_bukus'));
    }

    public function agenda_detail($id)
    {
        $agenda = Agenda::findOrFail($id);
        $jenis_bukus = Jenis_Buku::all();
        $formattedDate = Carbon::parse($agenda->created_at)->translatedFormat('d F Y');

        return view('feature.agenda.agenda-detail', compact('agenda', 'jenis_bukus', 'formattedDate'));
    }

    public function tambah_agenda(){
        return view('admin.tambah_agenda');
    }
    public function daftar_agenda(){
        $agendas = Agenda::all();
        return view('admin.daftar_agenda', compact('agendas'));
    }
    public function tambah_agenda_store(Request $request){
        // Validasi input
        $request->validate([
            'judul_agenda' => 'required',
            'foto_agenda' => 'required|file|mimes:jpeg,png,jpg',
            'isi_agenda' => 'required',
        ]);

        // Simpan cover agenda
        $fotoAgenda = $request->file('foto_agenda')->store('uploads/foto_agenda', 'public');

        // Simpan data lainnya ke database
        $agenda = new Agenda();
        $agenda->judul_agenda = $request->input('judul_agenda');
        $agenda->foto_agenda = $fotoAgenda;
        $agenda->isi_agenda = $request->input('isi_agenda');


        // Simpan data ke database
        $agenda->save();

        return redirect()->route('agenda.daftar')->with('success', 'Data agenda berhasil ditambahkan');
    }

    public function update_agenda(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul_agenda' => 'required',
            'foto_agenda' => 'nullable|mimes:jpeg,png,jpg',
            'isi_agenda' => 'required',
        ]);

        // Temukan agenda berdasarkan ID dan perbarui datanya
        $agenda = Agenda::findOrFail($id);
        $agenda->judul_agenda = $request->input('judul_agenda');
        $agenda->isi_agenda = $request->input('isi_agenda');

        // Update cover agenda jika ada yang baru
        if ($request->hasFile('foto_agenda')) {
            // Hapus file lama
            Storage::disk('public')->delete($agenda->foto_agenda);

            // Simpan cover baru
            $fotoAgenda = $request->file('foto_agenda')->store('uploads/foto_agenda', 'public');
            $agenda->foto_agenda = $fotoAgenda;
        }

        $agenda->save();

        return redirect()->back()->with('success', 'Data agenda berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Temukan agenda berdasarkan ID dan hapus
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return redirect()->back()->with('success', 'Data agenda berhasil dihapus');
    }
}
